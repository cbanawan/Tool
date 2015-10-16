<?php
if ($fresh_bids && !empty($fresh_bids)) {
//    $CI = & get_instance();
    ?>
    <table class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th>Researcher</th>
                <th>Segment Name</th>
                <th>Date</th>
                <th>CPC</th>
                <th>Ncomplete</th>
                <th>Estimated Cost</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($fresh_bids as $bid_val) {
                $segment_delete = $bid_val->segment_delete;
                ?>
                <tr>
                    <td><?php echo $bid_val->company_name; ?></td>
                    <td><?php echo $this->common_function->get_segment_format($bid_val->country_name, $project_segments[$bid_val->project_segments], $bid_val->segment_name, $bid_val->bid_status, $segment_delete->is_delete); ?></td>
                    <td><?php echo $bid_val->bid_createddate; ?></td>
                    <td><?php echo $bid_val->project_cpc; ?></td>
                    <td><?php echo $bid_val->project_ncomplete; ?></td>
                    <td><?php echo $bid_val->project_cpc * $bid_val->project_ncomplete; ?></td>
                    <td>
                        <a href="javascript:void(0)" class="btn blue" id="fresh_bid_reply_<?php echo $bid_val->bid_id; ?>">Reply</a>
                    </td>
                </tr>
                <tr style="display: none;" id="fresh_bid_reply_container_<?php echo $bid_val->bid_id; ?>">
                    <td colspan="7">
                        <div id="add_bid_container_<?php echo $bid_val->bid_id; ?>">
                            <form name="send_bid" action="<?php echo base_url('bids/send_bid'); ?>" method="post">
                                <input type="hidden" class="form-control" id="project_id" name="project_id" value="<?php echo $bid_val->project_id; ?>"  />
                                <input type="hidden" class="form-control" id="project_country_id" name="project_country_id" value="<?php echo $bid_val->project_country_id; ?>"  />
                                <input type="hidden" class="form-control" id="researcher_id" name="researcher_id" value="<?php echo $bid_val->researcher_id; ?>"  />
                                <input type="hidden" class="form-control" id="bid_status" name="bid_status" value="1"  />
                                <input type="hidden" class="form-control" id="is_read" name="is_read" value="0"  />					
<!--                                <input type="hidden" class="form-control" id="partner_id" name="partner_id" value="<?php echo $this->session->userdata('company_id'); ?>"  />
                                <input type="hidden" class="form-control" id="partner_user_id" name="partner_user_id" value="<?php echo $this->session->userdata('user_id'); ?> "  />-->
                                <div class="col-md-2"><?php echo $this->common_function->get_segment_format($bid_val->country_name, $project_segments[$bid_val->project_segments], $bid_val->segment_name, $bid_val->bid_status, ''); ?></div>
                                <div class="col-md-2"><strong>CPC</strong>&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" name="search_prj_hide_cpc" value="1">Hide CPC</label>
                                    <input type="text" class="form-control input-small" name="search_prj_cpc" placeholder="CPC" id="search_prj_cpc_<?php echo $bid_val->project_country_id . '_' . $bid_val->partner_id; ?>" value="<?php echo $bid_val->project_cpc; ?>"  />                                    
                                </div>
                                <div class="col-md-2"><strong>N Complete</strong>
                                    <input type="text" class="form-control input-small" name="search_prj_ncomplete" placeholder="NComplete" id="search_prj_ncomplete_<?php echo $bid_val->project_country_id . '_' . $bid_val->partner_id; ?>" value="<?php echo $bid_val->project_ncomplete; ?>"  />
                                </div>
                                <div class="col-md-2" ><strong>Estimated Cost</strong><br/>
                                    <span id="estimated_cost_<?php echo $bid_val->project_country_id . '_' . $bid_val->partner_id; ?>"> <?php echo $bid_val->project_cpc * $bid_val->project_ncomplete; ?>  </span>
                                </div>
                                <div class="col-md-3">
                                    <textarea class="form-control" name="search_prj_comment" placeholder="Comment" id="search_prj_comment_<?php echo $bid_val->project_country_id; ?>" style="height:50px;"></textarea>
                                </div>                                
                                <div class="col-md-1">
                                    <input class="btn green" value="Send" type="submit" id="fresh_bid_send" name="fresh_bid_send" />
                                </div>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
<?php
//if ($fresh_bids && !empty($fresh_bids)) {
// foreach ($fresh_bids as $bid_val) {
//                $segment_delete = $CI->mdl_project->check_project_country_delete($bid_val->project_country_id);
?>
<!--        <div class="portfolio-block" style="margin-top:15px;">
            <div class="col-md-3">
                <div class="portfolio-text">
                    <div class="portfolio-text-info">
                        <h4><?php echo $bid_val->project_name; ?></h4>
                        <p>
<?php echo $bid_val->project_external_note; ?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="portfolio-text">
                    <div class="portfolio-text-info" style="margin-top: 10px;">
                        Company Name: <span> <?php echo $bid_val->company_name; ?></span>
                        <p style="word-wrap: break-word;"><?php echo $bid_val->bid_comments; ?></p>  
                    </div>
                </div>
            </div>
<?php if ($bid_val->hide_cpc == 0) { ?>
                                    <div class="col-md-3 portfolio-stat">
                                        <div class="portfolio-info">
                                            Project CPC
                                            <span><?php echo $bid_val->project_cpc; ?></span>
                                        </div>
                                    </div>
<?php } ?>
            <div class="col-md-3">
                <div class="" style="margin-top: 10px;">        
                    <a style="margin-left: 7px;" class="btn blue pull-right" href="#" data-toggle="modal" data-target="#"><span>Reply</span></a>
                            <a class="btn green pull-right" href="#"  data-toggle="modal" data-target="#"><span>Accept</span></a>
                </div>
            </div>
        </div>         -->
<?php
//    }
//}
?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#bids').addClass('active');
        $('#bids').find('.arrow').addClass('open');
    });
</script>