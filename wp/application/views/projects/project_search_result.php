<?php if ($partners && !empty($partners)) { 
     foreach ($partners as $p){
    ?>
    <div class="portfolio-block" style="margin-top:15px;">
        <div class="col-md-5">
            <div class="portfolio-text">
                <div class="portfolio-text-info">
                    <h4><?php echo $p->company_name; ?></h4>
                    <p>
                        <?php echo $p->company_email; ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-5 portfolio-stat">
            <div class="portfolio-info">
                Target
                <span>
                    <?php echo $p->company_tags; ?>
                </span>
            </div>
        </div>
        <div class="col-md-2">
            <div class="portfolio-btn">
                <a class="btn bigicn-only" href="#" data-toggle="modal" data-toggle="modal"
   data-target="#basicModal">
                    <span>
                        Send Bid 
                    </span>
                </a>
            </div>
        </div>
    </div>
<?php } } ?>
<div class="modal fade" tabindex="-1" id="basicModal" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-wide">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title">Send Bid for <?php echo $projects['project_name'];?></h4>
			</div>
			<form action="<?php echo base_url('projects/send_bid');?>" method="post" class="form-inline" role="form" id="frm-send-bid">
			<input type="hidden" class="form-control" id="project_id" name="project_id" value="<?php echo $projects['project_id'];?>"  />
			<input type="hidden" class="form-control" id="partner_id" name="partner_id" value="<?php echo $p->company_id;?>"  />
			<input type="hidden" class="form-control" id="researcher_id" name="researcher_id" value="<?php echo $this->session->userdata('company_id');?>"  />
			<input type="hidden" class="form-control" id="researcher_user_id" name="researcher_user_id" value="<?php echo $this->session->userdata('user_id');?>"  />
			<div class="modal-body">
				<div class="form-group col-md-4">
					<label for="project_cpc" class="required_field">Project CPC</label><br />
					<input type="text" class="form-control input-small" id="project_cpc" name="project_cpc" placeholder="Project CPC" value="<?php echo $projects['project_cpc'];?>" >&nbsp;&nbsp;<label>
					<input type="checkbox" name="hide_cpc" id="hide_cpc" value="1" /> Hide CPC? </label>
				</div>
				<div class="form-group col-md-4">
					<label for="project_ncomplete" class="required_field">Project Complete</label><br />
					<input type="text" class="form-control input-small" id="project_ncomplete" name="project_ncomplete" placeholder="Project N complete" value="<?php echo $projects['project_ncomplete'];?>" >
				</div>
				<div class="form-group col-md-4">
					<div id="estimated_cost"></div>
				</div>
				
				<div class="clearfix">&nbsp;</div>
				<div class="form-group col-md-12">
					<label for="comment" class="required_field">Comment</label><br />
					<textarea class="form-control" id="comment" name="comment"></textarea>                   
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn default" data-dismiss="modal">Close</button>
				<button type="submit" class="btn blue">Save changes</button>
			</div>
			
<script>
jQuery(document).ready(function () {
	$('#project_ncomplete').keyup(function() {
	alert("Hi");
		var e_cost = $('#project_ncomplete').val() * $('#project_cpc').val();
		$('#estimated_cost').html("Estimated cost is "+e_cost);
	});
});
</script>
			</form>
		</div>
		<!-- /.modal-content -->
	</div>
	<!-- /.modal-dialog -->
</div>
