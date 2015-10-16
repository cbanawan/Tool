jQuery(document).ready(function(){
//<![CDATA[
var frm_signup = jQuery("#frm-signup"); 
var frm_login = jQuery("#frm-login"); 
	var company_name = jQuery("#company_name"); 
	function validate_company_name(){
		if(company_name.val() == ""){
			company_name.addClass("error");
			jQuery("#company_name_error").html('Please enter Company Name');
			return false;
		}else{
			var flag = '';
			jQuery.ajax({
				type: "POST",
				url: jQuery("#theme_url").val()+"/ajax_company_username.php",
				data: "company_name=" + company_name.val(),
				async: false,
				success : function(response){
					if(response == "success")   {
						company_name.removeClass("error");
						jQuery("#company_name_error").html('');
						flag = true;
					}  else   {
						company_name.addClass("error");
						jQuery("#company_name_error").html('Company Name is already exists');
						flag = false;
					}	
					
				}
			});
			return flag;
		}
	}
	company_name.blur(validate_company_name); 
	var user_name = jQuery("#user_name"); 
	function validate_user_name(){
		if(user_name.val() == ""){
			user_name.addClass("error");
			jQuery("#user_name_error").html('Please enter User Name');
			return false;
		} else {
			var flag = '';
			jQuery.ajax({
				type: "POST",
				url: jQuery("#theme_url").val()+"/ajax_company_username.php",
				data: "user_name=" + user_name.val(),
				async: false,
				success : function(response){
					if(response == "success")   {
						user_name.removeClass("error");
						jQuery("#user_name_error").html('');
						flag = true;
					}  else   {
						user_name.addClass("error");
						jQuery("#user_name_error").html('User Name is already exists');
						flag = false;
					}	
				}
			});
			return flag;
		}
	}
	user_name.blur(validate_user_name); 
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
	
	frm_signup.submit(function(){ 
		if(validate_company_name() & validate_user_name() & validate_user_email() & validate_user_password() & validate_user_confirm_password()){ 
			return true;
		}else{
			return false;
		}	
	});
	
	
	var login_user_name = jQuery("#login_user_name"); 
	var login_user_password = jQuery("#login_user_password"); 
	function validate_login_user_name(){
		if(login_user_name.val() == "" && login_user_password.val()){
			jQuery("#login_msg_error").html('Please enter User Name / Password');
			return false;
		} else {
			var flag = '';
			jQuery.ajax({
				type: "POST",
				url: jQuery("#theme_url").val()+"/ajaxlogin_username.php",
				data: "login_user_name=" + login_user_name.val() +"&login_user_password=" + login_user_password.val(),
				async: false,
				success : function(response){
					if(response == "success")   {
						jQuery("#login_msg_error").html('');
						flag = true;
					}  else   {
						jQuery("#login_msg_error").html('Enter valid User Name / Paasword');
						flag = false;
					}	
				}
			});
			return flag;
		}
	}
	frm_login.submit(function(){ 
		if(validate_login_user_name()){ 
			return true;
		}else{
			return false;
		}	
	});
});
 //]]>
