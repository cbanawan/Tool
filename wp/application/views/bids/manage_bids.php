<div class="row">
    <div class="col-md-3">
        <ul class="ver-inline-menu tabbable margin-bottom-10">
            <li class="active">
                <a data-toggle="tab" href="#tab_1-1">
                    <i class="fa fa-gavel"></i> Fresh Bids </a>
                <span class="after">
                </span>
            </li>
            <li>
                <a data-toggle="tab" href="#tab_2-2"><i class="fa fa-reply"></i> Bid Replies</a>
            </li>
            <!--            <li>
                            <a data-toggle="tab" href="#tab_3-3"><i class="fa fa-cogs"></i> Process</a>
                        </li>            -->
            <li>
                <a data-toggle="tab" href="#tab_4-4"><i class="fa fa-won"></i> Won Projects</a>
            </li>            
        </ul>
    </div>
    <div class="col-md-9">
        <div class="tab-content">
            <div id="tab_1-1" class="tab-pane active">
                <?php $this->load->view('bids/fresh_bids'); ?>
            </div>
            <div id="tab_2-2" class="tab-pane">
                <?php $this->load->view('bids/bid_replies'); ?>
            </div>
            <!--            <div id="tab_3-3" class="tab-pane">
                            Process
                        </div>-->
            <div id="tab_4-4" class="tab-pane">
                <?php $this->load->view('bids/won_bids'); ?>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#bids').addClass('active');
        $('#bids').find('.arrow').addClass('open');
    });
</script>
