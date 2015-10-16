	<?php $CI = & get_instance();
         ?>									<div class="modal-header">
											<h4 class="modal-title">Detail</h4>
										</div>
										<div class="modal-body">
											<table class="table table-striped table-bordered table-advance table-hover">
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
									<?php echo $est_cost = $sub_bid_val->project_cpc * $sub_bid_val->project_ncomplete;
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
								</th>
								<th class="numeric">
									<?php echo $est_total_cost; ?>
								</th>
							</tr>
							</tfoot>
					
					</table>

										</div>
										<div class="modal-footer">
											<button type="button" class="btn default" data-dismiss="modal">Close</button>
											
										</div>
									