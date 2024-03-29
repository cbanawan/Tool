<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
define('FILE_READ_MODE', 0644);
define('FILE_WRITE_MODE', 0666);
define('DIR_READ_MODE', 0755);
define('DIR_WRITE_MODE', 0777);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/

define('FOPEN_READ',							'rb');
define('FOPEN_READ_WRITE',						'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE',		'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE',	'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE',					'ab');
define('FOPEN_READ_WRITE_CREATE',				'a+b');
define('FOPEN_WRITE_CREATE_STRICT',				'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT',		'x+b');


define("CSS", 'css/');
define("JS", 'js/');
define("UPLOAD", 'uploads/');
define("IMAGES", 'images/');

//Database tables

define('TABLE_COMPANY_COUNRTY_MASTER','company_country_master');
define('TABLE_COMPANY_MASTER','company_master');
define('TABLE_COMPANY_SEGMENT_MASTER','company_segment_master');
define('TABLE_COUNTRY_MASTER','country_master');
define('TABLE_PANEL_USER_MASTER','panel_user_master');
define('TABLE_PROJECT_MASTER','project_master');
define('TABLE_PROJECT_COUNTRY_MASTER','project_country_master');
define('TABLE_BID_REPLIES_MASTER','bid_replies_master');
define('TABLE_BID_REPLIES_CHILD','bid_replies_child');
define('TABLE_EMAIL_TEMPLATE','email_template');
define('TABLE_PROJECT_FILE','project_files_master');

define("DATE_FORMAT_DB", 'Y-m-d H:i:s');

/* End of file constants.php */
/* Location: ./application/config/constants.php */
