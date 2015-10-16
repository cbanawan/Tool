<form class="horizontal-form" role="form" id="frmProject" action="<?php echo base_url(); ?>projects/insert_project" method="post">
    <input type="hidden" id="company_id" name="company_id" value="<?php echo $this->session->userdata('company_id'); ?>" />                    
    <div class="form-body">
		<div class="row">
			<div class="col-md-3">            
				<div class="form-group">
					<label for="project_name" class="control-label required_field">Project Name</label>                    
					<input type="text" class="form-control" id="project_name" name="project_name" placeholder="Project Name" value=""  />                    
				</div>
			</div>
			<div class="col-md-3">            

				<div class="form-group">
					<label for="project_notes" class="control-label">Project Internal Note</label>                   
					<textarea class="form-control" name="project_internal_note" id="project_internal_note" placeholder="Project Internal Note"></textarea>                    
				</div>					                 
			</div>
			<div class="col-md-3">            

				<div class="form-group">
					<label for="project_notes" class="control-label">Project External Note</label>                   
					<textarea class="form-control" name="project_external_note" id="project_external_note" placeholder="Project External Note"></textarea>                    
				</div>					                 
			</div> 
			<div class="col-md-3" style="margin-top:30px;"> 
				<input class="btn green" value="Add Project" type="submit" id="btn_project" />
				<a href="<?php echo base_url('projects'); ?>" class="btn default">Cancel</a>
			</div>
		</div>  
	</div>   
</form>

