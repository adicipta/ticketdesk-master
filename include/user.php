<?php
include_once('connect.php');

class user {
	
	private $id;
	private $name;
	private $email;
	private $mysqli;
	
	function __construct() {
		$this->mysqli = dbConnect();
	}
	
	public static function withUserName($userName) {
		$instance = new self();
		$instance->getUser($userName);
		return $instance;
		
	}
	public function getUser($userName) {
		$sql = "select * from users where username = '" . $userName . "'";
		$result = $this->mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				$this->id = $row['id'];
				$this->name = $row['username'];
				$this->email = $row['email'];
			}
		}
	
	}
	public function getEmail() {return $this->email;}
	public function getId() {return $this->id;}
	public function getName() {return $this->name;}
	public function getMysqli() {return $this->mysqli;}
	
	public function setId($id) {$this->id = $id;}
	public function setName($name) {$this->name = $name;}
	public function setEmail($email) {$this->email = $email;}
	
	
	public static function displayUserOptionList() {
		$mysqli = dbConnect();
		$sql = "select * from users";
		$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row
			while($row = $result->fetch_assoc()) {
				echo '<option value="' .  $row['username']  . '">' . $row['username'] . '</option>';
			}
		}
	}

	function loadUser(){
		$mysqli = dbConnect();
		$sql = "select *,u.id as userid from users u,groups g where u.groupid=g.id";
		$result = $mysqli->query($sql);
		
		if ($result->num_rows > 0) {
			// output data of each row 
			while($row = $result->fetch_assoc()) {
				// echo '<option value="' .  $row['username']  . '">' . $row['username'] . '</option>';
				echo '<tr>';
				echo '<td>' .  $row['userid']  . '</td>';
				echo '<td>' .  $row['username']  . '</td>';
				echo '<td>' .  $row['email']  . '</td>'; 
				echo '<td>' .  $row['name']  . '</td>'; 
				echo '<td><a href="edituser.php?id=' .  $row['userid']  . '" />Edit</a>
				<a href="manageusers.php?action=delete&id=' .  $row['userid']  . '" />Delete</a></td>';
				echo '</tr>';
			}
		}
	}

	function editUser($id=0){
		$mysqli = dbConnect();

				$sql = "select * from users Where id='$id'";
				$cur = $mysqli->query($sql);
				
				if ($cur->num_rows > 0) {
					// output data of each row 
					while($row = $cur->fetch_assoc()) { 
						echo '<input type="text" class="form-control" placeholder="id" aria-describedby="basic-addon1"  name="id" id="id" value="' .  $row['id']  . '"  readonly/><br>';
						echo '<input type="text" class="form-control" placeholder="Username" aria-describedby="basic-addon1"  name="username" id="username" value="' .  $row['username']  . '"/><br>';
						echo '<input type="text" class="form-control" placeholder="Email" aria-describedby="basic-addon1" name="email" id="email" value="' .  $row['email']  . '"/><br>';
						echo '<input type="password" name="password" id="password" class="form-control" placeholder="Password" aria-describedby="basic-addon1"/><br></td>';
						echo '<input type="password" name="confirmpwd" id="confirmpwd" class="form-control" placeholder="Confirm Password" aria-describedby="basic-addon1" /><br>';    

							if ($row['UserType']=='Administrator') {
								# code...
						 echo '<select class="form-control" name="UserType" id="UserType">
								<option value="none">Select User Type</option>
								<option selected value="Administrator">Administrator</option>
								<option value="User">User</option>
							</select>';
							}else if ($row['UserType']=='User'){
							echo '<select class="form-control" name="UserType" id="UserType">
								<option value="none">Select User Type</option>
								<option  value="Administrator">Administrator</option>
								<option selected value="User">User</option>
							</select>';

							}else{
								echo '<select class="form-control" name="UserType" id="UserType">
										<option value="none">Select User Type</option>
										<option  value="Administrator">Administrator</option>
										<option value="User">User</option>
									</select>';
							}
 							echo '<br/><select class="form-control" name="groupId"> ';

							$res = $mysqli->query("SELECT * FROM `groups`");
							while($result = $res->fetch_array()) { 
								if ($result['id']==$row['groupid']) {
									# code...
									echo '<option selected value="'.$result['id'].'">'.$result['name'].'</option>';
								} else{
									echo '<option value="'.$result['id'].'">'.$result['name'].'</option>';
								}
								
							}
						  
			               echo '</select>
				               
							<br/>';

					}
				}
	}

	function deleteuser(){
		$mysqli = dbConnect();
		if (isset($_GET['action'])) {
    // Sanitize and validate the data passed in
		    $userid =$_GET['id']; 
		   
		        // Create a random salt  
		 
		        // Insert the new user into the database 
		        if ($insert_stmt = $mysqli->prepare("DELETE  FROM `users`  WHERE id='$userid'")) {
		            // $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt,$userid);
		            // Execute the prepared query.
		            if (! $insert_stmt->execute()) {
		                header('Location: ../error.php?err=Registration failure: Update');
		            } else {
		                 $success .= '<p class="alert alert-success">User has been deleted.</p>';
		                //echo '<META http-equiv="refresh" content="3;URL=./index.php">';
		                // header('Location:manageusers.php');
		                 echo '<script>window.location="manageusers.php"</script>';
		            }
		        } 
	}


 }

}
 
		 
?>