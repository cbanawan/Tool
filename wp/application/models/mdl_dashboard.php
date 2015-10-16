<?php

/**
 * Description of mdl_dashboard
 *
 * @author rita
 */
class mdl_dashboard extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_begun_bids($researcher_id) {
        $query = "SELECT p.`project_country_id`,pm.project_name,pm.project_long_key,p.project_cpc,p.project_ncomplete,p.country_id, p.project_segments, p.segment_name "
                . "FROM " . TABLE_PROJECT_COUNTRY_MASTER . " p, " . TABLE_PROJECT_MASTER . " pm "
                . "WHERE p.country_id <> 0 and p.project_id = pm.project_id and p.is_delete = 0 "
                . "and p.`project_country_id` NOT IN ( select `project_country_id` "
                . "from " . TABLE_BID_REPLIES_MASTER . " b "
                . "where b.researcher_id = " . $researcher_id . ") "
                . "order by  p.`project_country_id` DESC";

        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function count_panalists() {
        $this->db->select('sum(number_panelists) as cnt');
        $query = $this->db->get(TABLE_PARTNER_SEGMENTS);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function get_awaiting_bids($researcher_id, $count = '') {
        $this->db->select('pm.project_name,pm.project_long_key, b.project_cpc,b.project_ncomplete,p.country_id, p.project_segments, p.segment_name, b.hide_cpc, b.partner_id, p.is_delete,b.bid_status');
        $this->db->where('b.researcher_id', $researcher_id);
        $this->db->where('b.bid_type', 1);
        $this->db->where('b.bid_status', 0);
        $this->db->where('b.is_read', 0);
        $this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " p", 'p.project_country_id = b.project_country_id');
        $this->db->join(TABLE_PROJECT_MASTER . " pm", 'pm.project_id = b.project_id');
        $query = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");
        if (isset($count) && $count != '') {
            return $query->num_rows();
        } else {
            if ($query->num_rows() > 0) {
                return $query->result();
            }
        }
        return false;
    }

    function get_awaiting_partner_bids($partner_id) {
        $this->db->select('pm.project_name,pm.project_long_key, b.project_cpc,b.project_ncomplete,p.country_id, p.project_segments, p.segment_name, b.hide_cpc, b.partner_id, p.is_delete,b.bid_status');
        $this->db->where('b.partner_id', $partner_id);
        $this->db->where('b.bid_type', 2);
        $this->db->where('b.bid_status', 1);
        $this->db->where('b.is_read', 0);
        $this->db->where("b.bid_id in (SELECT max(bid_id)
                                       FROM " . TABLE_BID_REPLIES_MASTER . "
				       WHERE partner_id = " . $this->session->userdata('company_id') . "
				       GROUP BY project_country_id )", NULL, FALSE);
        $this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " p", 'p.project_country_id = b.project_country_id');
        $this->db->join(TABLE_PROJECT_MASTER . " pm", 'pm.project_id = b.project_id');
        $this->db->group_by('b.project_country_id');
        $this->db->order_by('b.bid_createddate', 'desc');
        $query = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function get_awaiting_partner_bids_count($partner_id) {
        $this->db->select('pm.project_name,pm.project_long_key, b.project_cpc,b.project_ncomplete,p.country_id, p.project_segments, p.segment_name, b.hide_cpc, b.partner_id, p.is_delete,b.bid_status');
        $this->db->where('b.partner_id', $partner_id);
        $this->db->where('b.bid_type', 2);
        $this->db->where('b.bid_status', 1);
        $this->db->where('b.is_read', 0);
        $this->db->where("b.bid_id in (SELECT max(bid_id)
                                       FROM " . TABLE_BID_REPLIES_MASTER . "
				       WHERE partner_id = " . $this->session->userdata('company_id') . "
				       GROUP BY project_country_id )", NULL, FALSE);
        $this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " p", 'p.project_country_id = b.project_country_id');
        $this->db->join(TABLE_PROJECT_MASTER . " pm", 'pm.project_id = b.project_id');
        $this->db->group_by('b.project_country_id');
        $this->db->order_by('b.bid_createddate', 'desc');
        $query = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");
        return $query->num_rows();
    }

    function get_pending_win_bids($researcher_id) {
        $this->db->select('pm.project_name,pm.project_long_key, b.project_cpc,b.project_ncomplete,p.country_id, p.project_segments, p.segment_name, b.hide_cpc, b.partner_id, p.is_delete,b.bid_status');
        $this->db->where('b.researcher_id', $researcher_id);
        $this->db->where('b.bid_type', 1);
        $this->db->where('b.bid_status', 1);
        $this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " p", 'p.project_country_id = b.project_country_id');
        $this->db->join(TABLE_PROJECT_MASTER . " pm", 'pm.project_id = b.project_id');
        $query = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");

        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function get_win_projects($researcher_id) {
        $query = "SELECT distinct(pm.project_id) ,pm.project_long_key,pm.project_name,pm.project_modifieddate "
                . "FROM " . TABLE_BID_REPLIES_MASTER . " p, " . TABLE_PROJECT_MASTER . " pm "
                . "WHERE p.project_id = pm.project_id and p.bid_status = 3  and project_status = 1 "
                . "and `bid_createddate` = (SELECT max(`bid_createddate`) FROM " . TABLE_BID_REPLIES_MASTER . " p2 WHERE p2.`partner_id`= p.`partner_id`
   AND p2.`project_country_id`= p.`project_country_id`)
