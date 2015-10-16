<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdl_company
 *
 * @author Priyanka
 */
class mdl_company extends CI_Model {

    function __construct() {
        parent::__construct();
    }

    function get_company_detail($company_id) {
        $this->db->select('u.user_email,u.user_type,c.*');
        $this->db->where('c.company_id', $company_id);
        $this->db->join(TABLE_PANEL_USER_MASTER." u",'u.company_id = c.company_id');
        $query = $this->db->get(TABLE_COMPANY_MASTER." c");
        return $query->row_array();
    }
    
    function update_company($company_id,$company){
        $this->db->where('company_id', $company_id);        
        $this->db->set('company_modified_date ', date(DATE_FORMAT_DB));        
        $this->db->update(TABLE_COMPANY_MASTER, $company);
        return $this->db->affected_rows();
    }
	function insert_partner_segment($segment_detail){
		$this->db->insert(TABLE_PARTNER_SEGMENTS, $segment_detail);
		return $this->db->insert_id();
	}
	function check_partner_segments(){
		$this->db->where('partner_id',$this->session->userdata('company_id'));
		$res = $this->db->get(TABLE_PARTNER_SEGMENTS);
		if($res->num_rows() > 0){
			$this->db->where('partner_id',$this->session->userdata('company_id'));
			$this->db->delete(TABLE_PARTNER_SEGMENTS);
		}
		return false;
	}
	function get_country_from_panel_segments(){
		$this->db->select('distinct(c.country_id),c.country_name');
		$this->db->join(TABLE_COUNTRY_MASTER . " c", 'c.country_id = ps.country_id');
		$this->db->order_by('c.country_name', 'ASC');
		$query = $this->db->get(TABLE_PARTNER_SEGMENTS.' ps');
		if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
	}
	function get_country_segments($country_id){
		$this->db->where('country_id',$country_id);
		$this->db->where('partner_id',$this->session->userdata('company_id'));
		$query = $this->db->get(TABLE_PARTNER_SEGMENTS);
		if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;
	}
	function get_invoices( $status = 1,$invoice_id = ''){
		$this->db->select("p.researcher_estimated_cost, pc.is_delete, cm.country_name, pc.segment_name, pc.project_segments, pm.project_name");
		if($status == 1) {
			$this->db->join(TABLE_PROJECT_CLOSING_DETAIL . " p", 'p.project_id = i.project_id','left');
			
			$this->db->where('i.invoice_id', $invoice_id);
			$this->db->where('p.project_closing_id = i.project_closing_id');
		} else {
			$this->db->join(TABLE_PROJECT_CLOSING_DETAIL . " p", 'p.project_id <> i.project_id','left');
		}
		
			
		$this->db->join(TABLE_PROJECT_COUNTRY_MASTER . " pc", 'p.project_country_id = pc.project_country_id');	
		$this->db->join(TABLE_PROJECT_MASTER . " pm", 'pc.project_id = pm.project_id');	
		$this->db->join(TABLE_COUNTRY_MASTER . " cm", 'pc.country_id = cm.country_id');	
		
		$this->db->where('p.partner_approved', '1');
		$this->db->where('p.partner_id', $this->session->userdata('company_id'));
		$query = $this->db->get(TABLE_INVOICE_DETAIL.' i'); 
		
		if ($query->num_rows() > 0) {
            return $query->result();
        }
		
        return false;	
	}
	function get_invoice_master(){
		$this->db->where('partner_id', 2);
			$query = $this->db->get(TABLE_INVOICE_MASTER); 
		if ($query->num_rows() > 0) {
            return $query->result();
        }
        return false;	
	}
}
