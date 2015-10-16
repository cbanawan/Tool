<script src='<?php echo base_url() . JS; ?>jquery.MetaData.js' type="text/javascript" language="javascript"></script>
<link href='<?php echo base_url() . JS; ?>jquery.rating.css' type="text/css" rel="stylesheet"/>
 <script src='<?php echo base_url() . JS; ?>jquery.rating.js' type="text/javascript" language="javascript"></script>
 <script src='<?php echo base_url() . JS; ?>thickbox.js' type="text/javascript" language="javascript"></script>
<link href='<?php echo base_url() . CSS; ?>thickbox.css' type="text/css" rel="stylesheet"/>
<?php
if ($partners && !empty($partners)) {
    $blkcss_class = '';
    $blockcss_class = '';

    $CI = & get_instance();
    $CI->load->model('mdl_company');
	$timezone = array();
	$active_class1 = '';
					$active_class2 = '';
					$active_class3 = '';
					$src1 = '';
					$src2 = '';
					$src3 = '';
					$timeval1 = 0;
					$timeval2 = 0;
					$timeval3 = 0;

    foreach ($partners as $p) {
        $display_block = '';
        $company_detail = $CI->mdl_company->get_company_detail($p->company_id);
        $sub_grid_detail = $CI->mdl_project->search_partners_sub_data($project_id, $p->company_id);
        $ranks_detail = $CI->mdl_project->get_partner_rank($p->company_id);
		$ranks_totals = $CI->mdl_project->get_no_rows_partner_rank($p->company_id);
		//$avg_bid_speed =  ((int)$ranks_totals->cnt <= 0 ? 0 : ceil($ranks_detail->bid_speed_rank / $ranks_totals->cnt)); 
		//$avg_quality =  ((int)$ranks_totals->cnt <= 0 ? 0 : ceil($ranks_detail->quality_rank / $ranks_totals->cnt));
		//$avg_value =  ((int)$ranks_totals->cnt <= 0 ? 0 : ceil($ranks_detail->value_rank / $ranks_totals->cnt));
		//$avg_over_all =  ((int)$ranks_totals->cnt <= 0 ? 0 : ceil($ranks_detail->over_all_rank / $ranks_totals->cnt));
        foreach ($sub_grid_detail as $sub_val) {
            if ($sub_val->is_delete == 1) {
                $blkcss_class = 'deleted';
                $blkmain_class = '';
            } else {
                $blkcss_class = '';
                $blkmain_class = '';
            }

            $data_bid = $CI->mdl_project->check_bid_project_country($sub_val->project_country_id, $p->company_id, $project_id);
            $segment_delete = $CI->mdl_project->check_project_country_delete($sub_val->project_country_id);
            if ($data_bid && $data_bid != '') {
                $blkmain_class = $data_bid->bid_status;
            }
            $display_block .= $this->common_function->get_segment_format($sub_val->country_name, $project_segments[$sub_val->project_segments], $sub_val->segment_name, $blkmain_class, $segment_delete->is_delete);
        }
		if($company_detail['company_time_zone'])  {
					
					
					$timezone = explode(',',$company_detail['company_time_zone']);
					if($timezone[0] == 1) {
						$src1 = base_url('images/time1-active.png');
						$active_class1 = 'zone-active';
					} else {
						$src1 = base_url('images/time1.png');
						$active_class1 = '';
					}if($timezone[1] == 1) {
						$src2 = base_url('images/time2-active.png');
						$active_class2 = 'zone-active';
					} else {
						$src2 = base_url('images/time2.png');
						$active_class2 = '';
					}if($timezone[2] == 1) {
						$src3 = base_url('images/time3-active.png');
						$active_class3 = 'zone-active';
					} else {
						$src3 = base_url('images/time3.png');
						$active_class3 = '';
					}
					$timeval1 = $timezone[0];
					$timeval2 = $timezone[1];
					$timeval3 = $timezone[2];
				} else {
					$src1 = base_url('images/time1.png');
					$src2 = base_url('images/time2.png');
					$src3 = base_url('images/time3.png');
					$active_class1 = '';
					$active_class2 = '';
					$active_class3 = '';
					$timeval1 = 0;
					$timeval2 = 0;
					$timeval3 = 0;
				}
        ?>
        <div class="portfolio-block" style="margin-top:15px;">
            <div class="col-md-6">
                <div class="portfolio-text">
                    <div class="portfolio-text-info">
                        <h4><?php echo $company_detail['company_name']; ?></h4>
                        <p><?php echo $display_block; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-2 portfolio-stat">
				 <div class="portfolio-info">
				<img src="<?php echo $src1;?>" id="time-img_1" class="timezone-img <?php echo $active_class1;?>" title="The Americas" />
				<img src="<?php echo $src2;?>" id="time-img_2" class="timezone-img <?php echo $active_class2;?>" title="Europe and Africa" />
				<img src="<?php echo $src3;?>" id="time-img_3" class="timezone-img <?php echo $active_class3;?>" title="Asia and the Pacific"/>
				</div>	
			</div>
            <div class="col-md-2 portfolio-stat">
			
            
                    <a href="<?php echo base_url('projects/vendor_performance/'.$company_detail['company_id'].'/')?>?height=290&width=500" class="thickbox" title="Researcher’s reviews of <?php echo strtoupper($company_detail['company_name'])?>"><?php					
					 echo $this->lib_common->show_stars('partner_'.$company_detail['company_id'],ceil($company_detail['performance_rank']),1); 
					 
                    ?></a>

            
            </div>
            <div class="col-md-2">
                <div class="portfolio-btn">
                    <a class="btn bigicn-only" href="javascript:void(0)" id="show_prj_cty_detail_<?php echo $p->company_id; ?>">
                        <span>
                            Send Bid 
                        </span>
                    </a>
                </div>
            </div>
        </div>
        <div id="search_prj_sub_detail_<?php echo $p->company_id; ?>" style="display:none;" class="search_prj_sub_detail">
            <?php
            $i = 0;
            $css_class = '';
            $blockcss_class = '';
            foreach ($sub_grid_detail as $sub_val) {

                $i++;
                if (($i % 2) == 0) {
                    $css_class = "even_srch";
                } else {
                    $css_class = "odd_srch";
                }
                echo '<div class="row"><div class="' . $css_class . '">';
                //$check_bid_detail = $CI->mdl_project->check_segment_in_bid($project_id,$p->company_id); 
                $data_bid = $CI->mdl_project->check_bid_project_country($sub_val->project_country_id, $p->company_id, $project_id);
                $segment_delete = $CI->mdl_project->check_project_country_delete($sub_val->project_country_id);
                if ($data_bid && $data_bid != '') {
                    $hide_text = '';
                    $main_class = $data_bid->bid_status;
                    if ($data_bid->hide_cpc == 1) {
                        $hide_text = '(hidden)';
                    } else {
                        $hide_text = '';
                    }
                    echo '<div class="col-md-2">' . $this->common_function->get_segment_format($sub_val->country_name, $project_segments[$sub_val->project_segments], $sub_val->segment_name, $data_bid->bid_status, $segment_delete->is_delete) . '</div>';
                    echo '<div class="col-md-1"><label><strong>CPC : </strong></label><br /> ' . $data_bid->project_cpc . '&nbsp;' . $hide_text . '</div>';
                    echo '<div class="col-md-2"><label><strong>Ncomplete : </strong></label><br /> ' . $data_bid->project_ncomplete . '</div>';
                    echo '<div class="col-md-2"><label><strong>Estimated Cost : </strong></label><br /> ' . $data_bid->project_cpc * $data_bid->project_ncomplete . '</div>';

                    echo '<div class="col-md-3">' . $data_bid->bid_comments . '<br /><label></div>';
                    echo '<div class="col-md-2"><span style="color:green;font-weight:bold;">Already Sent</span></div>';
                } else {
                    if ($sub_val->is_delete == 0) {
                        echo '<form name="send_bid" action="' . base_url('projects/send_bid') . '" method="post"><input type="hidden" class="form-control" id="project_id" name="project_id" value="' . $project_id . '"  /><input type="hidden" class="form-control" id="project_country_id" name="project_country_id" value="' . $sub_val->project_country_id . '"  />
					<input type="hidden" class="form-control" id="partner_id" name="partner_id" value="' . $p->company_id . '"  />
					<input type="hidden" class="form-control" id="bid_status" name="bid_status" value="0"  />
					<input type="hidden" class="form-control" id="is_read" name="is_read" value="0"  />
					<input type="hidden" class="form-control" id="researcher_id" name="researcher_id" value="' . $this->session->userdata('company_id') . '"  />
					<input type="hidden" class="form-control" id="researcher_user_id" name="researcher_user_id" value="' . $this->session->userdata('user_id') . '"  />
					<div class="col-md-2"><span class="prj-block-display ' . $blockcss_class . '">' . $sub_val->country_name . '&nbsp;' . $project_segments[$sub_val->project_segments] . ' &nbsp;(' . $sub_val->segment_name . ')</span></div>';
                        echo '<div class="col-md-2"><strong>CPC</strong><input type="text" class="form-control input-small" name="search_prj_cpc" placeholder="CPC" id="search_prj_cpc_' . $sub_val->project_country_id . '_' . $p->company_id . '" value="' . $sub_val->project_cpc . '"  /><br /><label><input type="checkbox" name="search_prj_hide_cpc" value="1">Hide CPC</label></div>';
                        echo '<div class="col-md-2"><strong>N Complete</strong><input type="text" class="form-control input-small" name="search_prj_ncomplete" placeholder="NComplete" id="search_prj_ncomplete_' . $sub_val->project_country_id . '_' . $p->company_id . '" value="' . $sub_val->project_ncomplete . '"  /></div>';
                        echo '<div class="col-md-2" ><strong>Estimated Cost</strong><br /><span id="estimated_cost_' . $sub_val->project_country_id . '_' . $p->company_id . '">' . $sub_val->project_cpc * $sub_val->project_ncomplete . '</span></div><div class="col-md-3"><textarea class="form-control" name="search_prj_comment" 
					placeholder="Comment" id="search_prj_comment_' . $sub_val->project_country_id . '" style="height:34px;"></textarea></div>';
                        echo '<div class="col-md-1"><input class="btn green" value="Send" type="submit" /></div></form>';
                    } else {
                        $hide_text = '';
                        echo '<div class="col-md-3"><div class="prj-block-display ' . $blockcss_class . '">' . $sub_val->country_name . '&nbsp;' . $project_segments[$sub_val->project_segments] . ' &nbsp;(' . $sub_val->segment_name . ')</div></div>';
                        echo '<div class="col-md-2"><label><strong>CPC : </strong></label> ' . $sub_val->project_cpc . '&nbsp;' . $hide_text . '</div>';
                        echo '<div class="col-md-2"><label><strong>Ncomplete : </strong></label> ' . $sub_val->project_ncomplete . '</div>';
                        echo '<div class="col-md-2"><label><strong>Estimated Cost : </strong></label> ' . $sub_val->project_cpc * $sub_val->project_ncomplete . '</div>';

                        echo '<div class="col-md-2"><h4>Segment Deleted</h4></div>';
                    }
                }
                echo '</div></div><hr />';
            }
            ?>
        </div>
    <?php }
}
?>


