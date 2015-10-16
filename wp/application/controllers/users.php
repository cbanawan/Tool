<?php

/**
 * Description of user
 *
 * @author Priyanka
 */
class users extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->loadJs();
        $this->loadCSS();
        $this->load->config('pp_config');
    }

    private function loadCSS() {
        $this->cssFiles = array();
        $this->cssFiles[] = JS . 'bootstrap-fileupload/bootstrap-fileupload.css';
    }

    private function loadJs() {
        $this->jsFiles = array();
        $this->jsFiles[] = JS . 'bootstrap-fileupload/bootstrap-fileupload.js';
        $this->jsFiles[] = JS . 'users.js';
    }

    public function index() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['content'] = $this->parser->parse('users/users_list', $parse, true);
        $site_nav_arr = $this->config->item('user_list');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Users";
        $parse['header_inner'] = "User List";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

    function add_user() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['country'] = $this->config->item('country');
        $parse['content'] = $this->parser->parse('users/add_user', $parse, true);
        $site_nav_arr = $this->config->item('user_add');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Users";
        $parse['header_inner'] = "Add User";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

    function edit_user($user_id) {
        $parse = array();
        $parse['user_rs'] = $this->user_modal->get_user($user_id);
        $parse['country'] = $this->config->item('country');
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['content'] = $this->parser->parse('users/edit_user', $parse, true);
        $site_nav_arr = $this->config->item('user_edit');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];        
        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Users";
        $parse['header_inner'] = "Edit User";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

    function insert_user() {
        $user_rs = $this->user_modal->get_user($this->session->userdata('user_id'));
        $long_key = $this->lib_common->generate_long_key();

        if ($_POST) {
            $user_id = $this->input->post('user_id');
            $user_profile = array();
            $user_profile['user_name'] = trim($this->input->post('user_name'));
            $user_profile['user_email'] = trim($this->input->post('user_email'));
            $user_profile['user_address'] = trim($this->input->post('user_address'));
            $user_profile['user_city'] = $this->input->post('user_city');
            $user_profile['user_state'] = $this->input->post('user_state');
            $user_profile['user_country'] = $this->input->post('user_country');
            $user_profile['user_zipcode'] = $this->input->post('user_zipcode');
            $user_profile['user_phone'] = $this->input->post('user_phone');
            $user_profile['user_designation'] = $this->input->post('user_designation');
            $user_profile['company_id'] = $user_rs['company_id'];
            $user_profile['long_key'] = $long_key;
            $user_profile['user_entry_date'] = date(DATE_FORMAT_DB);
            $user_profile['user_modified_date'] = date(DATE_FORMAT_DB);
            $user_profile['user_entry_ip'] = $_SERVER['REMOTE_ADDR'];
            $user_profile['is_active'] = 1;
            $user_profile['user_type'] = 2;
            $user_profile['user_password'] = md5($this->input->post('user_password'));
            $rows = $this->user_modal->insert_user($user_profile);
			$user_activity = array();
			$user_activity['activity_type'] = ADD_USER_TYPE;
			$user_activity['activity_description'] = sprintf(ADD_USER_RESEARCHER,$this->session->userdata('user_name'),$this->input->post('user_name'));
			$this->user_modal->insert_user_activity($user_activity);
            $this->lib_message->set_success_message('User Added Successfully!!');
            redirect('users');
            exit;
        }
    }

    function update_user() {
        if ($_POST) {
            $user_id = $this->input->post('user_id');
            $user_profile = array();
            $user_profile['user_name'] = trim($this->input->post('user_name'));
            $user_profile['user_address'] = trim($this->input->post('user_address'));
            $user_profile['user_city'] = $this->input->post('user_city');
            $user_profile['user_state'] = $this->input->post('user_state');
            $user_profile['user_country'] = $this->input->post('user_country');
            $user_profile['user_zipcode'] = $this->input->post('user_zipcode');
            $user_profile['user_phone'] = $this->input->post('user_phone');
            $user_profile['user_designation'] = $this->input->post('user_designation');
            $rows = $this->user_modal->update_user_detail($user_id, $user_profile);
			$user_activity = array();
			$user_activity['activity_type'] = UPDATE_USER_TYPE;
			$user_activity['activity_description'] = sprintf(UPDATE_USER_RESEARCHER,$this->session->userdata('user_name'),$this->input->post('user_name'));
			$this->user_modal->insert_user_activity($user_activity);
            if ($rows && $rows != 0) {
                $this->lib_message->set_success_message('User Updated Successfully!!');
            } else {
                $this->lib_message->set_failure_message('Network Error!!');
            }
            redirect('users');
            exit;
        }
    }

    function delete_user($user_id) {
        $this->user_modal->delete_user($user_id);
		$user_activity = array();
			$user_activity['activity_type'] = DELETE_USER_TYPE;
			$user_activity['activity_description'] = sprintf(DELETE_USER_RESEARCHER,$this->session->userdata('user_name'),$this->input->post('user_name'));
			$this->user_modal->insert_user_activity($user_activity);
        redirect('users');
        exit;
    }

    public function profile() {
        $this->authentication->check_session();
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['country'] = $this->config->item('country');
        $parse['user'] = $this->user_modal->get_user($this->session->userdata('user_id'));
        $parse['content'] = $this->parser->parse('users/profile', $parse, true);
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "User Profile";
        $parse['header_inner'] = "My Profile";
        $parse['cssFiles'] = $this->cssFiles;
        $parse['jsFiles'] = $this->jsFiles;
        $parse['success_msg'] = $this->lib_message->get_success_message();
        $parse['failure_msg'] = $this->lib_message->get_failure_message();
        $this->parser->parse('common/layout', $parse);
    }

    public function change_avtar() {
        if ($_FILES['profile_pic']['name'] != "") {
            $upload_path = FCPATH . '/uploads/' . $this->session->userdata('user_id');
            if (!file_exists($upload_path)) {
                mkdir($upload_path, 0777);
            }
            $config['upload_path'] = $upload_path;
            $config['allowed_types'] = 'gif|jpg|jpeg|png';
            $config['max_size'] = '30000';
            $config['max_width'] = '1024';
            $config['max_height'] = '768';

            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('profile_pic')) {
                $error = array('error' => $this->upload->display_errors());
                $this->lib_message->set_failure_message($error['error']);
            } else {
                $data = $this->upload->data();
                $user_id = $this->input->post('user_id');
                unlink(FCPATH . 'uploads/' . $user_id . "/" . $this->input->post('hdn_image'));
                $user_profile = array();
                $user_profile['profile_pic'] = $data['file_name'];

                $rows = $this->user_modal->update_user_detail($user_id, $user_profile);
                if ($rows && $rows != 0) {
                    $this->session->set_userdata('profile_pic', $data['file_name']);
                    $this->lib_message->set_success_message('Profile Picture has been uploaded successfully!');
                } else {
                    $this->lib_message->set_failure_message('Network Error!!');
                }
            }
        }
        redirect('users/profile');
    }

    public function check_user_password() {
        if ($_POST)
            $current_pass = $this->input->post('current_pass');
        $user_pass = $this->user_modal->get_user_password($this->session->userdata('user_id'));
        if ($user_pass && md5($current_pass) != $user_pass->user_password) {
            echo "notmatched";
            exit();
        }
        echo "matched";
        exit();
    }

    public function update_password() {
        $this->authentication->check_session();
        $new_password = $old_password = NULL;
        $userid = "";
        if (isset($_POST)) {
            $new_password = $this->input->post('new_pass');
            $current_pass = $this->input->post('current_pass');
            $userid = $this->session->userdata('user_id');
            if ($current_pass != NULL) {
                $user_pass = $this->user_modal->get_user_password($userid);
                if ($user_pass && md5($current_pass) != $user_pass->user_password) {
                    $this->lib_message->set_failure_message('Current Password is not valid');
//                    redirect('users/profile');
                } else {
                    $user_detail = array();
                    $user_detail['user_password'] = md5($new_password);
                    $rows = $this->user_modal->update_user_detail($userid, $user_detail);
                    if ($rows && $rows != 0) {
                        $this->lib_message->set_success_message('Password has been changed successfully!');
                    } else {
                        $this->lib_message->set_failure_message('Network Error!!');
                    }
                }
            }
//            $this->send_email($userid, $new_password);            
        }
        redirect('users/profile');
    }

    public function update_profile() {
        if ($_POST) {
            $user_id = $this->input->post('user_id');
            $user_profile = array();
            $user_profile['user_name'] = trim($this->input->post('user_name'));
            $user_profile['user_address'] = trim($this->input->post('user_address'));
            $user_profile['user_city'] = $this->input->post('user_city');
            $user_profile['user_state'] = $this->input->post('user_state');
            $user_profile['user_country'] = $this->input->post('user_country');
            $user_profile['user_zipcode'] = $this->input->post('user_zipcode');
            $user_profile['user_phone'] = $this->input->post('user_phone');
            $user_profile['user_designation'] = $this->input->post('user_designation');
            $rows = $this->user_modal->update_user_detail($user_id, $user_profile);
            if ($rows && $rows != 0) {
                $this->lib_message->set_success_message('Profile has been updated successfully!');
            } else {
                $this->lib_message->set_failure_message('Network Error!!');
            }
            redirect('users/profile');
        }
    }

    public function get_all_users() {
        $aColumns = array('', 'user_name', 'user_email', 'actions');
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
            if (isset($_POST['user_email']) && $_POST['user_email'] != "") {
                $filter_data['user_email'] = trim($_POST['user_email']);
            }
        }
        // Select Data        
        $rResult = $this->user_modal->get_user_list($filter_data, $sort_array, $limit, $offset);
        // Data set length after filtering
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
                        $str = '<a id="edit_user_' . $m->user_id . '" href="' . base_url('users/edit_user/' . $m->user_id) . '">
                            <span class="icons" rel="tooltip" title="Edit User" ><i class="fa fa-edit fa-lg"></i></span></a>';
                        $str .= '<a id="rmvUser_' . $m->user_id . '" style="margin-left: 7px;" href="' . base_url('users/delete_user/' . $m->user_id) . '" onclick="javascript: return confirm(\'Are you sure do you want to delete?\');"><span class="" rel="tooltip" title="Delete"><i class="fa fa-trash-o fa-lg"></i></span></a>';
                        $row[] = $str;
                    } else if ($col == 'user_name' || $col == 'user_email') {
                        $row[] = $m->$col;
                    } else {
                        $row[] = '<input type="checkbox" class="checkboxes" value="' . $m->user_id . '"/>';
                    }
                }
                array_push($output['aaData'], $row);
            }
        }
        echo json_encode($output);
        exit();
    }

}
