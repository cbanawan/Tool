<!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) & !(IE 8)]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<title>Pangea Panel</title>
	<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon">
	<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/img/favicon.ico" type="image/x-icon">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
	<![endif]--><link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/apple_icons_57x57.png">
    <link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/img/apple_icons_72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/img/apple_icons_114x114.png">
    <link href='<?php echo get_template_directory_uri(); ?>/theme-css/fonts/css.css' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-css/bootstrap-responsive.css">    
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-css/plugins.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-css/theme.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-css/responsive.css">
    <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-css/theme_settings.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-css/rs-settings.css">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-css/color_theme.css" id="theme_color">
	<link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-css/panel-style.css">
	<!--[if IE 8 ]><link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/theme-css/color_theme.css" id="theme_color"><![endif]-->
                <script>       

                (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){

                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),

                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)

                })(window,document,'script','//www.google-analytics.com/analytics.js','ga');



                ga('create', 'UA-53265438-1', 'auto'); 

                ga('require', 'displayfeatures');

                ga('send', 'pageview');
        </script>
        
    <!--[if IE 8 ]><script>
        var e = ("article,aside,figcaption,figure,footer,header,hgroup,nav,section,time").split(',');
        for (var i = 0; i < e.length; i++) {
            document.createElement(e[i]);
        }		
    </script><![endif]-->
	<script src="<?php echo get_template_directory_uri(); ?>/theme-js/jquery-1.9.1.js"></script>
	<!--<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/theme-js/color_panel.js" ></script>-->
	<?php //wp_head(); ?>
</head>

<body >
<header>
		<div class="header_wrapper container">
        	<a href="http://<?php echo $_SERVER['SERVER_NAME'];?>" class="logo"><img src="<?php echo get_template_directory_uri(); ?>/img/logo.png" alt=""/></a>			
<nav><?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'menu' ) ); ?>
            <div class="clear"></div>
            </nav>
            
            <div class="head_search">
                <form class="search_form" method="get" name="search_form">
                    <input type="text" class="field_search" title="Search..." value="Search..." name="s">
                </form>
            </div>
            
        </div>
    </header>
    <?php // _e( 'Primary Menu', 'twentyfourteen' ); ?>
    <div class="main_wrapper">
        <!-- C O N T E N T -->
        <div class="content_wrapper">
