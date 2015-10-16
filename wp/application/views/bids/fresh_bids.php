<?php
if ($fresh_bids && !empty($fresh_bids)) {
    ?>
    <div class="table-responsive">
        <table id="tbl_fresh_bids" class="table table-striped table-bordered table-advance table-hover dataTable">
            <thead>
                <tr>
                    <th>Researcher</th>
                    <th>Project Name</th>
                    <th>Segment Name</th>
                    <th>Date</th>
                    <th>CPC</th>
                    <th>Ncomplete</th>
                    <th>Estimated Cost</th>
                    <th>Action</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($fresh_bids as $conversation_bids) {
                    $segment_delete = $conversation_bids->segment_delete;
                    ?>
                    <tr>
                        <td><?php echo $conversation_bids->company_name; ?></td>
                        <td><?php echo $conversation_bids->project_id . "_" . $conversation_bids->project_name; ?></td>
                        <td><?php echo $this->common_function->get_segment_format($conversation_bids->country_name, $project_segments[$conversation_bids->project_segments], $conversation_bids->segment_name, $conversation_bids->bid_status, $segment_delete->is_delete); ?></td>
                        <td><?php echo $conversation_bids->bid_createddate; ?></td>
                        <td align="center">
                            <?php if ($conversation_bids->hide_cpc) { ?>
                                --
                            <?php } else { ?>
                                <?php echo $conversation_bids->bid_cpc; ?>
                            <?php } ?>                
                        </td>
                        <td align="center"><?php echo $conversation_bids->bid_ncomplete; ?></td>
                        <td align="center">
                            <?php if ($conversation_bids->hide_cpc) { ?>
                                NA
                            <?php } else { ?>
                                <?php echo (intval($conversation_bids->bid_cpc) * intval($conversation_bids->bid_ncomplete)) + intval($conversation_bids->bid_setup_cost); ?>
                            <?php } ?>                                   
                        </td>
                        <td align="center">
                            <a href="javascript:void(0)" class="btn btn-xs blue reply tooltip" data-original-title="Reply" id="fresh_bid_reply_<?php echo $conversation_bids->bid_id; ?>">
                                <i class="fa fa-reply"></i> Reply</a>
                        </td>
                        <td><div style="margin:5px;" id="add_bid_container_<?php echo $conversation_bids->bid_id; ?>">
                                <div class="row">
                                    <div class="col-md-1"><strong>IR:</strong>
                                        <span><?php echo $conversation_bids->project_ir; ?></span>
                                    </div>                        
                                    <div class="col-md-2"><strong>LOI:</strong>
                                        <span><?php echo $conversation_bids->project_loi; ?></span>
                                    </div>                        
                                    <div class="col-md-2"><strong>Targets:</strong>
                                        <span><?php echo $conversation_bids->project_target; ?></span>
                                    </div>                        
                                    <div class="col-md-3"><strong>Projet Note:</strong>
                                        <span><?php echo $conversation_bids->project_external_note; ?></span>
                                    </div>                        
                                    <div class="col-md-3"><strong>Comment:</strong>
                                        <span><?php echo $conversation_bids->bid_comments; ?></span>
                                    </div>                        
                                    <div id="detail_<?php echo $conversation_bids->project_id; ?>_<?php echo $conversation_bids->bid_id; ?>"><?php if ($conversation_bids->bid_status != 3) { ?> 
                                            <div class="col-md-5">
                                                <?php
                                                $projects_file_detail = $conversation_bids->projects_file_detail;
                                                $f = 0;
                                                if (isset($projects_file_detail) && !empty($projects_file_detail)) {
                                                    foreach ($projects_file_detail as $file_val) {
                                                        $f++;
                                                        ?>
                                                        <span class="prj-block-display" id="prj_file_<?php echo $file_val['project_file_id']; ?>">
                                                            <i class="fa fa-file"></i>
                                                            <input type="hidden" value="<?php echo $file_val['project_file']; ?>" name="del_project_file" id="del_project_file_<?php echo $file_val['project_file_id']; ?>">
                                                            <input type="hidden" value="<?php echo $file_val['project_id']; ?>" name="del_project_id" id="del_project_id_<?php echo $file_val['project_file_id']; ?>"><?php echo $f; ?>&nbsp;<strong><a href="<?php echo base_url(UPLOAD . 'projects/' . $file_val['project_id'] . '/' . $file_val['project_file']); ?>" target ="_blank"><?php echo $file_val['project_file_name']; ?></a></strong>&nbsp;&nbsp;<?php echo $file_val['project_file_description']; ?>                                       
                                                        </span>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </div>
                                        <?php } ?>
                                    </div>    
                                </div>
                                <div style="margin-top: 10px;"> 
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
                                        <div class="row">
                                            <div class="col-md-2"><?php echo $this->common_function->get_segment_format($conversation_bids->country_name, $project_segments[$conversation_bids->project_segments], $conversation_bids->segment_name, $conversation_bids->bid_status, ''); ?></div>
                                            <div class="col-md-2"><strong>CPC</strong>&nbsp;&nbsp;
                                                <input type="text" class="form-control input-small" name="search_prj_cpc" placeholder="CPC" id="search_prj_cpc_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>" value="<?php
                                                if ($conversation_bids->hide_cpc) {
                                                    echo "";
                                                } else {
                                                    echo $conversation_bids->project_cpc;
                                                }
                                                ?>"  />                                    
                                            </div>
                                            <div class="col-md-2"><strong>N Complete</strong>
                                                <input type="text" class="form-control input-small" name="search_prj_ncomplete" placeholder="NComplete" id="search_prj_ncomplete_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>" value="<?php echo $conversation_bids->project_ncomplete; ?>"  />
                                            </div>
                                            <div class="col-md-2" ><strong>Estimated Cost</strong><br/>
                                                <span id="estimated_cost_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id ?>">
                                                    <?php
                                                    if ($conversation_bids->hide_cpc) {
                                                        echo "NA";
                                                    } else {
                                                        echo $conversation_bids->project_cpc * $conversation_bids->project_ncomplete;
                                                    }
                                                    ?></span>
                                            </div>
                                            <div class="col-md-3">
                                                <textarea class="form-control" name="search_prj_comment" placeholder="Comment" id="search_prj_comment_<?php echo $conversation_bids->project_country_id; ?>" style="height:50px;"></textarea>
                                            </div> 
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <strong>Project Minimum Fee</strong>
                                                <input type="text" class="form-control input-small" name="prj_management_fee" placeholder="Project Management Fee" id="prj_management_fee_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>" value="<?php echo $conversation_bids->project_management_fee; ?>"  />
                                            </div>
                                            <div class="col-md-2">
                                                <strong>Setup Cost</strong>
                                                <input type="text" class="form-control input-small" name="prj_setup_cost" placeholder="Project Setup Cost" id="prj_setup_cost_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>" value="<?php echo $conversation_bids->project_setup_cost; ?>"  />
                                            </div>
                                            <div class="col-md-5">
                                                <strong>Fee Type</strong> 
                                                <div class="radio-list">
                                                    <?php
                                                    foreach ($fee_type as $key => $value) {
                                                        $str = "";
                                                        if (($conversation_bids->bid_fee_type == 0 && $key == ONLY_THIS_SEGMENT) || ($key == $conversation_bids->bid_fee_type)) {
                                                            $str = 'checked';
                                                        }
                                                        ?>
                                                        <label class="radio-inline"><input type="radio" name="fee_type" id="<?php echo $value; ?>" value="<?php echo $key; ?>" <?php echo $str; ?>><?php echo trim($value); ?></label>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                            <div class="col-md-1" style="padding-left: 10px;">
                                                <input class="btn green send" value="Send" type="submit" id="fresh_bid_send" name="fresh_bid_send" />
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
            <!--                <tr style="display: none;" id="fresh_bid_reply_container_<?php echo $conversation_bids->bid_id; ?>">
                        <td colspan="7">
                            <div id="add_bid_container_<?php echo $conversation_bids->bid_id; ?>">
                                <form name="send_bid" action="<?php echo base_url('bids/send_bid'); ?>" method="post">
                                    <input type="hidden" class="form-control" id="project_id" name="project_id" value="<?php echo $conversation_bids->project_id; ?>"  />
                                    <input type="hidden" class="form-control" id="project_country_id" name="project_country_id" value="<?php echo $conversation_bids->project_country_id; ?>"  />
                                    <input type="hidden" class="form-control" id="researcher_id" name="researcher_id" value="<?php echo $conversation_bids->researcher_id; ?>"  />
                                    <input type="hidden" class="form-control" id="bid_status" name="bid_status" value="1"  />
                                    <input type="hidden" class="form-control" id="is_read" name="is_read" value="1"  />					
                                            <input type="hidden" class="form-control" id="partner_id" name="partner_id" value="<?php echo $this->session->userdata('company_id'); ?>"  />
                                    <input type="hidden" class="form-control" id="partner_user_id" name="partner_user_id" value="<?php echo $this->session->userdata('user_id'); ?> "  />
                                    <div class="col-md-2"><?php echo $this->common_function->get_segment_format($conversation_bids->country_name, $project_segments[$conversation_bids->project_segments], $conversation_bids->segment_name, $conversation_bids->bid_status, ''); ?></div>
                                    <div class="col-md-2"><strong>CPC</strong>&nbsp;&nbsp;<label class="checkbox-inline"><input type="checkbox" name="search_prj_hide_cpc" value="1">Hide CPC</label>
                                        <input type="text" class="form-control input-small" name="search_prj_cpc" placeholder="CPC" id="search_prj_cpc_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>" value="<?php echo $conversation_bids->project_cpc; ?>"  />                                    
                                    </div>
                                    <div class="col-md-2"><strong>N Complete</strong>
                                        <input type="text" class="form-control input-small" name="search_prj_ncomplete" placeholder="NComplete" id="search_prj_ncomplete_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>" value="<?php echo $conversation_bids->project_ncomplete; ?>"  />
                                    </div>
                                    <div class="col-md-2" ><strong>Estimated Cost</strong><br/>
                                        <span id="estimated_cost_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>"> <?php echo $conversation_bids->project_cpc * $conversation_bids->project_ncomplete; ?>  </span>
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
                    </tr>-->
                <?php } ?>
            </tbody>
        </table>
    </div>
<?php } else { ?>
    <div class="alert alert-info">
        <strong>Empty!</strong> No Bids Found.
    </div>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function () {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#bids').addClass('active');
        $('#bids').find('.arrow').addClass('open');        
    });
</script>