<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

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

define('FOPEN_READ', 'rb');
define('FOPEN_READ_WRITE', 'r+b');
define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
define('FOPEN_WRITE_CREATE', 'ab');
define('FOPEN_READ_WRITE_CREATE', 'a+b');
define('FOPEN_WRITE_CREATE_STRICT', 'xb');
define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');


define("CSS", 'css/');
define("JS", 'js/');
define("UPLOAD", 'uploads/');
define("IMAGES", 'images/');

//Database tables

define('TABLE_COMPANY_COUNRTY_MASTER', 'company_country_master');
define('TABLE_COMPANY_MASTER', 'company_master');
define('TABLE_COMPANY_SEGMENT_MASTER', 'company_segment_master');
define('TABLE_COUNTRY_MASTER', 'country_master');
define('TABLE_PANEL_USER_MASTER', 'panel_user_master');
define('TABLE_PROJECT_MASTER', 'project_master');
define('TABLE_PROJECT_COUNTRY_MASTER', 'project_country_master');
define('TABLE_BID_REPLIES_MASTER', 'bid_replies_master');
define('TABLE_BID_REPLIES_CHILD', 'bid_replies_child');
define('TABLE_EMAIL_TEMPLATE', 'email_template');
define('TABLE_PROJECT_FILE', 'project_files_master');
define('TABLE_PROJECT_CLOSING_MASTER', 'project_closing_master');
define('TABLE_PROJECT_CLOSING_DETAIL', 'project_closing_detail');
define('TABLE_RESEARCH_REWARD_DETAILS', 'researcher_reward_details');
define('TABLE_RESEARCH_REWARD', 'researcher_reward');
define('TABLE_RESEARCH_REWARD_REQUESTS', 'researcher_reward_requests');
define('TABLE_PARTNER_SEGMENTS', 'partner_segments');
define('TABLE_SESSION_LOG', 'session_log_master');
define('TABLE_USER_ACTIVITY', 'user_activity_log');
define('TABLE_INVOICE_MASTER', 'invoice_master');
define('TABLE_INVOICE_DETAIL', 'invoice_detail');

define("DATE_FORMAT_DB", 'Y-m-d H:i:s');
define("DATE_DISPLAY_FORMAT", 'm/d/Y');
define("DATETIME_DISPLAY_FORMAT", 'm/d/Y H:i:s');
define("REWARD_PERCENTAGE", '0.01');

define('ADD_PROJECT_TYPE', 'Add Project');
define('ADD_SEGMENT_TYPE', 'Add Project Segment');
define('ADD_FILE_TYPE', 'Add Project Segment file');
define('DELETE_FILE_TYPE', 'Delete Project Segment file');
define('UPDATE_STATUS', 'Update status');
define('EDIT_PROJECT_TYPE', 'Edit Project');
define('SEND_BID_TYPE', 'Send Bid');
define('ACCEPT_BID', 'Accept Bid');
define('ADD_PROJECT', '%s has added new "%s" project');
define('DELETE_SEGMENT', 'Delete segment');
define('ENABLE_SEGMENT', 'Enable segment');
define('CLOSE_PROJECT_TYPE', 'Close Project');
define('CLONE_PROJECT', 'Clone Project');
define('CLOSE_DETAIL_PARTNER', 'Closing detail for partner');
define('ADD_USER_TYPE', 'Add user');
define('UPDATE_USER_TYPE', 'Edit user');
define('DELETE_USER_TYPE', 'Delete user');
define('UPDATE_COMPANY_PROFILE_TYPE', 'Update profile');
define('UPDATE_BASIC_PROFILE_TYPE', 'Update Basic profile');
define('REDEEM_REWARDS_TYPE', 'Redeem rewards');

define('ADD_PROJECT_COUNTRY', '%s has added new "%s" project segment');
define('EDIT_PROJECT_COUNTRY', '%s has edited new "%s" project segment');
define('ADD_PROJECT_SEGMENT', '%s has added new "%s" segment file');
define('EDIT_PROJECT_MASTER_TYPE', 'Edit Project master');
define('EDIT_PROJECT_MASTER', '%s has edited new "%s" project');
define('DELETE_PROJECT_FILE', '%s has deleted new "%s" segment file');
define('SEND_BID', '%s has sent to %s on "%s" project');
define('ACCEPT_BID_DESC', '%s has accepted bid of partner "%s" on "%s" segment for %s project');
define('UPDATE_STATUS_DESC', '%s has updated status of "%s" project');
define('DELETE_SEGMENT_DESC', '%s has deleted segment "%s" of project "%s"');
define('CLOSE_PROJECT', '%s has closed project "%s"');
define('CLOSE_DETAIL_PARTNER_DESC', '%s has close project "%s" with partner "%s"');
define('ADD_USER_RESEARCHER', '%s has created new user "%s"');
define('UPDATE_USER_RESEARCHER', '%s has edited user "%s"');
define('DELETE_USER_RESEARCHER', '%s has deleted user "%s"');
define('CLONE_PROJECT_DESC', '%s has clone project of "%s". New cloned project added "%s"');
define('UPDATE_COMPANY_PROFILE_DESC', '%s has edited company profile "%s"');
define('UPDATE_BASIC_PROFILE_DESC', '%s has edited basic company profile "%s" ');
define('REDEEM_REWARDS_DESC', '%s has redeem rewards point "%s" payment by %s');

// Vendor
define('FRESH_BID_REPLY', 'User %s has sent reply from fresh bid');
define('CONVERSATION_REPLY', 'User %s has sent reply from conversation bid');
define('APPROVE_PROJECT', 'User %s has approved project from closing detail');
define('UPDATE_COMPANY_PROFILE', 'User %s has update company profile');
define('BASIC_PROFILING', 'User %s has update basic profiling');
define('ADD_USER', 'User %s has added new user');
define('EDIT_USER', 'User %s has edited user');
define('DELETE_USER', 'User %s has deleted user');
define('MULTI_DELETE_USER', 'User %s has deleted multiple users');
define('ADD_EMAIL_TEMPLATE', 'User %s has added email templates');
define('EDIT_EMAIL_TEMPLATE', 'User %s has edited email template');
define('DELETE_EMAIL_TEMPLATE', 'User %s has deleted email template');
define('MULTI_DELETE_EMAIL_TEMPLATE', 'User %s has deleted multiple email templates');

define('LOGGED_IN', 'User %s has logged in successfully');
define('LOGGED_OUT', 'User %s has logged out successfully');

/* End of file constants.php */
/* Location: ./application/config/constants.php */


