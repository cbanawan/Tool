jQuery(document).ready(function() {
	$('.page-sidebar-menu .active').removeClass('active');
    $('.page-sidebar-menu #company_profile').addClass('active');

    $('#company_countries').select2({
        placeholder: "Select Company Country",
        allowClear: true
    });

    $('#company_segment').select2({
        placeholder: "Select Company Segment",
        allowClear: true
    });

    $('#company_tag').tagsInput({
        width: 'auto',
		disable: 'disable',
        'onAddTag': function() {
            //alert(1);
        }
    });
    $('#company_panel_names').tagsInput({
        width: 'auto',
		
        'onAddTag': function() {
            //alert(1);
        }
    });
    /*if(c_cntry != undefined && c_cntry != "")
        $("#company_countries").select2("val", c_cntry);
    if(c_segment != undefined && c_segment != "")
        $("#company_segment").select2("val", c_segment);*/

    $('#frmCompany').find('.form-control').focusout(function() {
        check_validation($(this));
    });
    $('#btn_company_profile').click(function() {
        var error = false;
        $('#frmCompany').find('.form-control').each(function() {
            var flag = check_validation($(this));
            if (!flag)
                error = !flag;
        });
        if (error)
            return false;
        else {
            $('#hdn_company_country').val($('#company_countries').select2("val"));
            $('#hdn_company_segment').val($('#company_segment').select2("val"));
        }
    });
	$('img[id^="time-img_"]').live('click', function() {
		var val_id = $(this).attr('id').split("_")[1];
		if($('#time'+val_id).val() == 1){
			$('#time'+val_id).val(0);
			$(this).attr('src',base_url+'images/time'+val_id+'.png');
			$(this).removeClass('zone-active');
		} else {
			$('#time'+val_id).val(1);
			$(this).attr('src',base_url+'images/time'+val_id+'-active.png');
			$(this).addClass('zone-active');
		}
		
	});
	
});

function check_validation(element) {
    var zipcode_pattern = /^[0-9a-zA-Z-.]+$/;
    var alpha_regex = /^[a-zA-Z ]*$/;
//    var num_regex = /^[0-9]*$/;
    var phone_no_pattern = /^[0-9' '()-]+$/;
    var url_regex = /^(ht|f)tps?:\/\/[a-z0-9-\.]+\.[a-z]{2,4}\/?([^\s<>\#%"\,\{\}\\|\\\^\[\]`]+)?$/;
    var emailPattern = /^(([\w-]{1,})+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    var error = false;
    element.parent().removeClass('has-error');
    element.parent().find('span.help-block').remove();
    switch (element.attr('id')) {
        case "company_name":
            if ($.trim(element.val()) == '') {
                display_error('#' + element.attr('id'), 'Enter Company Name');
                error = true;
            }else if (check_title_validation(element.attr('id'), $.trim(element.val()), 'Allow only Alphanumeric,Space and Special Character(.!&@\#\$\%-_\(\)\')')) {
                error = true;
            }
            break;
        case "company_email":
//            if ($.trim(element.val()) == '') {
//                display_error('#' + element.attr('id'), 'Enter Company Email');
//                error = true;
//            } else 
                if ($.trim(element.val()) != "" && (!emailPattern.test($.trim(element.val())))) {
                display_error('#' + element.attr('id'), 'Enter valid Email');
                error = true;
            }
            break;
        case "company_type":
//            if ($.trim(element.val()) == '') {
//                display_error('#' + element.attr('id'), 'Select Company Type');
//                error = true;
//            }
            break;
        case "company_url":
			if ($.trim(element.val()) == '') {
				display_error('#' + element.attr('id'), 'Enter Url');
				error = true;
			}
/*			else 
                if (!url_regex.test($.trim(element.val()))) {
                display_error('#' + element.attr('id'), 'Enter Valid Url');
                error = true;
            }*/
            break;
        case "company_city":
            if ($.trim(element.val()) == '' || $.trim(element.val()) == 'Enter City') {
                display_error('#' + element.attr('id'), 'Enter City');
                error = true;
            } else if (!alpha_regex.test($.trim(element.val()))) {
                display_error('#' + element.attr('id'), 'Special Characters and numbers are not allowed');
                error = true;
            }
            break;
        case "company_state":
            if ($.trim(element.val()) == '') {
                display_error('#' + element.attr('id'), 'Enter State');
                error = true;
            } else if (!alpha_regex.test($.trim(element.val()))) {
                display_error('#' + element.attr('id'), 'Special characters and numbers are not allowed');
                error = true;
            }
            break;
        case "company_country":
            if($('#company_country').val() == ""){
               display_error("#" + element.attr('id'), 'Select Country');
                error = true; 
            }
            break;
        case "company_zip":
            if ($.trim(element.val()) == '' || $.trim(element.val()) == 'Enter Zipcode') {
                display_error("#" + element.attr('id'), 'Enter Zipcode');
                error = true;
            } else if (zipcode_pattern.test($.trim(element.val())) == false) {
                display_error("#" + element.attr('id'), 'Special characters (except . and -) are not allowed', '350px');
                error = true;
            }
            break;
        case "company_contact":
            if ($.trim(element.val()) == '') {
                display_error("#" + element.attr('id'), 'Enter Phone Number');
                error = true;
            } else if (phone_no_pattern.test($.trim(element.val())) == false) {
                display_error("#" + element.attr('id'), 'Enter Valid Phone Number');
                error = true;
            }
            break;
        case "company_segment":
//            if($('#company_segment').select2("val") == ""){
//               display_error("#" + element.attr('id'), 'Select Company Segment');
//                error = true; 
//            }
            break;
    }
    return !error;
}
