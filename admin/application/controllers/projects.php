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
			$parse['bid_detail'] = $this->mdl_project->get_project_bid($project_id);
			$parse['project_id'] = $project_id;
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
            $project_detail['project_internal_note'] = trim($this->input->post('project_internal_note'));
            $project_detail['project_external_note'] = trim($this->input->post('project_external_note'));
            $project_detail['researcher_id'] = $company_id;
            $project_detail['project_status'] = 1;
            $project_detail['project_created_by'] = $this->session->userdata('user_id');
            $project_detail['project_createddate'] = date(DATE_FORMAT_DB);
            $project_detail['project_modified_by'] = $this->session->userdata('user_id');
            $project_detail['project_modifieddate'] = date(DATE_FORMAT_DB);
            $project_detail['project_remoteip'] = $_SERVER['REMOTE_ADDR'];
            $project_id = $this->mdl_project->insert_project($project_detail);
            $this->lib_message->set_success_message('Project Added Successfully!!');
            redirect('projects/edit_project/'.$project_id);
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
            if (!move_uploaded_file($_FILES['project_file']['tmp_name'], $upload_path.'/'.$_FILES['project_file']['name'])) {
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
				$this->lib_message->set_success_message('File uploaded successfully!');
				redirect('projects/edit_project/'.$project_id);
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
            $this->lib_message->set_success_message('Project Detail Added Successfully!!');
            redirect('projects/edit_project/'.$project_id);
            exit;
        }
    }

    function send_bid() {
        if ($_POST) {
            $project_id = $this->input->post('project_id');
            $partner_id = $this->input->post('partner_id');
			$this->load->model('mdl_company');
            $compnay_admin = $this->mdl_company->get_company_detail($partner_id);
			
            $bid_detail = array();
            $bid_detail['project_id'] = $this->input->post('project_id');
            $bid_detail['researcher_id'] = $this->input->post('researcher_id');
            $bid_detail['researcher_user_id'] = $this->input->post('researcher_user_id');
            $bid_detail['partner_id'] = $this->input->post('partner_id');
            $bid_detail['partner_user_id'] = $compnay_admin['company_primary_user'];
            $bid_detail['project_cpc'] = $this->input->post('search_prj_cpc');
            $bid_detail['bid_type'] = 1;
            $bid_detail['bid_status'] = $this->input->post('bid_status');
            $bid_detail['is_read'] = $this->input->post('is_read');;
            $bid_detail['hide_cpc'] = $this->input->post('search_prj_hide_cpc');
            $bid_detail['project_country_id'] = $this->input->post('project_country_id');
            $bid_detail['project_ncomplete'] = $this->input->post('search_prj_ncomplete');
            $bid_detail['bid_comments'] = trim($this->input->post('search_prj_comment'));
            $bid_detail['bid_createddate'] = date(DATE_FORMAT_DB);
            $bid_detail['bid_modifieddate'] = date(DATE_FORMAT_DB);
            $bid_detail['bid_remote_ip'] = $_SERVER['REMOTE_ADDR'];

            $bid_id = $this->mdl_project->insert_bid_replies($bid_detail);
			$this->lib_message->set_success_message('Bid has been sent successfully!!');
			$this->session->set_userdata('active_project_tab', 'tab_search_project');
            redirect('projects/edit_project/' . $project_id);
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
            $this->lib_message->set_success_message('Project Updated Successfully!!');
            redirect('projects/edit_project/' . $project_id);
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
			echo "success";
            exit();
		}
            
	}

    function delete_project_file() {
        if ($_POST) {
			$upload_path = FCPATH . '/uploads/projects/' . $_POST['project_id'];
			@unlink($upload_path . "/" . $_POST['project_file']);
            $rows = $this->mdl_project->delete_project_file($_POST['project_file_id']);
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
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }
	function update_read_status() {
        if ($_POST) {
            $rows = $this->mdl_project->update_read_status($_POST['project_id'],$this->session->userdata('company_id'),$_POST['project_country_id']);
            if ($rows > 0) {
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }
	function accept_bid() {
        if ($_POST) {
            $rows = $this->mdl_project->accept_bid($_POST['bid_id']);
            if ($rows > 0) {
                echo "success";
				$this->session->set_userdata('active_project_tab', 'tab_bid_replies');
                exit();
            }
        }
        echo "error";
        exit;
    }
    function delete_project_country() {
        if ($_POST) {
			$rows = $this->mdl_project->delete_project_country($_POST['project_country_id'],$_POST['project_status']);
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
            $project['project_internal_note'] = $projects_detail[0]['project_internal_note'];
            $project['project_external_note'] = $projects_detail[0]['project_external_note'];
            $project['researcher_id'] = $projects_detail[0]['researcher_id'];
            $project['project_status'] = $projects_detail[0]['project_status'];
            $project['project_createddate'] = date(DATE_FORMAT_DB);
            $project['project_created_by'] = $this->session->userdata('user_id');
            $project['project_modifieddate'] = date(DATE_FORMAT_DB);
            $project['project_modified_by'] = $this->session->userdata('user_id');
            $project['project_remoteip'] = $_SERVER['REMOTE_ADDR'];			            
            $rows = $this->mdl_project->insert_project($project);
            if ($rows > 0) {
			$other_proj_details = array();
                $other_proj_details['project_id'] = $rows;
			   foreach($projects_detail as $val){
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
//        $aColumns = array('', 'project_name', 'project_ir', 'project_loi', 'project_cpc', 'project_ncomplete', 'project_target', 'actions');
        $aColumns = array('project_name','project_createddate', 'project_created_by', 'project_status', 'actions');
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
						if($m->project_status == 1) {
                        $str = '<a id="edit_project_' . $m->project_id . '" href="' . base_url('projects/edit_project/' . $m->project_id) . '">
						<span class="icons" rel="tooltip" title="Edit Project" ><i class="fa fa-edit fa-lg"></i></span></a>';
                        $str .= '<a id="cloneProject_' . $m->project_id . '" style="margin-left: 7px;" href="javascript:void(0);" ><span class="" rel="tooltip" title="Clone"><i class="fa fa-files-o fa-lg"></i></span></a>';
						$str .= '<a id="rmvProject_' . $m->project_id . '" style="margin-left: 7px;" href="javascript:void(0);"><span class="" rel="tooltip" title="Inactive"><i class="fa fa-circle fa-lg" style="color:#ed4e2a;"></i></span></a>';

						} else {
							$str = '<a id="updProject_' . $m->project_id . '" style="margin-left: 7px;" href="javascript:void(0);"><span class="" rel="tooltip" title="Active"><i class="fa fa-circle fa-lg" style="color:#3cc051;"></i></span></a>';
						}
                        $row[] = $str;
                    } else if($col == 'project_created_by') {
						$user_res = $this->user_modal->get_user($m->project_created_by);
						$row[] = $user_res['user_name'];
					}  else if ($col == 'project_status') {
						$bid_status_res = $this->mdl_project->get_bid_status_project($m->project_id);
						if(isset($bid_status_res) && $bid_status_res != '') {
							if($bid_status_res->bid_status == 0) {
								$bid_status = 'Fresh Project';
							} else if($bid_status_res->bid_status == 1) {
								$bid_status = 'Bid Sent';
							}else if($bid_status_res->bid_status == 2) {
								$bid_status = 'Close Project';
							}else if($bid_status_res->bid_status == 3) {
								$bid_status = 'Won';
							}
						} else {
							$bid_status = 'Project Setup';
						}
                        if ($m->project_status == 1) {
                            $row[] = '<span class="label label-sm label-success">Active</span>&nbsp;&nbsp;'.$bid_status;
                        } else {
                            $row[] = '<span class="label label-sm label-danger">Inactive</span>&nbsp;&nbsp;'.$bid_status;
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
			if(isset($_POST['partner_id']) && $_POST['partner_id']!= '') {
				$partner_id = $_POST['partner_id'];
			} else {
				$partner_id = '';
			}
			$segment_id = '';
			if(isset($_POST['segment_id']) && $_POST['segment_id']!= '') {
				$segment_id = $_POST['segment_id'];
			} else {
				$segment_id = '';
			}
			$rows = $this->mdl_project->get_filter_bid_replies($_POST['bid_status'],$_POST['project_id'],$partner_id,$segment_id);
           $someArray = array();
			foreach($rows as $bid_filter_val) {
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
}
