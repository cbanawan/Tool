<form class="horizontal-form" role="form" id="frmuser" action="<?php echo base_url('/users/update_user')?>" method="post">
	<input type="hidden" id="user_id" name="user_id" value="<?php echo (isset($user_rs)) ? $user_rs['user_id'] : ""; ?>" />  
	<div class="form-body">
		<fieldset><legend>Basic Details</legend>
			<div class="row">
				<div class="col-md-6">            
					<div class="form-group">
						<label for="user_name" class="control-label required_field">Full Name</label>             
						<input type="text" class="form-control" id="user_name" name="user_name" placeholder="Full Name" value="<?php echo (isset($user_rs)) ? $user_rs['user_name'] : ""; ?>" /> <span class="help-block error_span" id="user_name_error"></span>                   
					</div>
				</div>
				<div class="col-md-6">            
					<div class="form-group">
						<label for="user_email" class="control-label">Email Address</label>                    
						<input type="text" class="form-control" id="user_email" name="user_email" placeholder="Email Address" value="<?php echo (isset($user_rs)) ? $user_rs['user_email'] : ""; ?>" disabled="disabled"/>                    
					</div>
				</div>
				<div class="col-md-6">            
					<div class="form-group">
						<label for="user_designation" class="control-label">Title /Position</label>                    
						<input type="text" class="form-control" id="user_designation" name="user_designation" placeholder="Title /Position" value="<?php echo (isset($user_rs['user_designation'])) ? $user_rs['user_designation'] : ""; ?>" />
						
					</div>
				</div>
			</div>
		</fieldset>
		<fieldset><legend>Contact Details</legend>
			<div class="row">
				<div class="col-md-6"> 
					<div class="form-group">
						<label for="User_address" class="control-label">Address</label>
						<textarea class="form-control" name="user_address" id="user_address" placeholder="Address"><?php echo (isset($user_rs['user_address'])) ? $user_rs['user_address'] : ""; ?></textarea>                    
					</div>
				</div><div class="col-md-6">
					<div class="form-group">
						<label for="user_city" class="control-label">City</label>                    
						<input type="text" class="form-control" name="user_city" id="user_city" placeholder="City" value="<?php echo (isset($user_rs['user_city'])) ? $user_rs['user_city'] : ""; ?>" />                    
					</div>
				</div></div>
			<div class="row">
				<div class="col-md-6"> 
					<div class="form-group">
						<label for="user_state" class="control-label">State</label>            
						<input type="text" class="form-control" id="user_state" name="user_state" placeholder="State" value="<?php echo (isset($user_rs['user_state'])) ? $user_rs['user_state'] : ""; ?>" />
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
						if ($user_rs['user_country'] == $value->country_id)
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
						<input type="text" class="form-control" id="user_zipcode" name="user_zipcode" placeholder="Zip/Postal code" value="<?php echo (isset($user_rs['user_zipcode'])) ? $user_rs['user_zipcode'] : ""; ?>" />
					</div>
				</div>
				<div class="col-md-6"> 
					<div class="form-group">
						<label for="user_contact" class="control-label"> Phone</label>            
						<input type="text" class="form-control" name="user_phone" id="user_phone" value="<?php echo (isset($user_rs['user_phone'])) ? $user_rs['user_phone'] : ""; ?>" />
					</div>
				</div>
			</div>
	</div>
	<div class="margin-top-10 ">        
		<input class="btn green" value="Save Changes" type="submit" id="btn_user_profile" />
		<button class="btn default" type="button">Cancel</button>
	</div>
</form>
            
		

<script>
jQuery(document).ready(function(){
//<![CDATA[
	jQuery('.reset_btn').click( function() {
		jQuery(".form-control").removeClass("error");
		jQuery(".form-control").val("");
		jQuery(".error_span").html('');
		return false;
	});
	var frm_user = jQuery("#frmuser"); 
	
	var user_name = jQuery("#user_name"); 
	function validate_user_name(){
		if(user_name.val() == ""){
			user_name.addClass("error");
			jQuery("#user_name_error").html('Please enter Full Name');
			return false;
		}else{
			user_name.removeClass("error");
			jQuery("#user_name_error").html('');
			return true;	
		}
	}
	user_name.blur(validate_user_name); 
	user_name.keyup(validate_user_name);  
	frm_user.submit(function(){ 
		if(validate_user_name()){ 
			return true;
		}else{
			return false;
		}	
	});
});
 //]]>
</script>
