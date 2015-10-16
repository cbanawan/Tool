<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat blue">
            <div class="visual">
                <i class="fa fa-dollar"></i>
            </div>
            <div class="details">
                <div class="number">
                    149
                </div>
                <div class="desc">
                    Revenue
                </div>
            </div>
            <a class="more" href="#">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat green">
            <div class="visual">
                <i class="fa fa-bar-chart-o"></i>
            </div>
            <div class="details">
                <div class="number">
                    125
                </div>
                <div class="desc">
                    Won Projects
                </div>
            </div>
            <a class="more" href="#">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>

    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat purple">
            <div class="visual">
                <i class="fa fa-globe"></i>
            </div>
            <div class="details">
                <div class="number">
                    549
                </div>
                <div class="desc">
                    Clients Served
                </div>
            </div>
            <a class="more" href="#">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>

    </div>
    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
        <div class="dashboard-stat red">
            <div class="visual">
                <i class="fa fa-bell"></i>
            </div>
            <div class="details">
                <div class="number">
                    89
                </div>
                <div class="desc">
                    Pending Tasks
                </div>
            </div>
            <a class="more" href="#">
                View more <i class="m-icon-swapright m-icon-white"></i>
            </a>
        </div>
    </div>
</div>
<!-- END DASHBOARD STATS -->
<div class="clearfix"></div>
<!-- First Row -->
<div class="row ">
    <div class="col-md-6 col-sm-6">
        <div class="portlet box blue">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bell-o"></i>Awaiting Bid Reply
                </div>
            </div>
            <div class="portlet-body">
                <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">

                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th>
                                    Project
                                </th>
                                <th>
                                    Segment
                                </th>
                                <th class="numeric">
                                    CPC
                                </th>
                                <th class="numeric">
                                    Ncomplete
                                </th>
                                <th class="numeric">
                                    Est. cost
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($awaiting_bid) {
                                foreach ($awaiting_bid as $abid) {
                                    ?>
                                    <tr>
                                        <td>
        <?php echo $abid->project_name; ?>
                                        </td>
                                        <td>
                                            <?php
                                            $cname = $this->common_function->in_array_field($abid->country_id, 'country_id', $country, false);
                                            echo $cname->country_name . ' ' . $project_segments[$abid->project_segments] . ' (' . $abid->segment_name . ')';
                                            ?>
                                        </td>
                                        <td class="numeric">
        <?php echo $abid->project_cpc; ?>
                                        </td>
                                        <td class="numeric">
        <?php echo $abid->project_ncomplete; ?>
                                        </td>
                                        <td class="numeric">
        <?php echo $abid->project_cpc * $abid->project_ncomplete; ?>
                                        </td>
                                    </tr>
                            <?php } }else{?>
                                    <tr>
                                        <td colspan="5" align="center"> No bid available </td>
                                    </tr>
                            <?php } ?>
                            </tbody>
                        </table>
                </div>		
                <div class="scroller-footer">

                </div>
            </div>
        </div>
    </div>


    <div class="col-md-6 col-sm-6">
        <div class="portlet box green ">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-bell-o"></i>Won Projects
                </div>
            </div>
            <div class="portlet-body">
                <div class="scroller" style="height: 300px;" data-always-visible="1" data-rail-visible="0">
                    <table class="table table-bordered table-striped table-condensed flip-content">
                        <thead class="flip-content">
                            <tr>
                                <th>
                                    ID
                                </th>
                                <th>
                                    Name
                                </th>
                                <th class="numeric">
                                    Date
                                </th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if ($win_projects_detail) {
                                foreach ($win_projects_detail as $win_projects) {
                                    ?>
                                    <tr>
                                        <td>
        <?php echo $win_projects->project_id; ?>
                                        </td>
                                        <td>
        <?php echo $win_projects->project_name; ?>
                                        </td>
                                        <td>
        <?php echo $win_projects->project_modifieddate; ?>
                                        </td>

                                    </tr>
                                    <?php
                                }
                            } else {
                                echo '<tr><td colspan="3" align="center"> No projects available</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>		
                <div class="scroller-footer">

                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<!-- EOF Second Row -->
<div class="clearfix"></div>
<div class="row ">
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet box blue calendar">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-calendar"></i>Calendar
                </div>
            </div>
            <div class="portlet-body light-grey">
                <div id="calendar">
                </div>
            </div>
        </div>
        <!-- END PORTLET-->
    </div>
    <div class="col-md-6 col-sm-6">
        <!-- BEGIN PORTLET-->
        <div class="portlet paddingless">
            <div class="portlet-title line">
                <div class="caption"><i class="fa fa-bell-o"></i>Recent Activity</div>
                <div class="tools">	
                    <a href="" class="collapse"></a>
                    <a href="#portlet-config" data-toggle="modal" class="config"></a>
                    <a href="" class="reload"></a>
                    <a href="" class="remove"></a>
                </div>
            </div>
            <div class="portlet-body">
                <!--BEGIN TABS-->
                <div class="tabbable tabbable-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1_1" data-toggle="tab">System</a></li>
                        <li><a href="#tab_1_2" data-toggle="tab">Activities</a></li>
                        <li><a href="#tab_1_3" data-toggle="tab">Recent Users</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_1_1">
                            <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-success">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        You have 4 pending tasks.<span class="label label-sm label-danger ">Take action <i class="fa fa-share"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date">Just now</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab_1_2">
                            <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-success">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        You have 4 pending tasks.<span class="label label-sm label-danger ">Take action <i class="fa fa-share"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date">Just now</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="tab-pane " id="tab_1_3">
                            <div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible="0">
                                <ul class="feeds">
                                    <li>
                                        <div class="col1">
                                            <div class="cont">
                                                <div class="cont-col1">
                                                    <div class="label label-sm label-success">
                                                        <i class="fa fa-bell-o"></i>
                                                    </div>
                                                </div>
                                                <div class="cont-col2">
                                                    <div class="desc">
                                                        You have 4 pending tasks.<span class="label label-sm label-danger ">Take action <i class="fa fa-share"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col2">
                                            <div class="date">Just now</div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END TABS-->
            </div>
        </div>
        <!-- END PORTLET-->
        <div class="clearfix"></div>
    </div>
    <div class="clearfix"></div>
</div>
<script>$(document).ready(function () {
        $('#calendar').fullCalendar({//re-initialize the calendar
            disableDragging: false,
            editable: true
        });
    });</script>