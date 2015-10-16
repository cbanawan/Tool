<div class="row profile-account">
    <div class="col-md-3">
        <ul class="ver-inline-menu tabbable margin-bottom-10">
            <li class="active">
                <a data-toggle="tab" href="#tab_1-1">
                    <i class="fa fa-cog"></i> Personal info </a>
                <span class="after">
                </span>
            </li>
            <li>
                <a data-toggle="tab" href="#tab_2-2"><i class="fa fa-picture-o"></i> Change Avatar</a>
            </li>
            <li>
                <a data-toggle="tab" href="#tab_3-3"><i class="fa fa-lock"></i> Change Password</a>
            </li>            
        </ul>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div id="tab_1-1" class="tab-pane active">
                <form class="horizontal-form" role="form" id="frmCompany" action="<?php echo base_url(); ?>company/update_profile" method="post">
                    <input type="hidden" id="company_id" name="company_id" value="<?php echo (isset($company)) ? $company['company_id'] : ""; ?>" />                    
                    <div class="form-body">
                        <fieldset><legend>Basic Details</legend>
                            <div class="row">
                                <div class="col-md-6">            
                                    <div class="form-group">
                                        <label for="company_name" class="control-label required_field">Company Name</label>                    
                                        <input type="text" class="form-control" id="company_name" name="company_name" placeholder="Company Name" value="<?php echo (isset($company)) ? $company['company_name'] : ""; ?>" />                    
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
                                        <?php $user_email = (isset($company['user_email']) && $company['user_email'] != "") ? $company['user_email']: ""; ?>
                                        <label for="company_email" class="control-label">Company Email</label>
                                        <input type="text" class="form-control" id="company_email" name="company_email" placeholder="Company Email" value="<?php echo (isset($company['company_email']) && $company['company_email'] != "") ? $company['company_email'] : $user_email; ?>" />
                                    </div></div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_url" class="control-label">Company Url</label>
                                        <input type="text" class="form-control" id="company_url" name="company_url" placeholder="Company Url" value="<?php echo (isset($company['company_url'])) ? $company['company_url'] : ""; ?>" />
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                        <fieldset><legend>Contact Details</legend>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="company_address" class="control-label">Company Address</label>                   
                                        <textarea class="form-control" name="company_address" id="company_address" placeholder="Address"><?php echo (isset($company['company_address'])) ? $company['company_address'] : ""; ?></textarea>                    
                                    </div>
                                </div><div class="col-md-6">
                                    <div class="form-group">
                                        <label for="company_city" class="control-label">Company City</label>                    
                                        <input type="text" class="form-control" name="company_city" id="company_city" placeholder="City" value="<?php echo (isset($company['company_city'])) ? $company['company_city'] : ""; ?>" />                    
                                    </div>
                                </div></div>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="company_state" class="control-label">Company State</label>            
                                        <input type="text" class="form-control" id="company_state" name="company_state" placeholder="State" value="<?php echo (isset($company['company_state'])) ? $company['company_state'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="company_country" class="control-label">Company Country</label>            
                                        <div>
                                            <select class="form-control" name="company_country" id="company_country">
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
<!--                                            <input type="hidden" name="hdn_company_country" id="hdn_company_country" />-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="company_zip" class="control-label">Company Zip</label>            
                                        <input type="text" class="form-control" id="company_zip" name="company_zip" placeholder="Zipcode" value="<?php echo (isset($company['company_zipcode'])) ? $company['company_zipcode'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="company_contact" class="control-label">Company Phone</label>            
                                        <input type="text" class="form-control" name="company_contact" id="company_contact" value="<?php echo (isset($company['company_contact_no'])) ? $company['company_contact_no'] : ""; ?>" />
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="company_countries" class="control-label">Company Countries</label>            
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
                        <?php if(strtolower($company_type[$company['company_type']]) == 'researcher'){ ?>
                        <fieldset><legend>Basic Panel Profiling Details</legend>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="company_tag" class="control-label">Company Tag</label>            
                                        <input type="text" class="form-control tags" id="company_tag" name="company_tag" placeholder="Company Tags" value="<?php echo (isset($company['company_tags'])) ? $company['company_tags'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="company_segment" class="control-label">Company Segment</label>            
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
                            </div>
                        </fieldset>
                        <?php } ?>
                    </div>   
                    <div class="margin-top-10 ">        
                        <input class="btn green" value="Save Changes" type="submit" id="btn_company_profile" />
                        <button class="btn default" type="button">Cancel</button>
                    </div>
                </form>
            </div>
            <div id="tab_2-2" class="tab-pane">
