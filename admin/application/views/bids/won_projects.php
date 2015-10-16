<?php
if ($won_bids && !empty($won_bids)) {
    foreach ($won_bids as $b) {
        ?>
        <div class="portfolio-block" style="margin-top:15px;">
            <div class="col-md-3">
                <div class="portfolio-text">
                    <div class="portfolio-text-info">
                        <h4><?php echo $b->project_name; ?></h4>
                        <p>
                            <?php echo $b->project_external_note; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="portfolio-text">
                    <div class="portfolio-text-info" style="margin-top: 10px;">
                        Company Name: <span> <?php echo $b->company_name; ?></span>
        <!--                        <p style="word-wrap: break-word;"><?php echo $b->bid_comments; ?></p>  -->
                    </div>
                </div>
            </div>
            <?php if ($b->hide_cpc == 0) { ?>
                <div class="col-md-3 portfolio-stat">
                    <div class="portfolio-info">
                        Project CPC
                        <span><?php echo $b->project_cpc; ?></span>
                    </div>
                </div>
            <?php } ?>
            <!--            <div class="col-md-3">
                            <div class="" style="margin-top: 10px;">        
                                <a style="margin-left: 7px;" class="btn blue pull-right" href="#" data-toggle="modal" data-target="#"><span>Reply</span></a>        
                            </div>
                        </div>-->
        </div>         
        <?php
    }
}
?>