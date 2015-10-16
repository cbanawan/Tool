<!--<div class="show_detail" style="display:block;">
    <div class="row">
        <div class="col-md-3">Project Name : <?php echo (isset($projects)) ? $projects['project_name'] : ""; ?></div>
    </div>
    <div class="clearfix">&nbsp;</div>
    <div class="row">
        <div class="col-md-3">Note : <?php echo (isset($projects['project_note'])) ? $projects['project_note'] : ""; ?></div>       
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12"><button class="btn green pull-right" id="edit-project" style="margin-bottom:5px;">Edit Project</button></div>
    </div>
</div> -->
<?php
$CI = & get_instance();
$CI->load->model('mdl_project');
?>

<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
});
</script>
<div class="show_form">
    <form class="horizontal-form" role="form" id="frmProject" action="<?php echo base_url(); ?>projects/update_project_master" method="post">
        <input type="hidden" id="company_id" name="company_id" value="<?php echo $this->session->userdata('company_id'); ?>" />                    
        <input type="hidden" id="project_id" name="project_id" value="<?php echo (isset($projects)) ? $projects['project_id'] : ""; ?>" />                    
        <div class="form-body">
            <div class="row">
                <div class="col-md-3">            
                    <div class="form-group">
                        <label for="project_name" class="control-label required_field">Project Name </label><i class="fa fa-info-circle" style="color:#4d90fe;" data-toggle="tooltip" data-placement="top" title="Hooray!"></i>
                        <input type="text" class="form-control" id="project_name" name="project_name" placeholder="Project Name" value="<?php echo (isset($projects)) ? $projects['project_name'] : ""; ?>"  />                    
                    </div>
                </div>
                <div class="col-md-3">            

                    <div class="form-group">
                        <label for="project_internal_note" class="control-label">Project Internal Note</label>                   
                        <textarea class="form-control" name="project_internal_note" id="project_internal_note" placeholder="Project Internal Note" style="height:34px;"><?php echo (isset($projects['project_internal_note'])) ? $projects['project_internal_note'] : ""; ?></textarea>                    
                    </div>					                 
                </div><div class="col-md-3">            

                    <div class="form-group">
                        <label for="project_external_note" class="control-label">Project External Note</label>                   
                        <textarea class="form-control" name="project_external_note" id="project_external_note" placeholder="Project External Note" style="height:34px;"><?php echo (isset($projects['project_external_note'])) ? $projects['project_external_note'] : ""; ?></textarea>                    
                    </div>					                 
                </div> 
                
            </div>
			<div class="row pull-right">
				<div class="col-md-12 "> 
					<input class="btn green" value="Save" type="submit" id="btn_project" />				
					<a href="<?php echo base_url("projects");?>" class="btn default" >Cancel</a>
					<input class="btn green" value="Save &amp; Search Partner" type="button" id="btn_save_search" />
					
				</div>
			</div>
			<div class="clearfix">&nbsp;</div>
            <div class="row">
                <div class=" col-md-3" style="margin-bottom:20px;"><a href="javascript:void(0)" class="btn blue" id="add_project_details">Add Segments</a>&nbsp;&nbsp;<a href="javascript:void(0)" class="btn blue" id="add_project_files" data-toggle="tooltip" data-placement="top" title="Upload Files!">Add File</a></div>
                <div class="col-md-9"><?php
