 <?php

/**
 * Description of lib_send_mail
 *
 * @author Priyanka Patel
 */
class lib_send_mail {

    var $CI;

    function __construct() {
        $this->CI = & get_instance();        
    }

    function send_mail($user_email_id, $subject, $template_body,$is_html = true) {
        $from_name = "Team PangeaPanel";
        $from_email = "contact@pangeapanel.com";
        $config = Array(
            'protocol' => 'smtp',
            'smtp_host' => 'ssl://smtp.googlemail.com',
            'smtp_port' => 465,
            'smtp_user' => 'contact@pangeapanel.com', // add this
            'smtp_pass' => 'P@ngeaP@nel1', // add this
            'mailtype' => 'html',
            'charset' => 'iso-8859-1'
        );
        $config['crlf'] = "\r\n";
        $config['newline'] = "\r\n";

        $this->CI->load->library('email');
        $this->CI->email->initialize($config);
        if ($is_html) {
            $this->CI->email->set_mailtype("html");
        }
        $this->CI->email->from($from_email, $from_name);
        $this->CI->email->to($user_email_id);

        $this->CI->email->subject($subject);
        $this->CI->email->message($template_body);
        $result = $this->CI->email->send();
		//var_dump($result);
		//echo "<pre>";
		//print_r($result);die;
        return $result;
    }

}

?>
