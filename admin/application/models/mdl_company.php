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
}
