<?php
if ($conversation_bids && !empty($conversation_bids)) {
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
            foreach ($conversation_bids as $bid_val) {
                $sub_bid_detail = $bid_val->sub_bid;
                $segment_delete = $bid_val->segment_delete;
//                if ($bid_val->bid_type == 1) {
//                    $sub_bid_detail = $CI->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->researcher_id,false);
//                } else {
//                    $sub_bid_detail = $CI->mdl_project->get_project_sub_bid($bid_val->project_id, $bid_val->partner_id, true);
//                }
//                $segment_delete = $CI->mdl_project->check_project_country_delete($bid_val->project_country_id);
                ?>
                <tr>
                    <td><?php echo $bid_val->company_name; ?></td>
                    <td><?php echo $this->common_function->get_segment_format($bid_val->country_name, $project_segments[$bid_val->project_segments], $bid_val->segment_name, $bid_val->bid_status, $segment_delete->is_delete); ?></td>
                    <td><?php echo $bid_val->bid_createddate; ?></td>
                    <td><?php echo $bid_val->project_cpc; ?></td>
                    <td><?php echo $bid_val->project_ncomplete; ?></td>
                    <td><?php echo $bid_val->project_cpc * $bid_val->project_ncomplete; ?></td>
                    <td>
                        <a href="javascript:void(0);" class="btn purple" id="btn_seedetail_<?php echo $bid_val->project_id; ?>_<?php echo $bid_val->bid_id; ?>_<?php echo $bid_val->project_country_id; ?>" >See Detail</a>
                        <?php if ($bid_val->bid_status != 3) { ?> &nbsp;&nbsp;<a href="javascript:void(0)" class="btn green" id="accept_bid_<?php echo $bid_val->bid_id; ?>">Accept</a><?php } ?>
                    </td>
                </tr>
                <tr style="display: none;" id="detail_container_<?php echo $bid_val->project_id; ?>_<?php echo $bid_val->bid_id; ?>">
                    <td colspan="7">
                        <div id="detail_<?php echo $bid_val->project_id; ?>_<?php echo $bid_val->bid_id; ?>"><?php if ($bid_val->bid_status != 3) { ?> <div class="pull-right clearfix"><a href="javascript:void(0)" class="btn blue" id="add_bid_details_<?php echo $bid_val->bid_id; ?>">Reply</a>&nbsp;&nbsp;</div><div class="clearfix"></div> <?php } ?>
                            <ul class="chats clearfix">
                                <?php
                                foreach ($sub_bid_detail as $sub_bid) {                                                                  
                                    if (intval($sub_bid->bid_type) == 1) {
                                        $li_class = 'in';
//                                        $bid_user_name = $CI->user_modal->get_user($sub_bid->researcher_user_id);
//                                        $company_detail = $CI->mdl_company->get_company_detail($sub_bid->researcher_id);
                                        $bid_user_name = $sub_bid->bid_user;
                                        $company_detail = $sub_bid->company_detail;
                                        $bid_company_name = $company_detail['company_name'];
                                    } else {
                                        $li_class = 'out';
//                                        $bid_user_name = $CI->user_modal->get_user($sub_bid->partner_user_id);
//                                        $company_detail = $CI->mdl_company->get_company_detail($sub_bid->partner_id);
                                         $bid_user_name = $sub_bid->bid_user;
                                        $company_detail = $sub_bid->company_detail;
                                        $bid_company_name = $company_detail['company_name'];
                                    }
//                                    $segment_delete = $CI->mdl_project->check_project_country_delete($bid_val->project_country_id);
                                    ?>
                                    <li class="<?php echo $li_class; ?>" >
                                        <div class="message" style="<?php
                                        if ($sub_bid->is_read == 0) {
                                            echo 'font-weight:bold;';
                                        }
                                        ?>">
                                            <span class="arrow"></span>
                                            <a href="javascript:void(0);" class="name" style="<?php
                                            if ($sub_bid->is_read == 0) {
                                                echo 'font-weight:bold;';
                                            }
                                            ?>"><?php echo $bid_user_name['user_name'] . ' @ ' . $bid_company_name; ?></a>
                                            <span class="datetime" style="<?php
                                            if ($sub_bid->is_read == 0) {
                                                echo 'font-weight:bold;';
                                            }
                                            ?>">at <?php echo $sub_bid->bid_createddate; ?></span>
                                            <span class="body" style="padding-top:5px;"><?php echo $this->common_function->get_segment_format($sub_bid->country_name, $project_segments[$sub_bid->project_segments], $sub_bid->segment_name, $sub_bid->bid_status, $segment_delete->is_delete); ?>&nbsp;&nbsp;CPC : <?php echo $sub_bid->project_cpc; ?>&nbsp;|&nbsp;N Complete : <?php echo $sub_bid->project_ncomplete; ?>&nbsp;|&nbsp;Estimated Cost : <?php echo $sub_bid->project_cpc * $sub_bid->project_ncomplete; ?><br /><?php echo $sub_bid->bid_comments; ?></span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
                            <div id="add_bid_container_<?php echo $bid_val->bid_id; ?>" style="display: none;">
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
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function() {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#bids').addClass('active');
        $('#bids').find('.arrow').addClass('open');
    });
</script>