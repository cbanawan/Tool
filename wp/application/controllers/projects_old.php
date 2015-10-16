<?php

/**
 * Description of projects
 *
 * @author Rita
 */
class projects extends CI_Controller {

    private $jsFiles;
    private $cssFiles;
    private $project_details = '';

    function __construct() {
        parent::__construct();
        $this->authentication->check_session();
        $this->loadJs();
        $this->loadCSS();
        $this->load->config('pp_config');
        $this->load->model('mdl_project');
    }

    private function loadCSS() {
        $this->cssFiles = array();
        $this->cssFiles[] = JS . 'select2/select2_metro.css';
        $this->cssFiles[] = JS . 'jquery-tags-input/jquery.tagsinput.css';
    }

    private function loadJs() {
        $this->jsFiles = array();
        $this->jsFiles[] = JS . 'select2/select2.min.js';
        $this->jsFiles[] = JS . 'jquery-tags-input/jquery.tagsinput.min.js';
        $this->jsFiles[] = JS . 'project.js';
    }

    public function index() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['content'] = $this->parser->parse('projects/projects_list', $parse, true);
        $site_nav_arr = $this->config->item('project_list');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Projects";
        $parse['header_inner'] = "Manage Project";
        $parse['cssFiles'] = $this->cssFiles;
        $parse['jsFiles'] = $this->jsFiles;
        $parse['success_msg'] = $this->lib_message->get_success_message();
        $parse['failure_msg'] = $this->lib_message->get_failure_message();
        $this->parser->parse('common/layout', $parse);
    }

    function add_project() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['country'] = $this->config->item('country');
        $parse['project_segments'] = $this->config->item('company_segment');
//        $parse['project_extra_field'] = $this->parser->parse();
        $parse['content'] = $this->parser->parse('projects/add_project', $parse, true);
        $site_nav_arr = $this->config->item('project_add');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Projects";
        $parse['header_inner'] = "Add Project";
        $parse['cssFiles'] = $this->cssFiles;
        $parse['jsFiles'] = $this->jsFiles;
        $parse['success_msg'] = $this->lib_message->get_success_message();
        $parse['failure_msg'] = $this->lib_message->get_failure_message();
        $this->parser->parse('common/layout', $parse);
    }

    function edit_project($project_id) {
        $parse = array();
        $projects_detail = $this->mdl_project->get_projects($project_id);
        $this->project_details = $projects_detail;
        $parse['project_details'] = $projects_detail;
        $parse['project_id'] = $project_id;
//        $parse['projects'] = $this->mdl_project->get_projects($project_id);
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);

        $parse['project_details'] = $this->project_details($project_id);
