<div class="row">
	<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
		<div class="dashboard-stat blue">
			<div class="visual">
				<i class="fa fa-dollar"></i>
			</div>
			<div class="details">
				<div class="number">
					<?php if($resercher_rewards) { echo $resercher_rewards['total_rewards']; } else { echo '0';}?>
				</div>
				<div class="desc">
					 Researcher Rewards
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
					<?php echo $count_completed_bid;?>
				</div>
				<div class="desc">
					Completed Bids
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
					<?php echo $count_panalist['cnt'];?>
				</div>
				<div class="desc">
					Pangea Panel Panelists
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
					<?php echo $awaiting_bid_count;?>
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
					<i class="fa fa-bell-o"></i>Begun Bids
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
							<?php foreach($begun_bid_detail as $begun_bid) { ?>
							<tr>
								<td>
									<a href="<?php echo base_url('projects/edit_project/' . $begun_bid->project_long_key);?>"><?php echo $begun_bid->project_name;?></a>
								</td>
								<td>
									<?php $cname = $this->common_function->in_array_field($begun_bid->country_id, 'country_id', $country, false); 
									echo $cname->country_name.' '.$project_segments[$begun_bid->project_segments].' ('.$begun_bid->segment_name.')';?>
								</td>
								<td class="numeric">
									<?php echo $begun_bid->project_cpc;?>
								</td>
								<td class="numeric">
									<?php echo $begun_bid->project_ncomplete;?>
								</td>
								<td class="numeric">
									<?php echo $begun_bid->project_cpc * $begun_bid->project_ncomplete;?>
								</td>
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
		<div class="portlet box red ">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-bell-o"></i>Awaiting Return
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
							<?php foreach($awaiting_bid_detail as $awaiting_bid) { ?>
							<tr>
								<td>
									<a href="<?php echo base_url('projects/edit_project/' . $awaiting_bid->project_long_key);?>"><?php echo $awaiting_bid->project_name;?></a>
								</td>
								<td>
									<?php $cname = $this->common_function->in_array_field($awaiting_bid->country_id, 'country_id', $country, false); 
									echo $this->common_function->get_segment_format($cname->country_name, $project_segments[$awaiting_bid->project_segments], $awaiting_bid->segment_name, $awaiting_bid->bid_status, $awaiting_bid->is_delete)
									
									?>
								</td>
								<td class="numeric">
									<?php if($awaiting_bid->hide_cpc == 0) { echo $awaiting_bid->project_cpc;} else { echo "hidden";}?>
								</td>
								<td class="numeric">
									<?php echo $awaiting_bid->project_ncomplete;?>
								</td>
								<td class="numeric">
									<?php if($awaiting_bid->hide_cpc == 0) { echo $awaiting_bid->project_cpc * $awaiting_bid->project_ncomplete; } else { echo "NA"; }?>
								</td>
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
	<div class="clearfix"></div>
</div>
<!-- EOF First Row -->
<div class="clearfix"></div>
<!-- Second Row -->
<div class="row ">
	<div class="col-md-6 col-sm-6">
		<div class="portlet box purple">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-bell-o"></i>Pending Win
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
							<?php if($pending_win_bid_detail) {
							foreach($pending_win_bid_detail as $pending_win_bid) { ?>
							<tr>
								<td>
									<a href="<?php echo base_url('projects/edit_project/' . $pending_win_bid->project_long_key);?>"><?php echo $pending_win_bid->project_name;?></a>
								</td>
								<td>
									<?php $cname = $this->common_function->in_array_field($pending_win_bid->country_id, 'country_id', $country, false); 
									echo $this->common_function->get_segment_format($cname->country_name, $project_segments[$pending_win_bid->project_segments], $pending_win_bid->segment_name, $pending_win_bid->bid_status, $pending_win_bid->is_delete)
									
									?>
								</td>
								<td class="numeric">
									<?php if($pending_win_bid->hide_cpc == 0) { echo $pending_win_bid->project_cpc;} else { echo "hidden";}?>
								</td>
								<td class="numeric">
									<?php echo $pending_win_bid->project_ncomplete;?>
								</td>
								<td class="numeric">
									<?php if($pending_win_bid->hide_cpc == 0) { echo $pending_win_bid->project_cpc * $pending_win_bid->project_ncomplete; } else { echo "NA"; }?>
								</td>
							</tr>
							<?php }
} else {
	echo '<tr><td colspan="5" align="center"> No bid available</td></tr>';
}							?>
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
					<i class="fa fa-bell-o"></i>Win Projects
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
							<?php if($win_projects_detail) {
							foreach($win_projects_detail as $win_projects) { ?>
							<tr>
								<td>
									<?php echo $win_projects->project_id;?>
								</td>
								<td>
									<a href="<?php echo base_url('projects/edit_project/' . $begun_bid->project_long_key);?>"><?php echo $win_projects->project_name;?></a>
								</td>
								<td>
									<?php echo $win_projects->project_modifieddate;?>
								</td>
								
							</tr>
							<?php }
} else {
	echo '<tr><td colspan="3" align="center"> No projects available</td></tr>';
}							?>
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
				<div id="researcher_calendar">
				</div>
			</div>
		</div>
		<!-- END PORTLET-->
	</div>
	<div class="col-md-6 col-sm-6">
	<!-- BEGIN PORTLET-->
		<div class="portlet paddingless">
			<div class="portlet-title line">
				<div class="caption"><i class="fa fa-bell-o"></i>Activity Logs</div>
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
								<?php if($recent_activity_desc) { ?>
								<ul class="feeds">
								<?php foreach($recent_activity_desc as $recent_res) { ?>
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
														<?php $string = $recent_res->activity_description;
														$exp = explode('has',$string);
														echo ucwords($exp[1]);?>
													</div>
												</div>
											</div>
										</div>
										<div class="col2">
											<div class="date"><small><?php echo date('jS, M Y',strtotime($recent_res->activity_time));?></small></div>
										</div>
									</li> <?php } ?>
								</ul> <?php } ?>
							</div>
						</div>
						<div class="tab-pane " id="tab_1_3">
							<div class="scroller" style="height: 290px;" data-always-visible="1" data-rail-visible="0">
							<?php if($recent_users) { 
								$cnt= 0;?>
								<div class="row">
								<?php foreach($recent_users as $recent_user_val) {
									$cnt++;
								?>
									<div class="col-md-6 user-info">
									<?php $pic = ($recent_user_val->profile_pic == "") ? IMAGES . "avatar.png" : 'uploads/' . $recent_user_val->user_id . "/" . $recent_user_val->profile_pic; ?>
										<img alt="" src="<?php echo base_url() . $pic; ?>" class="img-responsive">
										<div class="details">
											<div>
												<a href="#"><?php echo $recent_user_val->user_name;?></a>
												<?php if($recent_user_val->is_active == 1) { ?>
												<span class="label label-sm label-success label-mini">
													Approved
												</span> <?php } else { ?>
												<span class="label label-sm label-info">
																Pending
															</span> <?php } ?>
											</div>
											<div>
											<?php echo date('d, M Y H:i A',strtotime($recent_user_val->user_entry_date));?>	
											</div>
										</div>
									</div>
								<?php  if($cnt == 2) { '</div> <div class="row">'; $cnt=0;}
								} ?>
								</div>
							<?php } ?>
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
<script>$(document).ready(function () {
        $('#researcher_calendar').fullCalendar({ //re-initialize the calendar
                disableDragging: false,
                editable: true                
            });
    });</script>