<form class="horizontal-form" role="form" id="frmCompany" action="<?php echo base_url(); ?>company/update_profile" method="post">
    <input type="hidden" id="company_id" name="company_id" value="<?php echo (isset($company)) ? $company['company_id'] : ""; ?>" />                    
    <div class="form-body">
        <fieldset><legend>Basic Details</legend>
            <div class="row">
                <div class="col-md-6">            
                    <div class="form-group">
                        <label for="company_name" class="control-label required_field">Company Name</label>                    
                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="<?php echo (isset($company)) ? $company['company_name'] : ""; ?>" disabled="disabled" />                    
                    </div>
                </div><div class="col-md-6">            
                    <div class="form-group">
                        <label for="company_type" class="control-label required_field">Company Type</label>
                        <select class="form-control" id="company_type" name="company_type" disabled="disabled">
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
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div></div>
            <div class="row">
                <div class="col-md-6"> 
                    <div class="form-group">
                        <?php $user_email = (isset($company['user_email']) && $company['user_email'] != "" && $company['user_type'] == '1') ? $company['user_email'] : ""; ?>
                        <label for="company_email" class="control-label">Primary Company Contact Email</label>
                        <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Primary Company Contact Email" value="<?php echo (isset($company['company_email']) && $company['company_email'] != "") ? $company['company_email'] : $user_email; ?>" />
                    </div></div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="company_url" class="control-label required_field">Company Url</label>
                        <input type="text" class="form-control" id="company_url" name="company_url" placeholder="Company Url" value="<?php echo (isset($company['company_url'])) ? $company['company_url'] : ""; ?>" />
                    </div>
                </div>
            </div>
        </fieldset>
        <fieldset><legend>Contact Details</legend>
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
                            <select class="form-control" name="company_country" id="company_country">
                                <option value="">Select Country</option>
                                <?php
                                if (!empty($country)) {
                                    foreach ($country as $value) {
                                        $sel = "";
                                        if ($company['company_country'] == $value->country_id)
                                            $sel = "selected='selected'";
                                        ?>
                                        <option value="<?php echo $value->country_id; ?>" <?php echo $sel; ?>><?php echo $value->country_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
<!--                                            <input type="hidden" name="hdn_company_country" id="hdn_company_country" />-->
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label for="company_zip" class="control-label required_field">Company Zip/Postal code</label>            
                        <input type="text" class="form-control" id="company_zip" name="company_zip" placeholder="Zip/Postal code" value="<?php echo (isset($company['company_zipcode'])) ? $company['company_zipcode'] : ""; ?>" />
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label for="company_contact" class="control-label required_field">Company Phone</label>            
                        <input type="text" class="form-control" name="company_contact" id="company_contact" value="<?php echo (isset($company['company_contact_no'])) ? $company['company_contact_no'] : ""; ?>" />
                    </div>
                </div>
            </div>  
			<?php if (strtolower($company_type[$company['company_type']]) !== 'researcher') { ?>
            <div class="row">
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label for="company_panel_names" class="control-label">Panel Names</label>            
                        <input type="text" class="form-control tags" id="company_panel_names" name="company_panel_names" placeholder="Panel Names" value="<?php echo (isset($company['company_panel_names'])) ? $company['company_panel_names'] : ""; ?>" />
                    </div>
                </div>
                <div class="col-md-6"> 
                    <div class="form-group">
                        <label for="company_primary_user" class="control-label">Primary Users</label>            
						<select class="form-control" name="company_primary_user" id="company_primary_user" >                        
							<?php
							if (isset($company_users)) {
								foreach ($company_users as $users_val) {
									if($company['company_primary_user'] == $users_val->user_id) {
										$selected = "selected";
									} else {
										$selected = "";
									} 
									?>
									<option value="<?php echo $users_val->user_id; ?>" <?php echo $selected; ?>><?php echo $users_val->user_name; ?></option>
									<?php
								}
							}
							?>
						</select>
                    </div>
                </div>
            </div>   
			<?php } ?>
        </fieldset>
        <?php if (strtolower($company_type[$company['company_type']]) !== 'researcher') { ?>
            <fieldset><legend>Basic Panel Profiling Details</legend>
                <div class="row">
                    
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="company_segment" class="control-label">Profiling Segments</label>            
                            <select class="form-control select2" name="company_segment" id="company_segment" multiple>                        
                                <?php
                                if (isset($company_segment)) {
                                    foreach ($company_segment as $key => $cs) {
                                        ?>
                                        <option value="<?php echo $key; ?>"><?php echo $cs; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>  
                            <input type="hidden" name="hdn_company_segment" id="hdn_company_segment" />
                        </div>
                    </div>
					<div class="col-md-6"> 
                        <div class="form-group">
                            <label for="company_tag" class="control-label">Additional Profiling Segments</label>            
                            <input type="text" class="form-control tags" id="company_tag" name="company_tag" placeholder="Additional Profiling Segments" value="<?php echo (isset($company['company_tags'])) ? $company['company_tags'] : ""; ?>" />
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="company_countries" class="control-label">Panel Locations</label>            
                            <div>
                                <select class="form-control select2" name="company_countries" id="company_countries" multiple>
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
            </fieldset>
        <?php } ?>
    </div>   
    <div class="margin-top-10 ">        
        <input class="btn green" value="Save Changes" type="submit" id="btn_company_profile" />
        <a href="<?php echo base_url(); ?>home" class="btn default">Cancel</a>
    </div>
</form>

<script type="text/javascript">
    var c_cntry = "";
    var c_segment = "";
    $(document).ready(function () {
        $('.active').removeClass('active');
        $('#company_profile').addClass('active');
<?php
if (isset($company)) {
    if ($company['company_countries'] != "") {
        ?>
                c_cntry = '<?php echo $company['company_countries']; ?>';
                c_cntry = c_cntry.split(",");
    <?php } if ($company['company_segment'] != "") { ?>
                c_segment = '<?php echo $company['company_segment']; ?>';
                c_segment = c_segment.split(",");
        <?php
    }
}
?>

    });
</script>
