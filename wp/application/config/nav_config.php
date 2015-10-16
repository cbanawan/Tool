<?php

$config['user_list'] = array('breadcrumb' => array('last' => 'Users'), 'action_view' => array('users/add_user' => 'Add User'));

$config['researcher_dashboard'] = array('breadcrumb' => array('last' => 'Dashboard'));
$config['rewards_nav'] = array('breadcrumb' => array('last' => 'Rewards'));
$config['user_add'] = array('breadcrumb' => array('users' => 'Users', 'last' => 'Add User'), 'action_view' => array('users' => 'Users'));
$config['user_edit'] = array('breadcrumb' => array('users' => 'Users', 'last' => 'Edit User'), 'action_view' => array('users' => 'Users'));

$config['project_add'] = array('breadcrumb' => array('projects' => 'Manage Projects', 'last' => 'Add Project'), 'action_view' => array('projects' => 'Projects'));
$config['project_edit'] = array('breadcrumb' => array('projects' => 'Manage Projects', 'last' => 'Edit Project'), 'action_view' => array('projects' => 'Projects', '#search_project' => 'Search Partners', '#bid_replies' => 'Bid Replies', '#awareded_partners' => 'Awarded Partners', '#closing_details' => 'Closing Details'));
$config['project_list'] = array('breadcrumb' => array('last' => 'Projects'), 'action_view' => array('projects/add_project' => 'Add Project'));
$config['project_search'] = array('breadcrumb' => array('projects' => 'Projects', 'last' => 'Search Project'), 'action_view' => array('projects' => 'Project List', 'projects/add_project' => 'Add Project'));

$config['bid_list'] = array('breadcrumb' => array('last' => 'Bids'), 'action_view' => array('bids' => 'Bids'));
$config['fresh_bid_list'] = array('breadcrumb' => array('#' => 'Manage Bids', 'last' => 'Fresh Bids'), 'action_view' => array());
$config['conv_bid_list'] = array('breadcrumb' => array('#' => 'Manage Bids', 'last' => 'Conversation'), 'action_view' => array());
$config['conv_detail_bid_list'] = array('breadcrumb' => array('#' => 'Manage Bids', 'bids/conversation' => 'Conversation', 'last' => 'Details'), 'action_view' => array());
$config['won_projects'] = array('breadcrumb' => array('#' => 'Manage Bids', 'last' => 'Won Projects'), 'action_view' => array());
$config['won_project_detail'] = array('breadcrumb' => array('#' => 'Manage Bids', 'bids/won_projects' => 'Won Projects', 'last' => 'Details'), 'action_view' => array());
$config['close_projects'] = array('breadcrumb' => array('#' => 'Manage Bids', 'last' => 'Close Projects'), 'action_view' => array());
$config['close_project_detail'] = array('breadcrumb' => array('#' => 'Manage Bids', 'bids/close_projects' => 'Close Projects', 'last' => 'Details'), 'action_view' => array());

$config['company_profile'] = array('breadcrumb' => array('last' => 'Company Profile'));
$config['basic_profile'] = array('breadcrumb' => array('last' => 'Basic Profile'));
$config['email_template'] = array('breadcrumb' => array('last' => 'Email Templates'), 'action_view' => array('email_template/add_email_template' => 'Add Email Template'));
$config['email_template_add'] = array('breadcrumb' => array('email_template' => 'Manage Email Templates', 'last' => 'Add Email Template'), 'action_view' => array('email_template' => 'Manage Email Templates'));
$config['email_template_edit'] = array('breadcrumb' => array('email_template' => 'Manage Email Templates', 'last' => 'Edit Email Template'), 'action_view' => array('email_template' => 'Manage Email Templates'));

$config['manage_project'] = array('breadcrumb' => array('last' => 'Manage Project'));
$config['invoice_partner'] = array('breadcrumb' => array('last' => 'Partner Invoice'));

//$config['permission'] = array('breadcrumb' => array('last' => 'Permission'));
//$config['permission_modules'] = array('users', 'company', 'project');
