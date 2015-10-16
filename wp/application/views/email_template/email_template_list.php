<div class="table-responsive">
    <table class="table table-bordered table-hover" id="email_template_lists">
        <thead>
            <tr>
                <th class="table-checkbox">
                    <input type="checkbox" class="group-checkable" data-set="#email_template_lists .checkboxes"/>
                </th>                
                <th>Shortcode</th>
                <th>Subject</th>
                <th>Actions</th>
            </tr>
        </thead>        
    </table>
</div>
<div class="row">        
    <div class="col-md-12">
    <div class="page-info"></div>                        
    </div>
</div>
<script type="text/javascript">
    var oTable = null;
jQuery(document).ready(function () {
	$('.page-sidebar-menu .active').removeClass('active');
    $('.page-sidebar-menu #email-template').addClass('active');
    var params = new Array();
    oTable = initdatatable('email_template_lists', base_url + 'email_template/get_all_email_template', params);
    $('a[id^="rmvTemplate_"]').live('click', function() {
        var delete_return = confirm("Are you sure do you want to delete this template?");
        if (delete_return == true) {
            var email_template_id = $(this).attr('id').split("_")[1];
            $.ajax({
                url: base_url + 'email_template/delete_email_template',
                data: {email_template_id: email_template_id},
                type: "post",
                success: function(response) {
                    if (response)
                    {
                        if (response == 'success') {
                            if (oTable != null) {
                                var row = $('#rmvTemplate_' + email_template_id).closest("tr").get(0);
                                oTable.fnDeleteRow(oTable.fnGetPosition(row));
                                set_toastr('', 'Email Template Deleted Successfully!!', 'success');
                            }
                        } else {
                            set_toastr('', 'There is some problem in delete email template', 'error');
                        }
                    }
                }
            });
        } else {
            //do nothing
        }
    });
});
</script>
