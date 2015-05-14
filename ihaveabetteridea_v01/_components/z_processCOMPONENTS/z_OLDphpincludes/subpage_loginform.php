<!-- login form snippet -->
<article class="loginform">
    <div>
	    <form class="form-horizontal login" role="form" action="_components/phpincludes/snippet_login_processing.php" onsubmit="javascript: return validateCAPTCHA(this);" method="POST">
		    <fieldset id="logininfo">
			    <legend>Login details</legend>
			    <div class="row">
				    <div class="form-group">
					    <!-- <label for="inputusername" class="col col-lg-2 control-label"><span class="text-red">*&nbsp;</span>Username:</label>
					    <div class="col col-lg-3">
						    <input type="text" class="form-control" id="inputusername" required placeholder="Username" maxlength="25" />
					    </div> --><!-- /.col -->
					    <label for="useremail" class="col col-lg-2 control-label"><span class="text-red">*&nbsp;</span>Email:</label>
					    <div class="col col-lg-3">
						    <input type="text" class="form-control" id="useremail" required autocomplete="off" placeholder="email@example.com" maxlength="50" />
					    </div><!-- /.col -->
					    <label for="inputpassword" class="col col-lg-2 control-label"><span class="text-red">*&nbsp;</span>Password:</label>
					    <div class="col col-lg-3">
						    <input type="password" class="form-control" id="inputpassword" required placeholder="Password" maxlength="12" />
					    </div><!-- /.col -->
					    <label class="col col-lg-2">&nbsp;</label><!-- /.col -->
				    </div><!-- /.form-group -->
			    </div><!-- /.row -->
		    </fieldset><!-- #logininfo -->
		    <p>
                <button id="logsubmit" name="logsubmit" class="btn btn-primary pull-left" type="submit" onclick="formhash(this.form, this.form.inputpassword);">Login</button>
                <span>&nbsp;<a href="#">Forgot Password?</a></span>
            </p>
		    <!-- <p><input type="button" id="logsubmit" name="logsubmit" class="btn btn-primary pull-right" value="Login" onclick="formhash(this.form, this.form.inputpassword);" /></p> -->
	    </form><!-- /.login -->
        <p>If you are not yet registered, please <a href="http://www.balancewellness.co.uk/zNEWsite_idea/registration.php">register</a> to access all areas on this website.</p>
    </div>
</article><!-- /.loginform -->
