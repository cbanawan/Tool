<?php

/**
 * Description of track
 *
 * @author Sank
 */
class track extends CI_Controller {

    private $jsFiles;
    private $cssFiles;
     private $fee_type;

    function __construct() {
        parent::__construct();
        $this->loadJs();
        $this->loadCSS();
        $this->load->model('mdl_bids');
        $this->load->model('mdl_project');
        $this->load->model('mdl_company');
        $this->load->model('user_modal');
        $this->load->config('pp_config');
        $this->fee_type = $this->config->item('fee_type');
    }

    private function loadCSS() {
        $this->cssFiles = array();
    }

    private function loadJs() {
        $this->jsFiles = array();
        $this->jsFiles[] = JS . 'bids.js';
    }
    
    function bid($long_key){
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_segments'] = $this->config->item('company_segment');
//        $project_id = $this->mdl_project->get_id_from_long_key($project_long_key)->project_id;
//        $conversation_bids = $this->mdl_bids->get_statuswise_bids(1, $project_id);
        $conversation_bids = $this->mdl_bids->get_bid_detail($long_key);
        $project_id = $conversation_bids['project_id'];
        $projects_file_detail = $this->mdl_project->get_project_file_master($project_id);
        $parse['projects_file_detail'] = $projects_file_detail;
        if (!empty($conversation_bids)) {
//            foreach ($conversation_bids as $bid_val) {
                if ($conversation_bids['bid_type'] == 1) {
                    $sub_bid_detail = $this->mdl_project->get_project_sub_bid($conversation_bids['project_id'], $conversation_bids['researcher_id'], $conversation_bids['project_country_id'], false);
                } else {
                    $sub_bid_detail = $this->mdl_project->get_project_sub_bid($conversation_bids['project_id'], $conversation_bids['partner_id'], $conversation_bids['project_country_id'], true);
                }
                $segment_delete = $this->mdl_project->check_project_country_delete($conversation_bids['project_country_id']);
                $conversation_bids['sub_bid'] = $sub_bid_detail;
                $conversation_bids['segment_delete'] = $segment_delete;
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
//            }
        }
        $parse['conversation_bids'] = $conversation_bids;
        $parse['fee_type'] = $this->fee_type;
        $parse['content'] = $this->parser->parse('bids/bid_detail', $parse, true);
//        $site_nav_arr = $this->config->item('conv_detail_bid_list');
//        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Bids";
        $parse['header_inner'] = "Bid Detail";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

}
