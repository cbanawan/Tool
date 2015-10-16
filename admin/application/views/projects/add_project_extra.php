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
var country_json = '<?php echo $this->config->item('country_json'); ?>';
var cntry_arr = $.parseJSON(country_json);
//console.log(country_json);
</script>