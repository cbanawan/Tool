<form class="horizontal-form" role="form" id="frmProject" action="<?php echo base_url(); ?>projects/insert_project" method="post">
    <input type="hidden" id="company_id" name="company_id" value="<?php echo $this->session->userdata('company_id'); ?>" />                    
    <input type="hidden" id="project_id" name="project_id" value="<?php echo (isset($projects)) ? $projects['project_id'] : ""; ?>" />                    
    <div class="form-body">
        <fieldset><legend>Basic Details</legend>
            <div class="row">
                <div class="col-md-6">            
                    <div class="form-group">
                        <label for="project_name" class="control-label required_field">Project Name</label>                    
                        <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Project Name" value=""  />                    
                    </div>
                </div>
                <div class="col-md-6">            

                    <div class="form-group">
                        <label for="project_notes" class="control-label">Project Note</label>                   
                        <textarea class="form-control" name="project_notes" id="project_notes" placeholder="Project Note"></textarea>                    
                    </div>					                 
                </div>                      
            </div>      
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="project_countries" class="control-label required_field">Project Countries</label>            
                        <div>
                            <select class="form-control select2" name="project_countries" id="project_countries" multiple>
                                <?php
                                if (!empty($country)) {
                                    foreach ($country as $value) {
                                        ?>
                                        <option value="<?php echo $value->country_id; ?>"><?php echo $value->country_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                            <input type="hidden" name="hdn_project_country" id="hdn_project_country" />
                        </div>
                    </div>  
                </div>
               
            </div>
            <div id="project_extra_detail"></div>
        </fieldset>
    </div>   
    <div class="margin-top-10 ">        
        <input class="btn green" value="Save Changes" type="submit" id="btn_project" />
        <a href="<?php echo base_url('projects'); ?>" class="btn default">Cancel</a>
    </div>
</form>
<?php $this->load->view('projects/add_project_extra'); ?>

<script type="text/javascript">
    var p_cntry = "";
    $(document).ready(function() {
<?php
if (isset($projects)) {
    if ($projects['project_countries'] != "") {
        ?>
                p_cntry = '<?php echo $projects['project_countries']; ?>';
                p_cntry = p_cntry.split(",");
    <?php } } ?>
    });
</script>
