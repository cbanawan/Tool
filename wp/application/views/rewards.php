<div class="row">
	<div class="col-md-10" >
	<label>Total Researcher Rewards:</label> <strong><?php if($resercher_rewards) { echo $resercher_rewards['total_rewards']; } ?></strong><br />
	<label>Redeemed Rewards:</label> <strong><?php if($resercher_rewards) { echo $resercher_rewards['reedeamed_rewards']; }?></strong><br />
	<label>Rewards Available:</label> <strong><?php if($resercher_rewards) { echo $resercher_rewards['total_rewards'] - $resercher_rewards['reedeamed_rewards']; } ?></strong><br />
	<label>Pending Rewards:</label> <strong><?php if($resercher_rewards) { echo  $resercher_rewards_request; }?></strong>
	</div>
	<div class="col-md-2 pull-right" >
		<a href="javascript:void(0);" class="btn blue" data-toggle="modal" data-toggle="modal"
   data-target="#basicModal">Redeem Point</a>
		<div class="modal fade" tabindex="-1" id="basicModal" role="dialog" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<h4 class="modal-title">Redeem Point</h4>
					</div>
					<div class="modal-body">
						<form class="form-horizontal" role="form">
							<div class="form-body">
								<div class="form-group">
									<label class="col-md-5 control-label">Rewards Available : </label>
									<div class="col-md-7" style="margin-top:10px;"><strong><?php if($resercher_rewards) { echo $resercher_rewards['total_rewards'] - $resercher_rewards['reedeamed_rewards']; } ?></strong>
										<input type="hidden" class="form-control" placeholder="Enter text" name="rewards_available" id="rewards_available" value="<?php if($resercher_rewards) { echo $resercher_rewards['total_rewards'] - $resercher_rewards['reedeamed_rewards']; } ?>">
										<input type="hidden" class="form-control" placeholder="Enter text" name="reedeamed_rewards" id="reedeamed_rewards" value="<?php if($resercher_rewards) { echo $resercher_rewards['reedeamed_rewards']; } ?>">
										
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Redeem Amount : </label>
									<div class="col-md-7"><input type="text" class="form-control" placeholder="Enter amount" value="" name="redeem_amount" id="redeem_amount"><span class="help-block " id="amt_error">should not be greater than rewards available.</span>							
									</div>
									
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Payment Method : </label>
									<div class="col-md-7"><select class="form-control payment_method" name="payment_method" id="payment_method">                        
                                <?php
                                if (isset($payment_method)) {
                                    foreach ($payment_method as $key => $ps) {
                                        ?>
                                        <option value="<?php echo $key; ?>"><?php echo $ps; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>					
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-5 control-label">Notes : </label>
									<div class="col-md-7"><textarea id="notes" name="notes" class="form-control"></textarea>
									</div>
									
								</div>
							</div>
						</form>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn default" data-dismiss="modal">Close</button>
						<button type="button" class="btn blue" id="save_redeem_point">Save changes</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="clearfix">&nbsp;</div>
<div class="row">
	<div class="col-md-12" >
		<table class="table table-striped table-bordered table-advance table-hover">
			<thead>
				<tr>
					<th>ID</th>
					<th>Partner</th>
					<th>Project</th>
					<th>Cost</th>
					<th>Reward</th>
					
				</tr>
			</thead>
			<tbody>
			<?php if($resercher_rewards_details) { 
			foreach($resercher_rewards_details as $detail) { ?>
			<tr>
				<td><?php echo $detail->entry_id;?></td>
				<td><?php echo $detail->company_name;?></td>
				<td><?php echo $detail->project_name;?></td>
				<td><?php echo $detail->cost;?></td>
				<td><?php echo $detail->reward_amt;?></td>
			</tr>
			<?php }
			
			} else { ?>
			<tr>
				<td colspan="5"> No data available</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>    
<div class="clearfix">&nbsp;</div>
<h3>Rewards Request</h3>
<div class="row">
	<div class="col-md-12" >
		<table class="table table-striped table-bordered table-advance table-hover">
			<thead>
				<tr>

					<th>Date</th>
					<th>Amount</th>
					<th>Method</th>
					<th>Notes</th>
					<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php if($resercher_request_rewards) {
			foreach($resercher_request_rewards as $request_detail) { ?>
			<tr>
				<td><?php echo date(DATE_DISPLAY_FORMAT, strtotime($request_detail->request_date));?></td>
				<td><?php echo $request_detail->reward_amt;?></td>
				<td><?php echo $payment_method[$request_detail->reward_method];?></td>
				<td><?php echo $request_detail->notes;?></td>
				<td><?php echo $payment_status[$request_detail->status];?></td>
			</tr>
			<?php } 
			} else { ?>
			<tr>
				<td colspan="5"> No data available</td>
			</tr>
			<?php } ?>
			</tbody>
		</table>
	</div>
</div>                