<ul class="nav nav-tabs" id="vendor_close_project">
    <li class="tablink active">
        <a href="#tab_fb" data-toggle="tab">Fresh Bids</a>
    </li>
    <li class="tablink">
        <a href="#tab_conv" data-toggle="tab">Conversation</a>
    </li>
    <li class="tablink">
        <a href="#tab_wp" data-toggle="tab">Won Projects</a>
    </li>
    <li class="tablink">
        <a href="#tab_cd" data-toggle="tab">Closing Details</a>
    </li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active in" id="tab_fb">
       <?php $this->load->view('bids/tabs/tab_fb'); ?>
    </div>
    <div class="tab-pane fade in" id="tab_conv">
        <?php $this->load->view('bids/tabs/tab_conv'); ?>
    </div>
    <div class="tab-pane fade  in" id="tab_wp">
        <?php $this->load->view('bids/tabs/tab_wp'); ?>
    </div>
    <div class="tab-pane fade  in" id="tab_cd">
        <?php $this->load->view('bids/tabs/tab_cd'); ?>
    </div>
</div>
<script type="text/javascript">
    jQuery(document).ready(function () {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#manage_projects').addClass('active');                
    });
</script>