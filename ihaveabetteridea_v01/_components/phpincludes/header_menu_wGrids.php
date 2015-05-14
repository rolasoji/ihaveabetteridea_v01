<!-- top navigation bar -->
<div id="topnav" class="navbar navbar-inverse navbar-static-top">
	<div class="container-fluid">
        <div id="logincheck" class="pull-right">
            <?php if (login_check($mysqli) == "true") : ?>
                <p><span><?php echo "Welcome ".htmlentities($_SESSION['username']); ?></span>&nbsp;
                <span><a href="_components/phpincludes/snippet_logout_processing.php" class="btn btn-primary btn-sm">Log out</a></span></p>
            <?php else : ?>
                <p><span><a href="http://www.balancewellness.co.uk/zNEWsite_idea/login.php" class="btn btn-primary btn-sm">Login</a></span>&nbsp;
                <span><a href="http://www.balancewellness.co.uk/zNEWsite_idea/registration.php" class="btn btn-danger btn-sm">Register now</a></span></p>
            <?php endif; ?>
            <p>&nbsp;</p>
        </div><!-- /#logincheck -->
        <div id="navitems">
    	    <a href="http://www.balancewellness.co.uk/zNEWsite_idea/" class="navbar-brand">Balance Wellness</a>
            <div class="navbar-header">
                <button class="navbar-toggle" data-toggle="collapse" data-target="#navHeaderCollapse">
                    <span class="sr-only">Toogle</span>
        	        <!-- Glyphicon shows up as black by default / also doesn't allow proper menu item alignment -->
                    <span class="glyphicon glyphicon-tasks" style="color: #ccc;"></span>
                </button><!-- /.navbar-toggle button -->
            </div><!-- /.navbar-header -->
            <div id="navHeaderCollapse" class="collapse navbar-collapse">
        	    <ul class="nav navbar-nav navbar-right">
            	    <li><a href="http://www.balancewellness.co.uk/zNEWsite_idea/index.php"><span class="glyphicon glyphicon-home"></span>&nbsp;Wellness home</a></li>
            	    <li><a href="http://www.balancewellness.co.uk/zNEWsite_idea/dashboard.php"><span class="glyphicon glyphicon-dashboard"></span>&nbsp;My dashboard</a></li>
            	    <li><a href="http://www.balancewellness.co.uk/zNEWsite_idea/about.php">About</a></li>
            	    <li><a href="http://www.balancewellness.co.uk/zNEWsite_idea/blog/index.php">Blog</a></li>
            	    <li class="dropdown">
                	    <a href="http://www.balancewellness.co.uk/zNEWsite_idea/aboutfood.php" class="dropdown-toggle" data-toggle="dropdown" id="dropdownMenu">
                    	    Food <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                    	    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Calories</a></li>
                            <li role="presentation" class="divider"></li>
                    	    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Analysis</a></li>
                    	    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Planning</a></li>
                    	    <li role="presentation"><a role="menuitem" tabindex="-1" href="#">Tips</a></li>
                        </ul>
				    </li>
            	    <li><a href="http://www.balancewellness.co.uk/zNEWsite_idea/faqpage.php">Wellness FAQ</a></li>
            	    <li><a href="#contactform_modal" data-toggle="modal">Contact</a></li>
            	    <!--<li><a href="#contactform_modal" data-backdrop="false" data-toggle="modal">Contact</a></li>-->
                </ul><!-- /.nav list -->
            </div><!-- /.collapse -->
        </div><!-- /#navitems -->
    </div><!-- /.container-fluid -->
</div><!-- end pageheader -->
<!-- end top navigation bar -->
