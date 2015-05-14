<?php include_once "_components/phpincludes/header.php"; ?>
<body id="home" data-ng-controller="musicController">
    <!-- header & top navigation bar -->
    <?php include_once "_components/phpincludes/header_menu.php"; ?>
    <!-- end of header & top navigation bar -->
    <div class="pagecontent container">
        <!-- site content -->
        <!-- page header container -->
	    <div class="page-header no-padding">
            <div class="logodiv">
                <img class="pull-right" src="http://www.balancewellness.co.uk/zNEWsite_idea/images/logoBW.png" alt="Balance Wellness - You deserve it!" valign="top" />
                <img class="no-padding" src="http://www.balancewellness.co.uk/zNEWsite_idea/images/transplaceholder.png" width="100%" height="1px" />
            </div><!-- /.logodiv -->
		    <h3><span class="pull-left"><em><span class="text-black">i</span><span class="text-red">Have</span><span class="text-black">A</span><span class="text-green">better</span><span class="text-blue">Idea</span></small> &hellip;&nbsp;for&nbsp;<small><span class="text-blue">&lt;idea / subject / topic name&gt;</span></small></em></span></h3>
            <br /><h4 class="pull-right"><em>First stop for verifiable ideas &hellip;&nbsp;about anything!</em></h4>
	    </div><!-- /.page-header -->
        <!-- end of page header -->
    </div><!-- /.container -->
    <!-- site content starts -->
    <div class="container">
        <div class="content row">
            <div class="col col-lg-12">
                <!-- menu items -->
                <ul class="nav nav-tabs center-block">
                	<li role="presentation" class="active"><a href="#">Ideas</a></li>
                	<li role="presentation"><a href="#">Products</a></li>
                	<li role="presentation"><a href="#">Skills</a></li>
                </ul>
            </div><!-- /.col -->
        </div><!-- /.content row -->
    </div>
    <div class="container-fluid clearfix">
        <div class="content row">
            <div class="sidebar col col-lg-3">
                <!-- sidebar include file(s) - xxx starts -->
                <p>Left column</p>
                <!-- sidebar include file(s) ends -->
            </div><!-- /.sidebar col -->
            <div class="sidebar col col-lg-6">
                <!-- center content include file(s) starts -->
                <p>Content column</p>
                <!-- center content file(s) end -->
            </div>
            <div class="sidebar col col-lg-3">
                <!-- sidebar include file(s) - xxx starts -->
                <p>Right column</p>
                <!-- sidebar include file(s) ends -->
            </div><!-- /.sidebar col -->
        </div><!-- /.content row -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-xs-12">
                    <div class="form-group">
                    <input type="text" class="form-control" id="search" placeholder="search artists" data-ng-model="search" />
                    <h1>{{search}}</h1>
                    </div>
                    <table class="table table-striped table-hover">
                        <tbody>
                            <tr>
                                <th>Artist name</th>
                                <th>Genre</th>
                                <th>Rating</th>
                            </tr>
                            <tr data-ng-repeat="item in data">
                                <td>{{item.name}}</td>
                                <td>{{item.genre}}</td>
                                <td>{{item.rating}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="disclaimer row">
            <div class="col col-lg-12">
                <!-- disclaimer include file(s) starts -->
                <?php include_once "_components/phpincludes/subpage_disclaimer.php"; ?>
                <!-- disclaimer include file(s) ends -->
            </div><!-- /.col -->
        </div><!-- /.content row -->
    </div><!-- /.container -->
    <!-- site content ends -->
    <!-- footer bar include file(s) starts -->
    <?php include_once "_components/phpincludes/footer.php"; ?>
    <!-- footer bar include file(s) ends -->
