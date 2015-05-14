<!-- login form -->
<div id="loginform_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="loginform_modalLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="model-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h4>Login</h4>
            </div>
            <div class="modal-body">
                <?php include_once "snippet_loginform.php"; ?>
                <!-- <form method="post" action='' name="login_form">
                    <p><input type="text" class="span3" name="eid" id="email" placeholder="Email"></p>
                    <p><input type="password" class="span3" name="passwd" placeholder="Password"></p>
                    <p><button type="submit" class="btn btn-primary">Log in</button><a href="#">Forgot Password?</a></p>
                </form> -->
            </div>
            <div class="modal-footer">
                <a class="btn btn-default" data-dismiss="modal">Close</a>
            </div>
        </div>
    </div>
</div><!-- end login form modal -->
