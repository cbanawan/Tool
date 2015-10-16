<?php
if ($conversation_bids && !empty($conversation_bids)) {
    ?>
    <table id="tbl_conv_detail_bids" class="table table-striped table-bordered table-advance table-hover">
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
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($conversation_bids as $conversation_bids) {
                $sub_bid_detail = $conversation_bids->sub_bid;
                $segment_delete = $conversation_bids->segment_delete;
                ?>
                <tr>
                    <td><?php echo $conversation_bids->company_name; ?></td>
                    <td><?php echo $conversation_bids->project_id . "_" . $conversation_bids->project_name; ?></td>
                    <td><?php echo $this->common_function->get_segment_format($conversation_bids->country_name, $project_segments[$conversation_bids->project_segments], $conversation_bids->segment_name, $conversation_bids->bid_status, $segment_delete->is_delete); ?></td>
                    <td><?php echo date(DATETIME_DISPLAY_FORMAT, strtotime($conversation_bids->bid_createddate)); ?></td>
                    <td align="center"><?php echo $conversation_bids->bid_cpc; ?></td>
                    <td align="center"><?php echo $conversation_bids->bid_ncomplete; ?></td>
                    <td align="center"><?php echo (intval($conversation_bids->bid_cpc) * intval($conversation_bids->bid_ncomplete)) + intval($conversation_bids->bid_setup_cost); ?></td>
                    <td align="center">
                        <a href="javascript:void(0);" class="btn purple" id="btn_seedetail_<?php echo $conversation_bids->project_id; ?>_<?php echo $conversation_bids->bid_id; ?>_<?php echo $conversation_bids->project_country_id; ?>" >See Detail</a>                        
                    </td>
                </tr>
                <tr style="display: none;" id="detail_container_<?php echo $conversation_bids->project_id; ?>_<?php echo $conversation_bids->bid_id; ?>">
                    <td colspan="8">
                        <div class="col-md-1"><strong>IR:</strong>
                            <span><?php echo $conversation_bids->project_ir; ?></span>
                        </div>                        
                        <div class="col-md-1"><strong>LOI:</strong>
                            <span><?php echo $conversation_bids->project_loi; ?></span>
                        </div>                        
                        <div class="col-md-2"><strong>Targets:</strong>
                            <span><?php echo $conversation_bids->project_target; ?></span>
                        </div>                        
                        <div class="col-md-3"><strong>Projet Note:</strong>
                            <span><?php echo $conversation_bids->project_external_note; ?></span>
                        </div>                        
                        <div id="detail_<?php echo $conversation_bids->project_id; ?>_<?php echo $conversation_bids->bid_id; ?>"><?php if ($conversation_bids->bid_status != 3) { ?> 
                                <div class="col-md-5">
                                    <?php
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
                                <div class="pull-right">
                                    <a href="javascript:void(0)" class="btn blue" id="add_bid_details_<?php echo $conversation_bids->bid_id; ?>">Reply</a>
                                </div>
                                <div class="clearfix"></div> 
                            <?php } ?>
                            <div id="add_bid_container_<?php echo $conversation_bids->bid_id; ?>" style="display: none;">
                                <form name="send_bid" action="<?php echo base_url('bids/send_bid'); ?>" method="post">
                                    <input type="hidden" class="form-control" id="project_id" name="project_id" value="<?php echo $conversation_bids->project_id; ?>"  />
                                    <input type="hidden" class="form-control" id="project_country_id" name="project_country_id" value="<?php echo $conversation_bids->project_country_id; ?>"  />
                                    <input type="hidden" class="form-control" id="researcher_id" name="researcher_id" value="<?php echo $conversation_bids->researcher_id; ?>"  />
                                    <input type="hidden" class="form-control" id="researcher_user_id" name="researcher_user_id" value="<?php echo $conversation_bids->researcher_user_id; ?>"  />
                                    <input type="hidden" class="form-control" id="bid_status" name="bid_status" value="1"  />
                                    <input type="hidden" class="form-control" id="is_read" name="is_read" value="0"  />					
                                    <input type="hidden" class="form-control" id="partner_id" name="partner_id" value="<?php echo $this->session->userdata('company_id'); ?>"  />
                                    <input type="hidden" class="form-control" id="partner_user_id" name="partner_user_id" value="<?php echo $this->session->userdata('user_id'); ?> "  />
                                    <div class="row">
                                        <div class="col-md-3"><?php echo $this->common_function->get_segment_format($conversation_bids->country_name, $project_segments[$conversation_bids->project_segments], $conversation_bids->segment_name, $conversation_bids->bid_status, ''); ?></div>
                                        <?php if ($conversation_bids->hide_cpc == 0) { ?>
                                            <div class="col-md-2"><strong>CPC</strong>
                                                <input type="text" class="form-control input-small" name="search_prj_cpc" placeholder="CPC" id="search_prj_cpc_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>" value="<?php echo $conversation_bids->bid_cpc; ?>"  />                                    
                                            </div>
                                        <?php } ?>
                                        <div class="col-md-2"><strong>N Complete</strong>
                                            <input type="text" class="form-control input-small" name="search_prj_ncomplete" placeholder="NComplete" id="search_prj_ncomplete_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>" value="<?php echo $conversation_bids->bid_ncomplete; ?>"  />
                                        </div>
                                        <div class="col-md-2" ><strong>Estimated Cost</strong><br/>
                                            <span id="estimated_cost_<?php echo $conversation_bids->project_country_id . '_' . $conversation_bids->partner_id; ?>"> <?php echo $conversation_bids->bid_cpc * $conversation_bids->bid_ncomplete; ?>  </span>
                                        </div>
                                        <!--                                    </div>
                                                                            <div class="row">-->
                                        <!--                                        <div class="col-md-3">
                                                                                    <input type="text" class="form-control" name="min_mgmnt_fee" id="min_mgmnt_fee" placeholder="Min. Management Fee" />
                                                                                </div>-->
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
                                        <div class="col-md-1 pull-right" style="margin-right: 25px;">
                                            <input class="btn green" value="Send" type="submit" id="fresh_bid_send" name="fresh_bid_send" />
                                        </div>
                                    </div>
                                </form>
                            </div>
                            <div class="clearfix"></div> 
                            <ul class="chats" style="margin-top: 10px;">
                                <?php
                                foreach ($sub_bid_detail as $sub_bid) {
                                    if (intval($sub_bid->bid_type) == 1) {
                                        $li_class = 'in';
                                        $bid_user_name = $sub_bid->bid_user;
                                        $company_detail = $sub_bid->company_detail;
                                        $bid_company_name = $company_detail['company_name'];
                                    } else {
                                        $li_class = 'out';
                                        $bid_user_name = $sub_bid->bid_user;
                                        $company_detail = $sub_bid->company_detail;
                                        $bid_company_name = $company_detail['company_name'];
                                    }
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
                                            ?>">at <?php echo date(DATETIME_DISPLAY_FORMAT, strtotime($sub_bid->bid_createddate)); ?></span>
                                            <span class="body" style="padding-top:5px;"><?php echo $this->common_function->get_segment_format($sub_bid->country_name, $project_segments[$sub_bid->project_segments], $sub_bid->segment_name, $sub_bid->bid_status, $segment_delete->is_delete); ?>&nbsp;&nbsp;CPC : <?php
                                                if ($sub_bid->hide_cpc)
                                                    echo '-';
                                                else
                                                    echo $sub_bid->project_cpc;
                                                ?>&nbsp;|&nbsp;N Complete : <?php echo $sub_bid->project_ncomplete; ?>&nbsp;|&nbsp;Estimated Cost : <?php
                                                if ($sub_bid->hide_cpc)
                                                    echo 'NA';
                                                else
                                                    echo ($sub_bid->project_cpc * $sub_bid->project_ncomplete) + $sub_bid->project_setup_cost;
                                                ?>&nbsp;|&nbsp;Setup Cost: <?php echo $sub_bid->project_setup_cost; ?>&nbsp;|&nbsp;Min. Project Cost: <?php echo $sub_bid->project_management_fee; ?><br /><?php echo $sub_bid->bid_comments; ?></span>
                                        </div>
                                    </li>
                                <?php } ?>
                            </ul>
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
    $(document).ready(function () {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#bids').addClass('active');
        $('#bids').find('.arrow').addClass('open');
        $.cookie.raw = true;
        $.cookie('sub_menu_sel', 'conversation', {doamian: base_url, path: "/"});
    });
</script>