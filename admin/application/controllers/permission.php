<?php

/**
 * Description of permission
 *
 * @author priyanka
 */
class permission extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->authentication->check_session();
        $this->loadJS();
        $this->loadCSS();
        $this->load->config('pp_config');
    }

    private function loadJS() {
        $this->jsFiles = array();
    }

    private function loadCSS() {
        $this->cssFiles = array();
    }

    public function index() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
        $parse['modules'] = $this->config->item('permission_modules');
        $parse['user_type'] = $this->config->item('user_type');
        $parse['content'] = $this->parser->parse('admin/permission', $parse, true);
//        $parse['action_view'] = $this->parser->parse('common/action_view', $parse, true);
        $parse['site_nav'] = $this->config->item('permission')['breadcrumb'];
        $parse['breadcrumb_view'] = $this->parser->parse('common/breadcrumb_view', $parse, true);
        $parse['header_text'] = "Permission";
        $parse['header_inner'] = "Assign Permission";
        $parse['jsFiles'] = $this->jsFiles;
        $parse['cssFiles'] = $this->cssFiles;
        $this->parser->parse('common/layout', $parse);
    }

}
