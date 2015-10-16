<?php
if ($project_detail && !empty($project_detail)) {
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
            foreach ($project_detail as $row) {
                $sub_bid_detail = $row->sub_bid;
                $segment_delete = $row->segment_delete;
                ?>
                <tr>
                    <td><?php echo $row->company_name; ?></td>
                    <td><?php echo $row->project_id . "_" . $row->project_name; ?></td>
                    <td><?php echo $this->common_function->get_segment_format($row->country_name, $project_segments[$row->project_segments], $row->segment_name, $row->bid_status, $segment_delete->is_delete); ?></td>
                    <td><?php echo date(DATETIME_DISPLAY_FORMAT, strtotime($row->bid_createddate)); ?></td>
                    <td align="center"><?php echo $row->bid_cpc; ?></td>
                    <td align="center"><?php echo $row->bid_ncomplete; ?></td>
                    <td align="center"><?php echo (intval($row->bid_cpc) * intval($row->bid_ncomplete)) + intval($row->bid_setup_cost); ?></td>
                    <td align="center">
                        <a href="javascript:void(0);" class="btn purple" id="btn_seedetail_<?php echo $row->project_id; ?>_<?php echo $row->bid_id; ?>_<?php echo $row->project_country_id; ?>" >See Detail</a>                        
                        <?php if ($row->partner_approved == 0) { ?>
                            <a href="javascript:void(0);" class="btn green approve" id="btn_approve_<?php echo $row->project_id; ?>_<?php echo $row->bid_id; ?>_<?php echo $row->project_country_id; ?>" >Approve</a>                        
                        <?php } ?>
                    </td>
                </tr>
                <tr style="display: none;" id="detail_container_<?php echo $row->project_id; ?>_<?php echo $row->bid_id; ?>">
                    <td colspan="8">
                        <div id="detail_<?php echo $row->project_id; ?>_<?php echo $row->bid_id; ?>"><?php if ($row->bid_status != 3) { ?> 
                                <div class="col-md-5">
                                    <?php
                                    $f = 0;
                                    if (isset($projects_file_detail) && !empty($projects_file_detail)) {
                                        foreach ($projects_file_detail as $file_val) {
                                            $f++;
                                            ?>
                                            <span class="prj-block-display" id="prj_file_<?php echo $file_val['project_file_id']; ?>">
                                                <input type="hidden" value="<?php echo $file_val['project_file']; ?>" name="del_project_file" id="del_project_file_<?php echo $file_val['project_file_id']; ?>">
                                                <input type="hidden" value="<?php echo $file_val['project_id']; ?>" name="del_project_id" id="del_project_id_<?php echo $file_val['project_file_id']; ?>"><?php echo $f; ?>&nbsp;<strong><a href="<?php echo base_url(UPLOAD . 'projects/' . $file_val['project_id'] . '/' . $file_val['project_file']); ?>" target ="_blank"><?php echo $file_val['project_file_name']; ?></a></strong>&nbsp;&nbsp;<?php echo $file_val['project_file_description']; ?>
                                            </span>
                                            <?php
                                        }
                                    }
                                    ?>
                                </div>
                                <div class="col-md-3">
                                    <strong>Approved By: </strong>
                                    <span id="approve_name">
                                        <?php
                                        if ($row->partner_approved == 1) {
                                            echo $row->approve_by_name;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </span>                                   
                                </div>                            
                                <div class="col-md-4">
                                    <strong>Approved Date: </strong>
                                    <span id="approve_date">
                                        <?php
                                        if ($row->partner_approved == 1) {
                                            echo $row->approve_date;
                                        } else {
                                            echo "-";
                                        }
                                        ?>
                                    </span>
                                </div>
                                <div class="clearfix"></div> 
        <?php } ?>
                            <div id="add_bid_container_<?php echo $row->bid_id; ?>" style="display: none;">
                                <form name="send_bid" action="<?php echo base_url('bids/send_bid'); ?>" method="post">
                                    <input type="hidden" class="form-control" id="project_id" name="project_id" value="<?php echo $row->project_id; ?>"  />
                                    <input type="hidden" class="form-control" id="project_country_id" name="project_country_id" value="<?php echo $row->project_country_id; ?>"  />
                                    <input type="hidden" class="form-control" id="researcher_id" name="researcher_id" value="<?php echo $row->researcher_id; ?>"  />
                                    <input type="hidden" class="form-control" id="researcher_user_id" name="researcher_user_id" value="<?php echo $row->researcher_user_id; ?>"  />
                                    <input type="hidden" class="form-control" id="bid_status" name="bid_status" value="1"  />
                                    <input type="hidden" class="form-control" id="is_read" name="is_read" value="0"  />					
                                    <input type="hidden" class="form-control" id="partner_id" name="partner_id" value="<?php echo $this->session->userdata('company_id'); ?>"  />
                                    <input type="hidden" class="form-control" id="partner_user_id" name="partner_user_id" value="<?php echo $this->session->userdata('user_id'); ?> "  />
                                    <div class="col-md-2"><?php echo $this->common_function->get_segment_format($row->country_name, $project_segments[$row->project_segments], $row->segment_name, $row->bid_status, ''); ?></div>
        <?php if ($row->hide_cpc == 0) { ?>
                                        <div class="col-md-2"><strong>CPC</strong>
                                            <input type="text" class="form-control input-small" name="search_prj_cpc" placeholder="CPC" id="search_prj_cpc_<?php echo $row->project_country_id . '_' . $row->partner_id; ?>" value="<?php echo $row->project_cpc; ?>"  />                                    
                                        </div>
        <?php } ?>
                                    <div class="col-md-2"><strong>N Complete</strong>
                                        <input type="text" class="form-control input-small" name="search_prj_ncomplete" placeholder="NComplete" id="search_prj_ncomplete_<?php echo $row->project_country_id . '_' . $row->partner_id; ?>" value="<?php echo $row->project_ncomplete; ?>"  />
                                    </div>
                                    <div class="col-md-2" ><strong>Estimated Cost</strong><br/>
                                        <span id="estimated_cost_<?php echo $row->project_country_id . '_' . $row->partner_id; ?>"> <?php echo $row->project_cpc * $row->project_ncomplete; ?>  </span>
                                    </div>
                                    <div class="col-md-3">
                                        <textarea class="form-control" name="search_prj_comment" placeholder="Comment" id="search_prj_comment_<?php echo $row->project_country_id; ?>" style="height:50px;"></textarea>
                                    </div>                                
                                    <div class="col-md-1">
                                        <input class="btn green" value="Send" type="submit" id="fresh_bid_send" name="fresh_bid_send" />
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
                                            <span class="body" style="padding-top:5px;"><?php echo $this->common_function->get_segment_format($sub_bid->country_name, $project_segments[$sub_bid->project_segments], $sub_bid->segment_name, $sub_bid->bid_status, $segment_delete->is_delete); ?>&nbsp;&nbsp;CPC : <?php echo $sub_bid->project_cpc; ?>&nbsp;|&nbsp;N Complete : <?php echo $sub_bid->project_ncomplete; ?>&nbsp;|&nbsp;Estimated Cost : <?php echo ($sub_bid->project_cpc * $sub_bid->project_ncomplete) + $sub_bid->project_setup_cost;
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
    $(document).ready(function() {
        $('.page-sidebar-menu').find('.active').removeClass('active');
        $('#bids').addClass('active');
        $('#bids').find('.arrow').addClass('open');
    });
</script>