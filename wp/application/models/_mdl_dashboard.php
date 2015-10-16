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

	function get_begun_bids($researcher_id){
		 $query = "SELECT p.`project_country_id`,pm.project_name,p.project_cpc,p.project_ncomplete,p.country_id, p.project_segments, p.segment_name FROM ".TABLE_PROJECT_COUNTRY_MASTER." p, ".TABLE_PROJECT_MASTER." pm WHERE p.country_id <> 0 and p.project_id = pm.project_id and p.is_delete = 0 and p.`project_country_id` NOT IN ( select `project_country_id` from ".TABLE_BID_REPLIES_MASTER." b where b.researcher_id = " .$researcher_id. ") order by  p.`project_country_id` DESC" ;
		
		$res = $this->db->query($query);
		if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
	}
	function get_awaiting_bids($researcher_id){
		$this->db->select('pm.project_name, b.project_cpc,b.project_ncomplete,p.country_id, p.project_segments, p.segment_name, b.hide_cpc, b.partner_id, p.is_delete,b.bid_status');
		$this->db->where('b.researcher_id', $researcher_id);
		$this->db->where('b.bid_type', 1);
		$this->db->where('b.bid_status', 0);
		$this->db->where('b.is_read', 0);
		$this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " p", 'p.project_country_id = b.project_country_id');
		$this->db->join(TABLE_PROJECT_MASTER . " pm", 'pm.project_id = b.project_id');
		$query = $this->db->get(TABLE_BID_REPLIES_MASTER ." b");
		if ($query->num_rows() > 0) {
           return $query->result();
        }
        return false;
	}
	function get_pending_win_bids($researcher_id){
		$this->db->select('pm.project_name, b.project_cpc,b.project_ncomplete,p.country_id, p.project_segments, p.segment_name, b.hide_cpc, b.partner_id, p.is_delete,b.bid_status');
		$this->db->where('b.researcher_id', $researcher_id);
		$this->db->where('b.bid_type', 1);
		$this->db->where('b.bid_status', 1);
		$this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " p", 'p.project_country_id = b.project_country_id');
		$this->db->join(TABLE_PROJECT_MASTER . " pm", 'pm.project_id = b.project_id');
		$query = $this->db->get(TABLE_BID_REPLIES_MASTER ." b");
		
		if ($query->num_rows() > 0) {
           return $query->result();
        }
        return false;
	}
	function get_win_projects($researcher_id){
		 $query = "SELECT distinct(pm.project_id) ,pm.project_name,pm.project_modifieddate FROM " . TABLE_BID_REPLIES_MASTER . " p, ".TABLE_PROJECT_MASTER." pm WHERE p.project_id = pm.project_id and p.bid_status = 3 and `bid_createddate` = (SELECT max(`bid_createddate`) FROM " . TABLE_BID_REPLIES_MASTER . " p2 WHERE p2.`partner_id`= p.`partner_id`
   AND p2.`project_country_id`= p.`project_country_id`)
GROUP BY `project_country_id`, `partner_id`
ORDER BY `bid_createddate` DESC";
        $res = $this->db->query($query);
        if ($res->num_rows() > 0) {
            return $res->result();
        }
        return false;
	}
}
