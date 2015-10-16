<!-- BEGIN LOGIN FORM -->
<?php
if (isset($company_error_msg) && $company_error_msg != '') {
    echo $company_error_msg;
} else if (isset($company_success_msg) && $company_success_msg != '') {
    echo $company_success_msg;
} else if (isset($validation_reg_error_msg) && $validation_reg_error_msg != '') {
    echo '<h3 class="form-title">Oops... Invalid Link</h3>';
    echo $validation_reg_error_msg;
} else if (isset($forgot_pwd_msg) && $forgot_pwd_msg != '') {
    echo '<h3 class="form-title">Forgot password</h3>';
    echo $forgot_pwd_msg;
} else {
    ?>
    <form class="login-form" action="<?php echo base_url('/login/login_success') ?>" id="frm-login" method="post">
        <h3 class="form-title">Login to your account</h3>
        <div class="alert alert-danger display-hide" id="alert-danger1">
            <i class="fa fa-times close-icon pull-right"></i>
            <span>Enter valid user-email and password. </span>
        </div>
        <div class="alert alert-danger display-hide" id="alert-danger2">
            <i class="fa fa-times close-icon pull-right"></i>
            <span>You account is not activated. Please <a href="mailto:contact@pangeapanel.com">contact us</a> for more details. </span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="login_user_email" id="login_user_email" />
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password" name="login_user_password" id="login_user_password" />
            </div>

        </div>
        <div class="form-actions">
            <!--<label class="checkbox">
            <input type="checkbox" name="remember" value="1"/> Remember me </label>-->
            <button type="submit" class="btn green pull-right">
                Login <i class="m-icon-swapright m-icon-white"></i>
            </button>		

        </div>
        <div class="forget-password">
            <h4>Forgot your password ?</h4>
            <p>
                No worries, click <a href="javascript:;" id="forget-password">here</a>
                to reset your password.
            </p>
        </div>

        <div class="create-account">
            <p>
                Don't have an account yet ?&nbsp; <a href="javascript:;" id="register-btn">Create an account</a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN Registration FORM -->
    <form class="register-form" action="<?php echo base_url('/login/insert_company') ?>" id="frm-signup"  method="post">
        <h3>Sign Up</h3>
        <p class="hint">
            Enter your personal details below:
        </p>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Company Name</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Company Name" name="company_name" id="company_name" autocomplete="off" value="" >
            </div><span id="company_name_error" class="error_span"></span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Full Name</label>
            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Full Name" name="user_name" id="user_name" autocomplete="off">
            </div><span id="user_name_error" class="error_span"></span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Email</label>
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Email" name="user_email" id="user_email" autocomplete="off">
            </div>
            <span id="user_email_error" class="error_span" style="display:none;">User Email is already exists. <a href="javascript:;"  id="lnk-forget-password">Know more?</a></span>
            <span id="user_email_blank_error" class="error_span" style="display:none;">Please enter valid email address.</span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>
            <div class="input-icon">
                <i class="fa fa-lock"></i>			
                <input class="form-control placeholder-no-fix" type="password" placeholder="Password" name="user_password" id="user_password" autocomplete="off">
            </div>
            <span id="user_password_error" class="error_span"></span>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Confirm Password</label>
            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="password" placeholder="Confirm Password" name="user_confirm_password" id="user_confirm_password" autocomplete="off">
                </div><span id="user_confirm_password_error" class="error_span"></span>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Type : </label>
            <select class="form-control" name="user_type" id="user_type" ><?php echo $company_type; ?></select>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="tnc" id="tnc" /> I agree to the <a class="btn bigicn-only" href="#" data-toggle="modal" data-toggle="modal"
                                                                                data-target="#basicModal">
                    <span>
                        Terms of Service
                    </span>
                </a>for <span id="agreement-text">Researcher</id></span>
            </label>
            <span id="register_tnc_error" class="error_span"></span>
        </div>
        <div class="form-actions">
            <button type="button" id="register-back-btn" class="btn"><i class="m-icon-swapleft"></i> Back</button>
            <button type="submit" id="register-submit-btn" class="btn btn-success uppercase pull-right">Submit</button>
        </div>
    </form>
    <!-- END Registration FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="<?php echo base_url('login/forgot_password_process'); ?>" method="post" id="frm-forgot">
        <h3>Forget Password ?</h3>
        <p>
            Enter your e-mail address below to reset your password.
        </p>
        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email" name="forgot_email" id="forgot_email" />
            </div><span id="forgot_email_error" class="error_span"></span>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn">
                <i class="m-icon-swapleft"></i> Back </button>
            <button type="submit" class="btn green pull-right">
                Submit <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
    <div class="modal fade" tabindex="-1" id="basicModal" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-wide">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">TERMS AND CONDITIONS</h4>
                </div>
                <div class="modal-body" id ="modal-body-txt">
                    <i class="fa fa-download"></i> <a href="http://www.google.com" target="_blank">DOWNLOAD PDF</a><br/>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>

    <script>
        jQuery(document).ready(function () {
    //<![CDATA[

            var researcher_pdf = "<i class=\"fa fa-download\"></i> <a href=\"../researcher.pdf\" target=\"_blank\">DOWNLOAD PDF FOR RESEARCHER</a><br/>";

            var researcher = "<h2>TERMS AND CONDITIONS - RESEARCHER</h2>" +
                    "<p><strong>THIS IS A FAIRLY DETAILED DOCUMENT, AND IT CONTAINS MANY IMPORTANT PROVISIONS THAT" +
                    "AFFECT YOUR RIGHTS AND OBLIGATIONS. PLEASE NOTE BY ACCEPTING THESE TERMS DURING" +
                    "REGISTRATION AND THEREAFTER, YOU HEREBY AGREE TO BE LEGALLY BOUND BY THIS" +
                    "AGREEMENT.</strong></p>" +
                    "<p><strong>WE ENCOURAGE YOU TO PRINT A COPY OF THIS AGREEMENT FOR YOUR RECORDS.</strong></p>" +
                    "<p>Last Updated: March 1st, 2015</p>" +
                    "<p>We reserve the right to amend this agreement at any time and provide you an update to the effect. Any new features that augment or enhance Pangea Panel, including the release of new tools and resources, shall be subject to this agreement. Continued use of Pangea Panel after any such changes shall constitute your consent to such changes.</p>" +
                    "<p>The following agreement is intended for companies engaged in buying online sample from" +
                    "Partners/Vendors/Panel Companies via connections, bidding or project engagements through the Pangea" +
                    "Panel online marketplace/exchange/platform. Unless otherwise noted Pangea Panel will be referred to as \"us”, \"we”, or \"ours” and the Researcher/Buyer/Client will be considered, \"you”, \"your”, \"yours”. By accepting this agreement you understand that you are bound by the items below.</p>" +
                    "<p>Key Terms are defined below and will be used subsequently throughout the document -" +
                    "Partners/Vendors/Panel Companies</p>" +
                    "<ul>" +
                    "<li>These are the firms or companies that utilize Pangea Panel - as partners - to furnish market research services from you, the Researcher.</li>" +
                    "</ul>" +
                    "Active Membership" +
                    "<ul>" +
                    "<li>An account is considered active if it is either 1) in the agreed upon trial period or 2) where membership fees are paid in full or 3) other arrangements exists.</li>" +
                    "</ul>" +
                    "Final Project Costs" +
                    "<ul>" +
                    "<li>All money transferred and/or due from you to the Partner in connection to market research sample purchases (respondents), project minimum charges, or any project management or link setup or likewise that was initiated via utilizing Pangea Panel - inclusive of any additional costs from original bid due to extension of scope, re-fielding, modification of specs of the project or otherwise. Any non-USD currency will be converted by you to process Researcher Rewards (see below) and to facilitate our accounting with the Partner.</li>" +
                    "</ul>" +
                    "A Completd Project" +
                    "<ul>" +
                    "<li>Upon succession of sample fielding, you will promptly review and determine qualified completes (dictated by your realistic and industry standards), upon which time you will provide us with the final project costs due the Partner for services rendered associated with that project.</li>" +
                    "</ul>" +
                    "Researcher Rewards™" +
                    "<ul>" +
                    "<li> As part of your paid membership you’ll receive an account credit for the amount of 1% of any Final Project Costs that have been approved and paid by the Partner. These credits can be used towards subsequent membership or taken as a check payable to your company.</li>" +
                    "</ul>" +
                    "You agree to:" +
                    "<ul>" +
                    "<li>Not reach out to Partner/Vendor directly - defined as bidding or awarding projects without using Pangea Panel’s established process - in attempts to circumvent the Pangea Panel system unless a recent(defined as past 3 months) and verifiable pre-existing online sample purchasing relationship can be exhibited. This contact restriction shall exist while a member and extend for 6 months after any possible termination as a member of Pangea Panel.</li>" +
                    "<li>Provide prompt, honest and accurate cost and evaluation details when providing feedback/rating the Partner in relation to services rendered on the particular project.</li>" +
                    "<li>Not attempt to modify Final Project Costs furnished us as they will be considered FINAL, upon Partner confirmation.</li>" +
                    "<li>Not copy, mimic, replicate, reverse engineer or otherwise use the process flow, programming code or other material found on Pangea Panel. Treat the Pangea Panel application/service ‘as-is’ and \"as available” basis, with no implicit or explicit warranty and your use is done at your own risk.</li>" +
                    "<li> Not hold Pangea Panel in anyway responsible, liable or culpable for any and all services rendered by the Partner that were initiated through Pangea Panel.</li>" +
                    "<li> Allow Pangea Panel to include your company name, company details and any uploaded images to" +
                    "Pangea Panel in current and/or future marketing materials and to accomplish the transactional needs of" +
                    "the application.</li>" +
                    "<li> For studies where it is necessary to pay Partner(s) with any currency besides the US Dollar (USD), you will convert the costs to USD for Final Project Costs.</li>" +
                    "<li>Keep membership current or lose access to any and all historical details.</li>" +
                    "<li>Pay membership fees promptly.</li>" +
                    "<li>Promptly pay Partners directly for services initiated through Pangea Panel directly. Unless otherwise agreed upon, Pangea Panel does not facilitate payments.</li>" +
                    "<li>Accept cookies placed on your computer to aid in the easy transactions.</li>" +
                    "<li>Keep passwords and other details confidential.</li>" +
                    "<li>Hold any and all information, details, feasibility, cost or any transactional information generated or captured in Pangea Panel as property of Pangea Panel.</li>" +
                    "<li>Any Researcher Rewards - 1% earned during any free (unpaid) period are forfeited unless you engage in a paid membership, in which they will be transferred with use as prescribed above.</li>" +
                    "<li> Accept that rebate/rewards have no cash value until redeemed and can be revoked at any time.</li>" +
                    "<li>Accept that rebate/reward have no cash value if account is canceled, defunct or abandoned.</li>" +
                    "<li>Accept that rebate/rewards are released after the Partner confirms and pays the amount provided by you the Researcher.</li>" +
                    "<li>One rebate/reward will be issued per company/paid account based on the details provided by the initial membership. There will be no splitting the rewards. Multiple accounts with associated membership payments can accomplish any such need.</li>" +
                    "<li> Allow Pangea Panel to full bid engagement revenue estimates to settle the account if a study is closed but costs are still unconfirmed for a period of 30 days. In such a situation, no reward points will be issued to you, the researcher.</li>" +
                    "<li>Provide an exit interview, detailed letter or email in case of cancellation to allow us to better understand how we can improve Not use the Pangea Panel name, logo or tagline in any media, marketing, website or other publication without written consent.</li>" +
                    "</ul>" +
                    "<p>Your relationship with Pangea Panel should not be considered employment, contract work or otherwise.</p>" +
                    "<p>You will make every effort to resolve any dispute amicably; whether it is a dispute you have with us or one we have with you. You will not threaten, harass, publicly humiliate us or use inflammatory language in order to achieve your objectives. Please reach out to us directly via writing us at <a href=\"mailto:contact@pangeapanel.com\">contact@pangeapanel.com</a>.</p>" +
                    "<p>In the unfortunate event that we cannot settle the dispute, you agree that any legal action will be governed by the laws of the State of Utah, United States of America, without applying conflict of law provisions. You also agree that any action will be brought to a court in Utah County in said State of Utah and you hereby submit to their jurisdiction and authority.</p>" +
                    "<p>The failure of Pangea Panel to exercise or enforce any right or provision of this agreement shall not constitute a waiver of such right or provision. </p>" +
                    "<p>If any provision of these terms and conditions shall be held or declared to be invalid or unenforceable for any reason by any court of competent jurisdiction, such provision shall be deemed null and void and shall not affect the application and/or interpretation of these terms and conditions. The remaining provisions of these terms and conditions shall continue in full force and effect, as if the invalid or unenforceable provision was not a part of these terms and conditions.</p>" +
                    "<p>This agreement constitutes the entire agreement between you and Pangea Panel and governs your use of Pangea Panel, superseding any prior agreements between you and Pangea Panel (including, but not limited to, any prior versions of the Terms and Conditions).</p>" +
                    "<p>By accepting this agreement you certify that you have the rights, power and authority to, and on behalf of your company and agree to be responsible for the terms and conditions contained therein.</p>" +
                    "<p>Unless expressly written this agreement is with the your respective company wherein if the original agreement signer is no longer employed at your company or is later ineligible to engage into such an agreement, this agreement persists as if the original agreeing party still maintained employment. Additionally, if the agreeing company is acquired, merged or the entity is in anyway modified this agreement persists with the new company/entity or incorporation status.</p>" +
                    "<p>If you have questions regarding this agreement please email <a href=\"mailto:contact@pangeapanel.com\">contact@pangeapanel.com</a>.</p>";


            var partner_pdf = "<i class=\"fa fa-download\"></i> <a href=\"../partner.pdf\" target=\"_blank\">DOWNLOAD PDF FOR PARTNER</a><br/>";
            var partner = "<h2>TERMS AND CONDITIONS - PARTNER</h2>" +
                    "<p><strong>THIS IS A FAIRLY DETAILED DOCUMENT, AND IT CONTAINS MANY IMPORTANT PROVISIONS THAT AFFECT YOUR RIGHTS AND OBLIGATIONS. PLEASE NOTE BY ACCEPTING THESE TERMS DURING REGISTRATION AND THEREAFTER, YOU HEREBY AGREE TO BE LEGALLY BOUND BY THIS AGREEMENT.</strong></p>" +
                    "<p><strong>WE ENCOURAGE YOU TO PRINT A COPY OF THIS AGREEMENT FOR YOUR RECORDS.</strong></p>" +
                    "<p>Last Updated: March 1st, 2015</p>" +
                    "<p>We reserve the right to notify you of any amending or updating made to this agreement at any time by providing you an update to the effect via email used at time of signing this agreement," +
                    "unless otherwise furnished in writing. You’ll have 7 days from time of update notification to question or reject any changes via emailing <a href=\"mailto:contact@pangeapanel.com\">contact@pangeapanel.com</a> If there is no satisfactory resolution to any concerns with the revised agreement, the Partner can within 14 days of the notification exit the agreement pursuant to the term below. If no email is received by us from the Partner with the 7 day period, any changes are considered accepted and binding. Any new features that augment or enhance the Pangea Panel, including the release of new tools and resources, shall be subject to this agreement. Continued use of Pangea Panel after any such changes shall constitute your consent to such changes.</p>" +
                    "<p>The following agreement is intended for companies agreeing to sell online sample to Researchers/Buyers/Clients via connections, bidding or project engagements through the Pangea Panel online marketplace/exchange/platform. Unless otherwise noted Pangea Panel will be referred to as \"us\", \"we\", or \"ours\" and the Partner/seller/vendor will be considered, \"you\", \"your\", \"yours\". By accepting this agreement agreeing you understand that you are bound by the items below.</p>" +
                    "<p>Key Terms Defined - Buyers/Clients/Researchers</p>" +
                    "<ul>" +
                    "<li>These are the firms and/or people that utilize Pangea Panel - via paid or unpaid" +
                    "memberships - to obtain market research services from you.</li>" +
                    "</ul>" +
                    "Final Revenue" +
                    "<ul>" +
                    "<li>All money transferred and/or due to the Partner (you) in connection to market research sample purchases, project minimum charges, or any project management or link setup or likewise that was initiated in any form via utilizing Pangea Panel - inclusive of any additional costs from original bid due to extension of scope, re-fielding, modification of specs of the project or otherwise. Any possible non-USD currency will be converted by the Researcher for use on the Monthly Revenue-share Invoice (MRI -see below).</li>" +
                    "</ul>" +
                    "A Completed Project" +
                    "<ul>" +
                    "<li>Upon succession of sample fielding, the Researchers will review and determine qualified" +
                    "completes (dictated by Researcher standards), upon which time the researcher will provide us with the final revenue (defined above) amount due you for services associated with that project.</li>" +
                    "</ul>" +
                    "Revenue Share (rev-share)" +
                    "<ul>" +
                    "<li>The percentage of final revenue (defined above) that Pangea Panel is due per each" +
                    "completed project/survey (defined above). Rev-share is 15% of final revenue.</li>" +
                    "</ul>" +
                    "Monthly Revenue-share Invoice hereafter called \"MRI\":" +
                    "<ul>" +
                    "<li> On or about the 1st calendar day of each new month all completed projects (defined" +
                    "above) will be compiled, rev-share computed and furnished to you for your prompt review and payment processing.</li>" +
                    "</ul>" +
                    "Agreement: <br />" +
                    "You agree to:" +
                    "<ul>" +
                    "<li>Not reach out to Buyers/Researchers directly (without use of Pangea Panel) in attempts" +
                    "to circumvent the Pangea Panel system unless a recent (defined as past 3 months) and verifiable pre-existing online sample purchasing relationship can be exhibited. This contact restriction shall extend for 6 months after any possible termination as a Partner in Pangea Panel initiated by the Partner. (Contact restriction is only 3 months if in response to agreement update/amendment as described above). If Pangea Panel feels the Partner is not a good fit for the Partner and terminates the relationship the contact restriction will be 3 months.</li>" +
                    "<li>Review for any MRI’s issues within 3 business days from issuance. After 3 days the MRI" +
                    "is considered final and the full invoice is due.</li>" +
                    "<li>Pay the balance of MRI’s within 30 days of issuance via USD currency.</li>" +
                    "<li>Include the MRI # on any payments made either electronic, check or otherwise.</li>" +
                    "<li>Pay any finance charges for delinquent invoices at 3% per month with a minimum" +
                    "finance charge of $100.</li>" +
                    "<li>Be financially responsible for any collections for outstanding debts and/or legal recourse" +
                    "to recoup payment that will be applied to the outstanding balance.</li>" +
                    "<li>Provide a copy of the invoice furnished a Researcher in such case that the Researcher" +
                    "is unwilling, unable or significantly delayed in providing Pangea Panel the final revenue amount (defined above) and that amount will then be reflected in the MRI.</li>" +
                    "<li>Treat the Pangea Panel application/service ‘as-is’ and \"as available\" basis, with no" +
                    "implicit or explicit warranty and your use is done at your own risk.</li>" +
                    "<li>Not furnish any inaccurate, misleading or deceptive representation of your panel offering" +
                    "including but not limited to size, reach and recruiting practices.</li>" +
                    "<li>Promptly pay Partners directly for services initiated through Pangea Panel directly. Unless otherwise agreed upon, Pangea Panel does not facilitate payments.</li>" +
                    "<li>Not hold Pangea Panel in anyway responsible for any delayed, delinquent, or nonpayments" +
                    "for services rendered by the Researchers initiated through Pangea Panel.</li>" +
                    "<li>Allow Pangea Panel to include your company name, panel details and any uploaded" +
                    "images to Pangea Panel in current and/or future marketing materials and to accomplish" +
                    "the transactional needs of the application.</li>" +
                    "<li>Not copy, mimic, replicate, reverse engineer or otherwise use the process flow," +
                    "programming code or other material found on Pangea Panel.</li>" +
                    "<li>Keep membership current or lose access to any and all historical details.</li>" +
                    "<li>Keep passwords and other details confidential.</li>" +
                    "<li>Hold any and all information, details, feasibility, cost or any transactional information" +
                    "generated or captured in Pangea Panel as property of Pangea Panel.</li>" +
                    "<li>Provide an exit interview, detailed letter or email in case of cancellation to allow us to" +
                    "better understand how we can improve.</li>" +
                    "<li>Not use the Pangea Panel name, logo or tagline in any media, marketing, website or" +
                    "other publication without written consent.</li>" +
                    "</ul>" +
                    "<p>Membership is voluntary and can be cancelled by either party at any time, however any forthcoming MRI payments will still be your responsibility after any cancellation and any outstanding MRI payment will be due until paid in full and subject to the financing stipulated above. Researcher contact restrictions as stated above still apply.</p>" +
                    "<p>Your relationship with Pangea Panel should not be considered employment, contract work or" +
                    "otherwise.</p>" +
                    "<p>You will make every effort to resolve any dispute amicably; whether it is a dispute you have with" +
                    "us or one we have with you. You will not threaten, harass, publicly humiliate us or use" +
                    "inflammatory language in to get achieve your objectives. Please reach out to us directly via" +
                    "emailing <a href=\"mailto:contact@pangeapanel.com\">contact@pangeapanel.com</a>.</p>" +
                    "<p>In the unfortunate event that we cannot settle the dispute, you agree that any legal action will be governed by the laws of the State of Utah, United States of America, without applying conflict of" +
                    "law provisions. You also agree that any action will be brought to a court in Utah County in said State of Utah and you hereby submit to their jurisdiction and authority.</p>" +
                    "<p>The failure of Pangea Panel to exercise or enforce any right or provision of this agreement shall" +
                    "not constitute a waiver of such right or provision.</p>" +
                    "<p>If any provision of these terms and conditions shall be held or declared to be invalid or" +
                    "unenforceable for any reason by any court of competent jurisdiction, such provision shall be" +
                    "deemed null and void and shall not affect the application and/or interpretation of these terms" +
                    "and conditions. The remaining provisions of these terms and conditions shall continue in full" +
                    "force and effect, as if the invalid or unenforceable provision was not a part of these terms and" +
                    "conditions.</p>" +
                    "<p>This agreement constitutes the entire agreement between you and Pangea Panel and governs" +
                    "your use of Pangea Panel, superseding any prior agreements between you and Pangea Panel(including, but not limited to, any prior versions of the Terms of Service).</p>" +
                    "<p>By signing this agreement you certify that you have the rights, power and authority to, and on" +
                    "behalf of your company and agree to be responsible for the terms and conditions contained therein.</p>" +
                    "<p>Unless expressly written this agreement is with the your respective company wherein if the original agreement signer is no longer employed at your company or is later ineligible to engage into such an agreement, this agreement persists as if the original agreeing party still maintained" +
                    "employment. Additionally, if the agreeing company is acquired, merged or the entity is in anyway modified this agreement persists with the new company/entity or incorporation status.</p>" +
                    "<p>If you have questions regarding this agreement please email <a href=\"mailto:contact@pangeapanel.com\">contact@pangeapanel.com</a>.</p>" +
                    "<table cellpadding=\"8\" cellspacing=\"0\" border=\"1\">" +
                    "<tr>" +
                    "<td>Company Name :</td>" +
                    "<td style=\"width:200px;\">&nbsp;</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td>Signature :</td>" +
                    "<td>&nbsp;</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td>Printed Name :</td>" +
                    "<td>&nbsp;</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td>Title :</td>" +
                    "<td>&nbsp;</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td>Date :</td>" +
                    "<td>&nbsp;</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td>Phone Number :</td>" +
                    "<td>&nbsp;</td>" +
                    "</tr>" +
                    "<tr>" +
                    "<td>Email :</td>" +
                    "<td>&nbsp;</td>" +
                    "</tr>" +
                    "" +
                    "</table>";

            $("#modal-body-txt").html(researcher_pdf + researcher);

            jQuery('.register-form').hide();
    //jQuery('.forget-form').hide();

            jQuery('#register-btn').click(function () {
                jQuery('.login-form').hide();
                jQuery('.forget-form').hide();
                jQuery('.register-form').show();
            });
            jQuery('#register-back-btn').click(function () {
                jQuery('.login-form').show();
                jQuery('.register-form').hide();
                jQuery('.forget-form').hide();
            });
            jQuery('#back-btn').click(function () {
                jQuery('.login-form').show();
                jQuery('.register-form').hide();
                jQuery('.forget-form').hide();
            });
            jQuery('#forget-password').click(function () {
                jQuery('.login-form').hide();
                jQuery('.register-form').hide();
                jQuery('.forget-form').show();
            });
            jQuery('#lnk-forget-password').click(function () {
                jQuery('.login-form').hide();
                jQuery('.register-form').hide();
                jQuery('.forget-form').show();
            });

            jQuery(".alert-danger .close-icon").click(function () {
                jQuery(".alert-danger").removeClass('display-block');
                jQuery(".alert-danger").addClass('display-hide');
            });
            var frm_forgot = jQuery("#frm-forgot");
            var forgot_email = jQuery("#forgot_email");
            function validate_forgot_email() {
                var forgotemailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if (forgot_email.val() == "") {
                    forgot_email.addClass("error");
                    jQuery("#forgot_email_error").html("Please enter email");
                    return false;
                } else if (!forgotemailReg.test(forgot_email.val())) {
                    forgot_email.addClass("error");
                    jQuery("#forgot_email_error").html("Please enter valid email");
                    return false;
                } else {
                    var forgot_flag = '';
                    jQuery.ajax({
                        type: "post",
                        url: "<?php echo base_url('login/load_forgot_email'); ?>",
                        data: "forgot_email=" + forgot_email.val(),
                        async: false,
                        success: function (response) {
                            if ($.trim(response) == "success") {
                                forgot_email.removeClass("error");
                                jQuery("#forgot_email_error").html("");
                                forgot_flag = true;
                            } else {
                                forgot_email.addClass("error");
                                jQuery("#forgot_email_error").html("Email does not exist. Please contact us at <a href='mailto:contact@pangeapanel.com'>contact@pangeapanel.com</a>");
                                forgot_flag = false;
                            }
                        }
                    });
                    return forgot_flag;
                }
            }
            forgot_email.blur(validate_forgot_email);
            //forgot_email.keyup(validate_forgot_email);

            frm_forgot.submit(function () {
                if (validate_forgot_email()) {
                    return true;
                } else {
                    return false;
                }
            });

            var frm_login = jQuery("#frm-login");
            var login_user_email = jQuery("#login_user_email");
            var login_user_password = jQuery("#login_user_password");
            function validate_login_user_name() {
                if (login_user_email.val() == "" && login_user_password.val()) {
                    jQuery(".alert-danger").removeClass('display-hide');
                    jQuery(".alert-danger").addClass('display-block');
                    return false;
                } else {
                    var flag = '';
                    jQuery.ajax({
                        type: "post",
                        url: "<?php echo base_url('login/load_check_user_credential') ?>",
                        data: "login_user_email=" + login_user_email.val() + "&login_user_password=" + login_user_password.val(),
                        async: false,
                        success: function (response) {
                            if ($.trim(response) == "success") {
                                jQuery("#alert-danger1").removeClass('display-block');
                                jQuery("#alert-danger1").addClass('display-hide');
                                jQuery("#alert-danger2").removeClass('display-block');
                                jQuery("#alert-danger2").addClass('display-hide');
                                flag = true;
                            } else {
                                if ($.trim(response) == "fail") {
                                    jQuery("#alert-danger1").removeClass('display-hide');
                                    jQuery("#alert-danger1").addClass('display-block');
                                    jQuery("#alert-danger2").removeClass('display-block');
                                    jQuery("#alert-danger2").addClass('display-hide');
                                }
                                else {
                                    jQuery("#alert-danger2").removeClass('display-hide');
                                    jQuery("#alert-danger2").addClass('display-block');
                                    jQuery("#alert-danger1").removeClass('display-block');
                                    jQuery("#alert-danger1").addClass('display-hide');

                                }
                                flag = false;
                            }
                        }
                    });
                    return flag;
                }
            }
            frm_login.submit(function () {
                if (validate_login_user_name()) {
                    return true;
                } else {
                    return false;
                }
            });



            var frm_signup = jQuery("#frm-signup");
            var company_name = jQuery("#company_name");
            function validate_company_name() {
                if (company_name.val() == "") {
                    company_name.addClass("error");
                    jQuery("#company_name_error").html('Please enter Company Name');
                    return false;
                } else {
                    company_name.removeClass("error");
                    jQuery("#company_name_error").html('');
                    return true;
                }
            }
            company_name.blur(validate_company_name);

            var user_password = jQuery("#user_password");
            function validate_user_password() {
                if (user_password.val() == "") {
                    user_password.addClass("error");
                    jQuery("#user_password_error").html('Please enter Password');
                    return false;
                } else {
                    user_password.removeClass("error");
                    jQuery("#user_password_error").html('');
                    return true;
                }
            }
            user_password.blur(validate_user_password);
            //user_password.keyup(validate_user_password);  
            var user_name = jQuery("#user_name");
            function validate_user_name() {
                if (user_name.val() == "") {
                    user_name.addClass("error");
                    jQuery("#user_name_error").html('Please enter Full Name');
                    return false;
                } else {
                    user_name.removeClass("error");
                    jQuery("#user_name_error").html('');
                    return true;
                }
            }
            user_name.blur(validate_user_name);
            //user_name.keyup(validate_user_name);  
            var user_tnc = jQuery("#tnc");
            function validate_user_tnc() {
                if (jQuery('#tnc').prop('checked')) {
                    user_tnc.removeClass("error");
                    jQuery("#register_tnc_error").html('');
                    return true;
                } else {
                    user_tnc.addClass("error");
                    jQuery("#register_tnc_error").html('Please agree our Terms and Conditions');
                    return false;
                }
            }
            user_tnc.change(validate_user_tnc);
            var user_confirm_password = jQuery("#user_confirm_password");
            function validate_user_confirm_password() {
                if (user_confirm_password.val() == "" || user_confirm_password.val() != user_password.val()) {
                    user_confirm_password.addClass("error");
                    jQuery("#user_confirm_password_error").html('Please confirm your Password');
                    return false;
                } else {
                    user_confirm_password.removeClass("error");
                    jQuery("#user_confirm_password_error").html('');
                    return true;
                }
            }
            user_confirm_password.blur(validate_user_confirm_password);
            //user_confirm_password.keyup(validate_user_confirm_password);  
            var user_email = jQuery("#user_email");
            function validate_user_email() {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                if (user_email.val() == "") {
                    user_email.addClass("error");
                    jQuery("#user_email_blank_error").show();
                    jQuery("#user_email_error").hide();
                    return false;
                } else if (!emailReg.test(user_email.val())) {
                    user_email.addClass("error");
                    jQuery("#user_email_blank_error").show();
                    jQuery("#user_email_error").hide();
                    return false;
                } else {
                    var login_flag = '';
                    $.ajax({
                        url: base_url + 'login/load_check_user_email',
                        data: {user_email: user_email.val()},
                        type: "post",
                        async: false,
                        success: function (response) {
                            if ($.trim(response) === "success") {
                                user_email.removeClass("error");
                                jQuery("#user_email_blank_error").hide();
                                jQuery("#user_email_error").hide();
                                login_flag = true;
                            } else {
                                user_email.addClass("error");
                                jQuery("#user_email_blank_error").hide();
                                jQuery("#user_email_error").show();
                                login_flag = false;
                            }
                        }
                    });
                    return login_flag;
                }
            }
            user_email.blur(validate_user_email);
            //user_email.keyup(validate_user_email);

            frm_signup.submit(function () {
                if (validate_company_name() & validate_user_name() & validate_user_email() & validate_user_password() & validate_user_confirm_password() & validate_user_tnc()) {
                    return true;
                } else {
                    return false;
                }
            });

            $("#user_type").change(function () {
                var utype = this.value;
                if (utype === '1') {
                    $("#agreement-text").html('Researcher.');
                    $("#modal-body-txt").html(researcher_pdf + researcher);
                }
                if (utype === '2') {
                    $("#agreement-text").html('Partner.');
                    $("#modal-body-txt").html(partner_pdf + partner);
                }
                if (utype === '3') {
                    $("#agreement-text").html('Researcher and Partner.');
                    $("#modal-body-txt").html(researcher_pdf + partner_pdf + researcher + '<hr />' + partner);
                }
            });


        });
        //]]>
    </script>
<?php } ?>