var oTable = null;
jQuery(document).ready(function() {	
	
    formmodified = 0;
    $('form *').change(function(){
        formmodified = 1;
    });
	window.onbeforeunload = confirmExit;
    function confirmExit() {
		if (formmodified == 1) {
			return "New information not saved. Do you wish to leave the page?";
		}
	}
	 $("input[type='submit']").click(function() {
        formmodified = 0;
    });
    var lastTab = $.cookie('last_tab');
    setTimeout(function() {
        if (lastTab) {
            $('#edit-project-nav .tablink .' + lastTab).trigger("click");
        }
    }, 10);
    /* Load tab content using ajax */
    $('#action_menu').on('click', 'li a', function(e) {
        if ($(this).attr('href') == "javascript:void(0)") {
            e.preventDefault();
            var id_arr = ['search_project', 'bid_replies', 'awareded_partners', 'closing_details'];
            if (id_arr.indexOf($(this).attr('id')) > -1) {
                $('#edit-project-nav .tablink .tab_' + $(this).attr('id')).trigger("click");
            }
        }
    });
    $('#edit-project-nav').on('click', '.tablink a', function(e) {
        e.preventDefault();
        var url = $(this).attr("data-url");
        console.log(url);
        if (typeof url !== "undefined") {
            var pane = $(this), href = this.hash;
            $.ajax({
                url: base_url + url,
                data: {'project_id': $('#pdetails').val()},
                type: 'POST',
                async: false,
                success: function(response) {
                    $(href).html(response);
                    $.cookie('last_tab', href.substring(1));
                    pane.tab('show');
                }
            });
        }
    });
    
	$('#close_project_btn').live('click', function() {
		var close_return = confirm("Are you sure do you want to close this project detail?");
		if (close_return == true) {
			var close_project_id = $('#close_project_id').val();
			var closing_date = $('#closing_date').val();
			var entry_type = $('#entry_type').val();
			var opt_for_closing_chk = $('#opt_for_closing').attr('checked');
			
			if(opt_for_closing_chk == 'checked') {
				opt_for_closing = 1;
			} else {
				opt_for_closing = 0;
			}
			
			$.ajax({
				url: base_url + 'projects/close_project',
				data: {close_project_id: close_project_id, closing_date: closing_date, opt_for_closing: opt_for_closing, entry_type:entry_type},
				type: "post",
				success: function(response) {
					if(opt_for_closing_chk != 'checked')  {
						$('.closing-detail-container').show();
					}
				}
			});
			
		} else {
            return false;
        }
	});	
	var frmProjectSegment = jQuery("#frmProjectSegment"); 
	var prj_detail_segment_name = jQuery("#prj_detail_segment_name"); 
	function validate_prj_detail_segment_name(){
		if(prj_detail_segment_name.val() == ""){
			prj_detail_segment_name.addClass("error");
			jQuery("#prj_detail_segment_name_error").html('Please enter Segment Name');
			return false;
		}else {
			prj_detail_segment_name.removeClass("error");
			jQuery("#prj_detail_segment_name_error").html('');
			return true;
		}
	}
	prj_detail_segment_name.blur(validate_prj_detail_segment_name); 
	prj_detail_segment_name.keyup(validate_prj_detail_segment_name);
	
	frmProjectSegment.submit(function(){ 
		if(validate_prj_detail_segment_name()){ 
			return true;
		}else{
			return false;
		}	
	});
var frmProjectFiles = jQuery("#frmProjectFiles"); 
	var project_file = jQuery("#project_file"); 
	var project_file_name = jQuery("#project_file_name"); 
	var project_file_description = jQuery("#project_file_description"); 
	function validate_project_file(){
		if(project_file.val() == ""){
			project_file.addClass("error");
			jQuery("#project_file_error").html('Please browse file');
			return false;
		}else {
			project_file.removeClass("error");
			jQuery("#project_file_error").html('');
			return true;
		}
	}
	project_file.blur(validate_project_file); 
	project_file.keyup(validate_project_file);
	function validate_project_file_name(){
		if(project_file_name.val() == ""){
			project_file_name.addClass("error");
			jQuery("#project_file_name_error").html('Please enter file name');
			return false;
		}else {
			project_file_name.removeClass("error");
			jQuery("#project_file_name_error").html('');
			return true;
		}
	}
	project_file_name.blur(validate_project_file); 
	project_file_name.keyup(validate_project_file);
	function validate_project_file_description(){
		if(project_file_description.val() == ""){
			project_file_description.addClass("error");
			jQuery("#project_file_description_error").html('Please enter file description');
			return false;
		}else {
			project_file_description.removeClass("error");
			jQuery("#project_file_description_error").html('');
			return true;
		}
	}
	project_file_description.blur(validate_project_file_description); 
	project_file_description.keyup(validate_project_file_description);
	
	frmProjectFiles.submit(function(){ 
		if(validate_project_file() & validate_project_file_name() & validate_project_file_description()){ 
			return true;
		}else{
			return false;
		}	
	});
$('a[id^="usd_"]').live('click', function() {
	var val_id = $(this).attr('id').split("_")[1];
	var partner_id = $(this).attr('id').split("_")[2];
	$('#partner-cost-rank_'+partner_id).val(val_id);
});
$('a[id^="show-close-sub-detail_"]').live('click', function() {
	var partner_id = $(this).attr('id').split("_")[1];
	$('.show-sub-detail-tr').hide('slow');
	$('#show-sub-detail-tr_'+partner_id).show('slow');
});
$('a[id^="str_"]').live('click', function() {
	var val_id = $(this).attr('id').split("_")[1];
	var partner_id = $(this).attr('id').split("_")[2];
	$('#partner-rank_'+partner_id).val(val_id);
});
$('a[id^="btn-close-partner"]').live('click', function() {
	var close_return = confirm("Thank you for providing feedback and total costs spend on this Partner for this study. It is essential that these number are correct. Are you sure it's all correct?");
	if (close_return == true) {
		
		/*var project_id = $(this).attr('id').split("_")[1];
		var partner_id = $(this).attr('id').split("_")[2];
		var project_country_id = $(this).attr('id').split("_")[3];
		var project_closing_id = $('#project_closing_id_'+partner_id).val();
		var project_cpc = $('#prj-close-cpc_'+partner_id).val();
		var project_ncomplete = $('#prj-close-ncomplete_'+partner_id).val();
		var project_estimated_cost = $('#prj-close-ecost_'+partner_id).val();
		var researcher_estimated_cost = $('#prj-close-cost_'+partner_id).val();
		
		var partner_cost_rank = 0;
		
		var bid_speed_rank = $('input[name=bid_speed_rank_'+partner_id+']:checked').val();
		var quality_rank = $('input[name=quality_rank_'+partner_id+']:checked').val();
		var value_rank = $('input[name=value_rank_'+partner_id+']:checked').val();
		var over_all_rank = $('input[name=over_all_rank_'+partner_id+']:checked').val();
		var partner_rank = $('input[name=over_all_rank_'+partner_id+']:checked').val();
		$.ajax({
			url: base_url + 'projects/close_project_detail',
			data: {project_id: project_id, partner_id: partner_id, project_country_id: project_country_id, project_cpc: project_cpc, project_ncomplete:project_ncomplete, project_estimated_cost:project_estimated_cost, researcher_estimated_cost:researcher_estimated_cost, partner_rank:partner_rank, partner_cost_rank:partner_cost_rank, project_closing_id:project_closing_id,bid_speed_rank:bid_speed_rank,quality_rank:quality_rank,value_rank:value_rank,over_all_rank:over_all_rank  },
			type: "post",
			success: function(response) {
				//alert(response);
				set_toastr('', 'Project close detail have been entered successfully', 'success');
				window.location.reload();
				
			}
		});*/
	}
});
$('#accept_bid_all').live('click', function() {
	bid_id = [];
	$('.accept_check_box').each(function() { //loop through each checkbox
		if(this.checked == true){		
			bid_id = $(this).val();
		}
	});
	if(bid_id == '') {
		alert("Select atleast one acceptable bid");
		return false;
	} else {
		$.ajax({
			url: base_url + 'projects/accept_bid',
			data: {bid_id: bid_id},
			type: "post",
			success: function(response) {
				//window.location.reload();
			}
		});
	}
	return false;
});
$('.checkbox1').live('click', function() {
	$('#cpc_everage').html('');
	$('#ncomplete_total').html('');
	$('#estimated_total').html('');
	var ncomplete_total = 0;
	var estimated_total = 0;
	$('.checkbox1').each(function() { //loop through each checkbox
		if(this.checked == true){		
			ncomplete_total += +$(this).parent().next().next().next().next().next().text();
			estimated_total += +$(this).parent().next().next().next().next().next().next().text();
		}
    });
	if (ncomplete_total >0 || estimated_total > 0 )
	{
		$('#ncomplete_total').html(ncomplete_total);
		$('#estimated_total').html(estimated_total);
		$('#cpc_everage').html((estimated_total / ncomplete_total).toFixed(2));
	}
});
$('#all_check_bid_replies').live('click', function() {
	$('#cpc_everage').html('');
	$('#ncomplete_total').html('');
	$('#estimated_total').html('');
	var ncomplete_total = 0;
	var estimated_total = 0;
	$('.checkbox1').each(function() { //loop through each checkbox
        this.checked = true;  //select all checkboxes with class "checkbox1"  		
		ncomplete_total += +$(this).parent().next().next().next().next().next().text();
		estimated_total += +$(this).parent().next().next().next().next().next().next().text();
    });
	$('#ncomplete_total').html(ncomplete_total);
	$('#estimated_total').html(estimated_total);
	$('#cpc_everage').html((estimated_total / ncomplete_total).toFixed(2));
});
$('a[id^="read_check_bid_replies_"]').live('click', function() {
//$( "#none_check_bid_replies" ).trigger( "click" );
	var project_id = $(this).attr('id').split("_")[4];
	$('#cpc_everage').html('');
	$('#ncomplete_total').html('');
	$('#estimated_total').html('');
	var ncomplete_total = 0;
	var estimated_total = 0;
	$.ajax({
		type: "POST",
		data: {
		"bid_status": "read", "project_id" : project_id 
		},
		url: base_url +"projects/filter_for_bid_replies",
		dataType: "json",
		success: function(JSONObject) {
			for (var key in JSONObject) {
				if (JSONObject.hasOwnProperty(key)) {
					$('#bidchk_'+JSONObject[key]).attr('checked',true); 
					ncomplete_total += +$('#bidchk_'+JSONObject[key]).parent().next().next().next().next().next().text();
					estimated_total += +$('#bidchk_'+JSONObject[key]).parent().next().next().next().next().next().next().text();
				}
			}
			$('#ncomplete_total').html(ncomplete_total);
			$('#estimated_total').html(estimated_total);
			$('#cpc_everage').html((estimated_total / ncomplete_total).toFixed(2));
		}
	});
});
$('a[id^="unread_check_bid_replies_"]').live('click', function() {
//$( "#none_check_bid_replies" ).trigger( "click" );
	var project_id = $(this).attr('id').split("_")[4];
	$('#cpc_everage').html('');
	$('#ncomplete_total').html('');
	$('#estimated_total').html('');
	var ncomplete_total = 0;
	var estimated_total = 0;
	
	$.ajax({
		type: "POST",
		data: {
		"bid_status": "unread", "project_id" : project_id 
		},
		url: base_url +"projects/filter_for_bid_replies",
		dataType: "json",
		success: function(JSONObject) {
			for (var key in JSONObject) {
				if (JSONObject.hasOwnProperty(key)) {
					$('#bidchk_'+JSONObject[key]).attr('checked',true); 
					ncomplete_total += +$('#bidchk_'+JSONObject[key]).parent().next().next().next().next().next().text();
					estimated_total += +$('#bidchk_'+JSONObject[key]).parent().next().next().next().next().next().next().text();
				}
			}
			$('#ncomplete_total').html(ncomplete_total);
			$('#estimated_total').html(estimated_total);
			$('#cpc_everage').html((estimated_total / ncomplete_total).toFixed(2));
		}
	});
});
$('a[id^="parnter_check_bid_replies_"]').live('click', function() {
	//$( "#none_check_bid_replies" ).trigger( "click" );
	var project_id = $(this).attr('id').split("_")[5];
	var partner_id = $(this).attr('id').split("_")[4];
	$('#cpc_everage').html('');
	$('#ncomplete_total').html('');
	$('#estimated_total').html('');
	var ncomplete_total = 0;
	var estimated_total = 0;
	
	$.ajax({
		type: "POST",
		data: {
		"bid_status": "partner", "partner_id" : partner_id, "project_id" : project_id 
		},
		url: base_url +"projects/filter_for_bid_replies",
		dataType: "json",
		success: function(JSONObject) {
			for (var key in JSONObject) {
				if (JSONObject.hasOwnProperty(key)) {
					$('#bidchk_'+JSONObject[key]).attr('checked',true); 
					ncomplete_total += +$('#bidchk_'+JSONObject[key]).parent().next().next().next().next().next().text();
					estimated_total += +$('#bidchk_'+JSONObject[key]).parent().next().next().next().next().next().next().text();
				}
			}
			$('#ncomplete_total').html(ncomplete_total);
			$('#estimated_total').html(estimated_total);
			$('#cpc_everage').html((estimated_total / ncomplete_total).toFixed(2));
		}
	});
});
$('a[id^="segment_check_bid_replies_"]').live('click', function() {
	//$( "#none_check_bid_replies" ).trigger( "click" );
	var project_id = $(this).attr('id').split("_")[5];
	var segment_id = $(this).attr('id').split("_")[4];
	$('#cpc_everage').html('');
	$('#ncomplete_total').html('');
	$('#estimated_total').html('');
	var ncomplete_total = 0;
	var estimated_total = 0;
	
	$.ajax({
		type: "POST",
		data: {
		"bid_status": "segment", "segment_id" : segment_id, "project_id" : project_id 
		},
		url: base_url +"projects/filter_for_bid_replies",
		dataType: "json",
		success: function(JSONObject) {
			for (var key in JSONObject) {
				if (JSONObject.hasOwnProperty(key)) {
					$('#bidchk_'+JSONObject[key]).attr('checked',true); 
					ncomplete_total += +$('#bidchk_'+JSONObject[key]).parent().next().next().next().next().next().text();
					estimated_total += +$('#bidchk_'+JSONObject[key]).parent().next().next().next().next().next().next().text();
				}
			}
			$('#ncomplete_total').html(ncomplete_total);
			$('#estimated_total').html(estimated_total);
			$('#cpc_everage').html((estimated_total / ncomplete_total).toFixed(2));
		}
	});
});
$('#none_check_bid_replies').live('click', function() {
	$('#cpc_everage').html('');
	$('#ncomplete_total').html('');
	$('#estimated_total').html('');
	$('.checkbox1').each(function() { //loop through each checkbox
        this.checked = false;  //select all checkboxes with class "checkbox1"               
    });
});
	$('a[id^="proj_edit_"]').live('click', function() {
		 var project_country_id = $(this).attr('id').split("_")[2];
		 $('.pr_info').css('display','inline');
		 $('.pr_input').css('display','none');
		 $('.proj_input_'+project_country_id).css('display','block');
		 $('#proj_update_'+project_country_id).css('display','inline');
		 $('#proj_cancel_'+project_country_id).css('display','inline');
		 $('#proj_edit_'+project_country_id).css('display','none');
		 $('a[id^="proj_status_'+project_country_id+'"]').css('display','none');
		 $('.proj_info_'+project_country_id).css('display','none');
	});
	$('a[id^="proj_cancel_"]').live('click', function() {
		 var project_country_id = $(this).attr('id').split("_")[2];
		 $('.proj_input_'+project_country_id).css('display','none');
		 $('#proj_update_'+project_country_id).css('display','none');
		 $('#proj_cancel_'+project_country_id).css('display','none');
		 $('#proj_edit_'+project_country_id).css('display','inline');
		 $('a[id^="proj_status_'+project_country_id+'"]').css('display','inline');
		 $('.proj_info_'+project_country_id).css('display','block');
	});
	$('input[id^="search_prj_cpc_"], input[id^="search_prj_ncomplete_"]').live('blur', function(e) {
		e.preventDefault();
		 var project_country_id = $(this).attr('id').split("_")[3];
		 var partner_id = $(this).attr('id').split("_")[4];
		 
		 var val_cps = $('#search_prj_cpc_'+project_country_id+'_'+partner_id).val();
		 var val_ncomplete = $('#search_prj_ncomplete_'+project_country_id+'_'+partner_id).val();
		// alert(val_ncomplete);
		var val_est_cost = val_cps * val_ncomplete ;
		if(val_est_cost % 1 == 0){
			val_est_cost = val_est_cost;	
		} else {
			val_est_cost = val_est_cost.toFixed(2)
		}
		$('#estimated_cost_'+project_country_id+'_'+partner_id).html(val_est_cost);
		 
	});
	$('a[id^="proj_status_"]').live('click', function() {
		var project_country_id = $(this).attr('id').split("_")[2];
		var project_status = $(this).attr('id').split("_")[3];
		if(project_status == 1) {
			var delete_return = confirm("Are you sure do you want to delete this project detail?");
		} else {
			var delete_return = confirm("Are you sure do you want to enable this project detail?");
		}
        
        if (delete_return == true) {
            
            $.ajax({
                url: base_url + 'projects/delete_project_country',
                data: {project_country_id: project_country_id,project_status: project_status},
                type: "post",
                success: function(response) {
                   
                        	if(project_status == 1) {
								set_toastr('', 'Project Detail Deleted Successfully!!', 'success');
								
								
							} else {
								set_toastr('', 'Project Detail enabled Successfully!!', 'success');
								
							}
                          window.location.reload();  
                       
                }
            });
        } else {
            //do nothing
        }
    });
	$('a[id^="show_prj_cty_detail_"]').live('click', function() {
		var project_partner_id = $(this).attr('id').split("_")[4];
		
		$('.search_prj_sub_detail').hide();
		$('#search_prj_sub_detail_'+project_partner_id).show('slow');
	});
	$('a[id^="add_bid_details_"]').live('click', function() {
		var bid_id = $(this).attr('id').split("_")[3];
		$('#add_bid_container_'+bid_id).show('slow');
	});
	$('a[id^="btn_seedetail_"]').live('click', function() {
		var project_id = $(this).attr('id').split("_")[2];
		var bid_id = $(this).attr('id').split("_")[3];
		var project_country_id = $(this).attr('id').split("_")[4];
		$('.detail_container').hide();
		$.ajax({
			url: base_url + 'projects/update_read_status',
			data: {project_id: project_id,project_country_id:project_country_id},
			type: "post",
			success: function(response) {
			}
		});
		
		$('#detail_container_'+project_id+'_'+bid_id).show('slow');
		
		$('#reply_div').show('slow');
	});
	$('a[id^="btn_awd_seedetail_"]').live('click', function() {
		var project_id = $(this).attr('id').split("_")[3];
		var bid_id = $(this).attr('id').split("_")[4];
		
		var project_country_id = $(this).attr('id').split("_")[5];
		$('.awd_detail_container').hide();
		$('#awd_detail_container_'+project_id+'_'+bid_id).show('slow');
		$('#awd_detail_'+project_id+'_'+bid_id).show('slow');
	});
	$('a[id^="accept_bid_"]').live('click', function() {
		var bid_id = $(this).attr('id').split("_")[2];
		$.ajax({
			url: base_url + 'projects/accept_bid',
			data: {bid_id: bid_id},
			type: "post",
			success: function(response) {
			window.location.reload();
			}
		});
		
	});
	$('a[id^="proj_update_"]').live('click', function() {
		var project_country_id = $(this).attr('id').split("_")[2];
		var edit_project_country = $('#edit_project_country_'+project_country_id).val();
		var edit_segment_name_attr = $('#edit_segment_name_'+project_country_id);
		var edit_project_segment = $('#edit_project_segment_'+project_country_id).val();
		var edit_project_ir = $('#edit_project_ir_'+project_country_id).val();
		var edit_project_loi = $('#edit_project_loi_'+project_country_id).val();
		var edit_project_cpc = $('#edit_project_cpc_'+project_country_id).val();
		var edit_project_ncomplete = $('#edit_project_ncomplete_'+project_country_id).val();
		var edit_segment_name = $('#edit_segment_name_'+project_country_id).val();
		var edit_project_target = $('#edit_project_target_'+project_country_id).val();
		
		if(edit_segment_name == ""){
			edit_segment_name_attr.addClass("error");
			jQuery("#edit_segment_name_"+project_country_id+"_error").html('Please enter Segment Name');
			return false;
		}else {
			edit_segment_name_attr.removeClass("error");
			jQuery("#edit_segment_name_"+project_country_id+"_error").html('');
			$.ajax({
				url: base_url + 'projects/update_project_country',
				data: {project_country_id: project_country_id,
					country_id: edit_project_country,
					segment_name: edit_segment_name,
					project_segments: edit_project_segment,
					project_ir: edit_project_ir,
					project_loi: edit_project_loi,
					project_cpc: edit_project_cpc,
					project_ncomplete: edit_project_ncomplete,
					project_target: edit_project_target
					
					},
				type: "post",
				success: function(response) {
				   
							set_toastr('', 'Project Detail has been updated Successfully!!', 'success');
							window.location.reload();
						
					
				}
			});
		}
    });
    /* Load tab content using ajax */
  /*  $('#action_menu').on('click', 'li a', function(e) {
	if ($(this).attr('href') == "javascript:void(0)") {
        e.preventDefault();
        var id_arr = ['search_partner', 'bid_replies', 'awarede_partners', 'closing_details'];
        if (id_arr.indexOf($(this).attr('id')) > -1) {
            $('#edit-project-nav .tablink .tab_'+$(this).attr('id')).trigger("click");
        }
		}
    });
	$('#edit-project-nav').on('click', '.tablink a', function(e) {
        e.preventDefault();
        var url = $(this).attr("data-url");
        if (typeof url !== "undefined") {
            var pane = $(this), href = this.hash;
            $.ajax({
                url: base_url + url,
                data: {'project_id': $('#pdetails').val()},
                type: 'POST',
                async: false,
                success: function(response) {
                    $(href).html(response);
                    pane.tab('show');
                }
            });
        } else {
//            $(this).tab('show');
        }
    });
*/
    $('.page-sidebar-menu .active').removeClass('active');
    $('.page-sidebar-menu #projects').addClass('active');
    $('#edit-project-nav li:first').addClass('active');

    $('.project_target').tagsInput({
        width: 'auto'
    });
	$('a[id^="link_file_"]').live('click', function() {
        var delete_return = confirm("Are you sure do you want to delete this project file?");
        if (delete_return == true) {
            var project_file_id = $(this).attr('id').split("_")[2];
			var project_file = $('#del_project_file_'+project_file_id).val();
			var project_id = $('#del_project_id_'+project_file_id).val();
            $.ajax({
                url: base_url + 'projects/delete_project_file',
                data: {project_file_id: project_file_id, project_file:project_file, project_id:project_id},
                type: "post",
                success: function(response) {
                    if (response)
                    {
                        if (response == 'success') {
							$('#prj_file_'+project_file_id).remove();
                            set_toastr('', 'Project File has been deleted Successfully!!', 'success');
						}
					}
				}
            });
        } else {
            //do nothing
        }
    });
$('a[id^="rmvProject_"]').live('click', function() {
        var delete_return = confirm("Are you sure do you want to active this project?");
        if (delete_return == true) {
            var project_id = $(this).attr('id').split("_")[1];
            $.ajax({
                url: base_url + 'projects/delete_project',
                data: {project_id: project_id},
                type: "post",
                success: function(response) {
                    if (response)
                    {
                        if ($.trim(response) == 'success') {
                            if (oTable != null) {
								 oTable.fnReloadAjax();
                                set_toastr('', 'Project has been actived Successfully!!', 'success');
                            }
                        } else {
                            set_toastr('', 'There is some problem in inactive project', 'error');
                        }
                    }
                }
            });
        } else {
            //do nothing
        }
    });
$('a[id^="updProject_"]').live('click', function() {
        var delete_return = confirm("Are you sure do you want to inactive this project?");
        if (delete_return == true) {
            var project_id = $(this).attr('id').split("_")[1];
            $.ajax({
                url: base_url + 'projects/update_project_status',
                data: {project_id: project_id},
                type: "post",
                success: function(response) {
                    if (response)
                    {
                        if ($.trim(response) == 'success') {
                          if (oTable != null) {
                                var row = $('#updProject_' + project_id).closest("tr").get(0);
								 oTable.fnReloadAjax();
                                 set_toastr('', 'Project has been actived successfully!!', 'success');
                            }
						 
                        
                        } else {
                            set_toastr('', 'There is some problem inactive project', 'error');
                        }
                    }
                }
            });
        } else {
            //do nothing
        }
    });
    $('a[id^="cloneProject_"]').live('click', function() {
        var clone_return = confirm("Are you sure do you want to clone this project?");
        if (clone_return == true) {
            var project_id = $(this).attr('id').split("_")[1];
            $.ajax({
                url: base_url + 'projects/clone_project',
                data: {project_id: project_id},
                type: "post",
                success: function(response) {
                    if (response)
                    {
                        
                            if (oTable != null) {
                                oTable.fnReloadAjax();
                                set_toastr('', 'Project has been cloned Successfully!!', 'success');
                            }
                       
                    }
                }
            });
        } else {
            //do nothing
        }

    });

    var params = new Array();
    oTable = initdatatable('project_lists', base_url + 'projects/get_all_projects', params);

    $('#frmProject').find('.form-control').focusout(function() {
        check_validation($(this));
    });
    $('#edit-project').live('click', function() {
        $('.show_detail').hide('slow');
        $('.show_form').show('slow');
        $('#edit_prj_detail').hide('slow');
    });
   $('a[id^="edit_project_"]').live('click', function() {   
        $.removeCookie('last_tab');
    });
    $('#btn_project').live('click', function() {
        var error = false;
        $('#frmProject').find('.form-control').each(function() {
            var flag = check_validation($(this));
            if (!flag)
                error = !flag;
        });
        if (error)
            return false;
        else {
            var pc = $('#project_countries').select2("val");
            $('#hdn_project_country').val(pc);
            for (var i = 0; i < pc.length; i++) {
                $('#hdn_project_segments_' + pc[i]).val($('#project_segments_' + pc[i]).select2("val"));
            }
            $('#hdn_project_segments').val($('#project_segments').select2("val"));
        }
    });
	$('#btn_save_search').live('click', function() {
        var error = false;
        $('#frmProject').find('.form-control').each(function() {
            var flag = check_validation($(this));
            if (!flag)
                error = !flag;
        });
        if (error)
            return false;
        else {
			var project_name =  $('#project_name').val();
			var project_internal_note =  $('#project_internal_note').val();
			var project_id =  $('#project_id').val();
			var company_id =  $('#company_id').val();
			var project_external_note =  $('#project_external_note').val();
			var sub_srch_partner =  'yes';
            $.ajax({
				url: base_url + 'projects/update_project_master',
				data: {project_name: project_name,
					company_id: company_id,
					project_id: project_id,
					project_internal_note: project_internal_note,
					project_external_note: project_external_note,
					sub_srch_partner: sub_srch_partner
					},
				type: "post",
				success: function(response) {
						if (response == 'success') {
							set_toastr('', 'Project has been updated Successfully!!', 'success');
							$('#edit-project-nav .tablink .tab_search_project').trigger("click");
							
						} else {
							//set_toastr('', 'There is some problem in update project detail', 'error');
						}
					
				}
			});
			
        }
    });
    $('#cancel_project').live('click', function() {
        $('#edit_prj_detail').hide('slow');
    });
    $('#cancel_project_files').live('click', function() {
        $('#add_files_detail').hide('slow');
		
    });
     
    $('#add_project_details').live('click', function() {
        $('#edit_prj_detail').show('slow');
		$('#add_files_detail').hide('slow');
    });
	$('#add_project_files').live('click', function() {
        $('#add_files_detail').show('slow');
		$('#edit_prj_detail').hide('slow');
    });

    $('#project_countries').select2({
        placeholder: "Select Project Country",
        allowClear: true
    }).on("select2-removed", function(e){
	
	       $('.pc_'+e.val).remove();
	}).on("select2-selecting", function(e) {        	
        create_dynamic_fields(e.val);
    });
	
    
});

