<!-- form captcha snippet ..... -->
<fieldset id="captchaentry">
	<legend>Are you human?</legend>
	<div class="row">
		<div class="form-group">
            <a name="captchasection"></a>
			<p class="col col-lg-12">
                <span><img class="no-padding" src="http://www.balancewellness.co.uk/zNEWsite_idea/images/transplaceholder.png" width="8px" height="auto" /></span>
                <span><strong>Enter the CAPTCHA code shown below</strong></span>
            </p>
			<label for="captcha_code" class="col col-lg-2 control-label">CAPTCHA code:</label>
			<div class="col col-lg-3">
                <input id="captcha_code" name="captcha_code" type="text" class="form-control" required autocomplete="off" aria-describedby="captcha_coderefresh" /><br />
			</div><!-- /.col -->
			<div class="col col-lg-5">
                <!-- <div id="captcha-section"> -->
                    <img src="http://www.balancewellness.co.uk/zNEWsite_idea/captchaprocessing.php?width=100&amp;height=40&amp;characters=6" id="inputcaptcharefreshimg<?php echo $currentCAPTCHAID; ?>" alt="Captcha code" />
                <!-- </div> -->
                <a href="javascript: getCaptchaParam(this,'inputcaptcharefreshid<?php echo $currentCAPTCHAID; ?>');"><span id="inputcaptcharefreshid<?php echo $currentCAPTCHAID; ?>" 
                        class="btn btn-primary glyphicon glyphicon-refresh" aria-hidden="false"></span>
                <span id="inputcaptcharefreshid" class="sr-only">Refresh</span></a>
			</div><!-- /.col -->
			<label class="col col-lg-4">&nbsp;</label>
		</div><!-- /.form-group -->
	</div><!-- /.row -->
</fieldset><!-- #captchaentry -->
