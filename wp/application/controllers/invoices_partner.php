<?php
/**
 * Description of invoices_partner
 *
 * @author Rita
 */
class invoices_partner extends CI_Controller {

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
        $parse['invoice_status'] = $this->config->item('invoice_status');
        $parse['project_segments'] = $this->config->item('company_segment');
        $parse['invoice_payment_status'] = $this->config->item('invoice_payment_status');
        $parse['batch_number'] = $this->config->item('batch_number');
        $parse['country'] = $this->config->item('country');
        $parse['company_segment'] = $this->config->item('company_segment');
		
		$site_nav_arr = $this->config->item('invoice_partner');
        $parse['site_nav'] = $site_nav_arr['breadcrumb'];
        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
		
        $parse['header_text'] = "Invoice";
        $parse['header_inner'] = "Invoice";
		$parse['invoice_master_detail'] = $this->mdl_company->get_invoice_master(1);
		//$parse['active_invoices'] = $this->mdl_company->get_invoices(1);
		$parse['pending_invoices'] = $this->mdl_company->get_invoices(0);
		$parse['content'] = $this->parser->parse('company/invoice_partner', $parse, true);
        $parse['cssFiles'] = $this->cssFiles;
        $parse['jsFiles'] = $this->jsFiles;
        $parse['success_msg'] = $this->lib_message->get_success_message();
        $parse['failure_msg'] = $this->lib_message->get_failure_message();
        $this->parser->parse('common/layout', $parse); 
    }
	
}
?>