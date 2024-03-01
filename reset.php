<?php

include_once 'include/connect.php';
include_once 'include/header.php';
include_once 'include/system.php';

unset($message);

if($_POST['action']) {

    $systemEmail = system::withName('system email');
    $siteUrl = system::withName('siteurl');
    $mysqli = dbConnect();

    $email = mysqli_real_escape_string($mysqli,$_POST['email']);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email address
        $message =  "Invalid email address please type a valid email!";
    } else {
        $query = "SELECT id FROM users where email='".$email."'";
        $result = mysqli_query($mysqli,$query);
        $Results = mysqli_fetch_array($result);

        if(count($Results)>=1) {
            $encrypt = md5(1290*3+$Results['id']);
            $message = "Your password reset link send to your e-mail address.";
            $to=$email;
            $subject="Forget Password";
            $from = $systemEmail->getValue();
            $body='Hi, <br/> <br/>Your login ID is '.$Results['id'].' <br><br>Click <a href="' .$siteUrl->getValue(). 'include/process_reset.php?encrypt='.$encrypt.'&action=reset">here</a> to reset your password <br/>';
            $headers = "From: " . strip_tags($from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

            mail($to,$subject,$body,$headers);
            $message = 'An email with instuctions to reset you password has been sent to '.$email; 
        } else {
            $message = "Account not found.";
        }
    }
}
?>
<link href="css/bootstrap.css" rel="stylesheet">
<link href="style.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>

<script>
function checkSubmit(e)
{
   if(e && e.keyCode == 13)
   {
      document.forms[0].submit();
   }
}
</script>

<div id="loginPanel" class="panel panel-default">
  <div class="panel-heading">Reset Password</div>
	<div class="panel-body">
	    <?php if (isset($message)) { ?>
	        <p class="alert alert-info"> <?php echo '' .$message; ?> </p>
	    <?php } ?> 
	
		<form action="#" method="post" name="login_form" >
	        <div class="form-group">
	            <label class="col-sm-2 control-label">Email</label>
	            <div class="col-sm-10">
		            <input type="text" name="email" class="form-control" placeholder="user@email.com" aria-describedby="basic-addon1">
		        </div>
	        </div>

            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <div class="btn-toolbar" style="margin:1em 0 1em -5px;" role="toolbar" onKeyPress="return checkSubmit(event)" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="submit" id="action" name="action" value="password" class="btn btn-primary">Reset Password</button>
                            <a class="btn btn-success" href="./index.php">Log in</a>
                        </div>
                    </div> <!--button toolbar -->
                </div> <!--button column 10 -->
            </div> <!-- buttons div -->		
            
		</form>
		
	</div>
</div>