<?php

/**
 * Description of mdl_rewards
 *
 * @author rita
 */
class mdl_rewards extends CI_Model {

    function __construct() {
        parent::__construct();
    }
	function get_researcher_rewards_details($researcher_id){
		$this->db->select('r.cost,r.reward_amt,r.entry_id,pm.project_name,cm.company_name', $researcher_id);
		$this->db->where('r.researcher_id', $researcher_id);
		$this->db->join(TABLE_PROJECT_MASTER . " pm", 'pm.project_id = r.project_id');
		$this->db->join(TABLE_COMPANY_MASTER . " cm", 'cm.company_id = r.partner_id');
		$this->db->limit(10);
		$res = $this->db->get(TABLE_RESEARCH_REWARD_DETAILS ." r");
		if ($res->num_rows() > 0) {
            return $res->result();
        }
		return false;
	}
	function get_researcher_rewards($researcher_id){
		$this->db->where('researcher_id', $researcher_id);
		$res = $this->db->get(TABLE_RESEARCH_REWARD);
		if ($res->num_rows() > 0) {
            return $res->row_array();
        }
		return false;
	}
	function get_researcher_rewards_request($researcher_id){
		$this->db->where('researcher_id', $researcher_id);
		$res = $this->db->get(TABLE_RESEARCH_REWARD_REQUESTS);
		if ($res->num_rows() > 0) {
            return $res->result();
        }
		return false;
	}
	function get_researcher_request_for_rewards($researcher_id,$status){
		$this->db->where('researcher_id', $researcher_id);
		$this->db->where('status', $status);
		$res = $this->db->get(TABLE_RESEARCH_REWARD_REQUESTS);
		return $res->num_rows();
		
	}
    function insert_redeem_rewards($request_detail,$reedeamed_rewards){
		$this->db->insert(TABLE_RESEARCH_REWARD_REQUESTS, $request_detail);
        
		$this->db->where('researcher_id', $request_detail['researcher_id']);
		$this->db->set('reedeamed_rewards', ($reedeamed_rewards + $request_detail['reward_amt']));
		$this->db->set('entry_modified_by', ($request_detail['entry_modified_by']));
		$this->db->set('entry_modified_date', ($reedeamed_rewards + $request_detail['entry_modified_date']));
		$this->db->update(TABLE_RESEARCH_REWARD);
		$this->db->last_query();
		
		return $this->db->affected_rows();
	}
	
}
