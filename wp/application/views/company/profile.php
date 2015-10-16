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
			<div class="row">
			
				<div class="col-md-12">
				<div class="form-group">
				<?php 
				$active_class1 = '';
					$active_class2 = '';
					$active_class3 = '';
					$src1 = '';
					$src2 = '';
					$src3 = '';
					$timeval1 = 0;
					$timeval2 = 0;
					$timeval3 = 0;

				if($company['company_time_zone'])  {
					$timezone = array();
					
					$timezone = explode(',',$company['company_time_zone']);
					if($timezone[0] == 1) {
						$src1 = base_url('images/time1-active.png');
						$active_class1 = 'zone-active';
					} else {
						$src1 = base_url('images/time1.png');
						$active_class1 = '';
					}if($timezone[1] == 1) {
						$src2 = base_url('images/time2-active.png');
						$active_class2 = 'zone-active';
					} else {
						$src2 = base_url('images/time2.png');
						$active_class2 = '';
					}if($timezone[2] == 1) {
						$src3 = base_url('images/time3-active.png');
						$active_class3 = 'zone-active';
					} else {
						$src3 = base_url('images/time3.png');
						$active_class3 = '';
					}
					$timeval1 = $timezone[0];
					$timeval2 = $timezone[1];
					$timeval3 = $timezone[2];
				} else {
					$src1 = base_url('images/time1.png');
					$src2 = base_url('images/time2.png');
					$src3 = base_url('images/time3.png');
					$active_class1 = '';
					$active_class2 = '';
					$active_class3 = '';
					$timeval1 = 0;
					$timeval2 = 0;
					$timeval3 = 0;
				}
				?>
                <label for="company_primary_user" class="control-label">Your Timezone</label><br />	
					<img src="<?php echo $src1;?>" id="time-img_1" class="timezone-img <?php echo $active_class1;?>" title="The Americas" />
					<img src="<?php echo $src2;?>" id="time-img_2" class="timezone-img <?php echo $active_class2;?>" title="Europe and Africa" />
					<img src="<?php echo $src3;?>" id="time-img_3" class="timezone-img <?php echo $active_class3;?>" title="Asia and the Pacific"/>
					<input type="hidden" value="<?php echo $timeval1; ?>" id="time1" name="time1" />
					<input type="hidden" value="<?php echo $timeval2; ?>" id="time2" name="time2" />
					<input type="hidden" value="<?php echo $timeval3; ?>" id="time3" name="time3" />
				</div>
				</div>
			</div>			
			<?php } ?>
			
        </fieldset>
		
		</div>   
	
    <div class="margin-top-10 ">        
        <input class="btn green" value="Save Changes" type="submit" id="btn_company_profile" />
        <a href="<?php echo base_url(); ?>home" class="btn default">Cancel</a>
                <?php if (strtolower($company_type[$company['company_type']]) !== 'researcher') { ?><a href="<?php echo base_url(); ?>basic_profile" class="btn blue pull-right">Basic Profiling</a><?php } ?>
    </div>
</form>
<div class="clearfix">&nbsp;</div>
 <!--       <?php if (strtolower($company_type[$company['company_type']]) !== 'researcher') { ?>
          <form id="formupload" action="<?php echo base_url('company/upload_segment_file');?>" method="post" enctype="multipart/form-data">
 <div class="pull-right"><div class="input-group input-medium"><input type="file" name="upd_file_vendor" id="upd_file_vendor" value="" class="form-control" /><span class="input-group-btn"><input type="submit" class="btn blue" name="upd_vendor" value="Upload" /></div> </div></form><fieldset><legend>Basic Panel Profiling Details</legend> 
                <div class="row">
                    
                    <div class="col-md-6"> 
                        <div class="form-group">
                            <label for="company_segment" class="control-label">Profiling Segments</label>            
                            <select class="form-control select2" name="company_segment" id="company_segment" multiple disabled>                        
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
                            <label for="company_countries" class="control-label">Panel Locations</label>            
                            <div>
                                <select class="form-control select2" name="company_countries" id="company_countries" multiple disabled>
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
									<div class="col-md-12"> 
                    <div class="form-group">
                            <label for="company_tag" class="control-label">Additional Profiling Segments</label><br />
<?php $company_tags = array(); 
if(isset($company['company_tags'])) {  
$company_tags = explode(',',$company['company_tags']); 
foreach($company_tags as $tags_val ) {
	echo '<span class="prj-block-display">'.$tags_val.'</span>';
}
} ?>
                           <!-- <input type="text"  class="form-control tags uneditable-input" id="company_tag" name="company_tag" placeholder="Additional Profiling Segments" value="<?php echo (isset($company['company_tags'])) ? $company['company_tags'] : ""; ?>"   />-->
                       <!-- </div>
                    </div>
					</div> -->
                
				
            </fieldset>
        <?php } ?>
    

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
