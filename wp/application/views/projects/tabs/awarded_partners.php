<?php if(isset($bid_detail) && $bid_detail != '') { 
$CI = & get_instance();
$CI->load->model('mdl_company');
?>
<div class="portlet-body">
	<div class="table-responsive">
		<table class="table table-striped table-bordered table-advance table-hover">
			<thead>
				<tr>
					
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
		$segment_delete = $CI->mdl_project->check_project_country_delete($bid_val->project_country_id);?>
			<tr >
				<td><?php echo $bid_val->company_name; ?></td>
				<td><?php echo $this->common_function->get_segment_format($bid_val->country_name, $project_segments[$bid_val->project_segments], $bid_val->segment_name,$bid_val->bid_status ,$segment_delete->is_delete);?></td>
				<td><?php echo $bid_val->bid_createddate; ?></td>
				<td><?php echo $bid_val->project_cpc; ?></td>
				<td><?php echo $bid_val->project_ncomplete; ?></td>
				<td><?php echo intVal($this->common_function->display_estimate_cost($bid_val->project_cpc, $bid_val->project_ncomplete, $bid_val->project_setup_cost, $bid_val->project_management_fee)); ?></td>
				<td><a href="javascript:void(0);" class="btn purple" id="btn_awd_seedetail_<?php echo $bid_val->project_id; ?>_<?php echo $bid_val->bid_id; ?>_<?php echo $bid_val->project_country_id;?>" >See Detail</a></td>
			</tr>
			<tr style="display:none;" id="awd_detail_container_<?php echo $bid_val->project_id; ?>_<?php echo $bid_val->bid_id; ?>" class="awd_detail_container">
				<td colspan="7"><div id="awd_detail_<?php echo $bid_val->project_id; ?>_<?php echo $bid_val->bid_id; ?>"><div class="clearfix"></div> 
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
								<span class="body" style="padding-top:5px;"><?php echo $this->common_function->get_segment_format($sub_bid->country_name, $project_segments[$sub_bid->project_segments], $sub_bid->segment_name,$sub_bid->bid_status ,$segment_delete->is_delete);?>&nbsp;&nbsp;CPC : <?php if($sub_bid->hide_cpc == 0) { echo $sub_bid->project_cpc; } else { echo '-';}?>&nbsp;|&nbsp;N Complete : <?php echo $sub_bid->project_ncomplete;?>&nbsp;|&nbsp;Estimated Cost : <?php if($sub_bid->hide_cpc == 0) { echo intVal($this->common_function->display_estimate_cost($sub_bid->project_cpc, $sub_bid->project_ncomplete, $sub_bid->project_setup_cost, $sub_bid->project_management_fee)); } else { echo 'NA'; } echo $other_cost; ?><br /><?php echo $sub_bid->bid_comments;?></span>
							</div>
						</li>
						<?php } ?>
					</ul>
					
				</div>
				</td>
			</tr>
	<?php	} ?>
		</tbody>
		
	</table>
	</div>
	</div>
<?php }?>
