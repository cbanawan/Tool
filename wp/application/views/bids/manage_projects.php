<div class="table-responsive">
    <table class="table table-bordered table-hover" id="vendor_project_lists">
        <thead>
            <tr>
                <th style="width:10px;">ID</th>
                <th style="width:245px;">Name</th>
                <th>Date</th>
                <th>Created By</th>
                <th>Status</th>                
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
    jQuery(document).ready(function () {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#manage_projects').addClass('active');
        
        var params = new Array();
        var vpTable = initdatatable('vendor_project_lists', base_url + 'bids/get_all_vendor_projects', params);
    });
</script>