/*  
 * @Author: Priyanka Patel
 */
var oTable = null;
jQuery(document).ready(function () {
    /* Load tab content using ajax */
    $('#vendor_close_project').on('click', '.tablink a', function (e) {
        e.preventDefault();
        var url = $(this).attr("data-url");
        if (typeof url !== "undefined") {
            var pane = $(this), href = this.hash;
            $.ajax({
                url: base_url + url,
                data: {},
                type: 'POST',
                async: false,
                success: function (response) {
                    $(href).html(response);
                    pane.tab('show');
                }
            });
        }
    });

    $('.confirm_payment').live('click', function () {
        var project_id = $(this).attr('id').split("_")[2];
        var project_country_id = $(this).attr('id').split("_")[3];
        var cp_amount = $.trim($('#cp_amount_' + project_id + "_" + project_country_id).val());
        $.ajax({
            url: base_url + 'bids/confirm_payment',
            data: {
                project_id: project_id,
                project_country_id: project_country_id,
                amount: cp_amount
            },
            type: "post",
            success: function (response) {
//                response = $.parseJSON(response);
                if ($.trim(response) == 'success') {
                    $('#cp_amount_' + project_id + "_" + project_country_id).hide();
                    $(this).hide();
                    $('#cp_' + project_id + "_" + project_country_id).text(cp_amount);
                    set_toastr('', 'Amount Saved Successfully!', 'success');
                } else {
                    set_toastr('', 'Failed to Saved Amount!', 'error');
                }
            }
        });
    });
    $('.approve').live('click', function () {
//        var ele_id = $(this).attr('id').split("_");
        var project_id = $(this).attr('id').split("_")[2];
        var project_country_id = $(this).attr('id').split("_")[3];
        var conf = confirm("Are you really want to approve this project?");
        if (conf) {
            $.ajax({
                url: base_url + 'bids/approve_project',
                data: {project_id: project_id, project_country_id: project_country_id},
                type: "post",
                success: function (response) {
                    response = $.parseJSON(response);
                    if ($.trim(response.data) == 'success') {
                        $('#tr_approval_' + project_id + "_" + project_country_id).remove();
                        set_toastr('', 'Project Approved Successfully!', 'success');
                    } else {
                        set_toastr('', 'Failed to Approve Project!', 'error');
                    }
                }
            });
        }
    });

    $('a[id^="btn_seedetail_"]').live('click', function () {
        var project_id = $(this).attr('id').split("_")[2];
        var bid_id = $(this).attr('id').split("_")[3];
        var project_country_id = $(this).attr('id').split("_")[4];
        $('.detail_container').hide();
        $.ajax({
            url: base_url + 'projects/update_read_status',
            data: {project_id: project_id, project_country_id: project_country_id, is_researcher: 0},
            type: "post",
            success: function (response) {
            }
        });
        $('#detail_container_' + project_id + '_' + bid_id).toggle('slow');
        $('#reply_div').toggle('slow');
    });
    $('a[id^="add_bid_details_"]').live('click', function () {
        var bid_id = $(this).attr('id').split("_")[3];
        $('#add_bid_container_' + bid_id).show('slow');
    });
    $('a[id^="accept_bid_"]').live('click', function () {
        var bid_id = $(this).attr('id').split("_")[2];
        $.ajax({
            url: base_url + 'projects/accept_bid',
            data: {bid_id: bid_id},
            type: "post",
            success: function (response) {
                window.location.reload();
            }
        });
    });
    /*
     * datatable related functionality including expand / collapse
     * @type @call;jQuery@call;dataTable
     */
    oTable = jQuery('#tbl_fresh_bids').dataTable({
        "bLengthChange": false,
        bInfo: true,
        "bFilter": false,
        "bPaginate": true,
        "sPaginationType": "bootstrap",
        "aaSorting": [],
        "aoColumnDefs": [{
                "bSortable": false,
                "aTargets": [7, -1] // <-- gets last column and turns off sorting
            },
            {"bVisible": false, "aTargets": [8]
            }],
        "fnDrawCallback": function (nRow) {
            var div = '<div class="clearfix"></div>';
            $('.dataTables_paginate').after(div);
        }
    });

    $('#tbl_fresh_bids').on('click', ' tbody td .reply', function () {
        var nTr = $(this).parents('tr')[0];
        if (oTable.fnIsOpen(nTr))
        {
            /* This row is already open - close it */
            oTable.fnClose(nTr);
        }
        else
        {
            /* Open this row */
            var aData = oTable.fnGetData(nTr);
            var newTr = oTable.fnOpen(nTr, fnFormatDetails(aData), 'details');
            var len = aData.length;
            $(newTr).find('td:eq(0)').attr('colspan', len);
        }
    });

    function fnFormatDetails(aData)
    {
        var sOut = aData[aData.length - 1];
        return sOut;
    }
    /*
     * Conversation bid datatables
     * @type @call;jQuery@call;dataTable
     */
    var cTable = jQuery('#tbl_conv_bids').dataTable({
        "bLengthChange": false,
        bInfo: true,
        "bFilter": false,
        "bPaginate": true,
        "sPaginationType": "bootstrap",
        "aaSorting": [],
        "fnDrawCallback": function (nRow) {
            var div = '<div class="clearfix"></div>';
            $('.dataTables_paginate').after(div);
        }
    });


    $('input[id^="search_prj_cpc_"], input[id^="search_prj_ncomplete_"],input[id^="prj_setup_cost_"]').live('blur', function (e) {
        e.preventDefault();
        var project_country_id = $(this).attr('id').split("_")[3];
        var partner_id = $(this).attr('id').split("_")[4];
        var val_cps = $('#search_prj_cpc_' + project_country_id + '_' + partner_id).val();
        var val_ncomplete = $('#search_prj_ncomplete_' + project_country_id + '_' + partner_id).val();
        var val_setup_cost = $('#prj_setup_cost_' + project_country_id + '_' + partner_id).val();
        // alert(val_ncomplete);
        var e_cost = (val_cps * val_ncomplete) + parseFloat(val_setup_cost);
        $('#estimated_cost_' + project_country_id + '_' + partner_id).html(e_cost);

    });

    $('a[id^="show-close-sub-detail_"]').live('click', function () {
        var bid_id = $(this).attr('id').split("_")[1];
        var project_country_id = $(this).attr('id').split("_")[2];
        $('.show-sub-detail-tr').hide('slow');
        $('#show-sub-detail-tr_' + bid_id + "_" + project_country_id).show('slow');
    });
});