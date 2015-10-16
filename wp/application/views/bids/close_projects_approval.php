<?php
if ($close_projects_approval && !empty($close_projects_approval)) {
    $CI = &get_instance();
    ?>
    <table id="tbl_close_proj_app" class="table table-striped table-bordered table-advance table-hover">
        <thead>
            <tr>
                <th>Researcher</th>
                <th>Project Name</th>    
                <th>Estimated Cost</th>
                <th>Cost</th>        
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            foreach ($close_projects_approval as $row) {
                $css_class = '';
                $main_class = '';
                $bid_sub_detail = $row->sub_bid;
                $final_estimated_cost = $bid_sub_detail->total_estimate;

                $sub_bid_detail = $row->bid_sub_close; //$CI->mdl_project->get_project_sub_close_bid($row->project_id, $row->partner_id);
                $close_partner_project = $row->close_partner_project; //$CI->mdl_project->partner_project_close_detail($row->project_id, $row->partner_id);
                $st_str_display = '';
                $st_usd_display = '';

                if (isset($close_partner_project) && $close_partner_project != '') {
                    $detail_entry_type = 'update';
                    $update_detail = '<input type="hidden" name="project_closing_id" value="' . $close_partner_project->project_closing_id . '" id="project_closing_id_' . $row->partner_id . '">';
                    $project_cpc = $close_partner_project->project_cpc;
                    $project_ncomplete = $close_partner_project->project_ncomplete;

                    $project_estimated_cost = $close_partner_project->project_estimated_cost;
                    $researcher_estimated_cost = $close_partner_project->researcher_estimated_cost;
                    $partner_rank = $close_partner_project->partner_rank;
                    $cost_rank = $close_partner_project->partner_cost_rank;
                    $st_style = '';
                    for ($st_str = 1; $st_str <= 5; $st_str++) {
                        if ($close_partner_project->partner_rank == 1 && $close_partner_project->partner_rank >= $st_str) {
                            $st_style = "color:red;";
                        } else if (($close_partner_project->partner_rank == 2 || $close_partner_project->partner_rank == 3) && $close_partner_project->partner_rank >= $st_str) {
                            $st_style = "color:#FF8E01;";
                        } else if (($close_partner_project->partner_rank == 4 || $close_partner_project->partner_rank == 5) && $close_partner_project->partner_rank >= $st_str) {
                            $st_style = "color:green;";
                        } else {
                            $st_style = "";
                        }
                        $st_str_display .= '<a href="javascript:void(0);"  id="str_' . $st_str . '_' . $row->partner_id . '"><i class="fa fa-star" style="' . $st_style . '"></i></a>';
                    }
                    $usd_style = '';
                    for ($st_usd = 1; $st_usd <= 5; $st_usd++) {
                        if (($close_partner_project->partner_cost_rank == 1 || $close_partner_project->partner_cost_rank == 2) && $close_partner_project->partner_cost_rank >= $st_usd) {
                            $usd_style = "color:green;";
                        } else if (($close_partner_project->partner_cost_rank == 3) && $close_partner_project->partner_cost_rank >= $st_usd) {
                            $usd_style = "color:#FF8E01;";
                        } else if (($close_partner_project->partner_cost_rank == 4 || $close_partner_project->partner_cost_rank == 5) && $close_partner_project->partner_cost_rank >= $st_usd) {
                            $usd_style = "color:red;";
                        } else {
                            $usd_style = "";
                        }
                        $st_usd_display .= '<a href="javascript:void(0);"  id="usd_' . $st_usd . '_' . $row->partner_id . '"><i class="fa fa-usd" style="' . $usd_style . '"></i></a>&nbsp;';
                    }
                } else {
                    $detail_entry_type = 'insert';
                    $update_detail = '<input type="hidden" name="project_closing_id" value="0" id="project_closing_id_' . $row->partner_id . '">';
                    $project_cpc = $row->project_cpc;
                    $project_ncomplete = $row->project_ncomplete;
                    $project_estimated_cost = $final_estimated_cost;
                    $partner_rank = 0;
                    $cost_rank = 0;
                    $researcher_estimated_cost = 0;

                    for ($st_str = 1; $st_str <= 5; $st_str++) {
                        $st_str_display .= '<a href="javascript:void(0);"  id="str_' . $st_str . '_' . $row->partner_id . '"><i class="fa fa-star"></i></a>&nbsp;';
                    }
                    for ($st_usd = 1; $st_usd <= 5; $st_usd++) {
                        $st_usd_display .= '<a href="javascript:void(0);"  id="usd_' . $st_usd . '_' . $row->partner_id . '"><i class="fa fa-usd"></i></a>&nbsp;';
                    }
                }
                $segment_delete = $row->segment_delete; //$CI->mdl_project->check_project_country_delete($row->project_country_id);
                ?>
                <tr id="tr_approval_<?php echo $row->project_id; ?>_<?php echo $row->project_country_id; ?>">
                    <td><?php echo $row->company_name; ?></td>
                    <td>        
                        <?php echo $row->project_id . "_" . $row->project_name; ?>                        
                    </td>
                    <td><input type="hidden" id="prj-close-cpc_<?php echo $row->partner_id; ?>" value="<?php echo $project_cpc; ?>" class="form-control input-xsmall" />
                        <input type="hidden" id="prj-close-ncomplete_<?php echo $row->partner_id; ?>" value="<?php echo $project_ncomplete; ?>" class="form-control input-xsmall" />
                        <input type="hidden" id="prj-close-ecost_<?php echo $row->partner_id; ?>" value="<?php echo $project_estimated_cost; ?>" class="form-control input-xsmall" />
                        <a href="javascript:void(0);" id="show-close-sub-detail_<?php echo $row->bid_id; ?>_<?php echo $row->project_country_id; ?>" ><?php echo $project_estimated_cost; ?></a></td>                        
                    <td><?php echo $row->researcher_estimated_cost; ?></td>
                    <td>                                
                        <a href="javascript:void(0);" class="btn green approve" id="btn_approve_<?php echo $row->project_id; ?>_<?php echo $row->project_country_id; ?>" >Approve</a>                                                        
                    </td>
                </tr>
                <tr style="display:none;" class="show-sub-detail-tr" id="show-sub-detail-tr_<?php echo $row->bid_id; ?>_<?php echo $row->project_country_id; ?>">
                    <td colspan="7" align="center">
                        <table class="table table-striped table-bordered table-advance table-hover" style="width:65% !important">
                            <thead>
                                <tr>
                                    <th>Segment</th>
                                    <th class="numeric">CPC</th>
                                    <th class="numeric">Ncomplete</th>
                                    <th class="numeric">Setup cost</th>
                                    <th class="numeric">Min. Fee</th>
                                    <th class="numeric">Est. cost</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $est_cost = 0;
                                $est_total_cost = 0;
                                foreach ($sub_bid_detail as $sub_bid_val) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            $segment_delete = $CI->mdl_project->check_project_country_delete($sub_bid_val->project_country_id);

                                            echo $this->common_function->get_segment_format($sub_bid_val->country_name, $project_segments[$sub_bid_val->project_segments], $sub_bid_val->segment_name, $sub_bid_val->bid_status, $segment_delete->is_delete);
                                            ?>
                                        </td>
                                        <td class="numeric">
                                            <?php echo $sub_bid_val->project_cpc; ?>
                                        </td>
                                        <td class="numeric">
                                            <?php echo $sub_bid_val->project_ncomplete; ?>
                                        </td>
                                        <td class="numeric">
                                            <?php echo $sub_bid_val->project_setup_cost; ?>
                                        </td>
                                        <td class="numeric">
                                            <?php echo $sub_bid_val->project_management_fee; ?>
                                        </td>
                                        <td class="numeric">
                                            <?php
                                            echo intVal($this->common_function->display_estimate_cost($sub_bid_val->project_cpc, $sub_bid_val->project_ncomplete, $sub_bid_val->project_setup_cost, $sub_bid_val->project_management_fee));
                                            $est_cost = ($sub_bid_val->project_cpc * $sub_bid_val->project_ncomplete) + $sub_bid_val->project_setup_cost;
                                            $est_total_cost += $est_cost;
                                            ?>
                                        </td>
                                    </tr>
                                <?php } ?>

                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>
                                        &nbsp;
                                    </th>
                                    <th class="numeric">
                                        &nbsp;
                                    </th>
                                    <th class="numeric">
                                        &nbsp;
                                    </th><th class="numeric">
                                        &nbsp;
                                    </th><th class="numeric">
                                        &nbsp;
                                    </th>
                                    <th class="numeric">
                                        <?php echo $est_total_cost; ?>
                                    </th>
                                </tr>
                            </tfoot>

                        </table>
                    </td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
<?php } else { ?>
    <div class="alert alert-info">
        <strong>Empty!</strong> No Projects Found.
    </div>
<?php } ?>
<script type="text/javascript">
    jQuery(document).ready(function () {
//        var acTable = jQuery('#tbl_close_proj_app').dataTable();
//            "bLengthChange": false,
//            bInfo: true,
//            "bFilter": false,
//            "bPaginate": true,
//            "sPaginationType": "bootstrap",
//            "aaSorting": []
//        });
    });
</script>