<?php

class lib_message {

    private $ci;

    public function __construct() {
        $this->ci = &get_instance();
    }

    public function set_failure_message($message) {
        $this->ci->session->set_flashdata("failure_message", $message);
    }

    public function get_failure_message() {
        return $this->ci->session->flashdata("failure_message");
    }

    public function set_success_message($message) {
        $this->ci->session->set_flashdata("success_message", $message);
    }

    public function get_success_message() {
        return $this->ci->session->flashdata("success_message");
    }

    public function set_warning_message($message) {
        $this->ci->session->set_flashdata("warning_message", $message);
    }

    public function get_warning_message() {
        return $this->ci->session->flashdata("warning_message");
    }

}

?>