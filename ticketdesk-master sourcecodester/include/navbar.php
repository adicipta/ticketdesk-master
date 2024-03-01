<!-- include bootstrap css -->

<link href="css/bootstrap.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<?php
include_once('include/ticket.php');
include_once('include/category.php');
include_once('include/department.php');
include_once('include/user.php');
include_once('include/class.system.php');

$systemBrand = system::withName('brand'); # get branding for nav bar

?>
<style type="text/css">
    body{
        background: #2575fc;
          background: -webkit-linear-gradient(left, #35c73c, #2575fc);
          background: -o-linear-gradient(left, #35c73c, #2575fc);
          background: -moz-linear-gradient(left, #35c73c, #2575fc);
          background: linear-gradient(left, #35c73c, #2575fc);
    }
</style>
<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div id="navContainer" class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="main.php"><?php echo ''. $systemBrand->getValue(); ?></a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li id="tickets" class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Tickets <span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                        <li><a href="./tickets.php?ticketId=mine">My Tickets</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="./tickets.php?ticketId=all">All</a></li>
                        <li><a href="./tickets.php?ticketId=open">Open</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="./tickets.php?ticketId=woc">Waiting on Client</a></li>
                        <li><a href="./tickets.php?ticketId=woa">Waiting on Agent</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="./tickets.php?ticketId=closed">Closed</a></li>
                    </ul>
                </li>
                <li id="reports"><a href="reports.php">Reports</a></li>
             <?php if ( $_SESSION['usertype']=='Administrator') {  ?>  
                <li id="system" class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">System <span class="caret"></span></a>
                    <ul class="dropdown-menu ">
                    	<li><a href="./system.php?maintenace=categories">Categories</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="./manageusers.php?maintenace=users">Users</a></li>
                        <!--<li><a href="include/system.php?maintenace=groups">Groups</a></li>-->
						<!-- <li><a href="system.php?maintenace=groups">Groups</a></li> -->
                        <li role="separator" class="divider"></li>
                        <li><a href="./system.php?maintenace=system">System</a></li>
                    </ul>
                </li>
           <?php } ?>  
            </ul>
            <p class="navbar-text">User: <?php echo ''. $_SESSION['username'] ."|".$_SESSION['usertype']; ?><a href="./include/logout.php"> log out?</a></p>
            <form class="navbar-form navbar-right" role="search">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default">Submit</button>
            </form>
        </div> <!-- /.navbar-collapse -->
    </div> <!-- /. nav -->
</nav>
