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
                <h3>Personal Info</h3>
				<form class="horizontal-form" role="form" id="frmuser" action="<?php echo base_url(); ?>users/update_profile" method="post">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo (isset($user)) ? $user['user_id'] : ""; ?>" />  
					<div class="form-body">
                        <fieldset><legend>Basic Details</legend>
                            <div class="row">
                                <div class="col-md-6">            
                                    <div class="form-group">
                                        <label for="user_name" class="control-label required_field">Full Name</label>                    
                                        <input type="text" class="form-control" id="user_name" name="user_name" placeholder="Full Name" value="<?php echo (isset($user)) ? $user['user_name'] : ""; ?>" />                    
                                    </div>
                                </div>
								<div class="col-md-6">            
                                    <div class="form-group">
                                        <label for="user_email" class="control-label required_field">Email Address</label>                    
                                        <input type="text" class="form-control" id="user_email" name="user_email" placeholder="Email Address" value="<?php echo (isset($user)) ? $user['user_email'] : ""; ?>" disabled="disabled"/>                    
                                    </div>
                                </div>
								<div class="col-md-6">            
                                    <div class="form-group">
                                        <label for="user_designation" class="control-label required_field">Title /Position</label>                    
                                        <input type="text" class="form-control" id="user_designation" name="user_designation" placeholder="Title /Position" value="<?php echo (isset($user['user_designation'])) ? $user['user_designation'] : ""; ?>" />                    
                                    </div>
                                </div>
							</div>
						</fieldset>
						<fieldset><legend>Contact Details</legend>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="User_address" class="control-label">Address</label>
                                        <textarea class="form-control" name="user_address" id="user_address" placeholder="Address"><?php echo (isset($user['user_address'])) ? $user['user_address'] : ""; ?></textarea>                    
                                    </div>
                                </div><div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user_city" class="control-label">City</label>                    
                                        <input type="text" class="form-control" name="user_city" id="user_city" placeholder="City" value="<?php echo (isset($user['user_city'])) ? $user['user_city'] : ""; ?>" />                    
                                    </div>
                                </div></div>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="user_state" class="control-label">State</label>            
                                        <input type="text" class="form-control" id="user_state" name="user_state" placeholder="State" value="<?php echo (isset($user['user_state'])) ? $user['user_state'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="user_country" class="control-label">Country</label>
										<div><select class="form-control" name="user_country" id="user_country">
                                <option value="">Select Country</option>
                                <?php
                                if (!empty($country)) {
                                    foreach ($country as $value) {
                                        $sel = "";
                                        if ($user['user_country'] == $value->country_id)
                                            $sel = "selected='selected'";
                                        ?>
                                        <option value="<?php echo $value->country_id; ?>" <?php echo $sel; ?>><?php echo $value->country_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select></div>

										         </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="user_zip" class="control-label">Zip/Postal code</label>            
                                        <input type="text" class="form-control" id="user_zipcode" name="user_zipcode" placeholder="Zip/Postal code" value="<?php echo (isset($user['user_zipcode'])) ? $user['user_zipcode'] : ""; ?>" />
                                    </div>
                                </div>
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="user_contact" class="control-label"> Phone</label>            
                                        <input type="text" class="form-control" name="user_phone" id="user_phone" value="<?php echo (isset($user['user_phone'])) ? $user['user_phone'] : ""; ?>" />
                                    </div>
                                </div>
                            </div>
					</div>
					<div class="margin-top-10 ">        
                        <input class="btn green" value="Save Changes" type="submit" id="btn_user_profile" />
                        <button class="btn default" type="button">Cancel</button>
                    </div>
				</form>
            </div>
            <div id="tab_2-2" class="tab-pane">
                <form action="<?php echo base_url(); ?>users/change_avtar" role="form" method="post" enctype="multipart/form-data">
                    <input type="hidden" id="user_id" name="user_id" value="<?php echo (isset($user)) ? $user['user_id'] : ""; ?>" />                    
                    <div class="form-group">
                        <div class="thumbnail" style="width: 310px;">
                            <?php if (isset($user) && $user['profile_pic'] != "") { ?>
                                <img src="<?php echo base_url() . "uploads/" . $this->session->userdata('user_id') . "/" . $user['profile_pic']; ?>" />
                                <input type="hidden" id="hdn_image" name="hdn_image" value="<?php echo $user['profile_pic']; ?>" />
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
                <form name="frm_change_pass" id="frm_change_pass" method="post" action="<?php echo base_url(); ?>users/update_password">
                    <div class="form-group">
                        <label class="control-label">Current Password</label>
                        <input type="password" name="current_pass" id="current_pass" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">New Password</label>
                        <input type="password" name="new_pass" id="new_pass" class="form-control"/>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Re-type New Password</label>
                        <input type="password" name="retype_pass" id="retype_pass" class="form-control"/>
                    </div>
                    <div class="margin-top-10">
                        <input type="submit" name="btn_change_pass" id="btn_change_pass" value="Change Password" class="btn green" />                                                
                        <a href="<?php echo base_url(); ?>home" class="btn default">Cancel</a>
                    </div>
                </form>
            </div>           
        </div>
    </div>
    <!--end col-md-9-->
</div>

