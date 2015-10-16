<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mdl_country
 *
 * @author priyanka
 */
class mdl_country extends CI_Model {

    function __construct() {
        parent::__construct();
    }
    
    function get_all_country(){
        $query = $this->db->get(TABLE_COUNTRY_MASTER);         
        if ($query->num_rows() > 0) {
            return $query->result();
        }
    }


}
