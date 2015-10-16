<!-- BEGIN SIDEBAR --> 
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu">
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler hidden-phone">
                </div>
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
            </li>		
            <li class="start active " id="dashboard_menu">
                <a href="<?php echo base_url(); ?>">
                    <i class="fa fa-dashboard"></i>
                    <span class="title">
                        Dashboard
                    </span>
                    <span class="selected">
                    </span>
                </a>
            </li>
            <?php if ($this->session->userdata('company_type') != 2) { ?>
                <li class="" id="projects">
                    <a href="<?php echo base_url(); ?>projects">
                        <i class="fa fa-folder-open"></i>
                        <span class="title">
                            Manage Project
                        </span>
                    </a>
                </li><li class="" id="rewards">
                    <a href="<?php echo base_url(); ?>rewards">
                        <i class="fa fa-usd"></i>
                        <span class="title">
                            Rewards
                        </span>
                    </a>
                </li>
            <?php } if ($this->session->userdata('company_type') != 1) { ?>
                <li class="" id="bids">
                    <a href="javascript:void(0)">
                        <i class="fa fa-gavel"></i>
                        <span class="title">
                            Manage Bids
                        </span>
                        <span class="arrow">
                        </span>
                    </a>
                    <ul class="sub-menu">
                        <li id="fresh_bid"><a href="<?php echo base_url(); ?>bids/fresh_bids">Fresh Bids</a></li>
                        <li id="conversation"><a href="<?php echo base_url(); ?>bids/conversation">Conversation</a></li>
                        <li id="won_project"><a href="<?php echo base_url(); ?>bids/won_projects">Won Projects</a></li>
                        <li id="close_project"><a href="<?php echo base_url(); ?>bids/close_projects">Closing Details</a></li>
                    </ul>
                </li>
                <li class="" id="manage_projects">
                    <a href="<?php echo base_url(); ?>bids/manage_projects">
                        <i class="fa fa-folder-open"></i>
                        <span class="title">
                            Manage Project
                        </span>
                    </a>
                </li>	
				<li class="" id="invoices">
                    <a href="<?php echo base_url(); ?>invoices_partner">
                        <i class="fa fa-file"></i>
                        <span class="title">
                            Invoices
                        </span>
                        <span class="arrow">
                        </span>
                    </a>
				</li>
            <?php } ?>
            <li class="" id="company_profile">
                <a href="<?php echo base_url(); ?>company/profile">
                    <i class="fa fa-briefcase"></i>
                    <span class="title">
                        Company Profile
                    </span>
                </a>
            </li>
	    <?php if ($this->session->userdata('user_type') == 1) { ?>	
                <li class="" id="user_menu">
                    <a href="<?php echo base_url(); ?>users">
                        <i class="fa fa-user"></i>
                        <span class="title">
                            Users
                        </span>
                        <span class="selected">
                        </span>
                    </a>
                </li>
            <?php }   if ($this->session->userdata('user_type') == 0) {?>
            <li class="" id="email-template">
                <a href="<?php echo base_url(); ?>email_template">
                    <i class="fa fa-envelope"></i>
                    <span class="title">
                        Email Template
                    </span>
                </a>
            </li>          
            <?php } ?>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->
