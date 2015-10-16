<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
	function get_project_master($project_id){
		$this->db->where('project_id', $project_id);
		$query = $this->db->get(TABLE_PROJECT_MASTER);
		
		if ($query->num_rows() > 0) {
            return $query->row_array();
        }
        return false;
	}
	function get_project_file_master($project_id){
		$this->db->where('project_id', $project_id);
		$query = $this->db->get(TABLE_PROJECT_FILE);
		
		if ($query->num_rows() > 0) {
            return $query->result_array();
        }
        return false;
	}
	function get_project_country_detail($project_country_id){
		//$this->db->select('segment_name');
		$this->db->where('project_country_id', $project_country_id);
        $query = $this->db->get(TABLE_PROJECT_COUNTRY_MASTER);
		 return $query->row();
	}
	function get_project_country($project_id){
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

    function insert_bid_replies($bid_detail) {
        $this->db->insert(TABLE_BID_REPLIES_MASTER, $bid_detail);
        return $this->db->insert_id();
    }
	/*function update_read_status($project_id,$researcher_id,$project_country_id) {
        $this->db->where('project_id', $project_id);
        $this->db->where('researcher_id', $researcher_id);
        $this->db->where('project_country_id', $project_country_id);
        $this->db->where('bid_type', 2);
        $this->db->set('bid_modifieddate ', date(DATE_FORMAT_DB));
        $this->db->set('is_read ', 1);
        $this->db->update(TABLE_BID_REPLIES_MASTER);
		return $this->db->affected_rows();
    }*/
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
        $this->db->set('project_status ', 0);
        $this->db->update(TABLE_PROJECT_MASTER);
        return $this->db->affected_rows();
    }function update_project_status($project_id) {
        $this->db->where('project_id', $project_id);
        $this->db->set('project_status ', 1);
        $this->db->update(TABLE_PROJECT_MASTER);
        return $this->db->affected_rows();
    }
	function delete_project_country($project_country_id,$project_status) {
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
	
	function check_bid_project_country($project_country_id,$partner_id,$project_id){
		$this->db->where('project_country_id', $project_country_id);
		$this->db->where('partner_id', $partner_id);
		$this->db->where('project_id', $project_id);
		$this->db->order_by('bid_createddate', 'DESC');
	    $query = $this->db->get(TABLE_BID_REPLIES_MASTER);
				if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
	}
	function check_project_country_delete($project_country_id){
		$this->db->select('is_delete');
		$this->db->where('project_country_id', $project_country_id);
	    $query = $this->db->get(TABLE_PROJECT_COUNTRY_MASTER);
				if ($query->num_rows() > 0) {
            return $query->row();
        }
        return false;
	}
	function get_filter_bid_replies($bid_status,$project_id,$partner_id = '',$segment_id = '') {
		$query = "SELECT p.bid_id FROM ".TABLE_BID_REPLIES_MASTER." p join ".TABLE_COMPANY_MASTER." c on p.partner_id = c.company_id join ".TABLE_PROJECT_COUNTRY_MASTER." pc on pc.project_country_id = p.project_country_id left join ".TABLE_COUNTRY_MASTER." cm on pc.country_id = cm.country_id WHERE";
		if($bid_status == 'read') {
			$query .= " p.is_read = 1";
		} else if($bid_status == 'unread') {
			$query .= " p.is_read = 0";
		} else if($bid_status == 'partner') {
			$query .= " p.partner_id = ".$partner_id;
		} else if($bid_status == 'segment') {
			$query .= " p.project_country_id = ".$segment_id;
		}
		$query .= " and p.project_id =".$project_id." and `bid_createddate` =
  (SELECT max(`bid_createddate`) FROM ".TABLE_BID_REPLIES_MASTER." p2
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
	function get_project_bid($project_id) {
		$query = "SELECT p.*, c.company_name, cm.country_name, pc.segment_name, pc.project_segments
FROM ".TABLE_BID_REPLIES_MASTER." p join ".TABLE_COMPANY_MASTER." c on p.partner_id = c.company_id join ".TABLE_PROJECT_COUNTRY_MASTER." pc on pc.project_country_id = p.project_country_id left join ".TABLE_COUNTRY_MASTER." cm on pc.country_id = cm.country_id  
WHERE p.project_id =".$project_id." and `bid_createddate` =
  (SELECT max(`bid_createddate`) FROM ".TABLE_BID_REPLIES_MASTER." p2
   WHERE p2.`partner_id`= p.`partner_id`
   AND p2.`project_country_id`= p.`project_country_id`)
GROUP BY `project_country_id`, `partner_id`
ORDER BY `bid_createddate` DESC";
 $res = $this->db->query($query);

		if ($res->num_rows() > 0) {
            return $res->result();
        }
		
        return false;
	}
	/*function get_project_sub_bid($project_id,$partner_id) {
		$query = "SELECT p.*, c.company_name, cm.country_name, pc.segment_name, pc.project_segments
FROM ".TABLE_BID_REPLIES_MASTER." p join ".TABLE_COMPANY_MASTER." c on p.partner_id = c.company_id join ".TABLE_PROJECT_COUNTRY_MASTER." pc on pc.project_country_id = p.project_country_id left join ".TABLE_COUNTRY_MASTER." cm on pc.country_id = cm.country_id 
WHERE p.project_id =".$project_id." and p.partner_id = ".$partner_id." ORDER BY `bid_createddate` DESC";
 $res = $this->db->query($query);

		if ($res->num_rows() > 0) {
            return $res->result();
        }
		
        return false;
	}*/
	function get_project_sub_bid($project_id, $partner_id, $is_partner = true) {
        $query = "SELECT p.*, c.company_name, cm.country_name, pc.segment_name, pc.project_segments
FROM " . TABLE_BID_REPLIES_MASTER . " p join " . TABLE_COMPANY_MASTER . " c on p.partner_id = c.company_id join " . TABLE_PROJECT_COUNTRY_MASTER . " pc on pc.project_country_id = p.project_country_id left join " . TABLE_COUNTRY_MASTER . " cm on pc.country_id = cm.country_id 
WHERE p.project_id =" . $project_id;
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
    function get_project_list($filter_data, $sort_array, $limit, $offset) {
        if (!empty($filter)) {
            if (array_key_exists("project_name", $filter))
                $this->db->where('project_name', $filter['project_name']);
        }
        if (!empty($sort)) {
            if (array_key_exists("project_name", $sort))
                $this->db->order_by($this->db->escape_str('project_name'), $this->db->escape_str($sort['project_name']));

//            if (array_key_exists("project_ir", $sort))
//                $this->db->order_by($this->db->escape_str('project_ir'), $this->db->escape_str($sort['project_ir']));
//
//            if (array_key_exists("project_loi", $sort))
//                $this->db->order_by($this->db->escape_str('project_loi'), $this->db->escape_str($sort['project_loi']));
//
//            if (array_key_exists("project_cpc", $sort))
//                $this->db->order_by($this->db->escape_str('project_cpc'), $this->db->escape_str($sort['project_cpc']));
//            if (array_key_exists("project_ncomplete", $sort))
//                $this->db->order_by($this->db->escape_str('project_ncomplete'), $this->db->escape_str($sort['project_ncomplete']));
//            if (array_key_exists("project_target", $sort))
//                $this->db->order_by($this->db->escape_str('project_target'), $this->db->escape_str($sort['project_target']));
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
from ".TABLE_COMPANY_MASTER." as  cmp,  ".TABLE_PROJECT_COUNTRY_MASTER." as pcm  
where FIND_IN_SET( pcm.project_segments, cmp.company_segment) > 0  
and  FIND_IN_SET( pcm.country_id, cmp.company_countries) > 0 and 
pcm.project_id = ".$project_id." and cmp.company_type <> 1 " ;

        $res = $this->db->query($query);
				//echo $this->db->last_query();
		//exit;
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }
	function search_partners_sub_data($project_id,$company_id) {
		$query = "select  pcm.country_id, cm.country_name ,pcm.is_delete,pcm.project_segments, pcm.segment_name, pcm.project_country_id,pcm.project_cpc, pcm.project_ncomplete from   ".TABLE_PROJECT_COUNTRY_MASTER." as pcm left join ".TABLE_COUNTRY_MASTER." cm on pcm.country_id = cm.country_id , ".TABLE_COMPANY_MASTER." as  cmp
where FIND_IN_SET( pcm.project_segments, cmp.company_segment) > 0  
and  FIND_IN_SET( pcm.country_id, cmp.company_countries) > 0 and 
pcm.project_id = ".$project_id." and cmp.company_type <> 1 and cmp.company_id = ".$company_id;

        $res = $this->db->query($query);
				//echo $this->db->last_query();
		//exit;
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
    }
	function get_bid_status_project($project_id){
		$query = "SELECT p.bid_status FROM ".TABLE_BID_REPLIES_MASTER." p WHERE p.project_id =".$project_id." and `bid_createddate` = (SELECT max(`bid_createddate`) FROM ".TABLE_BID_REPLIES_MASTER." p2 WHERE p2.`partner_id`= p.`partner_id`
   AND p2.`project_country_id`= p.`project_country_id`)
GROUP BY `project_country_id`, `partner_id`
ORDER BY `bid_createddate` DESC";
		$res = $this->db->query($query);
		if ($res->num_rows() > 0) {
            return $res->row();
        } 		
        return false;
	}
}
