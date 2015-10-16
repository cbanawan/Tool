<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of manageUser
 *
 * @author Rita
 */
class manageUser extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->loadJs();   
    }
    
     private function loadJs() {
        $this->jsFiles = array();
		$this->jsFiles[] =  JS .'users.js';
    }

    public function index() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
		$parse['content'] = $this->parser->parse('manageUser', $parse, true);
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Users";
        $parse['header_inner'] = "User List";        
        $parse['jsFiles'] = $this->jsFiles;        
        $this->parser->parse('common/layout', $parse);
    }  function addUser() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
		$parse['content'] = $this->parser->parse('addUser', $parse, true);
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    } function editUser($user_id) {
        $parse = array();
		$user_rs = $this->user_modal->get_user($user_id);
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
		$parse['content'] = $this->parser->parse('editUser', $user_rs, true);
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }
	function insert_user(){
		$user_rs = $this->user_modal->get_user($this->session->userdata('user_id'));
		$user_data = array(
			'user_name' => $_POST['user_name'] ,
			'user_login' => $_POST['user_login'] ,
			'user_email' => $_POST['user_email'] ,
			'user_password' => $_POST['user_password'] ,
			'company_id' => $user_rs->company_id 
		);
		
		$this->user_modal->insert_user($user_data);
		redirect('manageUser');
		exit;
	}function update_user(){
		$user_rs = $this->user_modal->get_user($this->session->userdata('user_id'));
		$user_data = array(
			'user_id' => $_POST['user_id'] ,
			'user_name' => $_POST['user_name'] ,
			'user_login' => $_POST['user_login'] ,
			'user_email' => $_POST['user_email'] ,
			'user_password' => $_POST['user_password'] ,
			'company_id' => $user_rs->company_id 
		);
		
		$this->user_modal->update_user($user_data);
		redirect('manageUser');
		exit;
	}
	public function get_all_users() {
        $aColumns = array('','user_name', 'user_email', 'actions');
        $data = $this->lib_common->datatable_basics($aColumns);
        $sEcho = $data['sEcho'];
        $limit = $data['limit'];
//        $limit = 1;
        $offset = $data['offset'];
        $sort_array = $data['sort_array'];

        /*
         * Filtering         
         */
        $filter_data = array();
        if ($_POST) {
            if (isset($_POST['user_email']) && $_POST['user_email'] != "") {
                $filter_data['user_email'] = trim($_POST['user_email']);
            }
        }
        // Select Data
        //$rResult = $this->organisation_model->get_school_list($organisation_id, $archieve_status, $sort_array, $limit, $offset);
        $rResult = $this->user_modal->get_user_list($filter_data, $sort_array, $limit, $offset);
        // Data set length after filtering

//        $iTotal = $iFilteredTotal = $this->organisation_model->get_school_list_total($organisation_id, $archieve_status);
        $iTotal = $this->user_modal->get_user_list_total($filter_data);
        $iFilteredTotal = count($rResult);
        // Total data set length
        // Output
        $output = array(
            'sEcho' => intval($sEcho),
            'iTotalRecords' => $iTotal,
            'iTotalDisplayRecords' => $iFilteredTotal,
            'aaData' => array()
        );

        if (!empty($rResult)) {
            foreach ($rResult as $m) {
                $row = array();
                foreach ($aColumns as $col) {
                    if ($col == 'actions') {
                        $str = '<a id="editUser_' . $m->user_id . '" href="javascript: void(0)">
                            <span class="icons" rel="tooltip" title="Edit User" ><i class="fa fa-edit fa-lg"></i></span></a>';
                        $str .= '<a id="rmvUser_' . $m->user_id . '" style="margin-left: 7px;" href="javascript: void(0)" onclick="javascript: confirm_delete(' . $m->user_id . ');"><span class="" rel="tooltip" title="Delete"><i class="fa fa-trash-o fa-lg"></i></span></a>';
                        $row[] = $str;
                    }else if($col == 'user_name' || $col == 'user_email'){
                        $row[] = $m->$col;
                    }else{
                        $row[] = '<input type="checkbox" class="checkboxes" value="'.$m->user_id.'"/>';
                    }
                }
                array_push($output['aaData'], $row);
            }
        }
        echo json_encode($output);
        exit();
    }
}
