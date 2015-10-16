<?php 

/**
 * Description of basic_profile
 *
 * @author Rita
 */
class basic_profile extends CI_Controller {
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
    }

    private function loadJs() {
        $this->jsFiles = array();
       
    }
	public function index() {
		$parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['company_type'] = $this->config->item('company_type');
        $parse['country'] = $this->config->item('country');
		$parse['project_segments'] = $this->config->item('company_segment');
        
		$parse['country_detail'] = $this->mdl_company->get_country_from_panel_segments();
            $parse['content'] = $this->parser->parse('company/basic_profile', $parse, true);
        
//        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $site_nav_arr = $this->config->item('basic_profile');
		$parse['site_nav'] = $site_nav_arr['breadcrumb'];
		
	    $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Panel Profiling details";
        $parse['header_inner'] = "Panel Profiling details";
        $parse['cssFiles'] = $this->cssFiles;
        $parse['jsFiles'] = $this->jsFiles;
        $parse['success_msg'] = $this->lib_message->get_success_message();
        $parse['failure_msg'] = $this->lib_message->get_failure_message();
        $this->parser->parse('common/layout', $parse);
    }

	function upload_segment_file(){
		$this->mdl_company->check_partner_segments();		
		$upload_path = FCPATH . '/uploads/' . $this->session->userdata('user_id');
        if (!file_exists($upload_path)) {
            mkdir($upload_path, 0777);
        }
		if (!move_uploaded_file($_FILES['upd_file_vendor']['tmp_name'], $upload_path . '/' . $_FILES['upd_file_vendor']['name'])) {
			$this->lib_message->set_failure_message('There is problem with file uploading!!');
            redirect('company/profile');
		} else {
			$company_segments = '1,2,3,4';
			$company_countries = array();
			$company_profile = array();
			$company_tags = array();
			$segment_file = $upload_path . '/' . $_FILES['upd_file_vendor']['name'];
			$segment_handel = fopen($segment_file, 'r');
			//$theData = fgets($segment_handel);
			$i = 0;
			//$segment_detail = array();
			$country = $this->config->item('country');
			
			while (($segment_data= fgetcsv($segment_handel, 2048, ",")) !== FALSE) {
				
				$segment_detail['partner_id'] = $this->session->userdata('company_id');
				$opt_cname = $this->common_function->in_array_field(trim($segment_data[0]), 'country_name', $country, false);
				

				if($opt_cname != '') {
				$company_countries[] = $opt_cname->country_id;
					for($j=1;$j <= 8;$j++) {
						$tags_index = ($j*2)-1;
                                                $number_panelists_index = ($j*2);
						$company_tags[] = str_replace(';',',',trim($segment_data[$j]));
						$segment_detail['country_id'] = $opt_cname->country_id;
						$segment_detail['segment_id'] = $j;
						$segment_detail['tags'] = trim($segment_data[$tags_index]);
						$segment_detail['number_panelists'] = (int) trim($segment_data[$number_panelists_index]);
						$segment_detail['entry_created_by'] = $this->session->userdata('user_id');
						$segment_detail['entry_created_date'] = date(DATE_FORMAT_DB);
						$segment_detail['entry_modified_by'] = $this->session->userdata('user_id');
						$segment_detail['entry_modified_date'] = date(DATE_FORMAT_DB);
						$segment_detail['entry_remote_ip'] = $_SERVER['REMOTE_ADDR'];
						$rows = $this->mdl_company->insert_partner_segment($segment_detail);
					}
				}
							
				
			}
			$company_profile['company_countries'] = implode(',',$company_countries);
            $company_profile['company_tags'] = implode(',',$company_tags);
            $company_profile['company_segment'] = $company_segments;
			 $rows = $this->mdl_company->update_company($this->session->userdata('company_id'), $company_profile);
			fclose($segment_handel);
			$user_activity = array();
			$user_activity['activity_type'] = UPDATE_BASIC_PROFILE_TYPE;
			$res = $this->mdl_company->get_company_detail($this->session->userdata('company_id'));
			$user_activity['activity_description'] = sprintf(UPDATE_BASIC_PROFILE_DESC,$this->session->userdata('user_name'),$res['company_name']);
			$this->user_modal->insert_user_activity($user_activity);
			$this->lib_message->set_success_message('Partner segments have been updated successfully!');redirect('basic_profile');			
		} 
	}
}
?>