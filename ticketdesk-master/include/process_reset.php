<?php
session_start();


include_once('connect.php');


unset($message);
$mysqli = dbConnect();
if(isset($_GET['action'])) {          
    if($_GET['action']=="reset") {
        $encrypt = mysqli_real_escape_string($mysqli,$_GET['encrypt']);
        $query = "SELECT id FROM users where md5(1290*3+id)='".$encrypt."'";
        
        $result = mysqli_query($mysqli,$query);
        $Results = mysqli_fetch_array($result);
        if(count($Results)>=1) {

            $_SESSION['encryptId'] = $encrypt; // store the encrypted id
        } else {
            unset($_SESSION['encryptId']);
            $message = 'Invalid key please try again. <a href="../reset.php">Forget Password?</a>';

        }
    }
} elseif(isset($_POST['p'])) {
    
    //$encrypt = mysqli_real_escape_string($mysqli,$_GET['action']);
    $encrypt = mysqli_real_escape_string($mysqli, $_SESSION['encryptId']);
    $password = mysqli_real_escape_string($mysqli, $_POST['p']);
    
    $query = "SELECT id FROM users where md5(1290*3+id)='".$encrypt."'";

    $result = mysqli_query($mysqli,$query);
    $Results = mysqli_fetch_array($result);
    if(count($Results)>=1) {        
        // create a random salt
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);

        $query = "update users set password='$password', salt='$random_salt' where id=" . $Results['id'];
        mysqli_query($mysqli,$query);

        $message = 'Your password changed sucessfully <a href="../index.php">click here to login</a>.';
    } else {
        unset($_SESSION['encryptId']);
        $message = 'Update failed. <a href="../reset.php">Forget Password?</a>';
    }
}
else {
    header("location: ../index.php");
}

?>
<link href="../css/bootstrap.css" rel="stylesheet">
<link href="../style.css" rel="stylesheet">

<!-- jQuery (necessary for Bootstraps JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.min.js"></script>

<script type="text/JavaScript" src="../js/sha512.js"></script>
<script type="text/JavaScript" src="../js/forms.js"></script>

<div id="loginPanel" class="panel panel-default">
  <div class="panel-heading"> Reset Password</div>
	<div class="panel-body">
		
		<?php if (isset($message)) { ?>
	        <p class="alert alert-info"> <?php echo '' . $message; ?> </p>
	    <?php } ?>

        <?php if (isset($_SESSION['encryptId'])) {?>
		<form action="process_reset.php" method="post" id="resetPasswordForm" >
	        <div class="form-group">
	            <label class="col-sm-2 control-label">Password</label>
	            <div class="col-sm-10">		         
		            <input type="password" id="password" name="password" class="form-control" placeholder="New Password" aria-describedby="basic-addon1">
		        </div>
	        </div>
	        <div class="form-group">
	            <label class="col-sm-2 control-label">Repeat</label>
	            <div class="col-sm-10">
		            <input type="password" id="confirmpwd" name="confirmpwd" class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon1">
		        </div>
	        </div>
	        
            <div class="form-group">
                <div class="col-sm-2"></div>
                <div class="col-sm-10">
                    <div class="btn-toolbar" style="margin:1em 0 1em -5px;" role="toolbar" aria-label="...">
                        <div class="btn-group" role="group" aria-label="...">
                            <button type="button" id="action" name="action" class="btn btn-primary" onclick="mypasswordmatch()">Submit</button>
                        </div>
                    </div> <!--button toolbar -->
                </div> <!--button column 10 -->
            </div> <!-- buttons div -->		
            
		</form>
        <?php } ?>
		
	</div>
</div>

<script>
function mypasswordmatch()
{
    var pass1 = document.getElementById("password").value;
    var pass2 = document.getElementById("confirmpwd").value;
    var password = document.getElementById("password");
    var resetForm = document.getElementById("resetPasswordForm");
    if (pass1 != pass2) {
        alert("Passwords do not match");
        return false;
    } else {
        formhash(resetForm, password);
    }
}
</script>