//        $parse['project_search_view'] = $this->do_search($projects_detail['project_countries'], $projects_detail['project_segments'], $projects_detail['project_target'], $project_id);
        $parse['content'] = $this->parser->parse('projects/edit_project', $parse, true);
        $site_nav_arr = $this->config->item('project_edit');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Projects";
        $parse['header_inner'] = "Edit " . $projects_detail[0]['project_name'];
        $parse['cssFiles'] = $this->cssFiles;
        $parse['jsFiles'] = $this->jsFiles;
        $parse['success_msg'] = $this->lib_message->get_success_message();
        $parse['failure_msg'] = $this->lib_message->get_failure_message();
        $this->parser->parse('common/layout', $parse);
    }

    function project_details($project_id = NULL) {
        $parse = array();
        if ($_POST) {
            $project_id = $_POST['project_id'];
        }
        if ($this->project_details != "" && $project_id !== $this->project_details[0]['project_id']) {
            $projects_detail = $this->mdl_project->get_projects($project_id);
        } else {
            $projects_detail = $this->project_details;
        }

        $parse['country'] = $this->config->item('country');
		$parse['country_json'] = $this->config->item('country_json');
		//echo "<pre>";
		//print_r($this->config->item('country_json'));die;
        $parse['project_segments'] = $this->config->item('company_segment');
        $parse['projects'] = $projects_detail;
        if ($_POST) {
            echo $this->parser->parse('projects/tabs/project_details', $parse, TRUE);
        } else {
            return $this->parser->parse('projects/tabs/project_details', $parse, TRUE);
        }
    }

    public function do_search_project() {
        $parse = array();
        if ($_POST) {
            $project_id = $_POST['project_id'];
            if ($this->project_details != "" && $project_id == $this->project_details[0]['project_id']) {
                $projects_detail = $this->project_details;
            } else {
                $projects_detail = $this->mdl_project->get_projects($project_id);
            }
           $parse['partners'] = $this->mdl_project->search_partners_data($project_id);
            $parse['projects'] = $this->mdl_project->get_projects($project_id);
            echo $this->parser->parse('projects/tabs/project_search_result', $parse, TRUE);
        }
    }

    function bid_replies() {
        $parse = array();
        if ($_POST) {
            $project_id = $_POST['project_id'];
            if ($this->project_details != "" && $project_id == $this->project_details[0]['project_id']) {
                $projects_detail = $this->project_details;
            } else {
                $projects_detail = $this->mdl_project->get_projects($project_id);
            }
            echo $this->parser->parse('projects/tabs/bid_replies', $parse, TRUE);
        }
    }

    function awarded_partners() {
        $parse = array();
        if ($_POST) {
            $project_id = $_POST['project_id'];
            if ($this->project_details != "" && $project_id == $this->project_details[0]['project_id']) {
                $projects_detail = $this->project_details;
            } else {
                $projects_detail = $this->mdl_project->get_projects($project_id);
            }
            echo $this->parser->parse('projects/tabs/awarded_partners', $parse, TRUE);
        }
    }

    function closing_details() {
        $parse = array();
        if ($_POST) {
            $project_id = $_POST['project_id'];
            if ($this->project_details != "" && $project_id == $this->project_details[0]['project_id']) {
                $projects_detail = $this->project_details;
            } else {
                $projects_detail = $this->mdl_project->get_projects($project_id);
            }
            echo $this->parser->parse('projects/tabs/closing_details', $parse, TRUE);
        }
    }

    function insert_project() {
        if ($_POST) {

            $company_id = $this->input->post('company_id');
            $project_detail = array();
            $project_detail['project_name'] = trim($this->input->post('project_name'));
//            $project_detail['project_countries'] = $this->input->post('hdn_project_country');
            $project_detail['project_note'] = trim($this->input->post('project_notes'));
            $project_detail['researcher_id'] = $company_id;
            $project_detail['project_status'] = 1;
            $project_detail['project_createddate'] = date(DATE_FORMAT_DB);
            $project_detail['project_modifieddate'] = date(DATE_FORMAT_DB);
            $project_detail['project_remoteip'] = $_SERVER['REMOTE_ADDR'];

            $project_id = $this->mdl_project->insert_project($project_detail);
            if ($project_id > 0) {
                $other_proj_details = array();
                $other_proj_details['project_id'] = $project_id;
                $countries = explode(",", $this->input->post('hdn_project_country'));
                foreach ($countries as $k => $cntry) {
                    $other_proj_details['country_id'] = $cntry;
                    $other_proj_details['project_segments'] = $_POST['project_segments'][$k];
                    $other_proj_details['project_target'] = $_POST['project_target'][$k];
                    $other_proj_details['project_ir'] = $_POST['project_ir'][$k];
                    $other_proj_details['project_loi'] = $_POST['project_loi'][$k];
                    $other_proj_details['project_cpc'] = $_POST['project_cpc'][$k];
                    $other_proj_details['project_ncomplete'] = $_POST['project_ncomplete'][$k];
                    $this->mdl_project->insert_project_country_master($other_proj_details);
                }
            }
            $this->lib_message->set_success_message('Project Added Successfully!!');
            redirect('projects');
            exit;
        }
    }

    function send_bid() {
        if ($_POST) {
            $project_id = $this->input->post('project_id');
            $partner_id = $this->input->post('partner_id');
            $compnay_admin = $this->user_modal->get_company_admin($partner_id);
            $bid_detail = array();
            $bid_detail['project_id'] = $this->input->post('project_id');
            $bid_detail['researcher_id'] = $this->input->post('researcher_id');
            $bid_detail['researcher_user_id'] = $this->input->post('researcher_user_id');
            $bid_detail['partner_id'] = $this->input->post('partner_id');
            $bid_detail['partner_user_id'] = $compnay_admin->user_id;
            $bid_detail['project_cpc'] = $this->input->post('project_cpc');
            $bid_detail['hide_cpc'] = $this->input->post('hide_cpc');
            $bid_detail['project_cpc'] = $this->input->post('project_cpc');
            $bid_detail['project_ncomplete'] = $this->input->post('project_ncomplete');
            $bid_detail['bid_comments'] = trim($this->input->post('comment'));
            $bid_detail['bid_createddate'] = date(DATE_FORMAT_DB);
            $bid_detail['bid_modifieddate'] = date(DATE_FORMAT_DB);
            $bid_detail['bid_remote_ip'] = $_SERVER['REMOTE_ADDR'];

            $this->mdl_project->insert_bid_replies($bid_detail);
            $this->lib_message->set_success_message('Bid send Successfully!!');
            redirect('projects/edit_project/' . $project_id);
            exit;
        }
    }

    function update_project() {
        if ($_POST) {
            $company_id = $this->input->post('company_id');
            $project_id = $this->input->post('project_id');
            $project_detail = array();
            
            $project_detail['project_name'] = trim($this->input->post('project_name'));
//            $project_detail['project_countries'] = $this->input->post('hdn_project_country');
            $project_detail['project_note'] = trim($this->input->post('project_notes'));
            $project_detail['researcher_id'] = $company_id;
            $project_detail['project_status'] = 1;
            $project_detail['project_modifieddate'] = date(DATE_FORMAT_DB);
            $res = $this->mdl_project->update_project_detail($project_id, $project_detail);
            if ($res > 0) {
                $this->mdl_project->delete_project_country($project_id);
                $other_proj_details = array();
                $other_proj_details['project_id'] = $project_id;
                $countries = explode(",", $this->input->post('hdn_project_country'));
                foreach ($countries as $k => $cntry) {
                    $other_proj_details['country_id'] = $cntry;
                    $other_proj_details['project_segments'] = $_POST['project_segments'][$k];
                    $other_proj_details['project_target'] = $_POST['project_target'][$k];
                    $other_proj_details['project_ir'] = $_POST['project_ir'][$k];
                    $other_proj_details['project_loi'] = $_POST['project_loi'][$k];
                    $other_proj_details['project_cpc'] = $_POST['project_cpc'][$k];
                    $other_proj_details['project_ncomplete'] = $_POST['project_ncomplete'][$k];
                    $this->mdl_project->insert_project_country_master($other_proj_details);
                }
            }
            $this->lib_message->set_success_message('Project Updated Successfully!!');
            redirect('projects/edit_project/' . $project_id);
            exit;
        }
    }

    function delete_project() {
        if ($_POST) {
            $rows = $this->mdl_project->delete_project($_POST['project_id']);
            if ($rows > 0) {
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }

    function clone_project() {
        if ($_POST) {
            $projects_detail = $this->mdl_project->get_projects($_POST['project_id']);
			$project = array();
            $project['project_name'] = 'clone-'.trim($projects_detail[0]['project_name']);
            $project['project_note'] = $projects_detail[0]['project_note'];
            $project['researcher_id'] = $projects_detail[0]['researcher_id'];
            $project['project_status'] = $projects_detail[0]['project_status'];
            $project['project_createddate'] = date(DATE_FORMAT_DB);
            $project['project_modifieddate'] = date(DATE_FORMAT_DB);
            $project['project_remoteip'] = $_SERVER['REMOTE_ADDR'];			            
            $rows = $this->mdl_project->insert_project($project);
            if ($rows > 0) {
			$other_proj_details = array();
                $other_proj_details['project_id'] = $rows;
			   foreach($projects_detail as $val){
				$other_proj_details['country_id'] = $val['country_id'];
                    $other_proj_details['project_segments'] = $val['project_segments'];
                    $other_proj_details['project_target'] = $val['project_target'];
                    $other_proj_details['project_ir'] = $val['project_ir'];
                    $other_proj_details['project_loi'] = $val['project_loi'];
                    $other_proj_details['project_cpc'] = $val['project_cpc'];
                    $other_proj_details['project_ncomplete'] = $val['project_ncomplete'];
                    $this->mdl_project->insert_project_country_master($other_proj_details);
			   }
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }

    public function get_all_projects() {
//        $aColumns = array('', 'project_name', 'project_ir', 'project_loi', 'project_cpc', 'project_ncomplete', 'project_target', 'actions');
        $aColumns = array('', 'project_name', 'project_status', 'actions');
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
            if (isset($_POST['project_name']) && $_POST['project_name'] != "") {
                $filter_data['project_name'] = trim($_POST['project_name']);
            }
        }
        $rResult = $this->mdl_project->get_project_list($filter_data, $sort_array, $limit, $offset);
        $iTotal = $this->mdl_project->get_project_list_total($filter_data);
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
                        $str = '<a id="edit_project_' . $m->project_id . '" href="' . base_url('projects/edit_project/' . $m->project_id) . '">
                            <span class="icons" rel="tooltip" title="Edit Project" ><i class="fa fa-edit fa-lg"></i></span></a>';
                        $str .= '<a id="rmvProject_' . $m->project_id . '" style="margin-left: 7px;" href="javascript:void(0);"><span class="" rel="tooltip" title="Delete"><i class="fa fa-trash-o fa-lg"></i></span></a>';
                        $str .= '<a id="cloneProject_' . $m->project_id . '" style="margin-left: 7px;" href="javascript:void(0);" ><span class="" rel="tooltip" title="Clone"><i class="fa fa-files-o fa-lg"></i></span></a>';
                        $row[] = $str;
                    } else if ($col == "") {
                        $row[] = '<input type="checkbox" class="checkboxes" value="' . $m->project_id . '"/>';
                    } else if ($col == 'project_status') {
                        if ($m->project_status == 1) {
                            $row[] = '<span class="label label-sm label-success">Active</span>';
                        } else {
                            $row[] = '<span class="label label-sm label-danger">In Active</span>';
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

    //    public function search_project() {
//        $parse = array();
//        $parse['header'] = $this->parser->parse('common/header', $parse, true);
//        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
//        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
//        $parse['country'] = $this->config->item('country');
//        $parse['segment'] = $this->config->item('company_segment');
//        $parse['content'] = $this->parser->parse('projects/projects_search', $parse, true);
//        $breadcrumb = $this->config->item('project_search');
//        $parse['site_nav'] = $breadcrumb['breadcrumb'];
//        $parse['actions'] = $breadcrumb['action_view'];
//        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
//        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
//        $parse['header_text'] = "Projects";
//        $parse['header_inner'] = "Search Project";
//        $parse['cssFiles'] = $this->cssFiles;
//        $parse['jsFiles'] = $this->jsFiles;
//        $this->parser->parse('common/layout', $parse);
//    }
//    public function do_search($countries, $segments, $targets, $project_id) {
//        $parse = array();
//        $parse['partners'] = $this->mdl_project->search_partners_data($countries, $segments, $targets);
//        $parse['projects'] = $this->mdl_project->get_projects($project_id);
//        return $this->parser->parse('projects/project_search_result', $parse, TRUE);
//    }
}
