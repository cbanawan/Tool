jQuery(document).ready(function() {
    $('.page-sidebar-menu .sub-menu li').click(function(){
        $('sub-menu li').find('.active').removeClass('active');
        $(this).addClass('active');
    });

});
function display_error(element, msg) {
    var span = $('<span />', {class: "help-block", text: msg});
    $(element).parent('div').addClass('has-error');
    $(element).after(span);
}

function check_title_validation(div, value, msg_to_display) {
    var title_pattern = /^[0-9a-zA-Z' '\-_\'\(\).!&@\#\$\%]+$/;
    if (title_pattern.test(value) == false) {
        display_error('#' + div, msg_to_display);        
        return true;
    }
    return false;
}

function set_toastr(title, msg, to_do, page_nav, to_redirect, is_click) {
    var shortCutFunction = to_do;
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "positionClass": "toast-top-center",
        "onclick": null,
        "showDuration": "1000",
        "hideDuration": "1000",
        "timeOut": "10000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "slideDown",
        "hideMethod": "slideUp"
    };
    if (is_click !== undefined) {
        toastr.options.onclick = function() {
            if (page_nav === 'redirect') {
                window.location = to_redirect;
            }
        };
    }
    toastr[shortCutFunction](msg, title);
    setTimeout(function() {
        if (page_nav == 'reload') {
            window.location.reload(true);
        }
        if (page_nav == 'redirect') {
            window.location = to_redirect;
        }
    }, 1500);
}

function initdatatable(table_id, source_url, params) {
    var oTable = jQuery('#' + table_id).dataTable({
        "bLengthChange": false,
        "sPaginationType": "bootstrap",
        "bFilter": false,
//            "sPageButtonActive": "paginate_current",
        "aaSorting": [],
        "sServerMethod": "POST",
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": source_url,
        "bDeferRender": true,
        "oLanguage": {
            "sEmptyTable": "No data available"
        },
        "fnServerData": function(sSource, aoData, fnCallback, oSettings) {
            if (params != undefined && params.length > 0) {
                for (var i = 0; i < params.length; i++) {
                    var json = params[i];
                    aoData.push({'name': json.name, 'value': $(json.value).val()});
                }
            }
            $.ajax({"dataType": 'json', "type": "POST", "url": source_url, "data": aoData, "success": fnCallback});
        },
        "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [0, -1] // <-- gets last column and turns off sorting
            }],
        "fnCreatedRow": function(nRow, aData, iDataIndex) {
//            var len = aData.length - 1;
            $(nRow).find('td:eq(' + 0 + ')').css('text-align', 'center');
//                $(nRow).find('td:eq(' + len + ')').css('text-align', 'center');
        },
        "fnDrawCallback": function(nRow) {
            if (nRow._iRecordsTotal > 1) {
                $(nRow).find('td:eq(' + 0 + ')').css('text-align', 'left');
            }
            if (nRow._iRecordsTotal <= nRow._iDisplayLength) {
                $(".dataTables_paginate").hide();
                $('#' + table_id + '_info').hide();
            } else {
                $(".dataTables_paginate").show();
                $('#' + table_id + '_info').show();
            }
        }
    });
//    $('#' + table_id + '_paginate').addClass('pagination');
//    $('#' + table_id + '_paginate').css('float', '');
//    var pagination = $('#' + table_id + '_paginate');
//    $(pagination).css('float', '');
//    $(".page-info").append($('#' + table_id + '_info'));
    check_all_none(table_id);
    return oTable;
}

function check_all_none(table_id) {
    jQuery('#' + table_id + ' .group-checkable').change(function() {
        var set = jQuery(this).attr("data-set");
        var checked = jQuery(this).is(":checked");
        jQuery(set).each(function() {
            if (checked) {
                $(this).attr("checked", true);
                $(this).parents('tr').addClass("active");
            } else {
                $(this).attr("checked", false);
                $(this).parents('tr').removeClass("active");
            }
        });
        jQuery.uniform.update(set);
    });

    jQuery('#' + table_id + ' tbody tr .checkboxes').change(function() {
        $(this).parents('tr').toggleClass("active");
    });
}