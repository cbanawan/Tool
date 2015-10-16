<?php

$config['user_type'] = array('0' => 'superadmin', '1' => 'admin', '2' => 'user');

$config['company_type'] = array("1" => "Researcher", "2" => "Partner", "3" => "Both");

$config['company_segment'] = array('1' => 'B2B', '2' => 'B2C', '3' => 'Community', '4' => 'Phone', "5" => "Clinical Trail Recruit", "6" => "Focus Group Recruit", "7" => "In-Home Usage Test", "8"=> "Other");
$config['payment_method'] = array('1' => 'Cash', '2' => 'Cheque');
$config['payment_status'] = array('0' => 'Pending', '1' => 'Approved');
$config['invoice_status'] = array('0' => 'Active', '1' => 'Inactive', '2'=>'Preparing');
$config['invoice_payment_status'] = array('0' => 'Invoice sent', '1' => 'Paid', '2' => 'Pushback', '3' => 'Delay');

$config['batch_number'] = array('1' => 'Jan 1 to Jan 15', 
'2' => 'Jan 16 to Jan 31',
'3' => 'Feb 1 to Feb 15',
'4' => 'Feb 16 to Feb 28',
'5' => 'Mar 1 to Mar 15',
'6' => 'Mar 16 to Mar 31',
'7' => 'Apr 1 to Apr 15',
'8' => 'Apr 16 to Apr 31',
'9' => 'May 1 to May 15',
'10' => 'May 16 to May 31',
'11' => 'Jun 1 to Jun 15',
'12' => 'Jun 16 to Jun 31',
'13' => 'Jul 1 to Jul 15',
'14' => 'Jul 16 to Jul 31',
'15' => 'Aug 1 to Aug 15',
'16' => 'Aug 16 to Aug 31',
'17' => 'Sep 1 to Sep 15',
'18' => 'Sep 16 to Sep 31',
'19' => 'Oct 1 to Oct 15',
'20' => 'Oct 16 to Oct 31',
'21' => 'Nov 1 to Nov 15',
'22' => 'Nov 16 to Nov 31',
'23' => 'Dec 1 to Dec 15',
'24' => 'Dec 16 to Dec 31');

$CI = & get_instance();
$CI->load->model('mdl_country');
$country = $CI->mdl_country->get_all_country();
$config['country'] = $country;

$cjson = array();
foreach ($country as $row) {
    array_push($cjson, array('id' => $row->country_id, 'name' => htmlentities($row->country_name, ENT_QUOTES)));
}
//$config['country_json'] = json_encode($cjson,JSON_HEX_APOS);
$config['country_json'] = json_encode($cjson);

define("WHOLE_PROJECT", 1);
define("ONLY_THIS_SEGMENT", 2);

$config['fee_type'] = array(
    WHOLE_PROJECT => 'Whole Project',
    ONLY_THIS_SEGMENT => "Only This Segment"
);
