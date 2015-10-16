<?php

/**
 * Description of mdl_bids
 *
 * @author priyanka
 */
class mdl_bids extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_statuswise_bids($bid_status, $project_id = NULL) {
        $this->db->select('b.*,b.project_cpc bid_cpc,b.project_ncomplete bid_ncomplete,b.project_setup_cost bid_setup_cost,b.fee_type bid_fee_type,co.country_name,pc.*,p.project_name,p.project_long_key,p.project_external_note,c.company_name,c.company_countries,p.project_modifieddate');
        $this->db->where('b.partner_id', $this->session->userdata('company_id'));
        $this->db->where('b.bid_status', $bid_status);
        if (($project_id != NULL) && ($project_id > 0)) {
            $this->db->where('b.project_id', $project_id);
        }
        $this->db->join(TABLE_PROJECT_MASTER . " p", 'p.project_id = b.project_id');
        $this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " pc", "b.project_country_id = pc.project_country_id");
        $this->db->join(TABLE_COMPANY_MASTER . " c", 'c.company_id = b.researcher_id');
        $this->db->join(TABLE_COUNTRY_MASTER . " co", 'pc.country_id = co.country_id');
        if ($bid_status == 0 || $bid_status == 1) {
            $this->db->where('is_read', 0);
        }
        $this->db->where("b.bid_id in (SELECT max(bid_id)
				FROM " . TABLE_BID_REPLIES_MASTER . "
				WHERE partner_id = " . $this->session->userdata('company_id') . "
				GROUP BY project_country_id )", NULL, FALSE);
        if (($project_id == NULL) || ($project_id = 0)) {
            $this->db->group_by('b.project_id');
        } else {
            $this->db->group_by('b.project_country_id');
        }
        $this->db->order_by('b.bid_createddate', 'desc');
        $res = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_closed_projects($is_approved = 0, $project_id = NULL) {
        $query = "SELECT pcd.confirmed_payment,pcd.confirmed_payment_amount,pcd.researcher_estimated_cost,pcd.partner_approved,pcd.partner_approved_by,pcd.partner_approved_date,"
                . "p.*,pm.project_name, c.company_name, cm.country_name, pc.segment_name, pc.project_segments "
                . "FROM " . TABLE_BID_REPLIES_MASTER . " p "
                . " JOIN " . TABLE_PROJECT_MASTER . " pm on p.project_id = pm.project_id "
                . "JOIN " . TABLE_PROJECT_CLOSING_DETAIL . " pcd on p.project_id = pcd.project_id "
                . "JOIN " . TABLE_COMPANY_MASTER . " c on p.researcher_id = c.company_id "
                . "JOIN " . TABLE_PROJECT_COUNTRY_MASTER . " pc on pc.project_country_id = p.project_country_id "
                . "left JOIN " . TABLE_COUNTRY_MASTER . " cm on pc.country_id = cm.country_id "
                . "WHERE p.bid_status = 3 AND "
                . " p.partner_id = " . $this->session->userdata('company_id')
                . " AND pcd.partner_approved = " . $is_approved
                . " AND `bid_createddate` = (SELECT max(`bid_createddate`) "
                . "FROM " . TABLE_BID_REPLIES_MASTER . " p2 
                   WHERE p2.`partner_id`= p.`partner_id` 
                   AND p2.`project_country_id`= p.`project_country_id`)";
        if ($project_id != NULL)
            $query .= " AND pm.project_id = " . $project_id;
        $query .= " GROUP BY `project_id`";
        $query .= " ORDER BY `bid_createddate` DESC";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    public function get_closed_project_detail($project_id) {
        $this->db->select('b.*,pcd.partner_approved,pcd.partner_approved_by,pcd.partner_approved_date,b.project_cpc bid_cpc,b.project_ncomplete bid_ncomplete,b.project_setup_cost bid_setup_cost,b.fee_type bid_fee_type,co.country_name,pc.*,p.project_name,p.project_external_note,c.company_name,c.company_countries');
        $this->db->where('b.project_id', $project_id);
        $this->db->join(TABLE_PROJECT_MASTER . " p", 'p.project_id = b.project_id');
        $this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " pc", "b.project_country_id = pc.project_country_id");
        $this->db->join(TABLE_COMPANY_MASTER . " c", 'c.company_id = b.researcher_id');
        $this->db->join(TABLE_COUNTRY_MASTER . " co", 'pc.country_id = co.country_id');
        $this->db->join(TABLE_PROJECT_CLOSING_DETAIL . " pcd", 'b.project_id = pcd.project_id');
        $this->db->where("b.bid_id in (SELECT max(bid_id)
				FROM " . TABLE_BID_REPLIES_MASTER . "
				WHERE partner_id = " . $this->session->userdata('company_id') . "
				GROUP BY project_country_id )", NULL, FALSE);
        $this->db->group_by('b.project_country_id');
        $this->db->order_by('b.bid_createddate', 'DESC');
        $res = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_approved_by_name($approved_by) {
        $this->db->select('user_name');
        $this->db->where('user_id', $approved_by);
        $res = $this->db->get(TABLE_PANEL_USER_MASTER);
        if ($res->num_rows() > 0) {
            return $res->row();
        }
        return false;
    }

    function approve_project($project_id, $project_country_id) {
        $this->db->where('project_id', $project_id);
        $this->db->where("project_country_id", $project_country_id);
        $this->db->set('partner_approved', 1);
        $this->db->set('partner_approved_date', date('Y-m-d'));
        $this->db->set('partner_approved_by', $this->session->userdata('user_id'));
        $this->db->update(TABLE_PROJECT_CLOSING_DETAIL);
        return $this->db->affected_rows();
    }

    function save_confirm_payment($project_id, $project_country_id, $amount) {
        $this->db->where('project_id', $project_id);
        $this->db->where("project_country_id", $project_country_id);
        $this->db->set('confirmed_payment', 1);
        $this->db->set('confirmed_payment_userid', $this->session->userdata('user_id'));
        $this->db->set('confirmed_payment_date', date('Y-m-d'));
        $this->db->set('confirmed_payment_amount', $amount);
        $this->db->update(TABLE_PROJECT_CLOSING_DETAIL);
        return $this->db->affected_rows();
    }

    function get_vendor_projects($filter, $sort, $limit, $offset) {
        if (!empty($filter)) {
            if (array_key_exists("project_name", $filter))
                $this->db->where('project_name', $filter['project_name']);
        }
        if (!empty($sort)) {
            if (array_key_exists("project_name", $sort))
                $this->db->order_by($this->db->escape_str('project_name'), $this->db->escape_str($sort['project_name']));
            if (!empty($sort)) {
                if (array_key_exists("project_name", $sort))
                    $this->db->order_by($this->db->escape_str('project_name'), $this->db->escape_str($sort['project_name']));
                if (array_key_exists("project_createddate", $sort))
                    $this->db->order_by($this->db->escape_str('project_createddate'), $this->db->escape_str($sort['project_createddate']));
                if (array_key_exists("project_status", $sort))
                    $this->db->order_by($this->db->escape_str('project_status'), $this->db->escape_str($sort['project_status']));
            }else {
                $this->db->order_by('project_id', 'DESC');
            }
            if (array_key_exists("project_status", $sort))
                $this->db->order_by($this->db->escape_str('project_status'), $this->db->escape_str($sort['project_status']));
        }
        $row = 0;
        if ($limit != NULL) {
            if ($offset != NULL) {
                $row = $offset;
            }
            $this->db->limit($limit, $row);
        }
        $this->db->where('b.partner_id', $this->session->userdata('company_id'));
        $this->db->join(TABLE_PROJECT_MASTER . " p", 'p.project_id = b.project_id');
        $this->db->group_by('b.project_id');
        $this->db->order_by('b.bid_createddate', 'desc');
        $res = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_vendor_projects_total() {
        if (!empty($filter)) {
            if (array_key_exists("project_name", $filter))
                $this->db->where('project_name', $filter['project_name']);
        }
        $this->db->where('b.partner_id', $this->session->userdata('company_id'));
        $this->db->join(TABLE_PROJECT_MASTER . " p", 'p.project_id = b.project_id');
        $this->db->group_by('b.project_id');
        $res = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");
        return $res->num_rows();
    }

    function get_bids() {
        $res = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");
        return $res->result();
    }

    function update_bid($bid_id, $bid) {
        $this->db->where('bid_id', $bid_id);
        $this->db->update(TABLE_BID_REPLIES_MASTER, $bid);
    }

    function get_bid_detail($bid_long_key) {
        $this->db->select('b.*,b.project_cpc bid_cpc,b.project_ncomplete bid_ncomplete,b.project_setup_cost bid_setup_cost,b.fee_type bid_fee_type,co.country_name,pc.*,p.project_name,p.project_long_key,p.project_external_note,c.company_name,c.company_countries');
        $this->db->where('b.bid_long_id', $bid_long_key);
        $this->db->join(TABLE_PROJECT_MASTER . " p", 'p.project_id = b.project_id');
        $this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " pc", "b.project_country_id = pc.project_country_id");
        $this->db->join(TABLE_COMPANY_MASTER . " c", 'c.company_id = b.researcher_id');
        $this->db->join(TABLE_COUNTRY_MASTER . " co", 'pc.country_id = co.country_id');
        $res = $this->db->get(TABLE_BID_REPLIES_MASTER . " b");
        if ($res->num_rows() > 0) {
            return $res->row_array();
        }
        return false;
    }

}
