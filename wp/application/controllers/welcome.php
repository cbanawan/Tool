<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Welcome extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->authentication->check_session();
        $this->loadJs();
        $this->loadCSS();
        $this->load->config('pp_config');
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
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function index() {
        $this->load->model('mdl_bids');
        $bids = $this->mdl_bids->get_bids();
        foreach ($bids as $value) {
//            $key = $this->lib_common->generate_long_key();
            $key = md5(uniqid(rand(), true));
            $id = substr($key, 0, 8);
            $this->mdl_bids->update_bid($value->bid_id, array('bid_long_id' => $id));
            $id = "";
        }
        $this->load->view('welcome_message');
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */