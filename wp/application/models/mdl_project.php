<?php

/**
 * Description of mdl_project
 *
 * @author priyanka
 */
class mdl_project extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_projects($project_id) {
        $this->db->where('p.project_id', $project_id);
        $this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " pc", 'pc.project_id = p.project_id');
        $query = $this->db->get(TABLE_PROJECT_MASTER . " p");
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_all_withprojects() {

        $query = $this->db->get(TABLE_PROJECT_MASTER . " p");
        if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
    }

    function chk_longkey($longkey) {
        $this->db->where('project_long_key', $longkey);
        $query = $this->db->get(TABLE_PROJECT_MASTER);
        return $query->num_rows();
    }

    function update_long_key($project_id, $long_key) {
        $this->db->where('project_id', $project_id);
        $this->db->set('project_long_key', $long_key);
        $query = $this->db->update(TABLE_PROJECT_MASTER);
    }

    function get_id_from_long_key($long_key) {
        $this->db->select('project_id');
        $this->db->where('project_long_key', $long_key);
        $query = $this->db->get(TABLE_PROJECT_MASTER);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function get_project_master($project_id) {
        $this->db->where('project_id', $project_id);
        $query = $this->db->get(TABLE_PROJECT_MASTER);

        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function get_project_file_master($project_id) {
        $this->db->where('project_id', $project_id);
        $query = $this->db->get(TABLE_PROJECT_FILE);

        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_project_country_detail($project_country_id) {
        //$this->db->select('segment_name');
        $this->db->where('project_country_id', $project_country_id);
        $query = $this->db->get(TABLE_PROJECT_COUNTRY_MASTER);
        return $query->row();
    }

    function get_project_country($project_id) {
        $this->db->where('project_id', $project_id);
        //$this->db->where('is_delete', 0);
        $query = $this->db->get(TABLE_PROJECT_COUNTRY_MASTER);
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function insert_project($projects_detail) {
        $this->db->insert(TABLE_PROJECT_MASTER, $projects_detail);
        return $this->db->insert_id();
    }

    function insert_project_files($project_file_detail) {
        $this->db->insert(TABLE_PROJECT_FILE, $project_file_detail);
        return $this->db->insert_id();
    }

    function insert_project_country_master($project_country_detail) {
        $this->db->insert(TABLE_PROJECT_COUNTRY_MASTER, $project_country_detail);
        return $this->db->insert_id();
    }

    function partner_project_close_detail($project_id, $partner_id) {
        /*$this->db->select('pc.* , c.user_name');
		
		$this->db->join(TABLE_PANEL_USER_MASTER . " c", 'c.user_id = pc.partner_approved_by');
		$this->db->where('partner_id', $partner_id);
        $this->db->where('project_id', $project_id);
        $query = $this->db->get(TABLE_PROJECT_CLOSING_DETAIL. " pc");*/
        $this->db->where('project_id', $project_id);
        $this->db->where('partner_id', $partner_id);        
        $query = $this->db->get(TABLE_PROJECT_CLOSING_DETAIL);
		
        if ($query->num_rows() == 1) {
            $this->db->select('pc.* , c.user_name');
		
            $this->db->join(TABLE_PANEL_USER_MASTER . " c", 'c.user_id = pc.partner_approved_by');
            $this->db->where('partner_id', $partner_id);
            $this->db->where('project_id', $project_id);
            $query = $this->db->get(TABLE_PROJECT_CLOSING_DETAIL. " pc");
            return $query->row();
        }
        
        if ($query->num_rows()>=2) {
           $this->db->where('partner_id', $partner_id);
           $this->db->where('project_id', $project_id);
           $this->db->delete(TABLE_PROJECT_CLOSING_DETAIL);
           return false;
        }
        
        return false;
    }

    function project_close_master($project_id) {
        $this->db->where('project_id', $project_id);
        $query = $this->db->get(TABLE_PROJECT_CLOSING_MASTER);
        if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
    }

    function insert_bid_replies($bid_detail) {
        $key = md5(uniqid(rand(), true));
        $id = substr($key, 0, 8);
        $bid_detail['bid_long_id'] = $id;
//  substr($this->lib_common->generate_long_key(), 0, 7);
        $this->db->insert(TABLE_BID_REPLIES_MASTER, $bid_detail);
        return $this->db->insert_id();
    }

    function close_project_master($close_proj_detail) {
        $this->db->where('project_id', $close_proj_detail['project_id']);
        $query = $this->db->get(TABLE_PROJECT_CLOSING_MASTER);
        if ($query->num_rows() == 0) {
            $this->db->insert(TABLE_PROJECT_CLOSING_MASTER, $close_proj_detail);
            $this->db->where('project_id', $close_proj_detail['project_id']);
            $this->db->set('project_status ', 2);
            $this->db->update(TABLE_PROJECT_MASTER);
            return $this->db->affected_rows();
        } else {
            $this->db->where('project_id', $close_proj_detail['project_id']);
            $this->db->update(TABLE_PROJECT_CLOSING_MASTER, $close_proj_detail);
            return $this->db->affected_rows();
        }
    }

    function close_project_detail($close_proj_detail) {
        $this->db->where('project_closing_id', $close_proj_detail['project_closing_id']);
        $query = $this->db->get(TABLE_PROJECT_CLOSING_DETAIL);
        if ($query->num_rows() > 0) {
            $this->db->where('project_closing_id', $close_proj_detail['project_closing_id']);
            $this->db->update(TABLE_PROJECT_CLOSING_DETAIL, $close_proj_detail);
            return $this->db->affected_rows();            
        } else {
            $this->db->insert(TABLE_PROJECT_CLOSING_DETAIL, $close_proj_detail);
            return $this->db->insert_id();            
        }
    }

    function researcher_reward_detail($reward_detail) {
        $this->db->where('researcher_id', $reward_detail['researcher_id']);
        $this->db->where('partner_id', $reward_detail['partner_id']);
        $this->db->where('project_id', $reward_detail['project_id']);
        $query = $this->db->get(TABLE_RESEARCH_REWARD_DETAILS);
        if ($query->num_rows() == 0) {
            $this->db->insert(TABLE_RESEARCH_REWARD_DETAILS, $reward_detail);
            return $this->db->insert_id();
        } else {
            $this->db->where('researcher_id', $reward_detail['researcher_id']);
            $this->db->where('partner_id', $reward_detail['partner_id']);
            $this->db->where('project_id', $reward_detail['project_id']);
            $this->db->update(TABLE_RESEARCH_REWARD_DETAILS, $reward_detail);
            return $this->db->affected_rows();
        }
    }

    function researcher_rewards($reward_detail) {
        $this->db->where('researcher_id', $reward_detail['researcher_id']);
        $query = $this->db->get(TABLE_RESEARCH_REWARD);
        if ($query->num_rows() == 0) {
            $this->db->query("insert into " . TABLE_RESEARCH_REWARD . " (entry_id,	researcher_id,total_rewards,reedeamed_rewards,entry_by,entry_modified_by,entry_date,entry_modified_date,entry_remote_ip) values(null, '" . $reward_detail['researcher_id'] . "', '" . $reward_detail['reward_amt'] . "',0,'" . $reward_detail['entry_created_by'] . "', '" . $reward_detail['entry_modified_by'] . "', now(), now(), '" . $_SERVER['REMOTE_ADDR'] . "') ");
        } else {

            $this->db->query("update " . TABLE_RESEARCH_REWARD . " set total_rewards = (select sum(reward_amt) from " . TABLE_RESEARCH_REWARD_DETAILS . " where researcher_id = '" . $reward_detail['researcher_id'] . "'), entry_modified_by = '" . $reward_detail['entry_modified_by'] . "', entry_modified_date = now() where researcher_id = '" . $reward_detail['researcher_id'] . "'");
        }
    }

    function update_partner_ranks($partner_id, $partner_detail) {
        $this->db->where('company_id', $partner_id);
        $this->db->set('cost_rank', $partner_detail['avg_cost_rank']);
        $this->db->set('performance_rank', $partner_detail['avg_performance_rank']);
        $this->db->update(TABLE_COMPANY_MASTER);


        return $this->db->affected_rows();
    }

    function get_partner_rank($partner_id) {
        $query = "SELECT sum(`bid_speed_rank`) as bid_speed_rank, sum(`quality_rank`) as quality_rank, sum(`value_rank`) as value_rank, sum(`over_all_rank`) as over_all_rank, sum(`partner_cost_rank`) as cost_rank, sum(`partner_rank`) as partner_rank FROM " . TABLE_PROJECT_CLOSING_DETAIL . " WHERE `partner_id` = " . $partner_id;
        $res = $this->db->query($query);
        return $res->row();
    }

    function get_no_rows_partner_rank($partner_id) {
        $query = "SELECT count(*) as cnt FROM " . TABLE_PROJECT_CLOSING_DETAIL . " WHERE `partner_id` = " . $partner_id;
        $res = $this->db->query($query);
        return $res->row();
    }

    /* function update_read_status($project_id,$researcher_id,$project_country_id) {
      $this->db->where('project_id', $project_id);
      $this->db->where('researcher_id', $researcher_id);
      $this->db->where('project_country_id', $project_country_id);
      $this->db->where('bid_type', 2);
      $this->db->set('bid_modifieddate ', date(DATE_FORMAT_DB));
      $this->db->set('is_read ', 1);
      $this->db->update(TABLE_BID_REPLIES_MASTER);
      return $this->db->affected_rows();
      } */

    function update_read_status($project_id, $researcher_id, $project_country_id, $is_researcher = true) {
        $this->db->where('project_id', $project_id);
        if ($is_researcher) {
            $this->db->where('researcher_id', $researcher_id);
            $this->db->where('bid_type', 2);
        } else {
            $this->db->where('partner_id', $researcher_id);
            $this->db->where('bid_type', 1);
        }
        $this->db->where('project_country_id', $project_country_id);

        $this->db->set('bid_modifieddate ', date(DATE_FORMAT_DB));
        $this->db->set('is_read ', 1);
        $this->db->update(TABLE_BID_REPLIES_MASTER);
        return $this->db->affected_rows();
    }

    function accept_bid($bid_id) {
        $this->db->where('bid_id', $bid_id);
        $this->db->set('bid_modifieddate ', date(DATE_FORMAT_DB));
        $this->db->set('bid_status ', 3);
        $this->db->update(TABLE_BID_REPLIES_MASTER);

        return $this->db->affected_rows();
    }

    function delete_project_file($project_file_id) {
        $this->db->where('project_file_id', $project_file_id);
        $this->db->delete(TABLE_PROJECT_FILE);
        return $this->db->affected_rows();
    }

    function delete_project($project_id) {
        $this->db->where('project_id', $project_id);
        $this->db->set('project_status ', 1);
        $this->db->update(TABLE_PROJECT_MASTER);
        return $this->db->affected_rows();
    }

    function update_project_status($project_id) {
        $this->db->where('project_id', $project_id);
        $this->db->set('project_status', 0);
        $this->db->update(TABLE_PROJECT_MASTER);
        return $this->db->affected_rows();
    }

    function delete_project_country($project_country_id, $project_status) {
        $this->db->where('project_country_id', $project_country_id);
        $this->db->set('is_delete ', $project_status);
        $this->db->update(TABLE_PROJECT_COUNTRY_MASTER);
        //echo $this->db->last_query();
        return $this->db->affected_rows();
    }

    function update_project_detail($project_id, $projects_detail) {
        $this->db->where('project_id', $project_id);
        $this->db->update(TABLE_PROJECT_MASTER, $projects_detail);
        return $this->db->affected_rows();
    }

    function update_project_country_detail($project_country_id, $projects_detail) {
        $this->db->where('project_country_id', $project_country_id);
        $this->db->update(TABLE_PROJECT_COUNTRY_MASTER, $projects_detail);
        return $this->db->affected_rows();
    }

    function check_bid_project_country($project_country_id, $partner_id = '', $project_id) {
        $this->db->where('project_country_id', $project_country_id);
        if ($partner_id != '') {
            $this->db->where('partner_id', $partner_id);
        }
        $this->db->where('project_id', $project_id);
        $this->db->order_by('bid_createddate', 'DESC');
        $query = $this->db->get(TABLE_BID_REPLIES_MASTER);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function check_accept_bid_from_vendor($researcher_id, $project_id, $project_country_id, $partner_id) {
        $this->db->where('researcher_id', $researcher_id);
        $this->db->where('partner_id', $partner_id);
        $this->db->where('project_country_id', $project_country_id);
        $this->db->where('project_id', $project_id);
        $this->db->where('bid_type', 2);
        $query = $this->db->get(TABLE_BID_REPLIES_MASTER);
        if ($query->num_rows() > 0) {
            return $query->num_rows();
        }
        return false;
    }

    function check_project_country_delete($project_country_id) {
        $this->db->select('is_delete');
        $this->db->where('project_country_id', $project_country_id);
        $query = $this->db->get(TABLE_PROJECT_COUNTRY_MASTER);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }

    function get_filter_bid_replies($bid_status, $project_id, $partner_id = '', $segment_id = '') {
        $query = "SELECT p.bid_id FROM " . TABLE_BID_REPLIES_MASTER . " p join " . TABLE_COMPANY_MASTER . " c on p.partner_id = c.company_id join " . TABLE_PROJECT_COUNTRY_MASTER . " pc on pc.project_country_id = p.project_country_id left join " . TABLE_COUNTRY_MASTER . " cm on pc.country_id = cm.country_id WHERE";
        if ($bid_status == 'read') {
            $query .= " p.is_read = 1";
        } else if ($bid_status == 'unread') {
            $query .= " p.is_read = 0";
        } else if ($bid_status == 'partner') {
            $query .= " p.partner_id = " . $partner_id;
        } else if ($bid_status == 'segment') {
            $query .= " p.project_country_id = " . $segment_id;
        }
        $query .= " and p.project_id =" . $project_id . " and `bid_createddate` =
  (SELECT max(`bid_createddate`) FROM " . TABLE_BID_REPLIES_MASTER . " p2
   WHERE p2.`partner_id`= p.`partner_id`
   AND p2.`project_country_id`= p.`project_country_id`)
GROUP BY p.`project_country_id`, p.`partner_id`
ORDER BY `bid_createddate` DESC";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_project_bid($project_id, $tab_status) {
        $whr = '';
        if ($tab_status == 'awarded_partner' || $tab_status == 'closing_partner') {
            $whr .= 'p.bid_status = 3 and ';
        }
        $query = "SELECT p.*, c.company_name, cm.country_name, pc.segment_name, pc.project_segments
FROM " . TABLE_BID_REPLIES_MASTER . " p join " . TABLE_COMPANY_MASTER . " c on p.partner_id = c.company_id join " . TABLE_PROJECT_COUNTRY_MASTER . " pc on pc.project_country_id = p.project_country_id left join " . TABLE_COUNTRY_MASTER . " cm on pc.country_id = cm.country_id  
WHERE p.project_id =" . $project_id . " and " . $whr . " `bid_createddate` =
  (SELECT max(`bid_createddate`) FROM " . TABLE_BID_REPLIES_MASTER . " p2
   WHERE p2.`partner_id`= p.`partner_id`
   AND p2.`project_country_id`= p.`project_country_id`)";
        if ($tab_status == 'closing_partner') {
            $query .= "GROUP BY `partner_id`";
        } else {
            $query .= "GROUP BY `project_country_id`, `partner_id`";
        }
        $query .= "ORDER BY `bid_createddate` DESC";
        $res = $this->db->query($query);

        if ($res->num_rows() > 0) {
            return $res->result();
        }

        return false;
    }

    function get_project_sub_bid($project_id, $partner_id, $segment_id, $is_partner = true) {
        $query = "SELECT p.*, c.company_name, cm.country_name, pc.segment_name, pc.project_segments
FROM " . TABLE_BID_REPLIES_MASTER . " p join " . TABLE_COMPANY_MASTER . " c on p.partner_id = c.company_id join " . TABLE_PROJECT_COUNTRY_MASTER . " pc on pc.project_country_id = p.project_country_id left join " . TABLE_COUNTRY_MASTER . " cm on pc.country_id = cm.country_id 
WHERE p.project_id =" . $project_id;
        $query .= " and p.project_country_id = " . $segment_id;
        if ($is_partner)
            $query .= " and p.partner_id = " . $partner_id;
        else
            $query .= " and p.researcher_id = " . $partner_id;
        $query .= " ORDER BY `bid_createddate` DESC";

        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_project_sub_close_bid($project_id, $partner_id, $is_partner = true) {
        $query = "SELECT p.*, c.company_name, cm.country_name, pc.segment_name, pc.project_segments
FROM " . TABLE_BID_REPLIES_MASTER . " p join " . TABLE_COMPANY_MASTER . " c on p.partner_id = c.company_id join " . TABLE_PROJECT_COUNTRY_MASTER . " pc on pc.project_country_id = p.project_country_id left join " . TABLE_COUNTRY_MASTER . " cm on pc.country_id = cm.country_id 
WHERE p.project_id =" . $project_id . " and
p.bid_id in (SELECT max(bid_id)
				FROM " . TABLE_BID_REPLIES_MASTER . "
				WHERE project_id = $project_id and  partner_id = $partner_id
				GROUP BY project_country_id )";
        if ($is_partner)
            $query .= " and p.partner_id = " . $partner_id;
        else
            $query .= " and p.researcher_id = " . $partner_id;


        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_file_by_project($project_id) {
        $this->db->where('pf.project_id', $project_id);
        $this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " pc", 'pc.project_country_id = pf.project_file_segment');
        $query = $this->db->get(TABLE_PROJECT_FILE . " pf");
        echo $this->db->last_query();
        if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
    }

    function get_project_list($filter_data, $sort, $limit, $offset) {
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
        $this->db->where('researcher_id', $this->session->userdata('company_id'));
        //$this->db->where('project_status', '1');
        $this->db->order_by('project_id', 'DESC');
        $res = $this->db->get(TABLE_PROJECT_MASTER);
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_project_list_total($filter) {
        if (!empty($filter)) {
            if (array_key_exists("project_name", $filter))
                $this->db->where('project_name', $filter['project_name']);
        }
//        $this->db->where('user_type', 2);
//        $this->db->where('company_id', $this->session->userdata('company_id'));
        $res = $this->db->get(TABLE_PROJECT_MASTER);
        return $res->num_rows();
    }

    function search_partners_data($project_id) {
        //$query = "select  pcm.country_id, cmp.*  from ".TABLE_COMPANY_MASTER." as  cmp,  ".TABLE_PROJECT_COUNTRY_MASTER." as pcm, ".TABLE_PROJECT_MASTER." as pm  where FIND_IN_SET( pcm.project_segments, cmp.company_segment) > 0  and  FIND_IN_SET( pcm.country_id, cmp.company_countries) > 0 and pm.project_status = 1 and pm.project_id = $project_id and pm.project_id = pcm.project_id and cmp.company_type <> 1" ;

        $query = "select distinct (cmp.company_id) as company_id
from " . TABLE_COMPANY_MASTER . " as  cmp,  " . TABLE_PROJECT_COUNTRY_MASTER . " as pcm  
where FIND_IN_SET( pcm.project_segments, cmp.company_segment) > 0  
and  FIND_IN_SET( pcm.country_id, cmp.company_countries) > 0 and 
pcm.project_id = " . $project_id . " and cmp.company_type <> 1 ";

        $res = $this->db->query($query);
        //echo $this->db->last_query();
        //exit;
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function search_partners_sub_data($project_id, $company_id) {
        $query = "select  pcm.country_id, cm.country_name ,pcm.is_delete,pcm.project_segments, pcm.segment_name, pcm.project_country_id,pcm.project_cpc, pcm.project_ncomplete from   " . TABLE_PROJECT_COUNTRY_MASTER . " as pcm left join " . TABLE_COUNTRY_MASTER . " cm on pcm.country_id = cm.country_id , " . TABLE_COMPANY_MASTER . " as  cmp
where FIND_IN_SET( pcm.project_segments, cmp.company_segment) > 0  
and  FIND_IN_SET( pcm.country_id, cmp.company_countries) > 0 and 
pcm.project_id = " . $project_id . " and cmp.company_type <> 1 and cmp.company_id = " . $company_id;

        $res = $this->db->query($query);
        //echo $this->db->last_query();
        //exit;
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }

    function get_bid_status_project($project_id) {
        $query = "SELECT p.bid_status FROM " . TABLE_BID_REPLIES_MASTER . " p WHERE p.project_id =" . $project_id . " and `bid_createddate` = (SELECT max(`bid_createddate`) FROM " . TABLE_BID_REPLIES_MASTER . " p2 WHERE p2.`partner_id`= p.`partner_id`
   AND p2.`project_country_id`= p.`project_country_id`)
GROUP BY `project_country_id`, `partner_id`
ORDER BY `bid_createddate` DESC";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->row();
        }
        return false;
    }

    function get_sub_bid_close_partner($project_id, $researcher_id, $partner_id, $project_country_id) {
        $query = "select sum((project_cpc * project_ncomplete) + project_setup_cost) as total_estimate
		from " . TABLE_BID_REPLIES_MASTER . " 
		where bid_id in (SELECT max(bid_id)
				FROM " . TABLE_BID_REPLIES_MASTER . "
				WHERE project_id = $project_id and researcher_id =  $researcher_id and  partner_id = $partner_id
				GROUP BY project_country_id )";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->row();
        }
        return false;
    }

    function get_long_key_from_id($project_id) {
        $this->db->select('project_long_key');
        $this->db->where('project_id', $project_id);
        $query = $this->db->get(TABLE_PROJECT_MASTER);
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
    }
	function activity_accept_bid($bid_id){
		$this->db->select('cm.company_name as partner, segment_name, project_segments, c.country_name');
		$this->db->join(TABLE_COMPANY_MASTER . " cm", 'cm.company_id = b.partner_id');
		$this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " pc", 'pc.project_country_id = b.project_country_id');
		$this->db->join(TABLE_COUNTRY_MASTER . " c", 'c.country_id = pc.country_id');
		
       
        $this->db->where('bid_id', $bid_id);
        $query = $this->db->get(TABLE_BID_REPLIES_MASTER." b");
		
        if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
	}
}
