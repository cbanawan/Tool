<form class="horizontal-form" role="form" id="frmCompany" action="<?php echo base_url(); ?>company/update_profile" method="post">
    <div class="form-body">
        <div class="row">
            <div class="col-md-6">            
                <div class="form-group">
                    <label for="company_name" class="control-label required_field">Company Name</label>                    
                    <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="<?php echo (isset($company)) ? $company['company_name'] : ""; ?>" />                    
                </div>
            </div><div class="col-md-6">            
                <div class="form-group">
                    <label for="company_type" class="control-label required_field">Company Type</label>
                    <select class="form-control" id="company_type" name="company_type">
                        <option value="">Select Company Type</option>
                        <?php
                        if (isset($company_type)) {
                            foreach ($company_type as $ctk => $ctv) {
                                $sel = "";
                                if (isset($company) && intval($ctk) == intval($company['company_type'])) {
                                    $sel = "selected='selected'";
                                }
                                ?>
                                <option value="<?php echo $ctk; ?>" <?php echo $sel; ?> ><?php echo $ctv; ?></option>
                            <?php }
                        }
                        ?>
                    </select>
                </div>
            </div></div>
        <div class="row">
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="company_email" class="control-label required_field">Company Email</label>
                    <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Company Email" value="<?php echo (isset($company['company_email'])) ? $company['company_email'] : ""; ?>" />
                </div></div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="company_url" class="control-label required_field">Company Url</label>
                    <input type="text" class="form-control" id="company_url" name="company_url" placeholder="Company Url" value="<?php echo (isset($company['company_url'])) ? $company['company_url'] : ""; ?>" />
                </div>
            </div></div>
        <div class="row">
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="company_address" class="control-label required_field">Company Address</label>                   
                    <textarea class="form-control" name="company_address" id="company_address" placeholder="Address"><?php echo (isset($company['company_address'])) ? $company['company_address'] : ""; ?></textarea>                    
                </div>
            </div><div class="col-md-6">
                <div class="form-group">
                    <label for="company_city" class="control-label required_field">Company City</label>                    
                    <input type="text" class="form-control" name="company_city" id="company_city" placeholder="City" value="<?php echo (isset($company['company_city'])) ? $company['company_city'] : ""; ?>" />                    
                </div>
            </div></div>
        <div class="row">
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="company_state" class="control-label required_field">Company State</label>            
                    <input type="text" class="form-control" id="company_state" name="company_state" placeholder="State" value="<?php echo (isset($company['company_state'])) ? $company['company_state'] : ""; ?>" />
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="company_country" class="control-label required_field">Company Country</label>            
                    <div>
                        <select class="form-control select2" name="company_country" id="company_country" multiple>
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
                        <input type="hidden" name="hdn_company_country" id="hdn_company_country" />
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="company_zip" class="control-label required_field">Company Zip</label>            
                    <input type="text" class="form-control" id="company_zip" name="company_zip" placeholder="Zipcode" value="<?php echo (isset($company['company_zipcode'])) ? $company['company_zipcode'] : ""; ?>" />
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="company_contact" class="control-label required_field">Company Contact</label>            
                    <input type="text" class="form-control" name="company_contact" id="company_contact" value="<?php echo (isset($company['company_contact_no'])) ? $company['company_contact_no'] : ""; ?>" />
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="company_tag" class="control-label">Company Tag</label>            
                    <input type="text" class="form-control tags" id="company_tag" name="company_tag" placeholder="Company Tags" value="<?php echo (isset($company['company_tags'])) ? $company['company_tags'] : ""; ?>" />
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="company_segment" class="control-label required_field">Company Segment</label>            
                    <select class="form-control select2" name="company_segment" id="company_segment" multiple>                        
                        <?php
                        if (isset($company_segment)) {
                            foreach ($company_segment as $key => $cs) {
                                ?>
                                <option value="<?php echo $key; ?>"><?php echo $cs; ?></option>
                            <?php }
                        }
                        ?>
                    </select>  
                    <input type="hidden" name="hdn_company_segment" id="hdn_company_segment" />
                </div>
            </div>
        </div>
    </div>
    <!--    <div class="form-group">
            <div class="col-md-offset-2 col-md-4">
                <div class="checkbox">
                    <label>
                        <input type="checkbox"> Remember me </label>
                </div>
            </div>
        </div>-->
    <div class="form-actions right">
        <button class="btn default" type="button">Cancel</button>
        <input class="btn green" value="Submit" type="submit" id="btn_company_profile" />
    </div>
</form>