<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of rewards
 *
 * @author rita
 */
class rewards extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->authentication->check_session();
        $this->loadJs();
        $this->loadCSS();
        $this->load->config('pp_config');
		 $this->load->model('mdl_rewards');
    }

    private function loadCSS() {
        $this->cssFiles = array();
       
    }

    private function loadJs() {
        $this->jsFiles = array();
		$this->jsFiles[] = JS . 'rewards.js';
       
    }


    public function index() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
		$site_nav_arr = $this->config->item('rewards_nav');
		$parse['site_nav'] = $site_nav_arr['breadcrumb'];
		$parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
		$parse['country'] = $this->config->item('country');
		$parse['project_segments'] = $this->config->item('company_segment');
		$parse['payment_method'] = $this->config->item('payment_method');
		$parse['payment_status'] = $this->config->item('payment_status');
		$parse['header_text'] = "Researcher Rewards";
        $parse['header_inner'] = "Researcher Rewards";
		$parse['resercher_rewards'] = $this->mdl_rewards->get_researcher_rewards($this->session->userdata('company_id'));
		$parse['resercher_request_rewards'] = $this->mdl_rewards->get_researcher_rewards_request($this->session->userdata('company_id'));
		$parse['resercher_rewards_request'] = $this->mdl_rewards->get_researcher_request_for_rewards($this->session->userdata('company_id'),0);
		$parse['resercher_rewards_details'] = $this->mdl_rewards->get_researcher_rewards_details($this->session->userdata('company_id'));
		$parse['content'] = $this->parser->parse('rewards', $parse, true);
	    $parse['cssFiles'] = $this->cssFiles;
        $parse['jsFiles'] = $this->jsFiles;
        $parse['success_msg'] = $this->lib_message->get_success_message();
        $parse['failure_msg'] = $this->lib_message->get_failure_message();
        $this->parser->parse('common/layout', $parse);
    }
	function insert_redeem_rewards(){
		if(isset($_POST)){
            $request_detail = array();
            $request_detail['researcher_id'] = $this->session->userdata('company_id');
            $request_detail['reward_amt'] = trim($this->input->post('redeem_amt'));
            $reedeamed_rewards = trim($this->input->post('reedeamed_rewards'));
            $request_detail['reward_method'] = trim($this->input->post('payment_method'));
            $request_detail['notes'] = trim($this->input->post('notes'));
            $request_detail['status'] = 0;
            $request_detail['request_by'] = $this->session->userdata('user_id');
            $request_detail['request_date'] = date(DATE_FORMAT_DB);
            $request_detail['entry_by'] = $this->session->userdata('user_id');
            $request_detail['entry_modified_by'] = $this->session->userdata('user_id');
            $request_detail['entry_date'] = date(DATE_FORMAT_DB);
            $request_detail['entry_modified_date'] = date(DATE_FORMAT_DB);
            $request_detail['entry_remote_ip'] = $_SERVER['REMOTE_ADDR'];
            $res = $this->mdl_rewards->insert_redeem_rewards($request_detail,$reedeamed_rewards);
			$user_activity = array();
			$user_activity['activity_type'] = REDEEM_REWARDS_TYPE;
			$payment_method = $this->config->item('payment_method');
			$user_activity['activity_description'] = sprintf(REDEEM_REWARDS_DESC,$this->session->userdata('user_name'),'$'.$this->input->post('redeem_amt'),$payment_method[$this->input->post('payment_method')]);
			$this->user_modal->insert_user_activity($user_activity);
            if ($res > 0) {
				echo "success";
				exit();
			}	
			echo "error";
			exit;
		}
	}

}