function create_dynamic_fields(country_id){
//console.log(cntry_arr);
$.each(cntry_arr,function(k,v){
if(v.id == country_id){
country_name = v.name;
}
});
        $('#dummy').find('legend').text(country_name);
        $('#dummy').find('.project_ir').attr('id', 'project_ir_' + country_id);
        $('#dummy').find('.project_loi').attr('id', 'project_loi_' + country_id);
        $('#dummy').find('.project_cpc').attr('id', 'project_cpc_' + country_id);
        $('#dummy').find('.project_ncomplete').attr('id', 'project_ncomplete_' + country_id);
        $('#dummy').find('.project_segments').attr('id', 'project_segments_' + country_id);
        $('#dummy').find('.hdn_project_segments').attr('id', 'hdn_project_segments_' + country_id);
        $('#dummy').find('.project_target').attr('id', 'project_target_' + country_id);
		//$('#dummy').addClass('pc_'+country_id);
		$('#dummy').find('fieldset').addClass('pc_'+country_id);
        var clone_code = $('#dummy').html();        
        //console.log(clone_code);
        $('#project_extra_detail').append(clone_code);
        $('#project_segments_' + country_id).select2({
            placeholder: "Select Project Segment",
            allowClear: true
        });
        $('#project_target_' + country_id).tagsInput({
            width: 'auto'
        });$('#edit_project_target_' + country_id).tagsInput({
            width: 'auto'
        });
}

