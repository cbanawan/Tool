<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of home
 *
 * @author priyanka
 */
class home extends CI_Controller {

    private $jsFiles;
    private $cssFiles;

    function __construct() {
        parent::__construct();
        $this->loadJs();   
    }
    
     private function loadJs() {
        $this->jsFiles = array();
//        $this->jsFiles[] = "order.js";
    }

    public function index() {
        $parse = array();
        $parse['header'] = $this->parser->parse('common/header', $parse, true);
        $parse['footer'] = $this->parser->parse('common/footer', $parse, true);
        $parse['sidebar'] = $this->parser->parse('common/sidebar', $parse, true);
//        $parse['content'] = $this->parser->parse('login', $parse, true);
        $parse['content'] = "<h2>This is testing Content</h2>";
        $parse['jsFiles'] = $this->jsFiles;
        $this->parser->parse('common/layout', $parse);
    }

}
