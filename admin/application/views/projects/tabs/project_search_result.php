<?php if ($partners && !empty($partners)) { 
$blkcss_class = '';
$blockcss_class = '';
		
$CI = & get_instance();
$CI->load->model('mdl_company');

     foreach ($partners as $p){
	 $display_block = '';
	 $company_detail = $CI->mdl_company->get_company_detail($p->company_id);
	 $sub_grid_detail = $CI->mdl_project->search_partners_sub_data($project_id,$p->company_id); 
	
		foreach($sub_grid_detail as $sub_val) {
		if($sub_val->is_delete == 1) { 
			$blkcss_class = 'deleted';
			$blkmain_class = '';
		} else { 
			$blkcss_class = '';
			$blkmain_class = '';
		}
		
			$data_bid = $CI->mdl_project->check_bid_project_country($sub_val->project_country_id,$p->company_id,$project_id);
			$segment_delete = $CI->mdl_project->check_project_country_delete($sub_val->project_country_id);
		if($data_bid && $data_bid != '') {
			$blkmain_class = $data_bid->bid_status;
		}
			$display_block .= $this->common_function->get_segment_format($sub_val->country_name, $project_segments[$sub_val->project_segments], $sub_val->segment_name, $blkmain_class,$segment_delete->is_delete);
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
                <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
            </div>
        </div>
        <div class="col-md-2 portfolio-stat">
            <div class="portfolio-info">
                <i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i><i class="fa fa-usd"></i>
            </div>
        </div>
        <div class="col-md-2">
            <div class="portfolio-btn">
                <a class="btn bigicn-only" href="javascript:void(0)" id="show_prj_cty_detail_<?php echo $p->company_id;?>">
                    <span>
                        Send Bid 
                    </span>
                </a>
            </div>
        </div>
    </div>
	<div id="search_prj_sub_detail_<?php echo $p->company_id;?>" style="display:none;" class="search_prj_sub_detail">
		<?php 
		$i = 0;
		$css_class = '';
		$blockcss_class = '';
		foreach($sub_grid_detail as $sub_val) {
		
		$i++;
		if(($i%2) == 0) { $css_class="even_srch";} else { $css_class = "odd_srch";}
			echo '<div class="row"><div class="'.$css_class.'">';
			//$check_bid_detail = $CI->mdl_project->check_segment_in_bid($project_id,$p->company_id); 
			$data_bid = $CI->mdl_project->check_bid_project_country($sub_val->project_country_id,$p->company_id,$project_id);
			$segment_delete = $CI->mdl_project->check_project_country_delete($sub_val->project_country_id);
			if($data_bid && $data_bid != '') {
				$hide_text = '';
				$main_class = $data_bid->bid_status;
				if($data_bid->hide_cpc == 1) {
					$hide_text = '(hidden)';
				} else {
					$hide_text = '';
				}
				echo '<div class="col-md-2">'.$this->common_function->get_segment_format($sub_val->country_name, $project_segments[$sub_val->project_segments], $sub_val->segment_name,$data_bid->bid_status,$segment_delete->is_delete).'</div>' ;
				echo '<div class="col-md-1"><label><strong>CPC : </strong></label><br /> '.$data_bid->project_cpc.'&nbsp;'.$hide_text.'</div>' ;
				echo '<div class="col-md-2"><label><strong>Ncomplete : </strong></label><br /> '.$data_bid->project_ncomplete.'</div>' ;
				echo '<div class="col-md-2"><label><strong>Estimated Cost : </strong></label><br /> '.$data_bid->project_cpc * $data_bid->project_ncomplete.'</div>' ;
					
				echo '<div class="col-md-3">'.$data_bid->bid_comments.'<br /><label></div>' ;
				echo '<div class="col-md-2"><span style="color:green;font-weight:bold;">Already Sent</span></div>' ;
				
			} else { 
				if($sub_val->is_delete == 0) {
					echo '<form name="send_bid" action="'.base_url('projects/send_bid').'" method="post"><input type="hidden" class="form-control" id="project_id" name="project_id" value="'.$project_id.'"  /><input type="hidden" class="form-control" id="project_country_id" name="project_country_id" value="'.$sub_val->project_country_id.'"  />
					<input type="hidden" class="form-control" id="partner_id" name="partner_id" value="'.$p->company_id.'"  />
					<input type="hidden" class="form-control" id="bid_status" name="bid_status" value="0"  />
					<input type="hidden" class="form-control" id="is_read" name="is_read" value="0"  />
					<input type="hidden" class="form-control" id="researcher_id" name="researcher_id" value="'.$this->session->userdata('company_id').'"  />
					<input type="hidden" class="form-control" id="researcher_user_id" name="researcher_user_id" value="'.$this->session->userdata('user_id').'"  />
					<div class="col-md-2"><span class="prj-block-display '.$blockcss_class.'">'.$sub_val->country_name.'&nbsp;'.$project_segments[$sub_val->project_segments].' &nbsp;('.$sub_val->segment_name.')</span></div>' ;
					echo '<div class="col-md-2"><strong>CPC</strong><input type="text" class="form-control input-small" name="search_prj_cpc" placeholder="CPC" id="search_prj_cpc_'.$sub_val->project_country_id.'_'.$p->company_id.'" value="'.$sub_val->project_cpc.'"  /><br /><label><input type="checkbox" name="search_prj_hide_cpc" value="1">Hide CPC</label></div>' ;
					echo '<div class="col-md-2"><strong>N Complete</strong><input type="text" class="form-control input-small" name="search_prj_ncomplete" placeholder="NComplete" id="search_prj_ncomplete_'.$sub_val->project_country_id.'_'.$p->company_id.'" value="'.$sub_val->project_ncomplete.'"  /></div>' ;
					echo '<div class="col-md-2" ><strong>Estimated Cost</strong><br /><span id="estimated_cost_'.$sub_val->project_country_id.'_'.$p->company_id.'">'.$sub_val->project_cpc * $sub_val->project_ncomplete.'</span></div><div class="col-md-3"><textarea class="form-control" name="search_prj_comment" 
					placeholder="Comment" id="search_prj_comment_'.$sub_val->project_country_id.'" style="height:34px;"></textarea></div>' ;
					echo '<div class="col-md-1"><input class="btn green" value="Send" type="submit" /></div></form>';
				} else {
					$hide_text = '';
					echo '<div class="col-md-3"><div class="prj-block-display '.$blockcss_class.'">'.$sub_val->country_name.'&nbsp;'.$project_segments[$sub_val->project_segments].' &nbsp;('.$sub_val->segment_name.')</div></div>' ;
					echo '<div class="col-md-2"><label><strong>CPC : </strong></label> '.$sub_val->project_cpc.'&nbsp;'.$hide_text.'</div>' ;
					echo '<div class="col-md-2"><label><strong>Ncomplete : </strong></label> '.$sub_val->project_ncomplete.'</div>' ;
					echo '<div class="col-md-2"><label><strong>Estimated Cost : </strong></label> '.$sub_val->project_cpc * $sub_val->project_ncomplete.'</div>' ;
					
					echo '<div class="col-md-2"><h4>Segment Deleted</h4></div>' ;
				}
			}
			echo '</div></div><hr />';
		}
		?>
	</div>
<?php } 
} ?>


