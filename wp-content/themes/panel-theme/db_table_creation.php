<?php 
/* user_master Table */

$user_db_table_name = $table_prefix."user_master";
global $user_db_table_name, $wpdb ;
if($wpdb->get_var("SHOW TABLES LIKE \"$user_db_table_name\"") != $user_db_table_name){
$user_table = 'CREATE TABLE `'.$user_db_table_name .'`  (
`entry_id` int(8) NOT NULL AUTO_INCREMENT PRIMARY KEY, 
`company_name` varchar(255) NOT NULL, 
`entry_date` DATETIME NOT NULL, 
`user_name` VARCHAR(250) NOT NULL, 
`user_email` VARCHAR(250) NOT NULL, 
`password` VARCHAR(250) NOT NULL, 
`user_type` VARCHAR(250) NOT NULL 
)';
$wpdb->query($user_table);
}

?>
