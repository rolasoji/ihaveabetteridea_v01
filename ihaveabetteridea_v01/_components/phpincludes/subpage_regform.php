<!-- registration form -->
<?php 
    // fix for multiple calls to snippet on registration page (contact & registration forms)
    // ... required on any page using CAPTCHA snippet fields (currently: popup_contact.php & subpage_regform.php)
    // ... initiate ID count for CAPTCHA snippet fields
    $currentCAPTCHAID = 0;
    //echo "here - ".esc_url_custom($_SERVER['PHP_SELF'])."<br/>";
?>
<article class="registrationform">
    <h2>Registration form</h2>
    <p>Struggling to complete the form? Please refer to <a href="#regformhelp">further instructions for completing registration</a> below for help.</p>
    <p>Already registered? Please <a href="http://www.balancewellness.co.uk/zNEWsite_idea/_components/phpincludes/popup_login.php">login</a> to access all areas on this website.</p>
    <div>
        <div>
	        <form id="regform" name"regform" class="form-horizontal registration" role="form" action="<?php esc_url_custom($_SERVER['PHP_SELF']);?>" method="POST">
	        <!-- <form id="regform" name"regform" class="form-horizontal registration" role="form" action="<?php esc_url_custom($_SERVER['PHP_SELF']);?>" 
                    onsubmit="javascript: getCaptchaParam(this,this.id);" method="POST"> -->
	        <!-- <form class="form-horizontal registration" role="form" action="_components/phpincludes/snippet_regform_processing.php" onsubmit="return dialogALERT(this)" method="POST"> -->
	        <!-- <form class="form-horizontal registration" role="form" action="registration_process.php" onsubmit="javascript: return dialogALERT(this);" method="POST"> -->
		        <fieldset id="personalinfo">
			        <legend>Personal info</legend>
			        <div class="row">
				        <div class="form-group">
					        <label for="userfname" class="col col-lg-2 control-label"><span class="text-red">*&nbsp;</span>Firstname:</label>
					        <div class="col col-lg-10">
						        <input type="text" class="form-control" id="userfname" autofocus placeholder="Firstname" required maxlength="50" />
						        <!-- <input type="text" class="form-control" id="user-fname" autofocus placeholder="Firstname" /> -->
					        </div><!-- /.col -->
				        </div><!-- /.form-group -->
			        </div><!-- /.row -->
			        <div class="row">
				        <div class="form-group">
					        <label for="userlname" class="col col-lg-2 control-label"><span class="text-red">*&nbsp;</span>Lastname:</label>
					        <div class="col col-lg-10">
						        <input type="text" class="form-control" id="userlname" autofocus placeholder="Lastname" required maxlength="50" />
						        <!-- <input type="text" class="form-control" id="user-lname" autofocus placeholder="Lastname" /> -->
					        </div><!-- /.col -->
				        </div><!-- /.form-group -->
			        </div><!-- /.row -->
			        <div class="row">
				        <div class="form-group">
					        <label for="companyname" class="col col-lg-2 control-label">Company name:</label>
					        <div class="col col-lg-10">
						        <input type="text" class="form-control" id="companyname" placeholder="Company name" maxlength="100" />
					        </div><!-- /.col -->
				        </div><!-- /.form-group -->
			        </div><!-- /.row -->
			        <div class="row">
				        <div class="form-group">
					        <label for="websiteurl" class="col col-lg-2 control-label">Website URL:</label>
					        <div class="col col-lg-10">
						        <input type="text" class="form-control" id="websiteurl" placeholder="Website URL" maxlength="100" />
					        </div><!-- /.col -->
				        </div><!-- /.form-group -->
			        </div><!-- /.row -->
			        <div class="row">
				        <div class="form-group">
					        <label for="useremail" class="col col-lg-2 control-label"><span class="text-red">*&nbsp;</span>Email:</label>
					        <div class="col col-lg-10">
						        <input type="text" class="form-control" id="useremail" required autocomplete="off" placeholder="email@example.com" maxlength="50" />
						        <!-- <input type="text" class="form-control" id="user-email" autocomplete="off" placeholder="email@example.com" /> -->
					        </div><!-- /.col -->
				        </div><!-- /.form-group -->
			        </div><!-- /.row -->
			        <div class="row">
				        <div class="form-group">
					        <label for="inputusername" class="col col-lg-2 control-label"><span class="text-red">*&nbsp;</span>Username:</label>
					        <div class="col col-lg-3">
						        <input type="text" class="form-control" id="inputusername" required placeholder="Username" maxlength="25" />
					        </div><!-- /.col -->
					        <label class="col col-lg-7">&nbsp;</label><!-- /.col -->
				        </div><!-- /.form-group -->
			        </div><!-- /.row -->
			        <div class="row">
				        <div class="form-group">
					        <label for="inputpassword" class="col col-lg-2 control-label"><span class="text-red">*&nbsp;</span>Password:</label>
					        <div class="col col-lg-3">
						        <input type="password" class="form-control" id="inputpassword" required placeholder="Password" maxlength="12" />
					        </div><!-- /.col -->
					        <label for="confirmpassword" class="col col-lg-2 control-label"><span class="text-red">*&nbsp;</span>Confirm password:</label>
					        <div class="col col-lg-3">
						        <input type="password" class="form-control" id="confirmpassword" required placeholder="Password" maxlength="12" />
					        </div><!-- /.col -->
					        <label class="col col-lg-2">&nbsp;</label><!-- /.col -->
				        </div><!-- /.form-group -->
			        </div><!-- /.row -->
		        </fieldset><!-- #personalinfo -->
		        <fieldset id="otherinfo">
			        <legend>Other info</legend>
			        <label class="col col-lg-2">Subscribe</label>
			        <div class="col col-lg-10 checkbox">
				        <label>
					        <input type="checkbox" id="subscribe" name="subscribe" CHECKED value="yes" />
					        Would you like to subscribe to our e-mail list?
				        </label>
			        </div><!-- /.col -->
                    <img class="no-padding" src="http://www.balancewellness.co.uk/zNEWsite_idea/images/transplaceholder.png" width="100%" height="10px" />
			
			        <label class="col col-lg-2" for="reference" class="control-label">How did you hear about us?</label>
			        <select class="col col-lg-3" name="reference" id="reference" class="form-control">
				        <option>Choose&hellip;</option>
				        <option value="friend">A friend</option>
				        <option value="facebook">Facebook</option>
				        <option value="twitter">Twitter</option>
				        <option value="friend">Bing</option>
				        <option value="friend">Google</option>
				        <option value="friend">Yahoo!</option>
				        <option value="friend">Other search engine</option>
				        <option value="other">Other</option>
			        </select><!-- /select .col -->
			        <!-- to prevent full width display of dropdown-->
			        <label class="col col-lg-5">&nbsp;</label>
			
			        <!-- <div class="col col-lg-12 form-group">
				        <label for="contact-msg" class="control-label">Other comments:</label>
				        <textarea class="form-control" rows="4"></textarea>
			        </div> --><!-- /.col -->
		        </fieldset><!-- #otherinfo -->
                <?php include "snippet_captcha_form.php"; ?>
		        <button id="regsubmit" name="regsubmit" class="btn btn-primary pull-right" type="button" onclick="regformhash(this.form, this.form.id, 
                                       this.form.useremail,
                                       this.form.inputpassword,
                                       this.form.confirmpassword);">Submit</button>
                <button class="btn btn-default pull-right" type="reset">Cancel</button>
		        <!-- <p><input type="button" id="regsubmit" name="regsubmit" class="btn btn-primary pull-right" value="Submit" onclick="regformhash(this.form,
                                       this.form.email,
                                       this.form.password,
                                       this.form.confirmpassword);" /></p> -->
	        </form><!-- /.registration -->
        </div>
        <a name="regformhelp"></a>
        <div class="active">
            <h4>Registration instructions</h4>
            <hr />
            <ul>
                <li>Usernames may contain only digits, upper and lower case letters and underscores and no symbols.</li>
                <li>Emails must be in a recognised email format e.g. email@example.com.</li>
                <li>Passwords must be at least 6 characters.</li>
                <li>Passwords must contain,
                    <ul>
                        <li>at least one upper case letter (A..Z)</li>
                        <li>at least one lower case letter (a..z)</li>
                        <li>at least one digit (0..9).</li>
                    </ul>
                </li>
                <li>Ensure both password entries match.</li>
            </ul>
        </div>
    </div>
    <hr />
</article><!-- /.registrationform -->
