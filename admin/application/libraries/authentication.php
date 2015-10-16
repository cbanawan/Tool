<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of authentication
 *
 * @author Priyanka
 */
class authentication {
    private $ci;

    public function __construct() {
        $this->ci = &get_instance();
    }
    
    function check_session() {
        $user_id = $this->ci->session->userdata('user_id');
        
        if ($user_id == "") {            
            redirect(base_url('login'));
        }
    }
}
