
<div class="form-body">
    <div class="row">
        <?php
        $checked = "";
        if (isset($close_master_detail) && $close_master_detail != '') {
            $entry_type = 'update';
            $closing_date = date('m/d/Y', strtotime($close_master_detail['project_closing_date']));
            if ($close_master_detail['opt_for_closing'] == 1) {
                $checked = "checked";
            } else {
                $checked = "";
            }
        } else {
            $entry_type = 'insert';
            $closing_date = date('m/d/Y');
            $checked = "";
        }
        ?>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label">Closing Date</label>
                <div class="input-group input-medium date datepicker" data-date-format="mm/dd/yyyy">
                    <input name="closing_date" class="form-control" id="closing_date" size="16" type="text" value="<?php echo $closing_date; ?>" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label class="control-label"><input name="close_project_id" id="close_project_id" type="hidden" value="<?php echo $project_id; ?>" /><input class="" name="opt_for_closing" id="opt_for_closing" type="checkbox" value="1" <?php echo $checked; ?> />&nbsp;&nbsp;This will not gonna go..</label>

            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <button class="btn blue" id="close_project_btn">Close Project</button>
            </div>
        </div>

    </div>
</div>    
<div class="closing-detail-container" style="<?php
if ($close_master_detail != '') {
    if ($close_master_detail['opt_for_closing'] == 1) {
        ?>display:none;<?php } else { ?> display:block;<?php
         }
     } else {
         ?> display:none; <?php } ?>">
     <?php
     if (isset($bid_detail) && $bid_detail != '') {
         $CI = & get_instance();
         $CI->load->model('mdl_company');
         ?>
        <div class="portlet-body">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>

                            <th>Partner</th>
                            <!--<th>Segment Name</th>-->
                            <th>Estimated Cost</th>
                            <th>Cost</th>
                            <th>Performance Rank</th>
                            <th>Cost Rank</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
						
                        foreach ($bid_detail as $bid_val) {
                            $css_class = '';
                            $main_class = '';
							$bid_sub_detail = $this->mdl_project->get_sub_bid_close_partner($project_id,$bid_val->researcher_id,$bid_val->partner_id,$bid_val->project_country_id);
							$final_estimated_cost = $bid_sub_detail->total_estimate;
							
                            $sub_bid_detail = $CI->mdl_project->get_project_sub_close_bid($bid_val->project_id, $bid_val->partner_id);
                            $close_partner_project = $CI->mdl_project->partner_project_close_detail($bid_val->project_id, $bid_val->partner_id);
                            $st_str_display = '';
                            $st_usd_display = '';

                            if (isset($close_partner_project) && $close_partner_project != '') {
                                $detail_entry_type = 'update';
                                $update_detail = '<input type="hidden" name="project_closing_id" value="' . $close_partner_project->project_closing_id . '" id="project_closing_id_' . $bid_val->partner_id . '">';
                                $project_cpc = $close_partner_project->project_cpc;
                                $project_ncomplete = $close_partner_project->project_ncomplete;
                                
                                $project_estimated_cost = $close_partner_project->project_estimated_cost;
                                $researcher_estimated_cost = $close_partner_project->researcher_estimated_cost;
								$partner_rank = $close_partner_project->partner_rank;
								$cost_rank = $close_partner_project->partner_cost_rank;
                                $st_style = '';
                                for ($st_str = 1; $st_str <= 5; $st_str++) {
                                    if ($close_partner_project->partner_rank == 1 && $close_partner_project->partner_rank >= $st_str) {
                                        $st_style = "color:red;";
                                    } else if (($close_partner_project->partner_rank == 2 || $close_partner_project->partner_rank == 3) && $close_partner_project->partner_rank >= $st_str) {
                                        $st_style = "color:#FF8E01;";
                                    } else if (($close_partner_project->partner_rank == 4 || $close_partner_project->partner_rank == 5) && $close_partner_project->partner_rank >= $st_str) {
                                        $st_style = "color:green;";
                                    } else {
                                        $st_style = "";
                                    }
                                    $st_str_display .= '<a href="javascript:void(0);"  id="str_' . $st_str . '_' . $bid_val->partner_id . '"><i class="fa fa-star" style="' . $st_style . '"></i></a>';
                                }
                                $usd_style = '';
                                for ($st_usd = 1; $st_usd <= 5; $st_usd++) {
                                    if (($close_partner_project->partner_cost_rank == 1 || $close_partner_project->partner_cost_rank == 2) && $close_partner_project->partner_cost_rank >= $st_usd) {
                                        $usd_style = "color:green;";
                                    } else if (($close_partner_project->partner_cost_rank == 3) && $close_partner_project->partner_cost_rank >= $st_usd) {
                                        $usd_style = "color:#FF8E01;";
                                    } else if (($close_partner_project->partner_cost_rank == 4 || $close_partner_project->partner_cost_rank == 5) && $close_partner_project->partner_cost_rank >= $st_usd) {
                                        $usd_style = "color:red;";
                                    } else {
                                        $usd_style = "";
                                    }
                                    $st_usd_display .= '<a href="javascript:void(0);"  id="usd_' . $st_usd . '_' . $bid_val->partner_id . '"><i class="fa fa-usd" style="' . $usd_style . '"></i></a>&nbsp;';
                                }
                            } else {
                                $detail_entry_type = 'insert';
                                $update_detail = '<input type="hidden" name="project_closing_id" value="0" id="project_closing_id_' . $bid_val->partner_id . '">';
                                $project_cpc = $bid_val->project_cpc;
                                $project_ncomplete = $bid_val->project_ncomplete;
                                $project_estimated_cost = $final_estimated_cost;
								$partner_rank = 0;
								$cost_rank = 0;
								$researcher_estimated_cost = 0;

                                for ($st_str = 1; $st_str <= 5; $st_str++) {
                                    $st_str_display .= '<a href="javascript:void(0);"  id="str_' . $st_str . '_' . $bid_val->partner_id . '"><i class="fa fa-star"></i></a>&nbsp;';
                                }
                                for ($st_usd = 1; $st_usd <= 5; $st_usd++) {
                                    $st_usd_display .= '<a href="javascript:void(0);"  id="usd_' . $st_usd . '_' . $bid_val->partner_id . '"><i class="fa fa-usd"></i></a>&nbsp;';
                                }
                            }
                            $segment_delete = $CI->mdl_project->check_project_country_delete($bid_val->project_country_id);
                            ?>
                            <tr >
                                <td><?php echo $bid_val->company_name . $update_detail; ?></td>
                                <!--<td><?php echo $this->common_function->get_segment_format($bid_val->country_name, $project_segments[$bid_val->project_segments], $bid_val->segment_name, $bid_val->bid_status, $segment_delete->is_delete); ?></td>-->
                               
                                <td><input type="hidden" id="prj-close-cpc_<?php echo $bid_val->partner_id; ?>" value="<?php echo $project_cpc; ?>" class="form-control input-xsmall" /><input type="hidden" id="prj-close-ncomplete_<?php echo $bid_val->partner_id; ?>" value="<?php echo $project_ncomplete; ?>" class="form-control input-xsmall" /><input type="hidden" id="prj-close-ecost_<?php echo $bid_val->partner_id; ?>" value="<?php echo $project_estimated_cost; ?>" class="form-control input-xsmall" /><!--<a class="btn bigicn-only close_det_btn" href="<?php echo base_url('projects/closing_sub_details/'.$bid_val->project_id.'/'.$bid_val->partner_id);?>" data-toggle="modal" data-toggle="modal"
   data-target=".closingDetail"><?php echo $project_estimated_cost; ?></a>--><a href="javascript:void(0);" id="show-close-sub-detail_<?php echo $bid_val->partner_id; ?>" ><?php echo $project_estimated_cost; ?></a></td>
                                <td><input type="text" id="prj-close-cost_<?php echo $bid_val->partner_id; ?>" value="<?php echo $researcher_estimated_cost;?>" class="form-control input-xsmall" /></td>
                                <td><?php echo $st_str_display; ?><input type="hidden" value="<?php echo $partner_rank;?>" id="partner-rank_<?php echo $bid_val->partner_id; ?>" /></td>
                                <td> <?php echo $st_usd_display; ?><input type="hidden" value="<?php echo $cost_rank;?>" id="partner-cost-rank_<?php echo $bid_val->partner_id; ?>" /></td>
                                <td><a href="javascript:void(0);" class="btn purple" id="btn-close-partner_<?php echo $bid_val->project_id; ?>_<?php echo $bid_val->partner_id; ?>_<?php echo $bid_val->project_country_id; ?>" >Update</a></td>
                            </tr>
							<tr style="display:none;" class="show-sub-detail-tr" id="show-sub-detail-tr_<?php echo $bid_val->partner_id; ?>">
								
								<td colspan="7" align="center">
									<table class="table table-striped table-bordered table-advance table-hover" style="width:65% !important">
                    <thead>
                							<tr>
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
									Setup cost
								</th>
								<th class="numeric">Min. Fee</th>
								<th >Fee Type</th>
								<th class="numeric">
									Est. cost
								</th>
							</tr>
							</thead>
							<tbody>
							<?php 
							$est_cost = 0;
							$est_total_cost = 0;
							foreach($sub_bid_detail as $sub_bid_val) { ?>
							<tr>
								<td>
									<?php 
									$segment_delete = $CI->mdl_project->check_project_country_delete($sub_bid_val->project_country_id);

									echo $this->common_function->get_segment_format($sub_bid_val->country_name, $project_segments[$sub_bid_val->project_segments], $sub_bid_val->segment_name, $sub_bid_val->bid_status, $segment_delete->is_delete);?>
								</td>
								<td class="numeric">
									<?php echo $sub_bid_val->project_cpc;?>
								</td>
								<td class="numeric">
									<?php echo $sub_bid_val->project_ncomplete;?>
								</td>
								<td class="numeric">
									<?php echo $sub_bid_val->project_setup_cost;?>
								</td>
								<td class="numeric">
									<?php echo $sub_bid_val->project_management_fee;?>
								</td><td class="numeric">
									<?php if($sub_bid_val->fee_type != 0) { echo $fee_type[$sub_bid_val->fee_type]; } else { echo 'NA';}?>
								</td>
								<td class="numeric">
									<?php echo intVal($this->common_function->display_estimate_cost($sub_bid_val->project_cpc, $sub_bid_val->project_ncomplete, $sub_bid_val->project_setup_cost, $sub_bid_val->project_management_fee)); 
									$est_cost = ($sub_bid_val->project_cpc * $sub_bid_val->project_ncomplete) + $sub_bid_val->project_setup_cost;
									$est_total_cost += $est_cost;
									?>
								</td>
							</tr>
							<?php } ?>
							
						</tbody>
						<tfoot>
                							<tr>
								<th>
									&nbsp;
								</th>
								<th class="numeric">
									&nbsp;
								</th>
								<th class="numeric">
									&nbsp;
								</th><th class="numeric">
									&nbsp;
								</th><th class="numeric">
									&nbsp;
								</th><th class="numeric">
									&nbsp;
								</th>
								<th class="numeric">
									<?php echo $est_total_cost; ?>
								</th>
							</tr>
							</tfoot>
					
					</table>
								</td>
							</tr>
                        <?php } ?>
                    </tbody>

                </table>
            </div>
        </div>
    <?php } ?>
	
</div>



<script type="text/javascript">
    jQuery(document).ready(function() {
        $('#closing_date').datepicker( {        
		
        endDate: '+0d',
        autoclose: true  } );
		$('.close_bid_btn').click(function(){
		$('.closingDetail').removeData('bs.modal');
		});
    });
</script>
