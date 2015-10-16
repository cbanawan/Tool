<?php

/**
 * Description of login
 *
 * @author Rita Vyas	
 */
class login extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->load->model('mdl_email_template');
        $this->load->library('lib_send_mail');
        $this->loadJs();
    }

    private function loadJs() {
        $this->jsFiles = array();
    }

    public function index() {
        $parse = array();
        if ($this->session->userdata('user_id') != '') {
            redirect('home');
            exit;
        } else {
            $parse['company_type'] = $this->common_function->get_company_type('select');
            $parse['content'] = $this->parser->parse('login', $parse, true);
            $parse['jsFiles'] = $this->jsFiles;
            $parse['failure_msg'] = $this->lib_message->get_failure_message();
            $this->parser->parse('common/login-layout', $parse);
        }
    }

    function load_check_user_credential() {
        $rec_count = $this->user_modal->check_user_credential(trim($_POST['login_user_email']), $_POST['login_user_password'], 0, 0);
        $flag = "success";
        if ($rec_count == 0) {
            $rec_count = $this->user_modal->check_user_credential(trim($_POST['login_user_email']), $_POST['login_user_password'], 0, 0, 0);
            if ($rec_count == 0)
                $flag = "fail";
            else
                $flag = "fail2";
        }
        echo $flag;
        exit();
    }

    function load_forgot_email() {
        $rec_count = $this->user_modal->check_user_credential(trim($_POST['forgot_email']), NULL, 0, 1);
        $flag = "success";
        if ($rec_count == 0) {
            $flag = "fail";
        }
        echo $flag;
        exit();
    }

    function load_check_user_email() {
        $user_login = $this->user_modal->check_register_email(trim($_POST['user_email']));
        $flag = "fail";
        if ($user_login == 0) {
            $flag = "success";
        }
        echo $flag;
        exit();
    }

    function login_success() {
        $user_data = array();
        $user_rs = $this->user_modal->check_user_credential(trim($_POST['login_user_email']), $_POST['login_user_password'], 1);
        $company_type = $this->user_modal->get_company_type($user_rs->company_id);
        $this->session->set_userdata(array(
            'user_id' => $user_rs->user_id,
            'profile_pic' => $user_rs->profile_pic,
            'user_name' => $user_rs->user_name,
            'user_email' => $user_rs->user_email,
            'user_type' => $user_rs->user_type,
            'company_type' => $company_type->company_type,
            'company_id' => $user_rs->company_id
        ));
        $user_log_data = array();
        $user_log_data['user_id'] = $user_rs->user_id;
        $user_log_data['remote_ip'] = $_SERVER['REMOTE_ADDR'];
        $user_log_data['last_access'] = date(DATE_FORMAT_DB);
        $user_log_data['log_status'] = 0;
        $this->user_modal->insert_session_log($user_log_data);
        
        $activity = array();
        $activity['activity_type'] = "";
        $activity['activity_description'] = sprintf(LOGGED_IN, $this->session->userdata('user_name'));
        $this->user_activity->insert_user_activity($activity);
        
        if ($user_rs->profile_complete == 0) {
            if ($user_rs->user_type == 1) {
                redirect('company/profile');
            } else {
                redirect('users/profile');
            }
        } else {
            redirect('home');
        }
        exit;
    }

    function insert_company() {
        $company_name = $_POST['company_name'];
        $is_company_exists = $this->user_modal->check_company_exists($company_name);
        $long_key = $this->lib_common->generate_long_key();
        if ($is_company_exists == 0) {
            $user_company_data = array(
                'user_name' => $_POST['user_name'],
                'user_email' => $_POST['user_email'],
                'user_password' => $_POST['user_password'],
                'user_type' => $_POST['user_type'],
                'company_name' => $_POST['company_name'],
                'long_key' => $long_key
            );
            $validation_link = base_url('login/validate_user/' . $long_key);
            $this->user_modal->insert_user_company($user_company_data);
            $template = $this->mdl_email_template->get_template_by_short_code('registration');
            $parse = array();
            $parse['Full Name'] = $user_company_data['user_name'];
            $parse['Validation Link'] = $validation_link;
            $content = $this->parser->parse_string($template['email_template_content'], $parse, true);
            //echo $content;die;
            $this->lib_send_mail->send_mail($user_company_data['user_email'], $template['email_template_subject'], $content);
            redirect('login/company_success');
        } else {
            redirect('login/company_error');
            //exit;
        }
    }

    function company_error() {
        $company_error_msg = "<h3>Oops..</h3><br /><br /><span class='error_span'>Your company is already registered. Please contact your company's Pangea Panel Admin or email us at</span> <a href='mailto:contact@pangeapanel.com'>contact@pangeapanel.com</a>.<br /><br /><button type='button' class='btn' onclick='location.href=\"" . base_url() . "\"'><i class='m-icon-swapleft'></i> Login</button>";
        $parse['company_error_msg'] = $company_error_msg;
        $parse['content'] = $this->parser->parse('login', $parse, true);
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/login-layout', $parse);
    }

    function company_success() {
        $user_data = $this->user_modal->get_last_user();
        if ($user_data->is_active == '0') {
            $validation_link = base_url('login/validate_user/' . $user_data->long_key);
            $parse['company_success_msg'] = "<h3>Thanks for registering!</h3><br /><br />We have sent an email to activate your account to " . $user_data->user_email . ". Please check your inbox and/or spam/bulk for that email and follow the directions contained there.
<br /><br /> <b>No email yet?</b> Please give it up to 15 minutes, recheck your spam folder and the email address above is correct. If you still have not received an email please email us at <a href='mailto:contact@pangeapanel.com'>contact@pangeapanel.com</a>.
<br /><br /><button type='button' class='btn' onclick='location.href=\"" . base_url() . "\"'><i class='m-icon-swapleft'></i> Login</button>";
        } else {
            $parse['company_success_msg'] = "<h3>Thanks for Registration</h3><br /><br /> You are already activated.<br /><br /><button type='button' class='btn' onclick='location.href=\"" . base_url() . "\"'><i class='m-icon-swapleft'></i> Login</button>";
        }
        $parse['content'] = $this->parser->parse('login', $parse, true);
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/login-layout', $parse);
    }

    function validate_user($long_key) {
        $user_validate = $this->user_modal->check_long_key($long_key);
        if ($user_validate == 0) {
            $user_validate = $this->user_modal->check_long_key($long_key, 1);
            if ($user_validate == 0) {
                $validation_reg_error_msg = "This link did not work. Please recheck the link. If you are still having problems, please contact us at <a href='mailto:contact@pangeapanel.com'>contact@pangeapanel.com</a>.<br /><br /><button type='button' class='btn' onclick='location.href=\"" . base_url() . "\"'><i class='m-icon-swapleft'></i> Login</button>";
            } else {
                $validation_reg_error_msg = "This link has been used. If you are still having problems, please contact us at <a href='mailto:contact@pangeapanel.com'>contact@pangeapanel.com</a>.<br /><br /><button type='button' class='btn' onclick='location.href=\"" . base_url() . "\"'><i class='m-icon-swapleft'></i> Login</button>";
            }
            $parse['validation_reg_error_msg'] = $validation_reg_error_msg;
            $parse['content'] = $this->parser->parse('login', $parse, true);
            $this->parser->parse('common/login-layout', $parse);
        } else {
            $user_data = $this->user_modal->active_user($long_key);
            $parse['company_success_msg'] = "<h3>Membership confirmed, thank you!</h3> <br/> Welcome! Please use your email address and your password provide when registering to sign in. If you are still having problems, please contact us at <a href='mailto:contact@pangeapanel.com'>contact@pangeapanel.com</a>.<br /><br /><button type='button' class='btn' onclick='location.href=\"" . base_url() . "\"'><i class='m-icon-swapleft'></i> Login</button>";
            $parse['content'] = $this->parser->parse('login', $parse, true);
            $this->parser->parse('common/login-layout', $parse);
            //redirect();
            //exit;
        }
    }

    function forgot_password_process() {
        $email_detail = $this->user_modal->check_user_credential(trim($_POST['forgot_email']), NULL, 1, 1);
        $new_password = $this->lib_common->random_password();
        $forgot_pwd_msg = "<h3>Email has been sent!</h3><br /><br />We have sent an email with new password to " . $_POST['forgot_email'] . ". Please check your inbox and/or spam/bulk for that email and follow the directions contained there.
                <br /><br /> <b>No email yet?</b> Please give it up to 15 minutes, recheck your spam folder and the email address above is correct. If you still have not received an email please email us at <a href='mailto:contact@pangeapanel.com'>contact@pangeapanel.com</a>.<br/>
                <br /><button type='button' class='btn' onclick='location.href=\"" . base_url() . "\"'><i class='m-icon-swapleft'></i> Login</button>";

        // Email  will be sent  to new email address.1


        $template = $this->mdl_email_template->get_template_by_short_code('forgotpassword');
        $parse = array();
        $parse['Full Name'] = $email_detail->user_name;
        $parse['Password'] = $new_password;
        $parse['Login Link'] = base_url('/login');
        $content = $this->parser->parse_string($template['email_template_content'], $parse, true);
        //echo $content;die;
        $this->lib_send_mail->send_mail(trim($_POST['forgot_email']), $template['email_template_subject'], $content);

        $parse['forgot_pwd_msg'] = $forgot_pwd_msg . $template['email_template_content'] . $new_password;

        $user_detail = array();
        $user_detail['user_password'] = md5($new_password);
        $rows = $this->user_modal->update_user_detail($email_detail->user_id, $user_detail);

        $parse['content'] = $this->parser->parse('login', $parse, true);
        $this->parser->parse('common/login-layout', $parse);
        //redirect();
        //exit;
    }

    function logout() {
        $user_log_data = array();
        $user_log_data['user_id'] = $this->session->userdata('user_id');
        $user_log_data['remote_ip'] = $_SERVER['REMOTE_ADDR'];
        $user_log_data['last_access'] = date(DATE_FORMAT_DB);
        $user_log_data['log_status'] = 1;
        $this->user_modal->insert_session_log($user_log_data);
        
        $activity = array();
        $activity['activity_type'] = "";
        $activity['activity_description'] = sprintf(LOGGED_OUT, $this->session->userdata('user_name'));
        $this->user_activity->insert_user_activity($activity);
        
        $this->session->unset_userdata('user_id');
        $this->session->unset_userdata('user_name');
        $this->session->unset_userdata('user_email');
        $this->session->unset_userdata('user_type');
        $this->session->unset_userdata('company_id');
        
        redirect();
        exit;
    }

}
