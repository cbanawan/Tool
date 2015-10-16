<ul class="nav nav-tabs" id="invoices_partner_detail">
    <li class="tablink active">
        <a href="#tab_invoice" data-url="#" data-toggle="tab">Pending Invoicing</a>
    </li>
    <li class="tablink">
        <a href="#tab_invoice_partner" data-url="#" data-toggle="tab">Invoices/Status</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active in" id="tab_invoice">
		<?php if($pending_invoices){ ?>
			<div class="table-responsive">
				<table class="table table-striped table-bordered table-advance table-hover">
				<thead>
					<tr>
						<th>Project</th>
						<th>Segment</th>
						<th class="numeric">Amount</th>
					</tr>
				</thead>
				<tbody>
			<?php foreach($pending_invoices as $invocies_pending) {  ?>
				<tr>
					<td><?php echo $invocies_pending->project_name; ?></td>
					<td><?php echo $this->common_function->get_segment_format($invocies_pending->country_name, $project_segments[$invocies_pending->project_segments],$invocies_pending->segment_name,'',$invocies_pending->is_delete);?></td>
					<td><?php echo $invocies_pending->researcher_estimated_cost;?></td>
				</tr>
			<?php } ?>
				</tbody>
				</table>
			</div>
			<?php } else {  ?>
<div class="alert alert-info">
        <strong>Empty!</strong> No records Found.
    </div>
		<?php 				} ?>
			
      
    </div>
    <div class="tab-pane fade" id="tab_invoice_partner">
        <?php if($invoice_master_detail){
			$CI = & get_instance();
			$CI->load->model('mdl_company');
        
			?>
			    <div class="table-responsive">
					<table class="table table-striped table-bordered table-advance table-hover">
                    <thead>
                        <tr>
							<th>Bacth No.</th>
                            <th>Date</th>
							<th>Cost</th>
                            <th>Payment Status</th>
                            <th>Invoice Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
        <?php
			foreach($invoice_master_detail as $invocies_detail) {
				$sub_invoice = $this->mdl_company->get_invoices(1,$invocies_detail->invoice_id);
				?>
				<tr>
					<td><?php echo $batch_number[$invocies_detail->batch_number];?></td>
					<td><?php echo $invocies_detail->invoice_date;?></td>
					<td><?php echo $invocies_detail->amount;?></td>
					<td><?php echo $invoice_payment_status[$invocies_detail->payment_status];?></td>
					<td><?php echo $invoice_status[$invocies_detail->status];?></td>
					<td><a href="javascript:void(0);" id="show-invoice-sub-detail_<?php echo $invocies_detail->invoice_id; ?>" class="btn green">Expand</a></td>
				</tr>
				
				<tr style="display:none !important;" id="show-invoice-sub-innerdetail_<?php echo $invocies_detail->invoice_id; ?>" class="show-invoice-sub-innerdetail">
					<td colspan="6" align="center">
						<?php if($sub_invoice) { ?>
						<table class="table table-striped table-bordered table-advance table-hover" style="width:65% !important">
							<thead>
                				<tr>
								<th>Project</th>
								<th>Segment</th>
								<th class="numeric">Amount</th>
								
							</tr>
							</thead>
							<tbody>
						<?php foreach ($sub_invoice as $sub_invoice_detail) { ?>
							<tr>
								<td><?php echo $sub_invoice_detail->project_name; ?></td>
								<td><?php echo $this->common_function->get_segment_format($sub_invoice_detail->country_name, $project_segments[$sub_invoice_detail->project_segments],$sub_invoice_detail->segment_name,'',$sub_invoice_detail->is_delete);?></td>
								<td><?php echo $sub_invoice_detail->researcher_estimated_cost;?></td>
							</tr>
						<?php } ?>
							</tbody>
						</table>
						<?php } else {  ?>
<div class="alert alert-info">
        <strong>Empty!</strong> No records Found.
    </div>
		<?php 				} ?>
							
					</td>
				</tr>
			<?php } ?>
				</tbody>
			</table>
		</div>
			
	   <?php }?>
	   
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#invoices').addClass('active');
        $('#invoices').find('.arrow').addClass('open');
		$('a[id^="show-invoice-sub-detail_"]').live('click', function() {
	var closedetail = $(this).attr('id').split("_")[1];
	$('.show-invoice-sub-innerdetail').hide('slow');
	$('#show-invoice-sub-innerdetail_'+closedetail).show('slow');
});
    });
</script>
