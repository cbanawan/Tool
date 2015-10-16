<form class="form-horizontal" role="form" id="frmCompany"  method="post">
    <div class="form-body">
        <div class="row">            
            <div class="form-group">
                <label for="company_name" class="col-md-2 control-label ">Company Name : </label> 
                <div class="col-md-4"><?php echo (isset($company)) ? $company['company_name'] : ""; ?></div>
            </div>            
            <div class="form-group">
                <label for="company_type" class="col-md-2 control-label ">Company Type : </label>
                <div class="col-md-4">
                    <?php
                    if (isset($company_type)) {
                        $sel = "";
                        foreach ($company_type as $ctk => $ctv) {

                            if (isset($company) && intval($ctk) == intval($company['company_type'])) {
                                $sel = $ctv;
                            }
                        }
                    }
                    echo $sel;
                    ?>

                </div>
            </div>
        </div>
        <div class="row">           
            <div class="form-group">
                <label for="company_email" class="col-md-2 control-label ">Company Email : </label>
                <div class="col-md-4">
                    <?php echo (isset($company['company_email'])) ? $company['company_email'] : ""; ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="company_url" class="col-md-2 control-label ">Company Url : </label>
                <div class="col-md-4">
                    <?php echo (isset($company['company_url'])) ? $company['company_url'] : ""; ?>
                </div>
            </div></div>
        <div class="row">           
            <div class="form-group">
                <label for="company_address" class="col-md-2 control-label ">Company Address : </label>                   
                <div class="col-md-4">
                    <?php echo (isset($company['company_address'])) ? $company['company_address'] : ""; ?>
                </div>
            </div>
            <div class="form-group">
                <label for="company_city" class="col-md-2 control-label ">Company City : </label>                    
                <div class="col-md-4">
                    <?php echo (isset($company['company_city'])) ? $company['company_city'] : ""; ?>                    
                </div>
            </div></div>
        <div class="row">          
            <div class="form-group">
                <label for="company_state" class="col-md-2 control-label ">Company State : </label>
                <div class="col-md-4">
                    <?php echo (isset($company['company_state'])) ? $company['company_state'] : ""; ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="company_country" class="col-md-2 control-label ">Company Country : </label>            
                <div class="col-md-4">
                    <?php
                    $sel = "";
                    if (!empty($country)) {
                        foreach ($country as  $value) {
                            if ($company['company_country'] == $value->country_id)
                                $sel = $value->country_name;
                        }
                    }echo $sel;
                    ?>                        
                </div>
            </div>
        </div>       
        <div class="row">            
            <div class="form-group">
                <label for="company_zip" class="col-md-2 control-label ">Company Zip : </label>
                <div class="col-md-4">
                    <?php echo (isset($company['company_zipcode'])) ? $company['company_zipcode'] : ""; ?>
                </div>
            </div>            
            <div class="form-group">
                <label for="company_contact" class="col-md-2 control-label ">Company Phone : </label>            
                <div class="col-md-4"><?php echo (isset($company['company_contact_no'])) ? $company['company_contact_no'] : ""; ?>
                </div>
            </div>
        </div>
<!--        <div class="row">
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="company_tag" class="control-label">Company Tag</label>            
                    <input type="text" class="form-control tags" id="company_tag" name="company_tag" placeholder="Company Tags" value="<?php echo (isset($company['company_tags'])) ? $company['company_tags'] : ""; ?>" />
                </div>
            </div>
            <div class="col-md-6"> 
                <div class="form-group">
                    <label for="company_segment" class="control-label ">Company Segment</label>            
                    <select class="form-control select2" name="company_segment" id="company_segment" multiple>                        
                        <?php
                        if (isset($company_segment)) {
                            foreach ($company_segment as $key => $cs) {
                                ?>
                                <option value="<?php echo $key; ?>"><?php echo $cs; ?></option>
                                <?php
                            }
                        }
                        ?>
                    </select>  
                    <input type="hidden" name="hdn_company_segment" id="hdn_company_segment" />
                </div>
            </div>
        </div>-->
    </div>

</form>
<script type="text/javascript">
    
    $(document).ready(function () {
        $('.active').removeClass('active');
        $('#company_profile').addClass('active');
	});
	</script>
