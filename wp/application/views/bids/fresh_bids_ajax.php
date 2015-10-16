<?php
if ($fresh_bids && !empty($fresh_bids)) {
    ?>
    
            <?php
            foreach ($fresh_bids as $conversation_bids) {
                $segment_delete = $conversation_bids->segment_delete;
                ?>
                <tr>
                    <td><?php echo $conversation_bids->company_name; ?></td>
                    <td><?php echo $conversation_bids->project_id . "_" . $conversation_bids->project_name; ?></td>
                    <td><?php echo $this->common_function->get_segment_format($conversation_bids->country_name, $project_segments[$conversation_bids->project_segments], $conversation_bids->segment_name, $conversation_bids->bid_status, $segment_delete->is_delete); ?></td>
                    <td><?php echo $conversation_bids->bid_createddate; ?></td>
                    <td><?php echo $conversation_bids->bid_cpc; ?></td>
                    <td><?php echo $conversation_bids->bid_ncomplete; ?></td>
                    <td><?php echo $conversation_bids->bid_cpc * $conversation_bids->bid_ncomplete; ?></td>
                    <td>
                        <a href="javascript:void(0)" class="btn blue reply" id="fresh_bid_reply_<?php echo $conversation_bids->bid_id; ?>">Reply</a>
                    </td>
                    <td><div style="margin:5px;" id="add_bid_container_<?php echo $conversation_bids->bid_id; ?>">
                            <form name="send_bid" action="<?php echo base_url('bids/send_bid'); ?>" method="post">
                                <input type="hidden" class="form-control" id="project_id" name="project_id" value="<?php echo $conversation_bids->project_id; ?>" />
                                <input type="hidden" class="form-control" id="project_country_id" name="project_country_id" value="<?php echo $conversation_bids->project_country_id; ?>"  />
                                <input type="hidden" class="form-control" id="researcher_id" name="researcher_id" value="<?php echo $conversation_bids->researcher_id; ?>"  />
                                <input type="hidden" class="form-control" id="researcher_user_id" name="researcher_user_id" value="<?php echo $conversation_bids->researcher_user_id; ?>"  />
                                <input type="hidden" class="form-control" id="bid_status" name="bid_status" value="1"  />
                                <input type="hidden" class="form-control" id="is_read" name="is_read" value="0"  />					
                                <input type="hidden" class="form-control" id="fresh_bid_id" name="fresh_bid_id" value="<?php echo $conversation_bids->bid_id; ?>"  />					
                                <input type="hidden" class="form-control" id="partner_id" name="partner_id" value="<?php echo $this->session->userdata('company_id'); ?>"  />
                                <input type="hidden" class="form-control" id="partner_user_id" name="partner_user_id" value="<?php echo $this->session->userdata('user_id'); ?>"  />
                                <div class="col-md-2"><?php echo $this->common_function->get_segment_format($conversation_bids->country_name, $project_segments[$conversation_bids->project_segments], $conversation_bids->segment_name, $conversation_bids->bid_status, ''); ?></div>
                                <?php if($conversation_bids->hide_cpc == 0){ ?>
                                <div class="col-md-2"><strong>CPC</strong>&nbsp;&nbsp;<label class="checkbox-inline">
                                        <input type="text" class="form-control input-small" name="search_prj_cpc" placeholder="CPC" id="search_prj_cpc_' . $bid_val->project_country_id . '_' . $bid_val->partner_id . '" value="<?php echo $conversation_bids->project_cpc; ?>"  />                                    
                                </div>
                                <?php } ?>
                                <div class="col-md-2"><strong>N Complete</strong>
                                    <input type="text" class="form-control input-small" name="search_prj_ncomplete" placeholder="NComplete" id="search_prj_ncomplete_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>" value="<?php echo $conversation_bids->project_ncomplete; ?>"  />
                                </div>
                                <div class="col-md-2" ><strong>Estimated Cost</strong><br/>
                                    <span id="estimated_cost_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id ?>">(<?php echo $conversation_bids->project_cpc * $conversation_bids->project_ncomplete; ?>)</span>
                                </div>
                                <div class="col-md-3">
                                    <textarea class="form-control" name="search_prj_comment" placeholder="Comment" id="search_prj_comment_<?php echo $conversation_bids->project_country_id; ?>" style="height:50px;"></textarea>
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