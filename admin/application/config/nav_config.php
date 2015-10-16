<?php

$config['user_list'] = array('breadcrumb' => array('last' => 'Users'), 'action_view' => array('users/add_user' => 'Add User'));
$config['user_add'] = array('breadcrumb' => array('users' => 'Users', 'last' => 'Add User'), 'action_view' => array('users' => 'Users'));
$config['user_edit'] = array('breadcrumb' => array('users' => 'Users', 'last' => 'Edit User'), 'action_view' => array('users' => 'Users'));

$config['project_add'] = array('breadcrumb' => array('projects' => 'Manage Projects', 'last' => 'Add Project'), 'action_view' => array('projects' => 'Projects'));
$config['project_edit'] = array('breadcrumb' => array('projects' => 'Manage Projects', 'last' => 'Edit Project'), 'action_view' => array('projects' => 'Projects','#search_partner'=>'Search Partners','#bid_replies'=>'Bid Replies','#awarede_partners'=>'Awarded Partners','#closing_details'=>'Closing Details'));
$config['project_list'] = array('breadcrumb' => array('last' => 'Projects'), 'action_view' => array('projects/add_project' => 'Add Project'));
$config['project_search'] = array('breadcrumb' => array('projects' => 'Projects','last' => 'Search Project'), 'action_view' => array('projects' => 'Project List','projects/add_project' => 'Add Project'));

$config['bid_list'] = array('breadcrumb' => array('last' => 'Bids'), 'action_view' => array('bids' => 'Bids'));

$config['company_profile'] = array('breadcrumb' => array('last' => 'Company Profile'));
$config['email_template'] = array('breadcrumb' => array('last' => 'Email Templates'), 'action_view' => array('email_template/add_email_template' => 'Add Email Template'));
$config['email_template_add'] = array('breadcrumb' => array('email_template' => 'Manage Email Templates', 'last' => 'Add Email Template'), 'action_view' => array('email_template' => 'Manage Email Templates'));
$config['email_template_edit'] = array('breadcrumb' => array('email_template' => 'Manage Email Templates', 'last' => 'Edit Email Template'), 'action_view' => array('email_template' => 'Manage Email Templates'));

//$config['permission'] = array('breadcrumb' => array('last' => 'Permission'));
//$config['permission_modules'] = array('users', 'company', 'project');
