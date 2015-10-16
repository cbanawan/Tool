<?php

/**
 * Description of home
 *
 * @author priyanka
 */
class home extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->authentication->check_session();
        $this->loadJs();
        $this->loadCSS();
        $this->load->config('pp_config');
        $this->load->model('mdl_dashboard');
        $this->load->model('mdl_rewards');
    }

    private function loadCSS() {
        $this->cssFiles = array();
        $this->cssFiles[] = JS . 'select2/select2_metro.css';
        $this->cssFiles[] = JS . 'jquery-tags-input/jquery.tagsinput.css';
        $this->cssFiles[] = JS . 'fullcalendar/fullcalendar.css';
        $this->cssFiles[] = JS . 'bootstrap-fileupload/bootstrap-fileupload.css';
    }

    private function loadJs() {
        $this->jsFiles = array();
        $this->jsFiles[] = JS . 'select2/select2.min.js';
        $this->jsFiles[] = JS . 'jquery-tags-input/jquery.tagsinput.min.js';

        $this->jsFiles[] = JS . 'fullcalendar/fullcalendar.min.js';
        $this->jsFiles[] = JS . 'calendar.js';
        $this->jsFiles[] = JS . 'bootstrap-fileupload/bootstrap-fileupload.js';
    }

    public function index() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $site_nav_arr = $this->config->item('researcher_dashboard');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['country'] = $this->config->item('country');
        $parse['project_segments'] = $this->config->item('company_segment');
        if ($this->session->userdata('company_type') == 1) {
			$parse['resercher_rewards'] = $this->mdl_rewards->get_researcher_rewards($this->session->userdata('company_id'));
            $parse['count_completed_bid'] = $this->mdl_dashboard->get_count_completed_bid();
            $parse['begun_bid_detail'] = $this->mdl_dashboard->get_begun_bids($this->session->userdata('company_id'));
            $parse['awaiting_bid_detail'] = $this->mdl_dashboard->get_awaiting_bids($this->session->userdata('company_id'));
			$parse['awaiting_bid_count'] = $this->mdl_dashboard->get_awaiting_bids($this->session->userdata('company_id'),'Yes');
			$parse['count_panalist'] = $this->mdl_dashboard->count_panalists();
            $parse['pending_win_bid_detail'] = $this->mdl_dashboard->get_pending_win_bids($this->session->userdata('company_id'));
            $parse['win_projects_detail'] = $this->mdl_dashboard->get_win_projects($this->session->userdata('company_id'));
            $parse['recent_activity_desc'] = $this->mdl_dashboard->get_recent_activities();
            $parse['recent_users'] = $this->mdl_dashboard->get_recent_users();
            $parse['content'] = $this->parser->parse('dashboard/researcher', $parse, true);
        } else if($this->session->userdata('company_type') == 2){
            $parse['activity'] = $this->user_activity->getRecentActivity();            
            $parse['revenue'] = $this->mdl_dashboard->get_partner_revenue();
            $parse['won_projects'] = $this->mdl_dashboard->get_partner_total_won_projects();
            $parse['clients_served'] = $this->mdl_dashboard->get_partner_total_client_served();
            $parse['awaiting_bid'] = $this->mdl_dashboard->get_awaiting_partner_bids($this->session->userdata('company_id'));
            $parse['win_projects_detail'] = $this->mdl_dashboard->get_partner_win_projects($this->session->userdata('company_id'));
            $parse['content'] = $this->parser->parse('dashboard/partner', $parse, true);
        }
        $parse['cssFiles'] = $this->cssFiles;
        $parse['jsFiles'] = $this->jsFiles;
        $parse['success_msg'] = $this->lib_message->get_success_message();
        $parse['failure_msg'] = $this->lib_message->get_failure_message();
        $this->parser->parse('common/dashboard_layout', $parse);
    }

}
