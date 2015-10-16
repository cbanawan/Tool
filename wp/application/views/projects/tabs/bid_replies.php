<?php if(isset($bid_detail) && $bid_detail != '') { 
$CI = & get_instance();
$CI->load->model('mdl_company');
?>
<div class="portlet-body">
	<div class="table-responsive">
		<div>
			<ul class="nav navbar-nav">
			<li class="dropdown"><a href="#" data-toggle="dropdown" class="dropdown-toggle top-nav-right">Filter For Bid<b class="caret"></b></a>
				<ul class="dropdown-menu">
					<li><a href="javascript:void(0);" id="all_check_bid_replies" >All</a></li>
					<li><a href="javascript:void(0);" id="none_check_bid_replies" >None</a></li>
					<li><a href="javascript:void(0);" id="read_check_bid_replies_<?php echo $project_id;?>" >Read</a></li>
					<li><a href="javascript:void(0);" id="unread_check_bid_replies_<?php echo $project_id;?>" >Unread</a></li>
					<li class="divider"></li>
					<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;Vendor</strong></li>
					<?php foreach($bid_detail as $bid_val) {  ?>
					<li><a href="javascript:void(0);" id="parnter_check_bid_replies_<?php echo $bid_val->partner_id;?>_<?php echo $project_id;?>" ><?php echo $bid_val->company_name; ?></a></li>
					<?php } ?>
					<li class="divider"></li>
					<li><strong>&nbsp;&nbsp;&nbsp;&nbsp;Segments</strong></li>
					<?php foreach($bid_detail as $bid_val) { 
$segment_delete = $CI->mdl_project->check_project_country_delete($bid_val->project_country_id);					?>
					
					<li><a href="javascript:void(0);" id="segment_check_bid_replies_<?php echo $bid_val->project_country_id;?>_<?php echo $project_id;?>"><?php echo $this->common_function->get_segment_format($bid_val->country_name, $project_segments[$bid_val->project_segments], $bid_val->segment_name,$bid_val->bid_status ,$segment_delete->is_delete);?></a></li>
					<?php }?>
				</ul>
			</li>
		</ul>	
		</div>
		<table class="table table-striped table-bordered table-advance table-hover">
			<thead>
				<tr>
					<th style="width:5px;">&nbsp;</th>
					<th>Partner</th>
					<th>Segment Name</th>
					<th>Date</th>
					<th>CPC</th>
					<th>Ncomplete</th>
					<th>Estimated Cost</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
	<?php foreach($bid_detail as $bid_val) { 
		$css_class = '';
		$main_class = '';
								
		$sub_bid_detail = $CI->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->partner_id,$bid_val->project_country_id);
		$chk_accept_btn = $CI->mdl_project->check_accept_bid_from_vendor($this->session->userdata('company_id'), $bid_val->project_id, $bid_val->project_country_id, $bid_val->partner_id);
		
		$segment_delete = $CI->mdl_project->check_project_country_delete($bid_val->project_country_id);?>
			<tr id="bidtr_<?php echo $bid_val->bid_id?>">
				<td><input type="checkbox" class="checkbox1 <?php if($bid_val->bid_status != 3 && $segment_delete->is_delete != 1 && $chk_accept_btn != 0) { ?> accept_check_box<?php }?>" value="<?php echo $bid_val->bid_id?>" id="bidchk_<?php echo $bid_val->bid_id?>"  /></td>
				<td><?php echo $bid_val->company_name; ?></td>
				<td><?php echo $this->common_function->get_segment_format($bid_val->country_name, $project_segments[$bid_val->project_segments], $bid_val->segment_name,$bid_val->bid_status ,$segment_delete->is_delete);?></td>
				<td><?php echo $bid_val->bid_createddate; ?></td>
				<td><?php echo $bid_val->project_cpc; ?></td>
				<td><?php echo $bid_val->project_ncomplete; ?></td>
				<td><?php echo intVal($this->common_function->display_estimate_cost($bid_val->project_cpc, $bid_val->project_ncomplete, $bid_val->project_setup_cost, $bid_val->project_management_fee)); ?></td>
				<td><a href="javascript:void(0);" class="btn purple" id="btn_seedetail_<?php echo $bid_val->project_id; ?>_<?php echo $bid_val->bid_id; ?>_<?php echo $bid_val->project_country_id;?>" >See Detail</a><?php if($bid_val->bid_status != 3 && $segment_delete->is_delete != 1 && $chk_accept_btn != 0) { ?> &nbsp;&nbsp;<a href="javascript:void(0)" class="btn green" id="accept_bid_<?php echo $bid_val->bid_id; ?>">Accept</a><?php } ?></td>
			</tr>
			<tr style="display:none;" id="detail_container_<?php echo $bid_val->project_id; ?>_<?php echo $bid_val->bid_id; ?>" class="detail_container">
				<td colspan="8"><div class="clearfix">&nbsp;</div><br /><div id="detail_<?php echo $bid_val->project_id; ?>_<?php echo $bid_val->bid_id; ?>"><?php if($bid_val->bid_status != 3 && $segment_delete->is_delete != 1)  { ?> <div class="pull-right clearfix"><a href="javascript:void(0)" class="btn blue" id="add_bid_details_<?php echo $bid_val->bid_id; ?>">Reply</a>&nbsp;&nbsp;</div><div class="clearfix"></div> <?php } ?>
				<?php 
					echo '<div id="add_bid_container_'.$bid_val->bid_id.'" style="display:none;"><form name="send_bid" action="'.base_url('projects/send_bid').'" method="post"><input type="hidden" class="form-control" id="project_id" name="project_id" value="'.$bid_val->project_id.'"  /><input type="hidden" class="form-control" id="project_country_id" name="project_country_id" value="'.$bid_val->project_country_id.'"  />
					<input type="hidden" class="form-control" id="partner_id" name="partner_id" value="'.$bid_val->partner_id.'"  />
					<input type="hidden" class="form-control" id="bid_status" name="bid_status" value="1"  />
					<input type="hidden" class="form-control" id="is_read" name="is_read" value="0"  />
					
					<input type="hidden" class="form-control" id="researcher_id" name="researcher_id" value="'.$this->session->userdata('company_id').'"  />
					<input type="hidden" class="form-control" id="researcher_user_id" name="researcher_user_id" value="'.$this->session->userdata('user_id').'"  />
					<div class="col-md-2">'.$this->common_function->get_segment_format($bid_val->country_name, $project_segments[$bid_val->project_segments], $bid_val->segment_name,$bid_val->bid_status ,'').'</div>' ;
					echo '<div class="col-md-2"><strong>CPC</strong><input type="text" class="form-control input-small" name="search_prj_cpc" placeholder="CPC" id="search_prj_cpc_'.$bid_val->project_country_id.'_'.$bid_val->partner_id.'" value="'.$bid_val->project_cpc.'"  /><br /><label><input type="checkbox" name="search_prj_hide_cpc" value="1">Hide CPC</label></div>' ;
					echo '<div class="col-md-2"><strong>N Complete</strong><input type="text" class="form-control input-small" name="search_prj_ncomplete" placeholder="NComplete" id="search_prj_ncomplete_'.$bid_val->project_country_id.'_'.$bid_val->partner_id.'" value="'.$bid_val->project_ncomplete.'"  /></div>' ;
					echo '<div class="col-md-2" ><strong>Estimated Cost</strong><br /><span id="estimated_cost_'.$bid_val->project_country_id.'_'.$bid_val->partner_id.'">'.$bid_val->project_cpc * $bid_val->project_ncomplete.'</span></div><div class="col-md-3"><textarea class="form-control" name="search_prj_comment" 
					placeholder="Comment" id="search_prj_comment_'.$bid_val->project_country_id.'" style="height:34px;"></textarea></div>' ;
					echo '<div class="col-md-1"><input class="btn green" value="Send" type="submit" /></div></form></div>'; ?>
					<div class="clearfix"></div>
					<ul class="chats">
					<?php foreach($sub_bid_detail as $sub_bid) { 
					
						if($sub_bid->bid_type == '1') { 
							$li_class= 'in';
							$bid_user_name = $CI->user_modal->get_user($sub_bid->researcher_user_id);
							$company_detail = $CI->mdl_company->get_company_detail($sub_bid->researcher_id);
							$bid_company_name = $company_detail['company_name'];
							$other_cost = '';
						} else { 
							$li_class= 'out';
							$bid_user_name = $CI->user_modal->get_user($sub_bid->partner_user_id);
							$company_detail = $CI->mdl_company->get_company_detail($sub_bid->partner_id);
							$bid_company_name = $company_detail['company_name'];
							$other_cost = '&nbsp;|&nbsp;Setup cost : '.$sub_bid->project_setup_cost.'&nbsp;|&nbsp;Min. project cost : '.$sub_bid->project_management_fee;
						}
						$segment_delete = $CI->mdl_project->check_project_country_delete($sub_bid->project_country_id);						?>
						<li class="<?php echo $li_class;?>" >
							<div class="message" style="<?php if($sub_bid->is_read == 0){ echo 'font-weight:bold;';} ?>">
								<span class="arrow"></span>
								<a href="javascript:void(0);" class="name" style="<?php if($sub_bid->is_read == 0){ echo 'font-weight:bold;';} ?>"><?php echo $bid_user_name['user_name'].' @ '.$bid_company_name;?></a>
								<span class="datetime" style="<?php if($sub_bid->is_read == 0){ echo 'font-weight:bold;';} ?>">at <?php echo $sub_bid->bid_createddate;?></span>
								<span class="body" style="padding-top:5px;"><?php echo $this->common_function->get_segment_format($sub_bid->country_name, $project_segments[$sub_bid->project_segments], $sub_bid->segment_name,$sub_bid->bid_status ,$segment_delete->is_delete);?>&nbsp;&nbsp;CPC : <?php if($sub_bid->hide_cpc == 0) { echo $sub_bid->project_cpc; } else { echo '-';}?>&nbsp;|&nbsp;N Complete : <?php echo $sub_bid->project_ncomplete;?>&nbsp;|&nbsp;Estimated Cost : <?php if($sub_bid->hide_cpc == 0) { echo intVal($this->common_function->display_estimate_cost($sub_bid->project_cpc, $sub_bid->project_ncomplete, $sub_bid->project_setup_cost, $sub_bid->project_management_fee)) ; } else { echo 'NA'; } echo $other_cost;?><br /><?php echo $sub_bid->bid_comments;?></span>
							</div>
						</li>
						<?php } ?>
					</ul>
					
				</div>
				</td>
			</tr>
	<?php	} ?>
		</tbody>
		<tfoot>
				<tr>
					<th style="width:5px;">&nbsp;</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th>&nbsp;</th>
					<th><span id="cpc_everage"></span></th>
					<th><span id="ncomplete_total"></span></th>
					<th><span id="estimated_total"></span></th>
					<th ><a href="javascript:void(0)" class="btn green" id="accept_bid_all">Accept</a></th>
				</tr>
			</tfoot>
	</table>
	</div>
	</div>
<?php }?>