GROUP BY `project_country_id`, `partner_id`
ORDER BY `bid_createddate` DESC";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_partner_win_projects($partner_id) {
        $query = "SELECT distinct(pm.project_id) ,pm.project_name,pm.project_long_key,pm.project_modifieddate "
                . "FROM " . TABLE_BID_REPLIES_MASTER . " p, " . TABLE_PROJECT_MASTER . " pm "
                . "WHERE p.project_id = pm.project_id and "
                . "p.bid_status = 3 and "
                . "`bid_createddate` = (SELECT max(`bid_createddate`) "
                . "FROM " . TABLE_BID_REPLIES_MASTER . " p2 
                    WHERE p2.`researcher_id`= p.`researcher_id`
   AND p2.`project_country_id`= p.`project_country_id`)
GROUP BY `project_country_id`
ORDER BY `bid_createddate` DESC";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_partner_revenue() {
        $query = "select SUM(researcher_estimated_cost) AS revenue "
                . "from " . TABLE_PROJECT_CLOSING_DETAIL
                . " where partner_id = " . $this->session->userdata('company_id')
                . " and partner_approved = 1";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->row_array();
        }
        return false;
    }

    function get_partner_total_won_projects() {
        $query = "SELECT SUM(project_total) as ptotal FROM ( "
                . "SELECT COUNT(*) AS project_total"
                . " FROM " . TABLE_BID_REPLIES_MASTER
                . " WHERE bid_status = 3 and partner_id = " . $this->session->userdata('company_id')
                . " GROUP BY project_id"
                . " UNION ALL"
                . " SELECT COUNT(*) AS project_total"
                . " FROM " . TABLE_PROJECT_CLOSING_DETAIL
                . " WHERE partner_id = " . $this->session->userdata('company_id')
                . " ) AS won_projects";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->row_array();
        }
        return false;
    }

    function get_partner_total_client_served() {
        $query = "SELECT DISTINCT (researcher_id)"
                . "from " . TABLE_BID_REPLIES_MASTER
                . " where partner_id = " . $this->session->userdata('company_id');
        $res = $this->db->query($query);
        return $res->num_rows();
    }

    function get_count_completed_bid() {
        $query = "SELECT distinct(`project_country_id`)  FROM `bid_replies_master` WHERE `researcher_id` = " . $this->session->userdata('company_id') . " AND `bid_type` = 1 AND `bid_status` = 3";
        $res = $this->db->query($query);
        return $res->num_rows();
    }
	function get_recent_activities(){
		 $query = "SELECT * FROM ".TABLE_USER_ACTIVITY." WHERE user_id = " . $this->session->userdata('user_id') . " and activity_type <> '".ADD_USER_TYPE."' order by activity_id DESC limit 0, 5";
        $res = $this->db->query($query);
        return $res->result();
	}
	function get_recent_users(){
		 $query = "SELECT * FROM ".TABLE_PANEL_USER_MASTER." WHERE company_id = " . $this->session->userdata('company_id') . " and user_type = 2 order by user_id DESC limit 0, 6";
        $res = $this->db->query($query);
        return $res->result();
	}

}
