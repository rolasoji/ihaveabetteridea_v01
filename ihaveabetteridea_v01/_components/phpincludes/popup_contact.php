<!-- contact form -->
<?php 
    // fix for multiple calls to snippet on registration page (contact & registration forms)
    // ... required on any page using CAPTCHA snippet fields (currently: popup_contact.php & subpage_regform.php)
    // ... initiate ID count for CAPTCHA snippet fields
    $currentCAPTCHAID = 0;
?>
<div id="contactform_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="contactform_modalLabel" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
				<h4>Contact us</h4>
			</div>
        	<form class="form-horizontal" role="form" action="check_captcha.php">
			    <div class="modal-body">
		                <fieldset id="contactmessage">
			                <legend>Enquiry message</legend>
                        	    <div class="row">
					                <div class="form-group">
						                <label for="contact-name" class="col-lg-2 control-label">Name:</label>
    					                <div class="col-lg-10">
      						                <input type="text" class="form-control" id="contact-name" placeholder="Full name">
    					                </div>
					                </div>
					                <div class="form-group">
						                <label for="contact-email" class="col-lg-2 control-label"><span class="text-red">*&nbsp;</span>Email:</label>
    					                <div class="col-lg-10">
      						                <!-- <input type="email" class="form-control" id="contact-email" required autocomplete="off" placeholder="you@example.com"> -->
						                    <input type="text" class="form-control" id="contact-email" autocomplete="off" placeholder="email@example.com" />
    					                </div>
					                </div>
			                        <label for="messagetype" class="col-lg-2 control-label">Message type</label>
			                        <div class="col col-lg-10 radio">
				                        <div class="form-group">
					                        <label><input type="radio" name="messagetype" id="messagetype1" value="question" /> Question</label>
					                        <label class="radio"><input type="radio" name="messagetype" id="messagetype2" value="comment" /> Comment</label>
				                        </div><!-- /.form-group -->
			                        </div><!-- /.col -->
					                <div class="form-group">
						                <label for="contact-msg" class="col-lg-2 control-label">Message:</label>
    					                <div class="col-lg-10">
      						                <textarea class="form-control" rows="8"></textarea>
    					                </div>
					                </div>
                    	        </div><!-- /.row -->
		                </fieldset><!-- #contactmessage -->
                        <?php 
                            // fix for multiple calls to snippet on registration page (contact & registration forms)
                            $currentCAPTCHAID++;
                            include "snippet_captcha_form.php"; 
                        ?>
			    </div>
			    <div class="modal-footer">
				    <a class="btn btn-default" data-dismiss="modal">Cancel</a>
                    <button id="contactsubmit" name="contactsubmit" class="btn btn-primary" type="submit">Send message</button>
			    </div>
			</form>
		</div>
	</div>
</div>
<!-- end contact form -->
