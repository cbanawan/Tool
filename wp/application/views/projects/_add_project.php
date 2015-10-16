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
<!--				<div class="col-md-2">            
                    <div class="form-group"><br /><br />
                        <input type="button" class="btn blue" name="btn_add_fields" id="btn_add_fields" value="Add" />
                    </div>
                </div>-->
			</div>
			<div id="project_extra_detail"></div>
        </fieldset>
    </div>   
    <div class="margin-top-10 ">        
        <input class="btn green" value="Save Changes" type="submit" id="btn_project" />
        <a href="<?php echo base_url(); ?>home" class="btn default">Cancel</a>
    </div>
</form>
<div id="dummy" style="display: none;">
    <fieldset>
        <legend></legend>
        <div class="row">               
            <div class="col-md-1">            
                <div class="form-group">
                    <label for="project_ir" class="control-label ">IR</label>                    
                    <input type="text" class="form-control project_ir input-xsmall" name="project_ir[]" placeholder="Project IR" value="0"  />                    
                </div>
            </div>
            <div class="col-md-1">            
                <div class="form-group">
                    <label for="project_loi" class="control-label ">LOI</label>                    
                    <input type="text" class="form-control project_loi input-xsmall" name="project_loi[]" placeholder="Project LOI" value="0"  />                    
                </div>
            </div>   
            <div class="col-md-1">            
                <div class="form-group">
                    <label for="project_cpc" class="control-label ">CPC</label>                    
                    <input type="text" class="form-control project_cpc input-xsmall" name="project_cpc[]" placeholder="Project CPC" value="0"  />                    
                </div>
            </div>
            <div class="col-md-2">            
                <div class="form-group">
                    <label for="project_ncomplete" class="control-label ">NComplete</label>                    
                    <input type="text" class="form-control project_ncomplete input-small" name="project_ncomplete[]" placeholder="Project No. Of Complete" value="0"  />                    
                </div>
            </div>   
            <div class="col-md-3"> 
                <div class="form-group">
                    <label for="project_segments" class="control-label required_field">Project Segments</label>            
                    <select class="form-control select2 project_segments" name="project_segments[]" multiple>                        
                        <?php
                        if (isset($project_segments)) {
                            foreach ($project_segments as $key => $ps) {
                                ?>
                                <option value="<?php echo $key; ?>"><?php echo $ps; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>  
                    <input type="hidden" class="hdn_project_segments"  />
                </div>
            </div>            
            <div class="col-md-4"> 
                <div class="form-group">
                    <label for="project_target" class="control-label required_field">Project Target</label>            
                    <input type="text" class="form-control tags project_target" name="project_target[]" placeholder="Project Target" value="" />
                </div>
            </div>
        </div>
    </fieldset>
</div>

<script type="text/javascript">
    var p_cntry = "";
    //var cntry  = "<?php //echo (isset($country)) ? json_encode($country) : ""; ?>";
    //console.log(cntry);
    var p_segment = "";
    $(document).ready(function() {
//        if (p_cntry != undefined && p_cntry != "")
//            $("#project_countries").select2("val", p_cntry);
//        if (p_segment != undefined && p_segment != "")
//            $("#project_segments").select2("val", p_segment);
<?php
if (isset($projects)) {
    if ($projects['project_countries'] != "") {
        ?>
                p_cntry = '<?php echo $projects['project_countries']; ?>';
                p_cntry = p_cntry.split(",");
    <?php } if ($projects['project_segments'] != "") { ?>
                p_segment = '<?php echo $projects['project_segments']; ?>';
                p_segment = p_segment.split(",");
        <?php
    }
}
?>

    });
</script>
