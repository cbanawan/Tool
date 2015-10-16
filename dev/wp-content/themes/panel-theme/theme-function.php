<?php
session_start();
//[signup_form]
function shortcode_signup_form( $atts,$content=null ) {
	extract( shortcode_atts( array(
		
	), $atts ) ); 
	$signup_form_display = '<div class="form-signup"><form method="post" id="frm-signup" >
	<input type="hidden" class="form-control" value="'.get_template_directory_uri().'" name="theme_url" id="theme_url" autocomplete="off">
	<div class="form-group">
      <label>Company Name : </label><input type="text" class="form-control" name="company_name" id="company_name" autocomplete="off"><span id="company_name_error"></span>
    </div>
    <div class="form-group">
      <label>User Name : </label><input type="text" class="form-control" name="user_name" id="user_name" autocomplete="off"><span id="user_name_error"></span>
    </div>
    <div class="form-group">
      <label>Email : </label><input type="text" class="form-control" name="user_email" id="user_email" autocomplete="off"><span id="user_email_error"></span>
    </div>
    <div class="form-group">
      <label>Password : </label><input type="password" class="form-control" name="user_password" id="user_password" autocomplete="off"><span id="user_password_error"></span>
    </div>
     <div class="form-group">
      <label>Confirm Password : </label><input type="password" class="form-control" name="user_confirm_password" id="user_confirm_password" autocomplete="off"><span id="user_confirm_password_error"></span>
    </div>
     <div class="form-group">
      <label>Type : </label><select class="form-control" name="user_type" id="user_type" ><option value="Researcher">Researcher</option><option value="Partner">Partner</option></select>
    </div>
	<div class="form-group">
      <label>&nbsp;</label><input type="submit" class="btn btn-default submit" name="submit_signup" value="Submit" />
    </div>
	</form></div>';
	return $signup_form_display;
}
add_shortcode( 'signup_form', 'shortcode_signup_form' );
//[login_form]
function shortcode_login_form( $atts,$content=null ) {
	extract( shortcode_atts( array(
		
	), $atts ) ); 
	$login_form_display = '<div class="form-signup"><div class="errorMsg" id="login_msg_error"></div><form method="post" id="frm-login" >
	<input type="hidden" class="form-control" value="'.get_template_directory_uri().'" name="theme_url" id="theme_url" autocomplete="off">
	<div class="form-group">
      <label>User Name : </label><input type="text" class="form-control" name="login_user_name" id="login_user_name" autocomplete="off">
    </div>
    <div class="form-group">
      <label>Password : </label><input type="password" class="form-control" name="login_user_password" id="login_user_password" autocomplete="off">
    </div>
     
    <div class="form-group">
      <label>&nbsp;</label><input type="submit" class="btn btn-default submit" name="submit_login" value="Login" />
    </div>
	</form></div>';
	return $login_form_display;
}
add_shortcode( 'login_form', 'shortcode_login_form' );
global $user_db_table_name, $wpdb ;
if(isset($_POST['submit_signup'])) {
	
	$wpdb->query("insert into $user_db_table_name values(null, '".$_POST['company_name']."', now(), '".$_POST['user_name']."', '".$_POST['user_email']."', '".$_POST['user_password']."', '".$_POST['user_type']."')");
	wp_redirect(get_option('siteurl').'/login/');
	exit;
	
}
if(isset($_POST['submit_login'])) {
	$user_sql = $wpdb->get_row("select entry_id from $user_db_table_name where user_name = '".$_POST['login_user_name']."' and password = '".$_POST['login_user_password']."' ");
	
	$_SESSION["userID"] = $user_sql->entry_id;
	wp_redirect(get_option('siteurl').'/userpage/');
	exit;
}
//[welcome_txt]
function shortcode_userpage( $atts,$content=null ) {

	extract( shortcode_atts( array(
		
	), $atts ) ); 
	global $user_db_table_name, $wpdb, $table_prefix ;
	$user_db_table_name = $table_prefix."user_master";
	$get_user_sql = $wpdb->get_row("select * from $user_db_table_name where entry_id = '".$_SESSION['userID']."'");
	echo 'Welcome, '.$get_user_sql->user_name;
}
add_shortcode( 'welcome_txt', 'shortcode_userpage' );
//[homepage_block bgcolor="" main_title="" bottom_content=""]
function shortcode_homepage_block( $atts,$content=null ) {
	extract( shortcode_atts( array(
		"bgcolor"=>$bgcolor,
		"main_title"=>$main_title,
		"bottom_content"=>$bottom_content		
	), $atts ) ); 
	$homepage_block_display ='<div class="module_line_trigger" data-option="hasShadow" data-background="'.$bgcolor.' url('.get_template_directory_uri().'/img/bg_pattern1.png) repeat 0 0" data-top-padding="top_padding_normal" data-bottom-padding="module_normal_padding">
		<div class="row-fluid">
			<div class="span12 module_cont module_feature_posts module_medium_padding">
				<div class="bg_title"><h4 class="headInModule">'.$main_title.'</h4></div>
				<div class="featured_slider">
					<div class="carouselslider featured_posts items4" >
						<ul class="item_list">
						'.do_shortcode($content).'
						</ul>                        
					</div>
					<div class="clear"></div>
				</div>
			</div>
			<div class="container">
				<center>'.do_shortcode($bottom_content).'</center>
				<div class="twitter_line"></div>
			</div>
		</div>
</div>';
return $homepage_block_display;
}
add_shortcode( 'homepage_block', 'shortcode_homepage_block' );
//[hompage_block_item img="" block_title="" learmore_link=""]
function shortcode_hompage_block_item( $atts,$content=null ) {
	extract( shortcode_atts( array(
		"img"=>$img,
		"block_title"=>$block_title,
		"learmore_link"=>$learmore_link
		
	), $atts ) ); 
	$hompage_block_item_display = '<li>
		<div class="item">
			<div class="img_block wrapped_img"><img src="'.$img.'"  alt=""><div class="carousel_fadder"></div></div>
			<div class="carousel_body">
				<div>
					<br/><h6 align="center">'.$block_title.'</h6>
				</div>
				<div class="carousel_desc">	                                                                
					<div class="exc">'.$content;if($learmore_link != '' ){ $hompage_block_item_display .= '<a href="'.$learmore_link.'"> Learn more... </a>'; } $hompage_block_item_display .= '</div>
				</div>
			</div>
		</div>
    </li> ';    
	return $hompage_block_item_display;
}
add_shortcode( 'hompage_block_item', 'shortcode_hompage_block_item' );
