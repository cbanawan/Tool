<?php

/**
 * Description of company
 *
 * @author rita
 */
class email_template extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->authentication->check_session();
        $this->loadJs();
        $this->loadCSS();
        $this->load->model('mdl_email_template');
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
        $parse['content'] = $this->parser->parse('email_template/email_template_list', $parse, true);	
        $site_nav_arr = $this->config->item('email_template');
		$parse['site_nav'] = $site_nav_arr['breadcrumb'];
		$parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['header_text'] = "Email Template";
        $parse['header_inner'] = "Email Template";
        $parse['cssFiles'] = $this->cssFiles;
        $parse['jsFiles'] = $this->jsFiles;
        $parse['success_msg'] = $this->lib_message->get_success_message();
        $parse['failure_msg'] = $this->lib_message->get_failure_message();
        $this->parser->parse('common/layout', $parse);
    }
    function add_email_template() {
		$parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['content'] = $this->parser->parse('email_template/form_view', $parse, true);
        $site_nav_arr = $this->config->item('email_template_add');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Email Template";
        $parse['header_inner'] = "Add Email Template";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
	}
    function edit_email_template($email_template_id) {
		$parse = array();
		//echo $email_template_id;
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['email_templates'] = $this->mdl_email_template->get_email_template($email_template_id);
        $parse['content'] = $this->parser->parse('email_template/form_view', $parse, true);
        $site_nav_arr = $this->config->item('email_template_edit');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['actions'] = $site_nav_arr['action_view'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Email Template";
        $parse['header_inner'] = "Edit Email Template";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
	}
	 function insert_email_template() {
        if ($_POST) {
            $email_template_detail = array();
            $email_template_detail['email_template_shortcode'] = trim($this->input->post('email_template_shortcode'));
			$email_template_detail['email_template_subject'] = trim($this->input->post('email_template_subject'));
			$email_template_detail['email_template_content'] = trim($this->input->post('email_template_content'));
            $email_template_detail['email_template_modifieddate'] = date(DATE_FORMAT_DB);
            $email_template_detail['email_template_remote_ip'] = $_SERVER['REMOTE_ADDR'];
			if($this->input->post('email_template_id') != '') {
				//$email_template_detail['email_template_id'] = $this->input->post('email_template_id');
				$this->mdl_email_template->update_email_template($this->input->post('email_template_id'),$email_template_detail);
				$this->lib_message->set_success_message('Project Added Successfully!!');
			} else {
				$email_template_detail['email_template_createddate'] = date(DATE_FORMAT_DB);
				$this->mdl_email_template->insert_email_template($email_template_detail);
				$this->lib_message->set_success_message('Project Added Successfully!!');
			}
            redirect('email_template');
            exit;
        }
    }
    function delete_email_template() {
        if ($_POST) {
            $rows = $this->mdl_email_template->delete_email_template($_POST['email_template_id']);
            if ($rows > 0) {
                echo "success";
                exit();
            }
        }
        echo "error";
        exit;
    }
    public function get_all_email_template() {
        $aColumns = array('', 'email_template_shortcode', 'email_template_subject', 'actions');
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
            if (isset($_POST['email_template_subject']) && $_POST['email_template_subject'] != "") {
                $filter_data['email_template_subject'] = trim($_POST['email_template_subject']);
            }
        }
        // Select Data        
        $rResult = $this->mdl_email_template->get_email_template_list($filter_data, $sort_array, $limit, $offset);
        // Data set length after filtering
        $iTotal = $this->mdl_email_template->get_email_template_list_total($filter_data);
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
                        $str = '<a id="edit_template_' . $m->email_template_id . '" href="' . base_url('email_template/edit_email_template/' . $m->email_template_id) . '">
                            <span class="icons" rel="tooltip" title="Edit Email Template" ><i class="fa fa-edit fa-lg"></i></span></a>';
                        $str .= '<a id="rmvTemplate_' . $m->email_template_id . '" style="margin-left: 7px;" href="javascript:void(0);"><span class="" rel="tooltip" title="Delete"><i class="fa fa-trash-o fa-lg"></i></span></a>';
                        $row[] = $str;
                    } else if ($col == 'email_template_shortcode' || $col == 'email_template_subject') {
                        $row[] = $m->$col;
                    } else {
                        $row[] = '<input type="checkbox" class="checkboxes" value="' . $m->email_template_id . '"/>';
                    }
                }
                array_push($output['aaData'], $row);
            }
        }
        echo json_encode($output);
        exit();
    }
}
