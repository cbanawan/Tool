<ul class="nav nav-tabs" id="vendor_close_project">
    <li class="tablink active">
        <a href="#tab_approval" data-url="bids/get_approval_project" data-toggle="tab">Approval</a>
    </li>
    <li class="tablink">
        <a href="#tab_approved" data-url="bids/get_approved_project" data-toggle="tab">Approved</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active in" id="tab_approval">
       <?php $this->load->view('bids/close_projects_approval'); ?>
    </div>
    <div class="tab-pane fade" id="tab_approved">
        
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#bids').addClass('active');
        $('#bids').find('.arrow').addClass('open');
    });
</script>
