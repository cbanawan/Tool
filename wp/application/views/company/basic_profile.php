<?php $CI = & get_instance();

if ($this->session->userdata('user_type') == '1') { ?><h4>Update via uploading the file. </h4> <a href="<?php echo base_url('uploads/DEmofile.csv');?>"><i class="fa fa-download"></i>&nbsp;&nbsp;Download demo file from here.</a>
<div class="clearfix">&nbsp;</div>
<form id="formupload" action="<?php echo base_url('basic_profile/upload_segment_file');?>" method="post" enctype="multipart/form-data">
 <div class="input-group input-medium"><input type="file" name="upd_file_vendor" id="upd_file_vendor" value="" class="form-control" /><span class="input-group-btn"><input type="submit" class="btn blue" name="upd_vendor" value="Upload" onclick="return confirm_upload();" /></div></form>
 <hr />
 <?php } ?>
 <div class="table-responsive">
		<table class="table table-striped table-bordered table-advance table-hover">
			<thead>
				<tr>
					<th>Country</th>
					
				</tr>
			</thead>
			<tbody>
	
 <?php 
 foreach($country_detail as $cval){
	?>
				<tr>
					<td><a href="javascript:void(0);" id="profile_exp_<?php echo $cval->country_id; ?>"><?php echo $cval->country_name; ?></a></td>
					
				</tr>
				<?php $sub_detail = $CI->mdl_company->get_country_segments($cval->country_id);
				if($sub_detail) { ?>
				<tr style="display:none;" id="exp_<?php echo $cval->country_id; ?>" class="profile_exp_adv">
				<td align="center">
					<table class="table table-striped table-bordered table-advance table-hover" style="width:65% !important">
					<thead>
						<tr>
							<th>Segment</th>
							<th>Tags</th>
							<th>No. Of Panelists</th>
						</tr>
					</thead>
					<tbody>
				<?php foreach($sub_detail as $sub_val) { ?>
				<tr>
					<td><?php echo $project_segments[$sub_val->segment_id];?></td>
					<td><?php $company_tags = array(); 
if(isset($sub_val->tags)) {
$tags = str_replace(';',',',trim($sub_val->tags));
$company_tags = explode(',',$tags); 
foreach($company_tags as $tags_val ) {
	echo '<span class="prj-block-display">'.$tags_val.'</span>';
}
} ?></td>
<td><?php echo $sub_val->number_panelists;?></td>
				</tr>
				<?php } ?>
				</tbody>
				</table>
				</td>
				</tr>
				<?php } ?>
			
	
 <?php }
 ?>
 </tbody>
		</table>
	</div>
<script type="text/javascript">
    $(document).ready(function () {
		$('.profile_exp_adv').hide();
        $('.active').removeClass('active');
        $('#basic_profiling').addClass('active');
		$('a[id^="profile_exp_"]').live('click', function() {
			var country_id = $(this).attr('id').split("_")[2];
			$('.profile_exp_adv').hide();
			$('#exp_'+country_id).show('slow');
		});

	});
	function confirm_upload(){
		var ext = $('#upd_file_vendor').val().split('.').pop().toLowerCase();
			if($.inArray(ext, ['csv','CSV']) == -1) {
			alert('invalid extension!');
			return false;
		}
		var close_return = confirm("Your old data about the profiling will be removed before uploading this, are you sure to go further?");
		if (close_return == true) {
			return true;
		} else {
			return false;
		}	
	}
</script>