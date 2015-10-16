<?php

/**
 * Description of bids
 *
 * @author priyanka
 */
class bids extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->authentication->check_session();
        $this->loadJs();
        $this->loadCSS();
        $this->load->model('mdl_bids');
        $this->load->model('mdl_project');
        $this->load->model('mdl_company');
        $this->load->model('user_modal');
//        $this->load->config('pp_config');
    }

    private function loadCSS() {
        $this->cssFiles = array();
    }

    private function loadJs() {
        $this->jsFiles = array();
        $this->jsFiles[] = JS . 'bids.js';
    }

    public function fresh_bids() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_segments'] = $this->config->item('company_segment');
        $fresh_bids = $this->mdl_bids->get_statuswise_bids(0);
        foreach ($fresh_bids as $bid_val) {
                $bid_val->segment_delete = $this->mdl_project->check_project_country_delete($bid_val->project_country_id);
        }
        $parse['fresh_bids'] = $fresh_bids;
        $parse['content'] = $this->parser->parse('bids/fresh_bids', $parse, true);
        $site_nav_arr = $this->config->item('fresh_bid_list');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
//        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Manage Bids";
        $parse['header_inner'] = "Fresh Bids";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

    public function conversation() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_segments'] = $this->config->item('company_segment');
        $conversation_bids = $this->mdl_bids->get_statuswise_bids(1);
//        $i = 0;
        foreach ($conversation_bids as $bid_val) {
            if ($bid_val->bid_type == 1) {
                $sub_bid_detail = $this->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->researcher_id, false);
            } else {
                $sub_bid_detail = $this->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->partner_id, true);
            }
            $segment_delete = $this->mdl_project->check_project_country_delete($bid_val->project_country_id);
            $bid_val->sub_bid = $sub_bid_detail;
            $bid_val->segment_delete = $segment_delete;
            foreach ($sub_bid_detail as $sub_bid) {
                if (intval($sub_bid->bid_type) == 1) {                   
                    $bid_user_name = $this->user_modal->get_user($sub_bid->researcher_user_id);
                    $company_detail = $this->mdl_company->get_company_detail($sub_bid->researcher_id);
                    
                } else {                    
                    $bid_user_name = $this->user_modal->get_user($sub_bid->partner_user_id);
                    $company_detail = $this->mdl_company->get_company_detail($sub_bid->partner_id);                    
                }
                $sub_bid->bid_user = $bid_user_name;
                $sub_bid->company_detail = $company_detail;
            }            
//            $conversation_bids->$i->segment_delete = $segment_delete;
//            $i++;
            }
            $parse['conversation_bids'] = $conversation_bids;
            $parse['content'] = $this->parser->parse('bids/conversation_bids', $parse, true);
            $site_nav_arr = $this->config->item('conv_bid_list');
            $parse['site_nav'] = $site_nav_arr['breadcrumb'];
//        $parse['actions'] = $site_nav_arr['action_view'];
            $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
            $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
            $parse['header_text'] = "Manage Bids";
            $parse['header_inner'] = "Conversation";
            $parse['jsFiles'] = $this->jsFiles;
            $this->parser->parse('common/layout', $parse);
        }

        public

        function won_projects() {
            $parse = array();
            $parse['header'] = $this->parser->parse('common/header', $parse, true);
            $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
            $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
            $parse['project_segments'] = $this->config->item('company_segment');
            $parse['won_bids'] = $this->mdl_bids->get_statuswise_bids(3);
            $parse['content'] = $this->parser->parse('bids/won_projects', $parse, true);
            $site_nav_arr = $this->config->item('won_projects');
            $parse['site_nav'] = $site_nav_arr['breadcrumb'];
//        $parse['actions'] = $site_nav_arr['action_view'];
            $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
            $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
            $parse['header_text'] = "Manage Bids";
            $parse['header_inner'] = "Won Projects";
            $parse['jsFiles'] = $this->jsFiles;
            $this->parser->parse('common/layout', $parse);
        }

        function send_bid() {
            if ($_POST) {
                $project_id = $this->input->post('project_id');
                $partner_id = $this->session->userdata('company_id');
//            $partner_id = $this->input->post('partner_id');
                $this->load->model('mdl_company');
                $compnay_admin = $this->mdl_company->get_company_detail($partner_id);
                $bid_detail = array();
                $bid_detail['project_id'] = $this->input->post('project_id');
                $bid_detail['partner_id'] = $this->session->userdata('company_id');
                $bid_detail['partner_user_id'] = $this->session->userdata('user_id');
                $bid_detail['researcher_id'] = $this->input->post('researcher_id');
                $bid_detail['partner_user_id'] = $compnay_admin['company_primary_user'];
                $bid_detail['project_cpc'] = $this->input->post('search_prj_cpc');
                $bid_detail['bid_type'] = 2;
                $bid_detail['bid_status'] = $this->input->post('bid_status');
                $bid_detail['is_read'] = $this->input->post('is_read');
                $bid_detail['hide_cpc'] = $this->input->post('search_prj_hide_cpc');
                $bid_detail['project_country_id'] = $this->input->post('project_country_id');
                $bid_detail['project_ncomplete'] = $this->input->post('search_prj_ncomplete');
                $bid_detail['bid_comments'] = trim($this->input->post('search_prj_comment'));
                $bid_detail['bid_createddate'] = date(DATE_FORMAT_DB);
                $bid_detail['bid_modifieddate'] = date(DATE_FORMAT_DB);
                $bid_detail['bid_remote_ip'] = $_SERVER['REMOTE_ADDR'];
                $bid_id = $this->mdl_project->insert_bid_replies($bid_detail);
                $this->lib_message->set_success_message('Bid send Successfully!!');
//            $this->session->set_userdata('active_project_tab', 'tab_search_project');
                redirect('bids/fresh_bids');
            }
        }

    }
    