<?php

$config['user_type'] = array('0' => 'superadmin','1' => 'admin', '2' => 'user');

$config['company_type'] = array("1" => "Researcher", "2" => "Partner", "3" => "Both");

$config['company_segment'] = array('1'=>'B2B','2'=>'B2C','3'=>'Community','4'=>'Phone');

$CI = & get_instance();
$CI->load->model('mdl_country');
$country = $CI->mdl_country->get_all_country();
$config['country'] = $country;

$cjson = array();
foreach($country as $row){
   array_push($cjson,array('id' => $row->country_id , 'name'=> htmlentities($row->country_name,ENT_QUOTES)));
}
//$config['country_json'] = json_encode($cjson,JSON_HEX_APOS);
$config['country_json'] = json_encode($cjson);
