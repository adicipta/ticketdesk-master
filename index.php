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
 


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login V20</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
  <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
  <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
  <link rel="stylesheet" type="text/css" href="css/util.css">
  <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->

<!-- ============================================================================================== -->
</head>
<body> 
  <div class="limiter">
    <div class="container-login100">
      <div class="wrap-login100 p-b-160 p-t-50">
        <form class="login100-form validate-form" action="include/process_login.php" method="post" name="login_form" id="login_form" onKeyPress="return checkSubmit(event, this)">
          <span class="login100-form-title p-b-43">
            Account Login
          </span>
          
          <div class="wrap-input100 rs1 validate-input" data-validate = "Email is required">
            <input class="input100" type="text" name="email" id="email">
            <span class="label-input100">Email</span>
          </div>
          
          
          <div class="wrap-input100 rs2 validate-input" data-validate="Password is required">
            <input class="input100" type="password" name="pass" id="pass">
            <span class="label-input100">Password</span>
          </div>

          <div class="container-login100-form-btn">
            <button class="login100-form-btn" onclick="formhash(this.form, this.form.pass);">
              Sign in
            </button>
          </div>
          
          <div class="text-center w-full p-t-23">
            <a href="#" class="txt1">
              Forgot password?
            </a>
          </div>
        </form>
      </div>
    </div>
  </div> 
  
  
<!--===============================================================================================-->
  <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/bootstrap/js/popper.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
  <script src="vendor/daterangepicker/moment.min.js"></script>
  <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
  <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
  <script src="js/main.js"></script>

<script type="text/JavaScript" src="js/sha512.js"></script> 
<script type="text/JavaScript" src="js/forms.js"></script> 

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
 

</body>
</html>