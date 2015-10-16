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
        $this->load->model('mdl_email_template'); 
        $this->load->library('lib_send_mail');
        $this->loadJs();
        $this->loadCSS();
        $this->load->config('pp_config');
		$this->load->model('mdl_project');
		$this->load->model('mdl_company');
    }

    private function loadCSS() {
        $this->cssFiles = array();
        $this->cssFiles[] = JS . 'bootstrap-datepicker/css/datepicker.css';
        $this->cssFiles[] = JS . 'select2/select2_metro.css';
        $this->cssFiles[] = JS . 'jquery-tags-input/jquery.tagsinput.css';
        
        //$this->cssFiles[] = JS . 'jquery.rating.css';
    }

    private function loadJs() {
        $this->jsFiles = array();
        $this->jsFiles[] = JS . 'bootstrap-datepicker/js/bootstrap-datepicker.js';
        $this->jsFiles[] = JS . 'select2/select2.min.js';
        $this->jsFiles[] = JS . 'jquery-tags-input/jquery.tagsinput.min.js';
        
       // $this->jsFiles[] = JS . 'jquery.rating.js';
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

    function edit_project($project_long_key) {
        $parse = array();
		$project_get = $this->mdl_project->get_id_from_long_key($project_long_key);
		$project_id = $project_get->project_id;
        $projects_detail = $this->mdl_project->get_project_master($project_id);
        $this->project_details = $projects_detail;
        $parse['project_details'] = $projects_detail;
        $parse['active_project_tab'] = $this->session->userdata('active_project_tab');
        $parse['project_id'] = $project_id;
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['project_details'] = $this->project_details($project_id);
        $parse['content'] = $this->parser->parse('projects/edit_project', $parse, true);
        $site_nav_arr = $this->config->item('project_edit');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Projects";
        $parse['header_inner'] = "Edit " . $projects_detail['project_name'];
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
        $projects_detail = $this->mdl_project->get_project_master($project_id);
        $projects_file_detail = $this->mdl_project->get_project_file_master($project_id);
        $projects_country_detail = $this->mdl_project->get_project_country($project_id);
        $parse['country'] = $this->config->item('country');
        $parse['project_segments'] = $this->config->item('company_segment');
        $parse['projects'] = $projects_detail;
        $parse['projects_country_details'] = $projects_country_detail;
        $parse['projects_file_detail'] = $projects_file_detail;

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
            $partners_detail = $this->mdl_project->search_partners_data($project_id);

            $parse['project_segments'] = $this->config->item('company_segment');

            $parse['partners'] = $partners_detail;
            $parse['project_id'] = $project_id;

            $parse['projects'] = $this->mdl_project->get_projects($project_id);
			
            echo $this->parser->parse('projects/tabs/project_search_result', $parse, TRUE);
        }
    }

    function bid_replies() {
        $parse = array();
        if ($_POST) {
            $project_id = $_POST['project_id'];
            
            $parse['project_segments'] = $this->config->item('company_segment');
            $parse['bid_detail'] = $this->mdl_project->get_project_bid($project_id, 'bid_replies');
            $parse['project_id'] = $project_id;
            echo $this->parser->parse('projects/tabs/bid_replies', $parse, TRUE);
        }
    }

    function awarded_partners() {
        $parse = array();
        if ($_POST) {
            $project_id = $_POST['project_id'];
            $parse['project_segments'] = $this->config->item('company_segment');
            $parse['bid_detail'] = $this->mdl_project->get_project_bid($project_id, 'awarded_partner');
            $parse['project_id'] = $project_id;
            echo $this->parser->parse('projects/tabs/awarded_partners', $parse, TRUE);
        }
    }

    function closing_details() {
        $parse = array();
        if ($_POST) {
            $project_id = $_POST['project_id'];
            $parse['project_segments'] = $this->config->item('company_segment');
            $parse['close_master_detail'] = $this->mdl_project->project_close_master($project_id);
            $bid_detail = $this->mdl_project->get_project_bid($project_id, 'closing_partner');
			$parse['bid_detail'] = $bid_detail;
            $parse['project_id'] = $project_id;
			$parse['fee_type'] = $this->config->item('fee_type');			
            echo $this->parser->parse('projects/tabs/closing_details', $parse, TRUE);
        }
    }

    function insert_project() {
        if ($_POST) {
            $company_id = $this->input->post('company_id');
			$project_long_key = $this->lib_common->generate_long_key();
            $project_detail = array();
            $project_detail['project_name'] = trim($this->input->post('project_name'));
            $project_detail['project_internal_note'] = trim($this->input->post('project_internal_note'));
            $project_detail['project_external_note'] = trim($this->input->post('project_external_note'));
            $project_detail['researcher_id'] = $company_id;
            $project_detail['project_status'] = 1;
			$project_detail['project_long_key'] = $project_long_key;
            $project_detail['project_created_by'] = $this->session->userdata('user_id');
            $project_detail['project_createddate'] = date(DATE_FORMAT_DB);
            $project_detail['project_modified_by'] = $this->session->userdata('user_id');
            $project_detail['project_modifieddate'] = date(DATE_FORMAT_DB);
            $project_detail['project_remoteip'] = $_SERVER['REMOTE_ADDR'];
            $project_id = $this->mdl_project->insert_project($project_detail);
			$user_activity = array();
			$user_activity['activity_type'] = ADD_PROJECT_TYPE;
			$user_activity['activity_description'] = sprintf(ADD_PROJECT,$this->session->userdata('user_name'),$this->input->post('project_name'));
			$this->user_modal->insert_user_activity($user_activity);
            $this->lib_message->set_success_message('Project has been added successfully!');
            redirect('projects/edit_project/' . $project_long_key);
            exit;
        }
    }

    function insert_project_files() {
        if ($_POST) {
            $project_id = $this->input->post('project_id');
			$project_file_detail = array();
            $upload_path = FCPATH . '/uploads/projects/' . $project_id;
            //exit;	
            if (!file_exists($upload_path)) {
                mkdir($upload_path, 0777);
            }
            if (!move_uploaded_file($_FILES['project_file']['tmp_name'], $upload_path . '/' . $_FILES['project_file']['name'])) {
                $this->lib_message->set_failure_message("Error in file upload");
            } else {
//				$data = $this->upload->data();
                $project_file_detail['project_file'] = $_FILES['project_file']['name'];
                $project_file_detail['project_file_name'] = trim($this->input->post('project_file_name'));
                $project_file_detail['project_file_description'] = trim($this->input->post('project_file_description'));
                $project_file_detail['project_file_segment'] = $this->input->post('project_file_segment');
                $project_file_detail['opt_for_bid'] = $this->input->post('opt_for_bid');
                $project_file_detail['project_id'] = $this->input->post('project_id');
                $project_file_detail['entry_created_by'] = $this->session->userdata('user_id');
                $project_file_detail['entry_created_date'] = date(DATE_FORMAT_DB);
                $project_file_detail['entry_modified_by'] = $this->session->userdata('user_id');
                $project_file_detail['entry_modified_date'] = date(DATE_FORMAT_DB);
                $project_file_detail['entry_remote_ip'] = $_SERVER['REMOTE_ADDR'];
                $project_file_id = $this->mdl_project->insert_project_files($project_file_detail);
                $this->lib_message->set_success_message('Project File has been uploaded successfully!');
                $project_key_detail = $this->mdl_project->get_long_key_from_id($project_id);
				$project_long_key = $project_key_detail->project_long_key;
				$user_activity = array();
				$user_activity['activity_type'] = ADD_FILE_TYPE;
				$user_activity['activity_description'] = sprintf(ADD_PROJECT_SEGMENT,$this->session->userdata('user_name'),$this->input->post('project_file_name'));
				$this->user_modal->insert_user_activity($user_activity);
				redirect('projects/edit_project/' . $project_long_key);
                exit;
            }
        }
        return false;
    }

    function insert_project_country() {
        if ($_POST) {
            $company_id = $this->input->post('company_id');
            $project_id = $this->input->post('project_id');
            $project_country_detail = array();
            $project_country_detail['country_id'] = trim($this->input->post('project_country'));
            $project_country_detail['segment_name'] = trim($this->input->post('segment_name'));
            $project_country_detail['project_segments'] = trim($this->input->post('project_segment'));
            $project_country_detail['project_target'] = trim($this->input->post('project_target'));
            $project_country_detail['project_ir'] = trim($this->input->post('project_ir'));
            $project_country_detail['project_loi'] = trim($this->input->post('project_loi'));
            $project_country_detail['project_cpc'] = trim($this->input->post('project_cpc'));
            $project_country_detail['project_ncomplete'] = trim($this->input->post('project_ncomplete'));
            $project_country_detail['project_id'] = $project_id;
            $project_country_detail['is_delete'] = 0;
            $project_country_detail['entry_created_by'] = $this->session->userdata('user_id');
            $project_country_detail['entry_createddate'] = date(DATE_FORMAT_DB);
            $project_country_detail['entry_modified_by'] = $this->session->userdata('user_id');
            $project_country_detail['entry_modifieddate'] = date(DATE_FORMAT_DB);
            $project_country_detail['entry_remote_ip'] = $_SERVER['REMOTE_ADDR'];

            $this->mdl_project->insert_project_country_master($project_country_detail);
			$user_activity = array();
			$user_activity['activity_type'] = ADD_SEGMENT_TYPE;
			$user_activity['activity_description'] = sprintf(ADD_PROJECT_COUNTRY,$this->session->userdata('user_name'),$this->input->post('segment_name'));
			$this->user_modal->insert_user_activity($user_activity);
            $this->lib_message->set_success_message('Project Segment Detail has been added successfully!');
            $project_key_detail = $this->mdl_project->get_long_key_from_id($project_id);
			$project_long_key = $project_key_detail->project_long_key;
			
			redirect('projects/edit_project/' . $project_long_key);
            exit;
        }
    }

    function send_bid() {
        if ($_POST) {
            $project_id = $this->input->post('project_id');
            $partner_id = $this->input->post('partner_id');
            $this->load->model('mdl_company');
            $compnay_admin = $this->mdl_company->get_company_detail($partner_id);
            $project_name_arr = $this->mdl_project->get_project_master($this->input->post('project_id'));

            $bid_detail = array();
            $bid_detail['project_id'] = $this->input->post('project_id');
            $bid_detail['researcher_id'] = $this->input->post('researcher_id');
            $bid_detail['researcher_user_id'] = $this->input->post('researcher_user_id');
            $bid_detail['partner_id'] = $this->input->post('partner_id');
            $bid_detail['partner_user_id'] = $compnay_admin['company_primary_user'];
            $bid_detail['project_cpc'] = $this->input->post('search_prj_cpc');
            $bid_detail['bid_type'] = 1;
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
			$user_activity = array();
			$user_activity['activity_type'] = SEND_BID_TYPE;
			$user_activity['activity_description'] = sprintf(SEND_BID,$this->session->userdata('user_name'),$compnay_admin['company_name'],$project_name_arr['project_name']);
			$this->user_modal->insert_user_activity($user_activity);
            $this->lib_message->set_success_message('Bid has been sent successfully!');
            
            
            
            $email_detail = $this->user_modal->get_user($compnay_admin['company_primary_user']);
            $compnay_researcher = $this->mdl_company->get_company_detail($this->input->post('researcher_id'));
            $projects_detail = $this->mdl_project->get_project_master($this->input->post('project_id'));
            
            
            $template = $this->mdl_email_template->get_template_by_short_code('bidneededpartner');
            $parse = array();
            $parse['Full Name'] = $email_detail['user_name'];
            $parse['Researcher'] = $compnay_researcher['company_name'];
            $parse['Project_Name'] = $projects_detail['project_name'];
            $parse['Bid_URL'] = base_url('/bids/fresh_bids');
            $content = $this->parser->parse_string($template['email_template_content'], $parse,true); 
                        
            $parse2= array();
            $parse2['Researcher'] = $compnay_researcher['company_name'];
            $parse2['Project_Name'] = $projects_detail['project_name'];
            $subject = $this->parser->parse_string($template['email_template_subject'], $parse2,true); 
            
            
            $toemail =$email_detail['user_email'];
            
            //echo $content;die;
            $this->lib_send_mail->send_mail($toemail, $subject, $content);

                       
            
            
            
            $this->session->set_userdata('active_project_tab', 'tab_search_project');
             $project_key_detail = $this->mdl_project->get_long_key_from_id($project_id);
				$project_long_key = $project_key_detail->project_long_key;

				redirect('projects/edit_project/' . $project_long_key);
            exit;
        }
    }

    function update_project_master() {
        if ($_POST) {
            $company_id = $this->input->post('company_id');
            $project_id = $this->input->post('project_id');
            $project_detail = array();
            $project_detail['project_name'] = trim($this->input->post('project_name'));
            $project_detail['project_internal_note'] = trim($this->input->post('project_internal_note'));
            $project_detail['project_external_note'] = trim($this->input->post('project_external_note'));
            $project_detail['researcher_id'] = $company_id;
            $project_detail['project_status'] = 1;
            $project_detail['project_modified_by'] = $this->session->userdata('user_id');
            $project_detail['project_modifieddate'] = date(DATE_FORMAT_DB);
            $project_detail['project_remoteip'] = $_SERVER['REMOTE_ADDR'];
            $res = $this->mdl_project->update_project_detail($project_id, $project_detail);
			$user_activity = array();
			$user_activity['activity_type'] = EDIT_PROJECT_MASTER_TYPE;
			$user_activity['activity_description'] = sprintf(EDIT_PROJECT_MASTER,$this->session->userdata('user_name'),$this->input->post('project_name'));
			$this->user_modal->insert_user_activity($user_activity);
            
            if($_POST['sub_srch_partner'] == 'yes') {
				
				if ($res > 0) {
					echo "success";
					exit();
				}	
			
				echo "error";
				exit;
			} else {
				
				$this->lib_message->set_success_message('Project Updated Successfully!!');
				 $project_key_detail = $this->mdl_project->get_long_key_from_id($project_id);
				$project_long_key = $project_key_detail->project_long_key;

				redirect('projects/edit_project/' . $project_long_key);
			}
            exit;
        }
    }

    function update_project_country() {
        if ($_POST) {
            $other_proj_details = array();
            $other_proj_details['country_id'] = $_POST['country_id'];
            $other_proj_details['segment_name'] = trim($this->input->post('segment_name'));
            $other_proj_details['project_segments'] = $_POST['project_segments'];
            $other_proj_details['project_target'] = $_POST['project_target'];
            $other_proj_details['project_ir'] = $_POST['project_ir'];
            $other_proj_details['project_loi'] = $_POST['project_loi'];
            $other_proj_details['project_cpc'] = $_POST['project_cpc'];
            $other_proj_details['project_ncomplete'] = $_POST['project_ncomplete'];
            $other_proj_details['entry_modified_by'] = $this->session->userdata('user_id');
            $other_proj_details['entry_modifieddate'] = date(DATE_FORMAT_DB);
            $rows = $this->mdl_project->update_project_country_detail($_POST['project_country_id'], $other_proj_details);
			$user_activity = array();
			$user_activity['activity_type'] = EDIT_PROJECT_TYPE;
			$user_activity['activity_description'] = sprintf(EDIT_PROJECT_COUNTRY,$this->session->userdata('user_name'),$this->input->post('segment_name'));
			$this->user_modal->insert_user_activity($user_activity);
            
            echo "success";
            exit();
        }
    }

    function delete_project_file() {
        if ($_POST) {
            $upload_path = FCPATH . '/uploads/projects/' . $_POST['project_id'];
            @unlink($upload_path . "/" . $_POST['project_file']);
            $rows = $this->mdl_project->delete_project_file($_POST['project_file_id']);
			$user_activity = array();
			$user_activity['activity_type'] = DELETE_FILE_TYPE;
			$user_activity['activity_description'] = sprintf(DELETE_PROJECT_FILE,$this->session->userdata('user_name'),$this->input->post('project_file'));
			$this->user_modal->insert_user_activity($user_activity);
            
            if ($rows > 0) {
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }

    function delete_project() {
        if ($_POST) {
            $rows = $this->mdl_project->delete_project($_POST['project_id']);
			$project_name_arr = $this->mdl_project->get_project_master($this->input->post('project_id'));
			$user_activity = array();
			$user_activity['activity_type'] = DELETE_PROJECT_TYPE;
			$user_activity['activity_description'] = sprintf(DELETE_PROJECT,$this->session->userdata('user_name'),$project_name_arr['project_name']);
			$this->user_modal->insert_user_activity($user_activity);
            
            if ($rows > 0) {
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }

    function update_project_status() {
        if ($_POST) {
            $rows = $this->mdl_project->update_project_status($_POST['project_id']);
            if ($rows > 0) {
				$project_name_arr = $this->mdl_project->get_project_master($this->input->post('project_id'));
				$user_activity = array();
				$user_activity['activity_type'] = UPDATE_STATUS;
				$user_activity['activity_description'] = sprintf(UPDATE_STATUS_DESC,$this->session->userdata('user_name'),$project_name_arr['project_name']);
				$this->user_modal->insert_user_activity($user_activity);
            
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }

    function update_read_status() {
        if ($_POST) {
            $rows = $this->mdl_project->update_read_status($_POST['project_id'], $this->session->userdata('company_id'), $_POST['project_country_id']);
            if ($rows > 0) {
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }

    function accept_bid() {
	$user_activity = array();
	$project_segments = $this->config->item('company_segment');
        if ($_POST) {
			if(is_array($_POST['bid_id'])) {
				foreach($_POST['bid_id'] as $bid_val) {
					$res = $this->mdl_project->activity_accept_bid($bid_val);
					$user_activity['activity_type'] = ACCEPT_BID;
					$segment_desc = $this->common_function->get_segment_format_proj($res->country_name, $project_segments[$res->project_segments], $res->segment_name);
					$user_activity['activity_description'] = sprintf(ACCEPT_BID_DESC,$this->session->userdata('user_name'),$res->partner, $segment_desc, $project_name_arr['project_name']);
					$this->user_modal->insert_user_activity($user_activity);
					$rows = $this->mdl_project->accept_bid($bid_val);
				}
			} else {
					$res = $this->mdl_project->activity_accept_bid($_POST['bid_id']);
					
					$user_activity['activity_type'] = ACCEPT_BID;
					$segment_desc = $this->common_function->get_segment_format_proj($res->country_name, $project_segments[$res->project_segments], $res->segment_name);
					$user_activity['activity_description'] = sprintf(ACCEPT_BID_DESC,$this->session->userdata('user_name'),$res->partner, $segment_desc, $project_name_arr['project_name']);
					$this->user_modal->insert_user_activity($user_activity);
					$rows = $this->mdl_project->accept_bid($_POST['bid_id']);
			}
            if ($rows > 0) {
                echo "success";
                $this->session->set_userdata('active_project_tab', 'tab_bid_replies');
                exit();
            }
			$project_name_arr = $this->mdl_project->get_project_master($this->input->post('project_id'));
			$user_activity = array();
			$user_activity['activity_type'] = UPDATE_STATUS;
			$user_activity['activity_description'] = sprintf(UPDATE_STATUS_DESC,$this->session->userdata('user_name'),$project_name_arr['project_name']);
			$this->user_modal->insert_user_activity($user_activity);
            
        }
        echo "error";
        exit;
    }

    function delete_project_country() {
        if ($_POST) {
            $rows = $this->mdl_project->delete_project_country($_POST['project_country_id'], $_POST['project_status']);
            if ($rows > 0) {
				$user_activity = array();
				$res = $this->mdl_project->get_project_country_detail($_POST['project_country_id']);
				$project_name_arr = $this->mdl_project->get_project_master($res->project_id);
				if($_POST['project_status'] == 1) {
					$user_activity['activity_type'] = DELETE_SEGMENT;
					$user_activity['activity_description'] = sprintf(DELETE_SEGMENT_DESC,$this->session->userdata('user_name'),$res->segment_name,$project_name_arr['project_name']);
				} else {
					$user_activity['activity_type'] = ENABLE_SEGMENT;
					$user_activity['activity_description'] = sprintf(ENABLE_SEGMENT_DESC,$this->session->userdata('user_name'),$res->segment_name,$project_name_arr['project_name']);
				}
				$this->user_modal->insert_user_activity($user_activity);
            
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }

    function close_project() {
        if ($_POST) {
            $close_project_id = $this->input->post('close_project_id');
            $close_proj_detail = array();
            $close_proj_detail['project_closing_date'] = date('Y-m-d', strtotime(trim($this->input->post('closing_date'))));
            $close_proj_detail['opt_for_closing'] = trim($this->input->post('opt_for_closing'));
            $close_proj_detail['project_id'] = $close_project_id;
            if ($_POST['entry_type'] == 'insert') {
                $close_proj_detail['entry_created_by'] = $this->session->userdata('user_id');
                $close_proj_detail['entry_created_date'] = date(DATE_FORMAT_DB);
            }
            $close_proj_detail['entry_modified_by'] = $this->session->userdata('user_id');
            $close_proj_detail['entry_modified_date'] = date(DATE_FORMAT_DB);
            $close_proj_detail['entry_remote_ip'] = $_SERVER['REMOTE_ADDR'];
            $rows = $this->mdl_project->close_project_master($close_proj_detail);
			$project_name_arr = $this->mdl_project->get_project_master($this->input->post('close_project_id'));
			$user_activity = array();
			$user_activity['activity_type'] = CLOSE_PROJECT_TYPE;
			$user_activity['activity_description'] = sprintf(CLOSE_PROJECT,$this->session->userdata('user_name'),$project_name_arr['project_name']);
			$this->user_modal->insert_user_activity($user_activity);
            
            if ($rows > 0) {
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }

    function close_project_detail() {
		
        if ($_POST) {
            $project_id = $this->input->post('project_id');
            $close_proj_detail = array();
            $reward_detail['partner_id'] = $close_proj_detail['partner_id'] = trim($this->input->post('partner_id'));
            $close_proj_detail['project_country_id'] = trim($this->input->post('project_country_id'));
            $close_proj_detail['project_cpc'] = trim($this->input->post('project_cpc'));
            $close_proj_detail['project_ncomplete'] = trim($this->input->post('project_ncomplete'));
            $close_proj_detail['project_estimated_cost'] = trim($this->input->post('project_estimated_cost'));
	    $reward_detail['researcher_id'] = $this->session->userdata('company_id');
            $reward_detail['cost'] = $close_proj_detail['researcher_estimated_cost'] = trim($this->input->post('researcher_estimated_cost'));
            $close_proj_detail['partner_rank'] = trim($this->input->post('partner_rank'));
            $close_proj_detail['bid_speed_rank'] = trim($this->input->post('bid_speed_rank'));
            $close_proj_detail['quality_rank'] = trim($this->input->post('quality_rank'));
            $close_proj_detail['value_rank'] = trim($this->input->post('value_rank'));
            $close_proj_detail['over_all_rank'] = trim($this->input->post('over_all_rank'));
            $close_proj_detail['partner_cost_rank'] = 0;
            $reward_detail['project_id'] = $close_proj_detail['project_id'] = $project_id;
            if ($_POST['project_closing_id'] == '0') {
                $reward_detail['entry_created_by'] = $close_proj_detail['entry_created_by'] = $this->session->userdata('user_id');
                $reward_detail['entry_created_date'] = $close_proj_detail['entry_created_date'] = date(DATE_FORMAT_DB);
            }
            $reward_detail['reward_amt'] = trim($this->input->post('researcher_estimated_cost')) * REWARD_PERCENTAGE ;
             $close_proj_detail['project_closing_id'] = trim($this->input->post('project_closing_id'));
            $reward_detail['entry_modified_by'] = $close_proj_detail['entry_modified_by'] = $this->session->userdata('user_id');
            $reward_detail['entry_modified_date'] = $close_proj_detail['entry_modified_date'] = date(DATE_FORMAT_DB);
            $reward_detail['entry_remote_ip'] = $close_proj_detail['entry_remote_ip'] = $_SERVER['REMOTE_ADDR'];
            $get_rank = $this->mdl_project->get_partner_rank($this->input->post('partner_id'));

            $get_rows = $this->mdl_project->get_no_rows_partner_rank($this->input->post('partner_id'));

            $partner_detail['avg_performance_rank'] = ($get_rank->partner_rank / $get_rows->cnt);
            $partner_detail['avg_cost_rank'] = ($get_rank->cost_rank / $get_rows->cnt);
            $this->mdl_project->update_partner_ranks($this->input->post('partner_id'), $partner_detail);
            $rows = $this->mdl_project->close_project_detail($close_proj_detail);
            echo $rows;exit();
            $this->mdl_project->researcher_reward_detail($reward_detail);
            $this->mdl_project->researcher_rewards($reward_detail);
			$company_detail = $this->mdl_company->get_company_detail($this->input->post('partner_id'));
            $user_activity = array();
			$project_name_arr = $this->mdl_project->get_project_master($this->input->post('project_id'));
			$user_activity['activity_type'] = CLOSE_DETAIL_PARTNER;
			$user_activity['activity_description'] = sprintf(CLOSE_DETAIL_PARTNER_DESC,$this->session->userdata('user_name'),$project_name_arr['project_name'], $company_detail['company_name']);
			$this->user_modal->insert_user_activity($user_activity);
            

            if ($rows > 0) {
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }
	function closing_sub_details($project_id, $partner_id) {
		$sub_bid_detail = $this->mdl_project->get_project_sub_bid($project_id, $partner_id);
		 $parse['project_segments'] = $this->config->item('company_segment');
		$parse['sub_bid_detail'] = $sub_bid_detail;
		echo $this->parser->parse('projects/tabs/closing_sub_detail', $parse, TRUE);
	}
    function clone_project() {
        if ($_POST) {
            $projects_detail = $this->mdl_project->get_projects($_POST['project_id']);
            $project = array();
            $project['project_name'] = $new_name = 'clone-' . trim($projects_detail[0]['project_name']);
            $project['project_internal_note'] = $projects_detail[0]['project_internal_note'];
            $project['project_external_note'] = $projects_detail[0]['project_external_note'];
            $project['researcher_id'] = $projects_detail[0]['researcher_id'];
            $project['project_status'] = $projects_detail[0]['project_status'];
			$project['project_long_key'] = $this->lib_common->generate_long_key();
            $project['project_createddate'] = date(DATE_FORMAT_DB);
            $project['project_created_by'] = $this->session->userdata('user_id');
            $project['project_modifieddate'] = date(DATE_FORMAT_DB);
            $project['project_modified_by'] = $this->session->userdata('user_id');
            $project['project_remoteip'] = $_SERVER['REMOTE_ADDR'];
            $rows = $this->mdl_project->insert_project($project);
			$user_activity = array();
			$user_activity['activity_type'] = CLONE_PROJECT;
			$user_activity['activity_description'] = sprintf(CLONE_PROJECT_DESC,$this->session->userdata('user_name'),$projects_detail[0]['project_name'], $new_name);
			$this->user_modal->insert_user_activity($user_activity);
			$add_user_activity = array();
			$add_user_activity['activity_type'] = ADD_PROJECT_TYPE;
			$add_user_activity['activity_description'] = sprintf(ADD_PROJECT,$this->session->userdata('user_name'),$new_name);
			$this->user_modal->insert_user_activity($add_user_activity);
            if ($rows > 0) {
                $other_proj_details = array();
                $other_proj_details['project_id'] = $rows;
                foreach ($projects_detail as $val) {
                    $other_proj_details['country_id'] = $val['country_id'];
                    $other_proj_details['segment_name'] = $val['segment_name'];
                    $other_proj_details['project_segments'] = $val['project_segments'];
                    $other_proj_details['project_target'] = $val['project_target'];
                    $other_proj_details['project_ir'] = $val['project_ir'];
                    $other_proj_details['project_loi'] = $val['project_loi'];
                    $other_proj_details['project_cpc'] = $val['project_cpc'];
                    $other_proj_details['project_ncomplete'] = $val['project_ncomplete'];
                    $other_proj_details['is_delete'] = 0;
                    $other_proj_details['entry_created_by'] = $this->session->userdata('user_id');
                    $other_proj_details['entry_createddate'] = date(DATE_FORMAT_DB);
                    $other_proj_details['entry_modified_by'] = $this->session->userdata('user_id');
                    $other_proj_details['entry_modifieddate'] = date(DATE_FORMAT_DB);
                    $other_proj_details['entry_remote_ip'] = $_SERVER['REMOTE_ADDR'];
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
		/*$arr_pr = $this->mdl_project->get_all_withprojects();
		foreach($arr_pr as $arr_val){
			$long_key = $this->lib_common->generate_long_key();
			
			$this->mdl_project->update_long_key($arr_val->project_id,$long_key);
		}*/
//        $aColumns = array('', 'project_name', 'project_ir', 'project_loi', 'project_cpc', 'project_ncomplete', 'project_target', 'actions');
        $aColumns = array('project_id', 'project_name', 'project_createddate', 'project_created_by', 'project_status', 'actions');
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
                        if ($m->project_status != 0) {
                            $str = '<a id="edit_project_' . $m->project_id . '" href="' . base_url('projects/edit_project/' . $m->project_long_key) . '">
						<span class="icons" rel="tooltip" title="Edit Project" ><i class="fa fa-edit fa-lg"></i></span></a>';
                            $str .= '<a id="cloneProject_' . $m->project_id . '" style="margin-left: 7px;" href="javascript:void(0);" ><span class="" rel="tooltip" title="Clone"><i class="fa fa-files-o fa-lg"></i></span></a>';
                            if($m->project_status != 2) {
								$str .= '<a id="updProject_' . $m->project_id . '" style="margin-left: 7px;" href="javascript:void(0);"><span class="" rel="tooltip" title="Active"><i class="fa fa-circle fa-lg" style="color:#3cc051;"></i></span></a>';
							}
                        } else {
							if($m->project_status != 2) {
                            $str = '<a id="rmvProject_' . $m->project_id . '" style="margin-left: 7px;" href="javascript:void(0);"><span class="" rel="tooltip" title="Inactive"><i class="fa fa-circle fa-lg" style="color:#ed4e2a;"></i></span></a>';
							}
                        }
                        $row[] = $str;
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

    function filter_for_bid_replies() {
        if ($_POST) {
            $partner_id = '';
            if (isset($_POST['partner_id']) && $_POST['partner_id'] != '') {
                $partner_id = $_POST['partner_id'];
            } else {
                $partner_id = '';
            }
            $segment_id = '';
            if (isset($_POST['segment_id']) && $_POST['segment_id'] != '') {
                $segment_id = $_POST['segment_id'];
            } else {
                $segment_id = '';
            }
            $rows = $this->mdl_project->get_filter_bid_replies($_POST['bid_status'], $_POST['project_id'], $partner_id, $segment_id);
            $someArray = array();
            foreach ($rows as $bid_filter_val) {
                $someArray[] = $bid_filter_val->bid_id;
            }
            // Convert the Array to a JSON String and echo it
            $someJSON = json_encode($someArray);
            print $someJSON;
            //echo $this->parser->parse('projects/tabs/bid_replies', $parse, TRUE);
            exit;
        }
        echo "error";
        exit;
    }
	
	function vendor_performance($vendor_id) {
        $parse = array();        
		$get_rank = $this->mdl_project->get_partner_rank($vendor_id);
		$get_rows = $this->mdl_project->get_no_rows_partner_rank($vendor_id);
		if($get_rank && $get_rank->bid_speed_rank != 0) {
			$parse['bid_speed_rank'] = $get_rank->bid_speed_rank / $get_rows->cnt;
		} else {
			$parse['bid_speed_rank'] = 0;
		}if($get_rank && $get_rank->quality_rank != 0) {
			$parse['quality_rank'] = $get_rank->quality_rank / $get_rows->cnt;
		} else {
			$parse['quality_rank'] = 0;
		}if($get_rank && $get_rank->value_rank != 0) {
			$parse['value_rank'] = $get_rank->value_rank / $get_rows->cnt;
		} else {
			$parse['value_rank'] = 0;
		}if($get_rank && $get_rank->over_all_rank != 0) {
			$parse['over_all_rank'] = $get_rank->over_all_rank / $get_rows->cnt;
		} else {
			$parse['over_all_rank'] = 0;
		}
		
		$parse['vendor_id'] = $vendor_id;
		echo $this->parser->parse('projects/tabs/vendor_performance', $parse, TRUE);
    }
}
