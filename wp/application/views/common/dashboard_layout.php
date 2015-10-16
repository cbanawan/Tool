<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8"/>
        <title>Pangea Panel</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
		<link rel="shortcut icon" href="http://pangeapanel.com/wp-content/themes/panel-theme/img/favicon.ico" type="image/x-icon">

        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="<?php echo base_url(); ?>font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . CSS; ?>bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . JS; ?>bootstrap-toastr/toastr.css" rel="stylesheet" type="text/css" />
         <link href="<?php echo base_url() . CSS; ?>profile.css" rel="stylesheet" type="text/css"/>
        <?php
        if (isset($cssFiles) && !empty($cssFiles)) {
            foreach ($cssFiles as $css) {
                ?>
                <link href="<?php echo base_url() . $css; ?>" rel="stylesheet" type="text/css"/>                
                <?php
            }
        }
        ?>
        <!-- BEGIN THEME STYLES -->
        <link href="<?php echo base_url() . CSS; ?>style-metronic.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . CSS; ?>style.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . CSS; ?>style-responsive.css" rel="stylesheet" type="text/css"/>
        <link href="<?php echo base_url() . CSS; ?>plugins.css" rel="stylesheet" type="text/css"/>                        
        <link href="<?php echo base_url() . CSS; ?>themes/default.css" rel="stylesheet" type="text/css" id="style_color"/>
        <link rel="stylesheet" href="<?php echo base_url() . JS; ?>data-tables/DT_bootstrap.css"/>        
        <link href="<?php echo base_url() . CSS; ?>custom.css" rel="stylesheet" type="text/css"/>
		 <script src="<?php echo base_url() . JS; ?>jquery-1.10.2.min.js" type="text/javascript"></script>
        <!-- END THEME STYLES -->
        <link rel="shortcut icon" href="favicon.ico"/>
        
                <script>
                    var base_url = '<?php echo base_url(); ?>';
                </script>
                    
    </head>
    <body class="page-header-fixed">
	<div class="new_throber_div" style="display:none;"></div>
        {header}
        <!-- BEGIN CONTAINER -->
        <div class="page-container">
            {sidebar}
            <!-- BEGIN CONTENT -->
            <div class="page-content-wrapper">                
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN PAGE TITLE & BREADCRUMB-->
                            <h3 class="page-title">
                                <?php echo (isset($header_text)) ? $header_text : ""; ?>
                            </h3>
                            <ul class="page-breadcrumb breadcrumb">
                                
								<li class="pull-right">
                                                                    
						            <div class="dashboard-date-range "  style="display: block;">
										<i class="fa fa-calendar"></i>
										<span><?php echo date('F d, Y');?></span>
									</div>
								</li>
                                <?php if($this->session->userdata('company_type') != 2) { ?><li class="btn-group" style="padding-right:125px;"><a class="btn green" href="<?php echo base_url('projects/add_project');?>" style="color:#fff;">Create Bid</a></li> <?php } ?>
                                <?php echo (isset($breadcrumb_view)) ? $breadcrumb_view : ""; ?>
                            </ul>
                            <!-- END PAGE TITLE & BREADCRUMB-->
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->
                    <div class="row">
                        <div class="col-md-12">
							{content}                            
                        </div>			
                    </div>
                </div>
            </div>
            <!-- END CONTENT -->
        </div>
        <!-- END CONTAINER -->
        {footer}
        
        <script src="<?php echo base_url() . JS; ?>jquery-migrate-1.2.1.min.js" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui-1.10.3.custom.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="<?php echo base_url() . JS; ?>jquery-ui/jquery-ui-1.10.3.custom.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() . JS; ?>bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() . JS; ?>uniform/jquery.uniform.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() . JS; ?>jquery.cokie.min.js" type="text/javascript"></script>
        <script src="<?php echo base_url() . JS; ?>bootstrap-toastr/toastr.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . JS; ?>data-tables/jquery.dataTables.min.js"></script>        
        <script type="text/javascript" src="<?php echo base_url() . JS; ?>data-tables/DT_bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url() . JS; ?>data-tables/datatable_api.js"></script>        
		<script type="text/javascript">
                    $(document).ready(function(){
						var body = $('body');
						body.addClass("page-sidebar-closed");
						$.cookie('sidebar_closed', '1');
						jQuery('.tooltip').tooltip();
	
                       var smsg = '<?php echo (isset($success_msg))? $success_msg:""; ?>';
                       var emsg = '<?php echo (isset($failure_msg))? $failure_msg:""; ?>';
                       if(smsg != ""){
                           set_toastr("",smsg,"success");
                       }
                       if(emsg != ""){
                           set_toastr("",emsg,"error");
                       }
                    });
                </script>
        
        <script src="<?php echo base_url() . JS; ?>app.js" type="text/javascript"></script>
        <script type="text/javascript" src="<?php echo base_url() . JS; ?>common.js"></script>        
        <?php
        if (isset($jsFiles) && !empty($jsFiles)) {
            foreach ($jsFiles as $js) {
                ?>
                <script src="<?php echo base_url() .  $js; ?>"></script>
                <?php
            }
        }
        ?>
		
                
          </body>
</html>
