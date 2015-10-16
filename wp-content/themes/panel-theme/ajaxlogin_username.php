<?php 
$wp_config_path = dirname(dirname(dirname(dirname(__FILE__))));
  if (file_exists($wp_config_path . DIRECTORY_SEPARATOR . "wp-config.php")) {
      include_once ($wp_config_path . DIRECTORY_SEPARATOR . "wp-config.php");
  } else {
      include_once (dirname($wp_config_path)) . DIRECTORY_SEPARATOR . "wp-config.php";
  }
global $user_db_table_name, $wpdb, $table_prefix ;
$user_db_table_name = $table_prefix."user_master";
if(isset($_POST['login_user_name']) && $_POST['login_user_name'] != '' && isset($_POST['login_user_password']) && $_POST['login_user_password'] != '' ) {
	
	$check_company_sql = $wpdb->get_results("select entry_id from $user_db_table_name where user_name = '".$_POST['login_user_name']."' and password = '".$_POST['login_user_password']."' ");
	if($wpdb->num_rows == 0) {
		echo "fail";	
	} else {
		echo "success";	
	}
	
} 
?>
