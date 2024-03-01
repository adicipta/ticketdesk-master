<?php
include_once 'include/connect.php';
include_once 'include/functions.php';
 
sec_session_start();
 
if (login_check(dbConnect()) == true) {
    #$logged = 'in';
    header('location: main.php');
} else {
    $logged = 'out';
}
?>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>


<script>
function checkSubmit(e, dom)
{
   if(e && e.keyCode == 13)
   {
       var form = document.getElementById("login_form");
       var password = document.getElementById("password");
       formhash(form, password);
      document.forms[0].submit();
   }
}
</script>

<!DOCTYPE html>
<html>
    <head>
        <title>Secure Login: Log In</title>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script> 
    </head>
    <body>  
		<div id="loginPanel" class="panel panel-default">
		  <div class="panel-heading"><span class="glyphicon glyphicon-list-alt"></span> Log in</div>
  			<div class="panel-body">
		        <?php
		        if (isset($_GET['error'])) {
		            echo '<p class="alert alert-danger">Error logging in, please try again.</p>';
		        }
		        ?> 
			<form action="include/process_login.php" method="post" name="login_form" id="login_form" onKeyPress="return checkSubmit(event, this)">
			    <div class="form-group">
			        <label class="col-sm-2 control-label">Username</label>
			        <div class="col-sm-10">
				        <input type="text" name="email" id="email" class="form-control" placeholder="user@email.com" aria-describedby="basic-addon1">
				    </div>
			    </div>
			    <div class="form-group">
			        <label class="col-sm-2 control-label">Password</label>
			        <div class="col-sm-10">
			            <input type="password" name="password" id="password"  class="form-control" placeholder="Password" aria-describedby="basic-addon1">
			        </div>
		        </div>
		        
		        <div class="form-group">
		            <div class="col-sm-2"></div>
		            <div class="col-sm-10">
		                <div class="btn-toolbar" style="margin:1em 0 1em -5px;" role="toolbar" aria-label="...">
                            <div class="btn-group" role="group" aria-label="...">
                                <button type="button" value="Login" id="Login" onclick="formhash(this.form, this.form.password);" class="btn btn-success">Log In</button>
                            </div>
                            <div class="btn-group" role="group" aria-label="...">
                                <!-- <a class="btn btn-primary" href='reset.php'>Forgot?</a> -->
                                <!-- <a class="btn btn-warning" href='register.php'>Register</a>	 -->
                            </div>
                        </div> <!--button toolbar -->
                    </div> <!--button column 10 -->
                </div> <!-- buttons div -->			

			</form>
			<?php
        if (login_check(dbConnect()) == true) {
                        echo '<p>Currently logged ' . $logged . ' as ' . htmlentities($_SESSION['username']) . '.</p>';
 
            echo '<p>Do you want to change user? <a href="include/logout.php">Log out</a>.</p>';
        } else {
                        echo '<p>Currently logged ' . $logged . '.</p>';
                        echo "<p>If you don't have a login, please register";
                }
?>      	</div>
		
		</div>
			
    </body>
</html>