$f = 0;
if (isset($projects_file_detail) && $projects_file_detail != '') {
    foreach ($projects_file_detail as $file_val) {
        $f++;
        if ($file_val['project_file_segment'] != 0) {
            $segment_name_obj = $CI->mdl_project->get_project_country_detail($file_val['project_file_segment']);
            $segment_name = $segment_name_obj->segment_name;
        } else {
            $segment_name = "All";
        }
        echo '<span class="prj-block-display" id="prj_file_' . $file_val['project_file_id'] . '"><input type="hidden" value="' . $file_val['project_file'] . '" name="del_project_file" id="del_project_file_' . $file_val['project_file_id'] . '"><input type="hidden" value="' . $file_val['project_id'] . '" name="del_project_id" id="del_project_id_' . $file_val['project_file_id'] . '">' . $f . '.&nbsp;<strong><a href="' . base_url(UPLOAD . 'projects/' . $projects['project_id'] . '/' . $file_val['project_file']) . '" target ="_blank">' . $file_val['project_file_name'] . '</a></strong>&nbsp;&nbsp;' . $file_val['project_file_description'] . '&nbsp;&nbsp;[' . $segment_name . ']&nbsp;&nbsp;' . $file_val['opt_for_bid'] . '&nbsp;&nbsp;<a href="javascritp:void(0);" id="link_file_' . $file_val['project_file_id'] . '"><i class="fa fa-times"></i></a></span>';
    }
}
?></div>
            </div>
        </div>
    </form>
    <div id="add_files_detail" style="display:none;">
        <form class="horizontal-form" role="form" id="frmProjectFiles" action="<?php echo base_url(); ?>projects/insert_project_files" method="post" enctype="multipart/form-data">
            <input type="hidden" id="project_id" name="project_id" value="<?php echo (isset($projects)) ? $projects['project_id'] : ""; ?>" /> 
            <fieldset><legend>Project Files</legend>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="project_file" class="control-label">Browse File</label>
                            <input type="file" class="form-control" id="project_file" name="project_file" placeholder="Project File" value=""  />      <span id="project_file_error" class="error_span"></span>               
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="project_file_name" class="control-label">File Name</label>
                            <input type="text" class="form-control" id="project_file_name" name="project_file_name" placeholder="Project File" value=""  />   <span id="project_file_name_error" class="error_span"></span>                  
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="project_file_description" class="control-label">File Description</label>
                            <textarea class="form-control" id="project_file_description" name="project_file_description" placeholder="Project File Description" style="height:34px;"></textarea>    <span id="project_file_description_error" class="error_span"></span>                 
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="project_file_description" class="control-label">Project Segment</label>

                            <select class="form-control" id="project_file_segment" name="project_file_segment" placeholder="Project File Description"><option value="0">All</option> <?php
                                foreach ($projects_country_details as $pc_val) {
                                    $opt_cname = $this->common_function->in_array_field($pc_val['country_id'], 'country_id', $country, false);

                                    $segment_val = $this->common_function->get_segment_format_proj($opt_cname->country_name, $project_segments[$pc_val['project_segments']], $pc_val['segment_name']);
                                    echo '<option value="' . $pc_val['project_country_id'] . '">' . $segment_val . '</option>';
                                }
                                ?>	</select>				
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label><input type="checkbox" name="opt_for_bid" value="Yes"/> Includes with bid</label>
                        </div>
                    </div>
                </div>
                <div class="row pull-right">
                    <div class="col-md-12 pull-right" > 
                        <input class="btn blue" value="Add File" type="submit" id="btn_add" data-toggle="tooltip" data-placement="top" title="Hooray!"/>
                        <a href="javascript:void(0);" class="btn default" id="cancel_project_files">Cancel</a>
                    </div>
                </div> 

            </fieldset>
        </form>
    </div>
    <div id="edit_prj_detail" style="display:none;">
        <form class="horizontal-form" role="form" id="frmProjectSegment" action="<?php echo base_url(); ?>projects/insert_project_country" method="post">
            <input type="hidden" id="project_id" name="project_id" value="<?php echo (isset($projects)) ? $projects['project_id'] : ""; ?>" /> 
            <fieldset><legend>Segments Details</legend>
                <div class="row">
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="project_country" class="control-label">Project Country</label>                    
                            <select class="form-control" name="project_country" id="project_country">
                                <?php
                                if (!empty($country)) {
                                    foreach ($country as $value) {
                                        ?>
                                        <option value="<?php echo $value->country_id; ?>"><?php echo $value->country_name; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>                  
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="segment_name" class="control-label ">Segment</label>                
                            <input type="text" class="form-control segment_name" id="prj_detail_segment_name" name="segment_name" placeholder="Segment" value=""  /> <span id="prj_detail_segment_name_error" class="error_span"></span>                   
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label for="project_segments" class="control-label">Project Segment</label>                    
                            <select class="form-control project_segment" name="project_segment">                        
                                <?php
                                if (isset($project_segments)) {
                                    foreach ($project_segments as $key => $ps) {
                                        ?>
                                        <option value="<?php echo $key; ?>"><?php echo $ps; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>                 
                        </div>
                    </div>
                    <div class="col-md-1" style="width:75px;">            
                        <div class="form-group">
                            <label for="project_ir" class="control-label ">IR</label>                    
                            <input type="text" class="form-control project_ir input-xsmall" name="project_ir" placeholder="IR" value="0"  />                    
                        </div>
                    </div>
                    <div class="col-md-1" style="width:75px;">            
                        <div class="form-group">
                            <label for="project_loi" class="control-label ">LOI</label>                    
                            <input type="text" class="form-control project_loi input-xsmall" name="project_loi" placeholder="LOI" value="0"  />                    
                        </div>
                    </div>
                    <div class="col-md-1" style="width:75px;">            
                        <div class="form-group">
                            <label for="project_cpc" class="control-label ">CPC</label>                    
                            <input type="text" class="form-control project_cpc input-xsmall" name="project_cpc" placeholder="CPC" value="0"  />                    
                        </div>
                    </div>
                    <div class="col-md-1" style="width:135px;">            
                        <div class="form-group">
                            <label for="project_ncomplete" class="control-label ">NComplete</label>                    
                            <input type="text" class="form-control project_ncomplete input-small" name="project_ncomplete" placeholder="NComplete" value="0"  />                    
                        </div>
                    </div>
                    <div class="col-md-2"> 
                        <div class="form-group">
                            <label for="project_target" class="control-label">Target Audience</label>            
                            <input type="text" class="form-control tags project_target" name="project_target" placeholder="Project Target" value="" />
                        </div>
                    </div>
                </div>
                <div class="row pull-right">
                    <div class="col-md-12 pull-right" > 
                        <input class="btn blue" value="Add" type="submit" id="btn_add" />
                        <a href="javascript:void(0);" class="btn default" id="cancel_project">Cancel</a>
                    </div>
                </div> 
            </fieldset>
        </form>
    </div>
    <div>
<?php if (isset($projects_country_details) && $projects_country_details != '') {
    ?>
            <div class="portlet-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-advance table-hover">
                        <thead>
                            <tr>
                                <th>Country</th>
                                <th>Segment Name</th>
                                <th>Segment</th>
                                <th>IR</th>
                                <th>LOI</th>
                                <th>CPC</th>
                                <th>Ncomplete</th>
                                <th>Target Audience</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody> <?php
                            foreach ($projects_country_details as $pc_val) {
                                if ($pc_val['is_delete'] == "1") {
                                    $tr_class = "deleted_detail";
                                    $show_action_button = "no";
                                } else {
                                    $tr_class = "";
                                    $show_action_button = "yes";
                                }
                                ?>
                            <form>
                                <tr class="project_country_detail <?php echo $tr_class; ?>" id="prj_country_<?php echo $pc_val['project_country_id']; ?>">
                                    <td style="width:200px;"><?php $cname = $this->common_function->in_array_field($pc_val['country_id'], 'country_id', $country, false);
                                echo '<div class="pr_info proj_info_' . $pc_val['project_country_id'] . '">' . $cname->country_name . '</div>';
                                ?><div class="pr_input proj_input_<?php echo $pc_val['project_country_id']; ?>" style="display:none;"><select class="form-control" name="edit_project_country" id="edit_project_country_<?php echo $pc_val['project_country_id']; ?>" style="width:150px;"><?php
                                        if (!empty($country)) {
                                            foreach ($country as $value) {
                                                if ($pc_val['country_id'] == $value->country_id) {
                                                    $cselected = "selected";
                                                } else {
                                                    $cselected = "";
                                                }
                                                ?>
                                                        <option value="<?php echo $value->country_id; ?>" <?php echo $cselected; ?>><?php echo $value->country_name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?></select></div>
                                    </td><td style="width:100px;"><div class="pr_info proj_info_<?php echo $pc_val['project_country_id']; ?>"><?php echo $pc_val['segment_name']; ?></div><div class="pr_input proj_input_<?php echo $pc_val['project_country_id']; ?>" style="display:none;"><input type="text" class="form-control segment_name" name="edit_segment_name" id="edit_segment_name_<?php echo $pc_val['project_country_id']; ?>" placeholder="Segment Name" value="<?php echo $pc_val['segment_name']; ?>"  /> <span id="edit_segment_name_<?php echo $pc_val['project_country_id']; ?>_error" class="error_span"></span>                   </div></td>
                                    <td style="width:140px;"><div class="pr_info proj_info_<?php echo $pc_val['project_country_id']; ?>"><?php echo $project_segments[$pc_val['project_segments']]; ?></div><div class="pr_input proj_input_<?php echo $pc_val['project_country_id']; ?>" style="display:none;"><select class="form-control" name="edit_project_segment" id="edit_project_segment_<?php echo $pc_val['project_country_id']; ?>" style="width:130px;">                        
                                                <?php
                                                if (isset($project_segments)) {
                                                    foreach ($project_segments as $key => $ps) {
                                                        if ($pc_val['project_segments'] == $key) {
                                                            $sselected = "selected";
                                                        } else {
                                                            $sselected = "";
                                                        }
                                                        ?>
                                                        <option value="<?php echo $key; ?>" <?php echo $sselected; ?>><?php echo $ps; ?></option>
                <?php
            }
        }
        ?>
                                            </select></div> </td>
                                    <td style="width:100px;"><div class="pr_info proj_info_<?php echo $pc_val['project_country_id']; ?>"><?php echo $pc_val['project_ir']; ?></div><div class="pr_input proj_input_<?php echo $pc_val['project_country_id']; ?>" style="display:none;"><input type="text" class="form-control project_ir input-xsmall" name="edit_project_ir" id="edit_project_ir_<?php echo $pc_val['project_country_id']; ?>" placeholder="IR" value="<?php echo $pc_val['project_ir']; ?>"  /></div></td>
                                    <td style="width:100px;"><div class="pr_info proj_info_<?php echo $pc_val['project_country_id']; ?>"><?php echo $pc_val['project_loi']; ?></div><div class="pr_input proj_input_<?php echo $pc_val['project_country_id']; ?>" style="display:none;"><input type="text" class="form-control project_loi input-xsmall" name="edit_project_loi" id="edit_project_loi_<?php echo $pc_val['project_country_id']; ?>" placeholder="LOI" value="<?php echo $pc_val['project_loi']; ?>"  /></div></td>
                                    <td style="width:80px;"><div class="pr_info proj_info_<?php echo $pc_val['project_country_id']; ?>"><?php echo $pc_val['project_cpc']; ?></div><div class="pr_input proj_input_<?php echo $pc_val['project_country_id']; ?>" style="display:none;"><input type="text" class="form-control project_cpc input-xsmall" name="edit_project_cpc" placeholder="CPC" id="edit_project_cpc_<?php echo $pc_val['project_country_id']; ?>" value="<?php echo $pc_val['project_cpc']; ?>"  /></div></td>
                                    <td style="width:80px;"><div class="pr_info proj_info_<?php echo $pc_val['project_country_id']; ?>"><?php echo $pc_val['project_ncomplete']; ?></div><div class="pr_input proj_input_<?php echo $pc_val['project_country_id']; ?>" style="display:none;"><input type="text" class="form-control project_ncomplete input-xsmall" name="edit_project_ncomplete" id="edit_project_ncomplete_<?php echo $pc_val['project_country_id']; ?>" placeholder="NComplete" value="<?php echo $pc_val['project_ncomplete']; ?>"  /></div></td>
                                    <td style="width:200px;"><div class="pr_info proj_info_<?php echo $pc_val['project_country_id']; ?>"><?php echo $pc_val['project_target']; ?></div><div class="pr_input proj_input_<?php echo $pc_val['project_country_id']; ?>" style="display:none;"><input type="text" class="form-control tags project_target" name="edit_project_target" id="edit_project_target_<?php echo $pc_val['project_country_id']; ?>" placeholder="Project Target" value="<?php echo $pc_val['project_target']; ?>" /></div></td>
                                    <td style="width:50px;"><?php if ($show_action_button == 'yes') { ?><a href="javascript:void(0);" class="pr_info" id="proj_edit_<?php echo $pc_val['project_country_id']; ?>"><i class="fa fa-edit"></i></a>&nbsp;<a href="javascript:void(0);" class="pr_info" id="proj_status_<?php echo $pc_val['project_country_id']; ?>_1"><i class="fa fa-trash-o"></i></a>&nbsp;<a href="javascript:void(0);" class="pr_input" id="proj_update_<?php echo $pc_val['project_country_id']; ?>" style="display:none;"><i class="fa fa-floppy-o"></i></a>&nbsp;<a href="javascript:void(0);" class="pr_input " id="proj_cancel_<?php echo $pc_val['project_country_id']; ?>" style="display:none;"><i class="fa fa-times"></i></a><?php } else {
                        echo 'Deleted&nbsp;<a href="javascript:void(0);" class="pr_info" id="proj_status_' . $pc_val['project_country_id'] . '_0"><i class="fa fa-undo"></i></a>';
                    } ?></td>
                                </tr>
                            </form>
    <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>	
<?php } ?>
    </div>	
</div>	
