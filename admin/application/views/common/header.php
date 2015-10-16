<!-- BEGIN HEADER -->
<div class="header navbar navbar-inverse navbar-fixed-top">
    <!-- BEGIN TOP NAVIGATION BAR -->
    <div class="header-inner">
        <!-- BEGIN LOGO -->
        <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url().IMAGES;  ?>logo.png" alt="logo" class="img-responsive"/>
        </a>
        <!-- END LOGO -->
        <!-- BEGIN RESPONSIVE MENU TOGGLER -->
        <a href="javascript:;" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <img src="<?php echo base_url().IMAGES;  ?>menu-toggler.png" alt=""/>
        </a>
        <!-- END RESPONSIVE MENU TOGGLER -->
        <!-- BEGIN TOP NAVIGATION MENU -->
        <ul class="nav navbar-nav pull-right">                      
            <!-- BEGIN USER LOGIN DROPDOWN -->
            <li class="dropdown user">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                    <?php $pic = ($this->session->userdata('profile_pic') == "") ? IMAGES."avatar-blank.png" : 'uploads/'.$this->session->userdata('user_id')."/".$this->session->userdata('profile_pic'); ?>
                    <img alt="" src="<?php echo base_url().$pic;  ?>" height="29" width="29" />
                    <span class="username">
                        <?php echo $this->session->userdata('user_name'); ?>
                    </span>
                    <i class="fa fa-angle-down"></i>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="<?php echo base_url('users/profile');?>"><i class="fa fa-user"></i> My Profile</a>
                    </li>
<!--                    <li>
                        <a href="page_calendar.html"><i class="fa fa-calendar"></i> My Calendar</a>
                    </li>
                    <li>
                        <a href="inbox.html"><i class="fa fa-envelope"></i> My Inbox
                            <span class="badge badge-danger">
                                3
                            </span>
                        </a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-tasks"></i> My Tasks
                            <span class="badge badge-success">
                                7
                            </span>
                        </a>
                    </li>
                    <li class="divider">
                    </li>
                    <li>
                        <a href="javascript:;" id="trigger_fullscreen"><i class="fa fa-move"></i> Full Screen</a>
                    </li>
                    <li>
                        <a href="extra_lock.html"><i class="fa fa-lock"></i> Lock Screen</a>
                    </li>-->
                    <li>
                        <a href="<?php echo base_url('login/logout');?>"><i class="fa fa-key"></i> Log Out</a>
                    </li>
                </ul>
            </li>
            <!-- END USER LOGIN DROPDOWN -->
        </ul>
        <!-- END TOP NAVIGATION MENU -->
    </div>
    <!-- END TOP NAVIGATION BAR -->
</div>
<!-- END HEADER -->
<div class="clearfix">
</div>
