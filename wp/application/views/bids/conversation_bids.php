<?php if ($conversation_bids && !empty($conversation_bids)) { ?>
    <table id="tbl_conv_bids" class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th>Researcher</th>
                <th>Project Name</th>   
                <th>Date</th>    
            </tr>
        </thead>
        <tbody>
            <?php foreach ($conversation_bids as $conversation_bids) { ?>
                <tr>
                    <td><?php echo $conversation_bids->company_name; ?></td>
                    <td><a href="<?php echo base_url('bids/conversation_bid_details/' . $conversation_bids->project_long_key); ?>">
                            <?php echo $conversation_bids->project_id . "_" . $conversation_bids->project_name; ?>
                        </a></td>                
                    <td><?php echo date(DATE_DISPLAY_FORMAT,strtotime($conversation_bids->bid_createddate)); ?></td>                
                </tr>       
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="alert alert-info">
        <strong>Empty!</strong> No Bids Found.
    </div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#bids').addClass('active');
        $('#bids').find('.arrow').addClass('open');
    });
</script>