function check_validation(element) {
    var digit_pattern = /^[0-9]+$/;
    var float_digit_pattern = /^[0-9.]+$/;
    var error = false;
    element.parent().removeClass('has-error');
    element.parent().find('span.help-block').remove();
    switch (element.attr('id')) {
        case "project_name":
            if ($.trim(element.val()) == '') {
                display_error('#' + element.attr('id'), 'Enter Project Name');
                error = true;
            } else if (check_title_validation(element.attr('id'), $.trim(element.val()), 'Allow only Alphanumeric,Space and Special Character(.!&@\#\$\%-_\(\)\')')) {
                error = true;
            }
            break;
        case "project_ir":
            if ($.trim(element.val()) == '') {
                display_error("#" + element.attr('id'), 'Enter Project IR');
                error = true;
            } else if (digit_pattern.test($.trim(element.val())) == false) {
                display_error("#" + element.attr('id'), 'Enter Valid IR');
                error = true;
            }
            break;
        case "project_loi":
            if ($.trim(element.val()) == '') {
                display_error("#" + element.attr('id'), 'Enter Project LOI');
                error = true;
            } else if (digit_pattern.test($.trim(element.val())) == false) {
                display_error("#" + element.attr('id'), 'Enter Valid LOI');
                error = true;
            }
            break;
        case "project_cpc":
            if ($.trim(element.val()) == '') {
                display_error("#" + element.attr('id'), 'Enter Project CPC');
                error = true;
            } else if (float_digit_pattern.test($.trim(element.val())) == false) {
                display_error("#" + element.attr('id'), 'Enter Valid CPC');
                error = true;
            }
            break;
        case "project_ncomplete":
            if ($.trim(element.val()) == '') {
                display_error("#" + element.attr('id'), 'Enter Project No. Of Complete');
                error = true;
            } else if (digit_pattern.test($.trim(element.val())) == false) {
                display_error("#" + element.attr('id'), 'Enter Valid No. Of Complete');
                error = true;
            }
            break;
        case "project_segments":
            if ($('#project_segments').val() == "") {
                display_error("#" + element.attr('id'), 'Select Project Segment');
                error = true;
            }
            break;
        case "project_countries":
            if ($('#project_countries').val() == "") {
                display_error("#" + element.attr('id'), 'Select Project countries');
                error = true;
            }
            break;
        case "project_target_tag":
            console.log($('span.tag').length);
            if ($('#project_target_tagsinput span.tag').length == 0) {
                display_error("#" + element.attr('id'), 'Please enter target');
                error = true;
            }
            break;
    }
    return !error;
}

function search_project() {
    $.ajax({
        "method": "POST",
        "url": base_url + 'projects/do_search',
        "data": $('#frm_project_search').serializeArray(),
        "success": function(response) {
            $('#project_search_result').html(response);
        }
    });
}
