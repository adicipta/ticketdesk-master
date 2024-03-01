<?php
include_once 'include/functions.php';
include_once 'include/connect.php';
include_once 'include/user.php';
include_once 'include/updateuser.php'; 
sec_session_start();

if(login_check(dbConnect()) == true) {
	include_once('include/navbar.php'); 
	$user = new user();

	$id = isset($_GET['id']) ? $_GET['id'] : 0;


}
?> 
   <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>

 
		    <div class="panel panel-default" style="margin:2em; margin-top: 90px;">
			  <div class="panel-heading">Edit User</div>
				<div class="panel-body">
					
					<?php
					if (!empty($error_msg)) {
						echo $error_msg;
					}
					if (!empty($success)) {
						echo $success;
					}
					?>
					<div id="regForm">
					  <div class="col-md-6">
						<form action="<?php echo esc_url($_SERVER['PHP_SELF']); ?>" method="post" name="registration_form"> 
							<?php $user->editUSer($id); ?>

							<input type="button" name="registerBtn" id="registerBtn" class="btn btn-primary" value="Save" onclick="return regformhash(this.form, this.form.username, this.form.email, this.form.password, this.form.confirmpwd,this.form.id,this.form.groupId);" /> 
						</form> 
					 </div>
					 <div class="col-md-6"> 
						<ul>
							<li>Usernames may contain only digits, upper and lowercase letters and underscores</li>
							<li>Emails must have a valid email format</li>
							<li>Passwords must be at least 6 characters long</li>
							<li>Passwords must contain
								<ul>
									<li>At least one uppercase letter (A..Z)</li>
									<li>At least one lowercase letter (a..z)</li>
									<li>At least one number (0..9)</li>
								</ul>
							</li>
							<li>Your password and confirmation must match exactly</li>
						</ul>
					 </div>
					 <div class="col-md-12">
					 	<table class="table table-bordered">
					 		<thead>
					 			<th>UserID</th>
					 			<th>Fullname</th>
					 			<th>Username</th> 
					 			<th>Department</th> 
					 			<th>Action</th>
					 		</thead>
					 		<tbody>
					 			<?php 
					 			  $user->loadUser();
					 			?>
					 		</tbody>
					 	</table>
					 </div>
					</div>
				</div>
			</div> 
 