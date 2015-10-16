<form class="horizontal-form" role="form" id="frmEmailTemplate" action="<?php echo base_url(); ?>email_template/insert_email_template" method="post">
    <input type="hidden" id="email_template_id" name="email_template_id" value="<?php echo (isset($email_templates)) ? $email_templates['email_template_id'] : ""; ?>" />                    
    <div class="form-body">
        
            <div class="row">
                <div class="col-md-6">            
                    <div class="form-group">
                        <label for="email_template_shortcode" class="control-label">Email Short Code</label>                    
                        <input type="text" class="form-control" id="email_template_shortcode" name="email_template_shortcode" placeholder="Email Short Code" value="<?php echo (isset($email_templates)) ? $email_templates['email_template_shortcode'] : ""; ?>"  />                    
                    </div>
                </div>
                <div class="col-md-6">            
                    <div class="form-group">
                        <label for="email_template_subject" class="control-label">Email Subject</label>                    
                        <input type="text" class="form-control" id="email_template_subject" name="email_template_subject" placeholder="Email Subject" value="<?php echo (isset($email_templates)) ? $email_templates['email_template_subject'] : ""; ?>"  />                    
                    </div>
                </div>
                <div class="col-md-6">            

                    <div class="form-group">
                        <label for="email_template_content" class="control-label">Email Template Content</label>                   
                        <textarea class="form-control" name="email_template_content" id="email_template_content" placeholder="Email Template Content"><?php echo (isset($email_templates)) ? $email_templates['email_template_content'] : ""; ?></textarea>                    
                    </div>					                 
                </div>                      
            </div>
        
     </div>
     <div class="margin-top-10 ">        
        <input class="btn green" value="Save Changes" type="submit" id="btn_project" />
        <a href="<?php echo base_url('email_template'); ?>" class="btn default">Cancel</a>
    </div>      
</form>
<script type="text/javascript">
jQuery(document).ready(function () {
	$('.page-sidebar-menu .active').removeClass('active');
    $('.page-sidebar-menu #email-template').addClass('active');
});
</script>
