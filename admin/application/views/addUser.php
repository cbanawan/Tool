<div class="col-md-8 ">
	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet box green ">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-reorder"></i> Add User
			</div>
		</div>
		<div class="portlet-body form">
			<form class="form-horizontal" role="form" action="<?php echo base_url('/manageUser/insert_user')?>" id="frm-user" method="post">
				<div class="form-body">
					<div class="form-group">
						<label class="col-md-3 control-label">Full Name</label>
						<div class="col-md-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-font"></i>
								</span>
								<input type="text" class="form-control" name="user_name" id="user_name" placeholder="Full Name">
							</div>
							<span class="help-block error_span" id="user_name_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">User Name</label>
						<div class="col-md-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-user"></i>
								</span>
								<input type="text" class="form-control " placeholder="User Name" name="user_login" id="user_login">
							</div>
							<span class="help-block error_span" id="user_login_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Email Address</label>
						<div class="col-md-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-envelope"></i>
								</span>
								<input type="email" class="form-control" placeholder="Email Address" name="user_email" id="user_email">
							</div>
							<span class="help-block error_span" id="user_email_error"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Password</label>
						<div class="col-md-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-lock"></i>	
								</span>
								<input class="form-control " type="password" placeholder="Password" name="user_password" id="user_password" autocomplete="off">
							</div><span id="user_password_error" class="help-block error_span"></span>
						</div>
					</div>
					<div class="form-group">
						<label class="col-md-3 control-label">Confirm Password</label>
						<div class="col-md-9">
							<div class="input-group">
								<span class="input-group-addon">
									<i class="fa fa-check"></i>
								</span>
								<input class="form-control" type="password" placeholder="Confirm Password" name="user_confirm_password" id="user_confirm_password" autocomplete="off">
							</div><span id="user_confirm_password_error" class="help-block error_span"></span>
						</div>
					</div>
				</div>
				<div class="form-actions fluid">
					<div class="col-md-offset-3 col-md-9">
						<button type="submit" class="btn green">Submit</button>
						<button type="reset" class="btn default reset_btn">Cancel</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>
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
	var user_login = jQuery("#user_login"); 
	function validate_user_login(){
		if(user_login.val() == ""){
			user_login.addClass("error");
			jQuery("#user_login_error").html('Please enter User Name');
			return false;
		} else {
			var login_flag = '';
			jQuery.ajax({
				type: "POST",
				url: "<?php echo base_url('login/load_check_user_login'); ?>",
				data: "user_login=" + user_login.val(),
				async: false,
				success : function(response){
					if(response == "success")   {
						user_login.removeClass("error");
						jQuery("#user_login_error").html('');
						login_flag = true;
					}  else   {
						user_login.addClass("error");
						jQuery("#user_login_error").html('User Login is already exists');
						login_flag = false;
					}
					//console.log(response);
				}
			});
			return login_flag;
		}
	}
	user_login.blur(validate_user_login); 
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
			jQuery("#user_email_error").html('Please enter email');
			return false; 
		} else if(!emailReg.test(user_email.val())) { 
			user_email.addClass("error");
			jQuery("#user_email_error").html('Please enter valid email');
			return false;
		} else {
			user_email.removeClass("error");
			jQuery("#user_email_error").html('');
			return true;
		}
	}
	user_email.blur(validate_user_email); 
	user_email.keyup(validate_user_email);
	
	frm_user.submit(function(){ 
		if(validate_user_login() & validate_user_name() & validate_user_email() & validate_user_password() & validate_user_confirm_password()){ 
			return true;
		}else{
			return false;
		}	
	});
});
 //]]>
</script>