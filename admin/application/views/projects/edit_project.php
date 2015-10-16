<input type="hidden" name="pdetails" id="pdetails" value="<?php echo $project_id; ?>" />
<?php 
/*$tab_project_detail = '';
	if(isset($active_project_tab)) {
		if(	$active_project_tab == 'tab_search_project') {
			$tab_search_project = 'active in';
		} else {
			$tab_search_project = '';
		}
		if(	$active_project_tab == 'tab_bid_replies') {
			$tab_bid_replies = 'active in';
		} else {
			$tab_bid_replies = '';
		}
	} else {
		$tab_project_detail = 'active in';
	}*/
	
?>
<ul class="nav nav-tabs " id="edit-project-nav">
    <li class="tablink active <?php //echo $tab_project_detail;?>"><a href="#tab_project_detail" data-toggle="tab" data-url="projects/project_details"><?php echo $projects['project_name']; ?> Details</a></li>
    <li class="tablink <?php //echo $tab_search_project;?>"><a href="#tab_search_project" data-toggle="tab" data-url="projects/do_search_project">Search Partners</a></li>
    <li class="tablink <?php //echo $tab_bid_replies;?>"><a href="#tab_bid_replies" data-toggle="tab" data-url="projects/bid_replies">Bid Replies</a></li>
    <li class="tablink"><a href="#tab_awarded_partners" data-toggle="tab" data-url="projects/awarded_partners">Awarded Partners</a></li>
    <li class="tablink"><a href="#tab_closing_details" data-toggle="tab" data-url="projects/closing_details">Closing details</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active in <?php //echo $tab_project_detail;?> " id="tab_project_detail">
       <?php echo (isset($project_details)) ? $project_details : "" ?>
    </div>

    <div class="tab-pane fade <?php //echo $tab_search_project;?>" id="tab_search_project">        	
    </div>

    <div class="tab-pane fade <?php //echo $tab_bid_replies;?>" id="tab_bid_replies">

    </div>

    <div class="tab-pane fade " id="tab_awarded_partners">

    </div>

    <div class="tab-pane fade " id="tab_closing_details">

    </div>	
</div>
