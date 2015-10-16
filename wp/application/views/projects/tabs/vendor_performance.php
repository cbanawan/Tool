<script src='<?php echo base_url() . JS; ?>jquery.MetaData.js' type="text/javascript" language="javascript"></script>
<link href='<?php echo base_url() . JS; ?>jquery.rating.css' type="text/css" rel="stylesheet"/>
 <script src='<?php echo base_url() . JS; ?>jquery.rating.js' type="text/javascript" language="javascript"></script>
 <div style="margin-top:10px;">&nbsp;</div>
<?php 
echo '<div class="row"><label class="col-md-4 control-label">Bid Speed :</label>'.$this->lib_common->show_stars('detail_bid_'.$vendor_id,ceil($bid_speed_rank),1).'</div>';
echo '<div class="row" style="padding-left:3em"><small>How fast did they return the bid back to you?</small></div><br/>';
echo '<div class="row"><label class="col-md-4 control-label">Quality :</label>'.$this->lib_common->show_stars('detail_quality_'.$vendor_id,ceil($quality_rank),1).'</div>';
echo '<div class="row" style="padding-left:3em"><small>How happy are you with the quality of sample you recieved?</small></div><br/>';
echo '<div class="row"><label class="col-md-4 control-label">Value :</label>'.$this->lib_common->show_stars('detail_value_'.$vendor_id,ceil($value_rank),1).'</div>';
echo '<div class="row" style="padding-left:3em"><small>How does their cost compare to what they offer?</small></div><br/>';
echo '<div class="row"><label class="col-md-4 control-label">Over-all Experience :</label>'.$this->lib_common->show_stars('detail_overall_'.$vendor_id,ceil($over_all_rank),1).'</div>';
echo '<div class="row" style="padding-left:3em"><small>Taking just this project as a whole, how happy are you with your experience with this partner?</small></div>';

?>