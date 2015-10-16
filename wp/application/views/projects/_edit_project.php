<input type="hidden" name="pdetails" id="pdetails" value="<?php echo $project_id; ?>" />
<ul class="nav nav-tabs " id="edit-project-nav">
    <li class="tablink"><a href="#tab_project_detail" data-toggle="tab" data-url="projects/project_details"><?php echo $projects[0]['project_name']; ?> Details</a></li>
    <li class="tablink"><a href="#tab_search_project" data-toggle="tab" data-url="projects/do_search_project">Search Partners</a></li>
    <li class="tablink"><a href="#tab_bid_replies" data-toggle="tab" data-url="projects/bid_replies">Bid Replies</a></li>
    <li class="tablink"><a href="#tab_awarded_partners" data-toggle="tab" data-url="projects/awarded_partners">Awarded Partners</a></li>
    <li class="tablink"><a href="#tab_closing_details" data-toggle="tab" data-url="projects/closing_details">Closing details</a></li>
</ul>
<div class="tab-content">
    <div class="tab-pane fade active in" id="tab_project_detail">
       <?php echo (isset($project_details)) ? $project_details : "" ?>
    </div>

    <div class="tab-pane fade " id="tab_search_project">        	
    </div>

    <div class="tab-pane fade " id="tab_bid_replies">
        
    </div>

    <div class="tab-pane fade " id="tab_awarded_partners">
        
    </div>

    <div class="tab-pane fade " id="tab_closing_details">
        
    </div>	
</div>

<script type="text/javascript">
    var p_cntry = "";
    var p_segment = "";
    $(document).ready(function () {
<?php
if (isset($projects)) { ?>
        p_cntry = new Array();    
                 <?php foreach ($projects as $value) { ?>
            p_cntry.push('<?php echo $value['country_id']; ?>');
        <?php }  ?>;              
   <?php //} if ($projects['project_segments'] != "") { ?>
//                p_segment = '<?php //echo $projects['project_segments']; ?>';
//                p_segment = p_segment.split(",");
        <?php
    }
//}
?>        
    });
</script>
