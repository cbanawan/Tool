<?php

/**
 * Description of bids
 *
 * @author priyanka
 */
class bids extends CI_Controller {

    private $jsFiles;
    private $cssFiles;
    private $fee_type;

    function __construct() {
        parent::__construct();
        $this->authentication->check_session();
        $this->load->model('mdl_email_template'); 
        $this->load->library('lib_send_mail');
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

    public function fresh_bids() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_segments'] = $this->config->item('company_segment');
        $fresh_bids = $this->mdl_bids->get_statuswise_bids(0, 0);
        if (!empty($fresh_bids)) {
            foreach ($fresh_bids as $bid_val) {
                $bid_val->segment_delete = $this->mdl_project->check_project_country_delete($bid_val->project_country_id);
                $bid_val->projects_file_detail = $this->mdl_project->get_project_file_master($bid_val->project_id);
            }
        }
        $parse['fresh_bids'] = $fresh_bids;
        $parse['fee_type'] = $this->fee_type;
        $parse['content'] = $this->parser->parse('bids/fresh_bids', $parse, true);
        $site_nav_arr = $this->config->item('fresh_bid_list');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
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
        $parse['conversation_bids'] = $conversation_bids;
        $parse['content'] = $this->parser->parse('bids/conversation_bids', $parse, true);
        $site_nav_arr = $this->config->item('conv_bid_list');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Manage Bids";
        $parse['header_inner'] = "Conversation";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

    public function conversation_bid_details($project_long_key) {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_segments'] = $this->config->item('company_segment');
        $project_id = $this->mdl_project->get_id_from_long_key($project_long_key)->project_id;
        $conversation_bids = $this->mdl_bids->get_statuswise_bids(1, $project_id);
        $projects_file_detail = $this->mdl_project->get_project_file_master($project_id);
        $parse['projects_file_detail'] = $projects_file_detail;
        if (!empty($conversation_bids)) {
            foreach ($conversation_bids as $bid_val) {
                if ($bid_val->bid_type == 1) {
                    $sub_bid_detail = $this->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->researcher_id, $bid_val->project_country_id, false);
                } else {
                    $sub_bid_detail = $this->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->partner_id, $bid_val->project_country_id, true);
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
            }
        }
        $parse['conversation_bids'] = $conversation_bids;
        $parse['fee_type'] = $this->fee_type;
        $parse['content'] = $this->parser->parse('bids/conversation_bids_details', $parse, true);
        $site_nav_arr = $this->config->item('conv_detail_bid_list');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Manage Bids";
        $parse['header_inner'] = "Conversation Detail";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

    public function won_projects() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_segments'] = $this->config->item('company_segment');
        $parse['won_bids'] = $this->mdl_bids->get_statuswise_bids(3);
        $parse['content'] = $this->parser->parse('bids/won_projects', $parse, true);
        $site_nav_arr = $this->config->item('won_projects');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Manage Bids";
        $parse['header_inner'] = "Won Projects";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

    public function won_project_details($project_long_key) {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_segments'] = $this->config->item('company_segment');
        $project_id = $this->mdl_project->get_id_from_long_key($project_long_key)->project_id;
        $won_bids = $this->mdl_bids->get_statuswise_bids(3, $project_id);
        $projects_file_detail = $this->mdl_project->get_project_file_master($project_id);
        $parse['projects_file_detail'] = $projects_file_detail;
        if (!empty($won_bids)) {
            foreach ($won_bids as $bid_val) {
                if ($bid_val->bid_type == 1) {
                    $sub_bid_detail = $this->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->researcher_id, $bid_val->project_country_id, false);
                } else {
                    $sub_bid_detail = $this->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->partner_id, $bid_val->project_country_id, true);
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
            }
        }
        $parse['won_bids'] = $won_bids;
        $parse['content'] = $this->parser->parse('bids/won_project_details', $parse, true);
        $site_nav_arr = $this->config->item('won_project_detail');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Manage Bids";
        $parse['header_inner'] = "Won Project Detail";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

//    public function _won_projects() {
//        $parse = array();
//        $parse['header'] = $this->parser->parse('common/header', $parse, true);
//        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
//        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
//        $parse['project_segments'] = $this->config->item('company_segment');
//        $parse['won_bids'] = $this->mdl_bids->get_statuswise_bids(3);
//        $parse['content'] = $this->parser->parse('bids/won_projects', $parse, true);
//        $site_nav_arr = $this->config->item('won_projects');
//        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
//        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
//        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
//        $parse['header_text'] = "Manage Bids";
//        $parse['header_inner'] = "Won Projects";
//        $parse['jsFiles'] = $this->jsFiles;
//        $this->parser->parse('common/layout', $parse);
//    }

    function send_bid() {
        if ($_POST) {
            $project_id = $this->input->post('project_id');
            $partner_id = $this->session->userdata('company_id');
            $compnay_admin = $this->mdl_company->get_company_detail($partner_id);
            if (isset($_POST['fresh_bid_id'])) {
                $this->mdl_project->update_read_status($project_id, $partner_id, $this->input->post('project_country_id'), false);
            }
            $bid_detail = array();
            $bid_detail['project_id'] = $this->input->post('project_id');
            $bid_detail['partner_id'] = $this->session->userdata('company_id');
            $bid_detail['partner_user_id'] = $this->session->userdata('user_id');
            $bid_detail['researcher_id'] = $this->input->post('researcher_id');
            $bid_detail['researcher_user_id'] = $this->input->post('researcher_user_id');
            $bid_detail['partner_user_id'] = $compnay_admin['company_primary_user'];
            $bid_detail['project_cpc'] = $this->input->post('search_prj_cpc');
            $bid_detail['bid_type'] = 2;
            if (isset($_POST['prj_management_fee'])) {
                $bid_detail['project_management_fee'] = $this->input->post('prj_management_fee');
            }
            $bid_detail['project_setup_cost'] = trim($_POST['prj_setup_cost']);
            $bid_detail['fee_type'] = trim($_POST['fee_type']);
            $bid_detail['bid_status'] = $this->input->post('bid_status');
            $bid_detail['is_read'] = $this->input->post('is_read');
            $bid_detail['hide_cpc'] = 0;
            $bid_detail['project_country_id'] = $this->input->post('project_country_id');
            $bid_detail['project_ncomplete'] = $this->input->post('search_prj_ncomplete');
            $bid_detail['bid_comments'] = trim($this->input->post('search_prj_comment'));
            $bid_detail['bid_createddate'] = date(DATE_FORMAT_DB);
            $bid_detail['bid_modifieddate'] = date(DATE_FORMAT_DB);
            $bid_detail['bid_remote_ip'] = $_SERVER['REMOTE_ADDR'];
            $bid_id = $this->mdl_project->insert_bid_replies($bid_detail);
            $this->lib_message->set_success_message('Bid send reply Successfully!!');
            
            
            $email_detail = $this->user_modal->get_user($bid_detail['researcher_user_id']);
            $compnay_partner = $this->mdl_company->get_company_detail($bid_detail['partner_id']);
            $projects_detail = $this->mdl_project->get_project_master($bid_detail['project_id']);
            
            
            $template = $this->mdl_email_template->get_template_by_short_code('bidreturnedresearcher');
            $parse = array();
            $parse['Full Name'] = $email_detail['user_name'];
            $parse['Partner'] = $compnay_partner['company_name'];
            $parse['Project_Name'] = $projects_detail['project_name'];
            $parse['Bid_URL'] = base_url('/projects/'.$this->mdl_project->get_long_key_from_id($bid_detail['project_id']));
            $content = $this->parser->parse_string($template['email_template_content'], $parse,true); 
                        
            $parse2= array();
            $parse2['Partner'] = $compnay_partner['company_name'];
            $parse2['Project_Name'] = $projects_detail['project_name'];
            $subject = $this->parser->parse_string($template['email_template_subject'], $parse2,true); 
            
            
            $toemail =$email_detail['user_email'];
            
            //echo $content;die;
            $this->lib_send_mail->send_mail($toemail, $subject, $content);
            
            
            
            
            $activity = array();
            if (isset($_POST['fresh_bid_id'])) {
                $activity = array();
                $activity['activity_type'] = "fresh bid";
                $activity['activity_description'] = sprintf(FRESH_BID_REPLY, $this->session->userdata('user_name'));
                $this->user_activity->insert_user_activity($activity);
                redirect('bids/fresh_bids');
            } else {
                $activity = array();
                $activity['activity_type'] = "conversastion";
                $activity['activity_description'] = sprintf(CONVERSATION_REPLY, $this->session->userdata('user_name'));
                $this->user_activity->insert_user_activity($activity);
                $long_key = $this->mdl_project->get_long_key_from_id($project_id)->project_long_key;
                redirect('bids/conversation_bid_details/' . $long_key);
            }
        }
    }

    function close_projects() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_segments'] = $this->config->item('company_segment');
        $project_detail = $this->mdl_bids->get_closed_projects();
        if (!empty($project_detail)) {
            foreach ($project_detail as $row) {
                $u = $this->mdl_bids->get_approved_by_name($row->partner_approved_by);
                if ($u) {
                    $row->approve_by_name = $u->user_name;
                    $row->approve_date = date(DATE_DISPLAY_FORMAT, strtotime($row->partner_approved_date));
                }
                $row->bid_sub_close = $this->mdl_project->get_project_sub_close_bid($row->project_id, $row->partner_id);
                $row->close_partner_project = $this->mdl_project->partner_project_close_detail($row->project_id, $row->partner_id);
                $sub_bid_detail = $this->mdl_project->get_sub_bid_close_partner($row->project_id, $row->researcher_id, $row->partner_id, $row->project_country_id);
                $segment_delete = $this->mdl_project->check_project_country_delete($row->project_country_id);
                $row->sub_bid = $sub_bid_detail;
                $row->segment_delete = $segment_delete;
            }
        }
        $parse['close_projects_approval'] = $project_detail;
        $parse['content'] = $this->parser->parse('bids/close_projects', $parse, true);
        $site_nav_arr = $this->config->item('close_projects');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Manage Bids";
        $parse['header_inner'] = "Close Projects";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

    function get_approval_project() {
        $parse = array();
        $parse['project_segments'] = $this->config->item('company_segment');
        $project_detail = $this->mdl_bids->get_closed_projects();
        if (!empty($project_detail)) {
            foreach ($project_detail as $row) {
                $u = $this->mdl_bids->get_approved_by_name($row->partner_approved_by);
                if ($u) {
                    $row->approve_by_name = $u->user_name;
                    $row->approve_date = date(DATE_DISPLAY_FORMAT, strtotime($row->partner_approved_date));
                }
                $row->bid_sub_close = $this->mdl_project->get_project_sub_close_bid($row->project_id, $row->partner_id);
                $row->close_partner_project = $this->mdl_project->partner_project_close_detail($row->project_id, $row->partner_id);
                $sub_bid_detail = $this->mdl_project->get_sub_bid_close_partner($row->project_id, $row->researcher_id, $row->partner_id, $row->project_country_id);
                $segment_delete = $this->mdl_project->check_project_country_delete($row->project_country_id);
                $row->sub_bid = $sub_bid_detail;
                $row->segment_delete = $segment_delete;
            }
        }
        $parse['close_projects_approval'] = $project_detail;
        echo $this->parser->parse('bids/close_projects_approval', $parse, true);
    }

    function get_approved_project() {
        $parse = array();
        $parse['project_segments'] = $this->config->item('company_segment');
        $approved_projects = $this->mdl_bids->get_closed_projects(1);
        if (!empty($approved_projects)) {
            foreach ($approved_projects as $row) {
                $u = $this->mdl_bids->get_approved_by_name($row->partner_approved_by);
                if ($u) {
                    $row->approve_by_name = $u->user_name;
                    $row->approve_date = date(DATE_DISPLAY_FORMAT, strtotime($row->partner_approved_date));
                }
                $row->bid_sub_close = $this->mdl_project->get_project_sub_close_bid($row->project_id, $row->partner_id);
                $row->close_partner_project = $this->mdl_project->partner_project_close_detail($row->project_id, $row->partner_id);
                $sub_bid_detail = $this->mdl_project->get_sub_bid_close_partner($row->project_id, $row->researcher_id, $row->partner_id, $row->project_country_id);
                $segment_delete = $this->mdl_project->check_project_country_delete($row->project_country_id);
                $row->sub_bid = $sub_bid_detail;
                $row->segment_delete = $segment_delete;
            }
        }
        $parse['close_projects_approved'] = $approved_projects;
        echo $this->parser->parse('bids/close_projects_approved', $parse, true);
    }

    function approve_project() {
        $json['data'] = 'fail';
        $project_id = trim($this->input->post('project_id'));
        $project_country_id = trim($this->input->post('project_country_id'));
        $rows = $this->mdl_bids->approve_project($project_id, $project_country_id);
        if ($rows > 0) {
            $json['data'] = "success";
        }
        echo json_encode($json);
        exit();
    }

    function confirm_payment() {
        $json = 'fail';
        $project_id = trim($this->input->post('project_id'));
        $project_country_id = trim($this->input->post('project_country_id'));
        $rows = $this->mdl_bids->save_confirm_payment($project_id, $project_country_id, trim($this->input->post('amount')));
        if (intval($rows) > 0) {
            $activity = array();
            $activity['activity_type'] = "confirm payment";
            $activity['activity_description'] = sprintf(APPROVE_PROJECT, $this->session->userdata('user_name'));
            $this->user_activity->insert_user_activity($activity);
            $json = "success";
        }
        echo trim($json);
        exit();
    }

    function manage_projects() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_segments'] = $this->config->item('company_segment');
        $parse['content'] = $this->parser->parse('bids/manage_projects', $parse, true);
        $site_nav_arr = $this->config->item('manage_project');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Manage Projects";
        $parse['header_inner'] = "Projects";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

    function get_all_vendor_projects() {
        $aColumns = array('project_id', 'project_name', 'project_createddate', 'project_created_by', 'project_status');
        $data = $this->lib_common->datatable_basics($aColumns);
        $sEcho = $data['sEcho'];
        $limit = $data['limit'];
        $offset = $data['offset'];
        $sort_array = $data['sort_array'];

        /*
         * Filtering         
         */
        $filter_data = array();
        if ($_POST) {
            if (isset($_POST['project_name']) && $_POST['project_name'] != "") {
                $filter_data['project_name'] = trim($_POST['project_name']);
            }
        }
        $rResult = $this->mdl_bids->get_vendor_projects($filter_data, $sort_array, $limit, $offset);
        $iTotal = $this->mdl_bids->get_vendor_projects_total($filter_data);
        $iFilteredTotal = count($rResult);
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
                    if ($col == "project_name") {
                        $row[] = '<a href="' . base_url() . 'bids/manage_project_tabs/' . $m->project_long_key . '">' . $m->project_name . '</a>';
                    } else if ($col == 'project_created_by') {
                        $user_res = $this->user_modal->get_user($m->project_created_by);
                        if (!empty($user_res)) {
                            $row[] = $user_res['user_name'];
                        } else {
                            $row[] = "";
                        }
                    } else if ($col == 'project_status') {
                        $bid_status_res = $this->mdl_project->get_bid_status_project($m->project_id);
                        if (isset($bid_status_res) && $bid_status_res != '') {
                            if ($bid_status_res->bid_status == 0) {
                                $bid_status = 'Bid sent';
                            } else if ($bid_status_res->bid_status == 1) {
                                $bid_status = 'Bid conversation';
                            } else if ($bid_status_res->bid_status == 2) {
                                $bid_status = 'Close Project';
                            } else if ($bid_status_res->bid_status == 3) {
                                $bid_status = 'Won';
                            }
                        } else {
                            $bid_status = 'Fresh setup';
                        }
                        if ($m->project_status == 1) {
                            $row[] = '<span class="label label-sm label-success">Active</span>&nbsp;&nbsp;<span class="label label-sm label-info" >' . $bid_status . '</span>';
                        } else if ($m->project_status == 0) {
                            $row[] = '<span class="label label-sm label-danger">Inactive</span>&nbsp;&nbsp;<span class="label label-sm label-info">' . $bid_status . '</span>';
                        } else {
                            $row[] = '<span class="label label-sm label-default ">Close</span>&nbsp;&nbsp;<span class="label label-sm label-info">' . $bid_status . '</span>';
                        }
                    } else {
                        $row[] = $m->$col;
                    }
                }
                array_push($output['aaData'], $row);
            }
        }
        echo json_encode($output);
        exit();
    }

    function manage_project_tabs($project_long_key) {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_segments'] = $this->config->item('company_segment');

        $project_id = $this->mdl_project->get_id_from_long_key($project_long_key)->project_id;
        $fresh_bids = $this->mdl_bids->get_statuswise_bids(0, $project_id);
        if (!empty($fresh_bids)) {
            foreach ($fresh_bids as $bid_val) {
                $bid_val->segment_delete = $this->mdl_project->check_project_country_delete($bid_val->project_country_id);
                $bid_val->projects_file_detail = $this->mdl_project->get_project_file_master($bid_val->project_id);
            }
        }
        $parse['fresh_bids'] = $fresh_bids;
        ////////////////
        $conversation_bids = $this->mdl_bids->get_statuswise_bids(1, $project_id);
        $projects_file_detail = $this->mdl_project->get_project_file_master($project_id);
        $parse['projects_file_detail'] = $projects_file_detail;
        if (!empty($conversation_bids)) {
            foreach ($conversation_bids as $bid_val) {
                if ($bid_val->bid_type == 1) {
                    $sub_bid_detail = $this->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->researcher_id, $bid_val->project_country_id, false);
                } else {
                    $sub_bid_detail = $this->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->partner_id, $bid_val->project_country_id, true);
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
            }
        }
        $parse['conversation_bids'] = $conversation_bids;
        //////////////////////////
        $won_bids = $this->mdl_bids->get_statuswise_bids(3, $project_id);
        $projects_file_detail = $this->mdl_project->get_project_file_master($project_id);
        $parse['projects_file_detail'] = $projects_file_detail;
        if (!empty($won_bids)) {
            foreach ($won_bids as $bid_val) {
                if ($bid_val->bid_type == 1) {
                    $sub_bid_detail = $this->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->researcher_id, $bid_val->project_country_id, false);
                } else {
                    $sub_bid_detail = $this->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->partner_id, $bid_val->project_country_id, true);
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
            }
        }
        $parse['won_bids'] = $won_bids;
        //////////////////////////////////////////
        $approved_projects = $this->mdl_bids->get_closed_projects(1, $project_id);
        if (!empty($approved_projects)) {
            foreach ($approved_projects as $row) {
                $u = $this->mdl_bids->get_approved_by_name($row->partner_approved_by);
                if ($u) {
                    $row->approve_by_name = $u->user_name;
                    $row->approve_date = date(DATE_DISPLAY_FORMAT, strtotime($row->partner_approved_date));
                }
                $row->bid_sub_close = $this->mdl_project->get_project_sub_close_bid($row->project_id, $row->partner_id);
                $row->close_partner_project = $this->mdl_project->partner_project_close_detail($row->project_id, $row->partner_id);
                $sub_bid_detail = $this->mdl_project->get_sub_bid_close_partner($row->project_id, $row->researcher_id, $row->partner_id, $row->project_country_id);
                $segment_delete = $this->mdl_project->check_project_country_delete($row->project_country_id);
                $row->sub_bid = $sub_bid_detail;
                $row->segment_delete = $segment_delete;
            }
        }
        $parse['close_projects_approved'] = $approved_projects;
        ////////
        $parse['fee_type'] = $this->fee_type;
        $parse['content'] = $this->parser->parse('bids/manage_project_tabs', $parse, true);
        $site_nav_arr = $this->config->item('manage_project');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Manage Projects";
        $parse['header_inner'] = "Bid Detail";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

}
