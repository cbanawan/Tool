<?php

/**
 * Description of company
 *
 * @author Priyanka
 */
class company extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->authentication->check_session();
        $this->loadJs();
        $this->loadCSS();
        $this->load->config('pp_config');
        $this->load->model('mdl_company');
    }

    private function loadCSS() {
        $this->cssFiles = array();
        $this->cssFiles[] = JS . 'select2/select2_metro.css';
        $this->cssFiles[] = JS . 'jquery-tags-input/jquery.tagsinput.css';
        $this->cssFiles[] = JS . 'bootstrap-fileupload/bootstrap-fileupload.css';
    }

    private function loadJs() {
        $this->jsFiles = array();
        $this->jsFiles[] = JS . 'select2/select2.min.js';
        $this->jsFiles[] = JS . 'jquery-tags-input/jquery.tagsinput.min.js';
        $this->jsFiles[] = JS . 'bootstrap-fileupload/bootstrap-fileupload.js';
        $this->jsFiles[] = JS . 'company.js';
    }

    public function index() {
        
    }

    public function profile() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['company_type'] = $this->config->item('company_type');
        $parse['country'] = $this->config->item('country');
        $parse['company_segment'] = $this->config->item('company_segment');
        $parse['company'] = $this->mdl_company->get_company_detail($this->session->userdata('company_id'));
        $parse['company_users'] = $this->user_modal->get_company_users($this->session->userdata('company_id'));
        if ($this->session->userdata('user_type') == '1') {
            $parse['content'] = $this->parser->parse('company/profile', $parse, true);
        } else {
            $parse['content'] = $this->parser->parse('company/profile_view', $parse, true);
        }
//        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $site_nav_arr = $this->config->item('company_profile');
		$parse['site_nav'] = $site_nav_arr['breadcrumb'];
	    $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Company Profile";
        $parse['header_inner'] = "Company Profile";
        $parse['cssFiles'] = $this->cssFiles;
        $parse['jsFiles'] = $this->jsFiles;
        $parse['success_msg'] = $this->lib_message->get_success_message();
        $parse['failure_msg'] = $this->lib_message->get_failure_message();
        $this->parser->parse('common/layout', $parse);
    }

    public function update_profile() {
        if ($_POST) {
            $company_id = $this->input->post('company_id');
            $company_profile = array();
            $company_profile['company_email'] = trim($this->input->post('company_email'));
            $company_profile['company_url'] = trim($this->input->post('company_url'));
            $company_profile['company_address'] = trim($this->input->post('company_address'));
            $company_profile['company_city'] = $this->input->post('company_city');
            $company_profile['company_state'] = $this->input->post('company_state');
            $company_profile['company_country'] = $this->input->post('company_country');
            $company_profile['company_countries'] = $this->input->post('hdn_company_country');
            $company_profile['company_zipcode'] = $this->input->post('company_zip');
            $company_profile['company_contact_no'] = $this->input->post('company_contact');
            $company_profile['company_tags'] = $this->input->post('company_tag');
            $company_profile['company_segment'] = $this->input->post('hdn_company_segment');
            $company_profile['company_panel_names'] = $this->input->post('company_panel_names');
            $company_profile['company_primary_user'] = $this->input->post('company_primary_user');

            $rows = $this->mdl_company->update_company($company_id, $company_profile);
            if ($rows && $rows != 0) {
                $this->lib_message->set_success_message('Profile Updated Successfully!!');
            } else
                $this->lib_message->set_failure_message('Network Error!!');
            redirect('company/profile');
        }
    }

}
