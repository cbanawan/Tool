		
<form class="horizontal-form" role="form" action="<?php echo base_url('/users/insert_user')?>" id="frm-user" method="post">
	<div class="form-body">
	<fieldset><legend>Basic Details</legend>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class=" control-label required_field">Full Name</label>
					<input type="text" class="form-control" name="user_name" id="user_name" placeholder="Full Name">
					<span class="help-block error_span" id="user_name_error"></span>
				</div>
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label required_field">Email Address</label>
					<input type="email" class="form-control" placeholder="Email Address" name="user_email" id="user_email">
					<span class="help-block error_span" id="user_email_error"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				<div class="form-group">
					<label class=" control-label required_field">Password</label>
					<input class="form-control " type="password" placeholder="Password" name="user_password" id="user_password" autocomplete="off">
					<span id="user_password_error" class="help-block error_span"></span>
				</div>		
			</div>
			<div class="col-md-6">
				<div class="form-group">
					<label class="control-label required_field">Confirm Password</label>
					<input class="form-control" type="password" placeholder="Confirm Password" name="user_confirm_password" id="user_confirm_password" autocomplete="off">
					<span id="user_confirm_password_error" class="help-block error_span"></span>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">            
				<div class="form-group">
					<label for="user_designation" class="control-label">Title /Position</label>                  
					<input type="text" class="form-control" id="user_designation" name="user_designation" placeholder="Title /Position" value="" />
				</div>
			</div>
		</div>
		</fieldset>
		<fieldset><legend>Contact Details</legend>
			<div class="row">
				<div class="col-md-6"> 
					<div class="form-group">
						<label for="User_address" class="control-label">Address</label>
						<textarea class="form-control" name="user_address" id="user_address" placeholder="Address"></textarea>                    
					</div>
				</div><div class="col-md-6">
					<div class="form-group">
						<label for="user_city" class="control-label">City</label>                    
						<input type="text" class="form-control" name="user_city" id="user_city" placeholder="City" value="" />                    
					</div>
				</div></div>
			<div class="row">
				<div class="col-md-6"> 
					<div class="form-group">
						<label for="user_state" class="control-label">State</label>            
						<input type="text" class="form-control" id="user_state" name="user_state" placeholder="State" value="" />
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
						?>
						<option value="<?php echo $value->country_id; ?>" ><?php echo $value->country_name; ?></option>
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
						<input type="text" class="form-control" id="user_zipcode" name="user_zipcode" placeholder="Zip/Postal code" value="" />
					</div>
				</div>
				<div class="col-md-6"> 
					<div class="form-group">
						<label for="user_contact" class="control-label"> Phone</label>            
						<input type="text" class="form-control" name="user_phone" id="user_phone" value="" />
					</div>
				</div>
			</div>
	</div>
	</fieldset>
		<div class="form-actions fluid">
			<div class="col-md-offset-3 col-md-9">
				<button type="submit" class="btn green">Submit</button>
				<button type="reset" class="btn default reset_btn">Cancel</button>
		</div>
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
	var frm_user = jQuery("#frm-user"); 
	var user_password = jQuery("#user_password"); 
	function validate_user_password(){
		if(user_password.val() == ""){
			user_password.addClass("error");
			jQuery("#user_password_error").html('Please enter Password');
			return false;
		}else{
			user_password.removeClass("error");
			jQuery("#user_password_error").html('');
			return true;	
		}
	}
	user_password.blur(validate_user_password); 
	user_password.keyup(validate_user_password);  
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
	var user_confirm_password = jQuery("#user_confirm_password"); 
	function validate_user_confirm_password(){
		if(user_confirm_password.val() == "" || user_confirm_password.val() != user_password.val()){
			user_confirm_password.addClass("error");
			jQuery("#user_confirm_password_error").html('Please confirm your Password');
			return false;
		} else {
			user_confirm_password.removeClass("error");
			jQuery("#user_confirm_password_error").html('');
			return true;	
		}
	}
	user_confirm_password.blur(validate_user_confirm_password); 
	user_confirm_password.keyup(validate_user_confirm_password);  
	var user_email = jQuery("#user_email"); 
	function validate_user_email(){
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(user_email.val() == "") { 
			user_email.addClass("error");
			jQuery("#user_email_error").html("Please enter email");
			return false; 
		} else if(!emailReg.test(user_email.val())) { 
			user_email.addClass("error");
			jQuery("#user_email_error").html("Please enter valid email");
			return false;
		} else {
			var login_flag = '';
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url('login/load_check_user_email'); ?>",
				data: "user_email=" + user_email.val(),
				async: false,
				success : function(response){
					if(response == "success")   {
						user_email.removeClass("error");
						jQuery("#user_email_error").html("");
						login_flag = true;
					}  else   {
						user_email.addClass("error");
						jQuery("#user_email_error").html("Your email already exists.");
						login_flag = false;
					}
				}
			});
			return login_flag;
		}
	}
	user_email.blur(validate_user_email); 
	user_email.keyup(validate_user_email);
	
	frm_user.submit(function(){ 
		if(validate_user_name() & validate_user_email() & validate_user_password() & validate_user_confirm_password()){ 
			return true;
		}else{
			return false;
		}	
	});
});
 //]]>
</script>