<!--                <p>
                    Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                </p>-->
                <form action="<?php echo base_url(); ?>company/change_avtar" role="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="company_id" name="company_id" value="<?php echo (isset($company)) ? $company['company_id'] : ""; ?>" />                    
                    <div class="form-group">
                        <div class="thumbnail" style="width: 310px;">
                            <?php if (isset($company) && $company['profile_pic'] != "") { ?>
                                <img src="<?php echo base_url() . "uploads/" . $this->session->userdata('company_id') . "/" . $company['profile_pic']; ?>" />
                                <input type="hidden" id="hdn_image" name="hdn_image" value="<?php echo $company['profile_pic']; ?>" />
                            <?php } else { ?>
                                <img src="<?php echo base_url() . IMAGES; ?>noimage.gif" alt="">
                            <?php } ?>
                        </div>
                        <div class="margin-top-10 fileupload fileupload-new" data-provides="fileupload">
                            <div class="input-group input-group-fixed">
                                <span class="input-group-btn">
                                    <span class="uneditable-input">
                                        <i class="fa fa-file fileupload-exists"></i>
                                        <span class="fileupload-preview">                                            
                                        </span>
                                    </span>
                                </span>
                                <span class="btn default btn-file">
                                    <span class="fileupload-new">
                                        <i class="fa fa-paper-clip"></i> Select file
                                    </span>
                                    <span class="fileupload-exists">
                                        <i class="fa fa-undo"></i> Change
                                    </span>
                                    <input type="file" class="default" name="profile_pic" id="profile_pic" />
                                </span>
                                <a href="#" class="btn red fileupload-exists" data-dismiss="fileupload"><i class="fa fa-trash-o"></i> Remove</a>
                            </div>
                        </div>
<!--                        <span class="label label-danger">
                            NOTE!
                        </span>
                        <span>
                            Attached image thumbnail is supported in Latest Firefox, Chrome, Opera, Safari and Internet Explorer 10 only
                        </span>-->
                    </div>
                    <div class="margin-top-10">
                        <input type="submit" name="btn_change_avtar" id="btn_change_avtar" value="Submit" class="btn green" />                        
                        <a href="#" class="btn default">Cancel</a>
                    </div>
                </form>
            </div>
            <div id="tab_3-3" class="tab-pane">
                <form name="frmCompany_cp" method="post" action="<?php echo base_url(); ?>company/update_password">
                    <div class="form-group">
                        <label class="control-label">Current Password</label>
                        <input type="password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">New Password</label>
                        <input type="password" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Re-type New Password</label>
                        <input type="password" class="form-control"/>
                    </div>
                    <div class="margin-top-10">
                        <input type="submit" name="btn_change_pass" id="btn_change_pass" value="Change Password" class="btn green" />                        
                        <!--                        <a href="#" class="btn green">Change Password</a>-->
                        <a href="#" class="btn default">Cancel</a>
                    </div>
                </form>
            </div>           
        </div>
    </div>
    <!--end col-md-9-->
</div>
<script type="text/javascript">
    var c_cntry = "";
    var c_segment = "";
    $(document).ready(function () {
<?php
if (isset($company)) {
    if ($company['company_country'] != "") {
        ?>
                c_cntry = '<?php echo $company['company_country']; ?>';
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
