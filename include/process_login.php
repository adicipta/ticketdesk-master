<?php
include_once 'connect.php';
include_once 'functions.php';
 
sec_session_start(); // Our custom secure way of starting a PHP session.
 

if (isset($_POST['email'], $_POST['p'])) {

    $email = $_POST['email'];
    $password = $_POST['p']; // The hashed password.
    $mysqli = dbConnect();
 
    if (login($email, $password, $mysqli) == true) {
        // Login success
        
        $sql="select * from users where email = '$email'";
	$result = $mysqli->query($sql);
	
	if ($result->num_rows > 0) {	
		while($row = $result->fetch_array()) {
			$_SESSION['userid'] = $row['id'];
        		$_SESSION['user'] = $row['username'];		
                $_SESSION['usertype'] = $row['UserType'];  
                $_SESSION['groupid'] = $row['groupid'];    		
		}
	}            

        
                                    
        header('Location: ../main.php');
    } else {
        // Login failed 
        header('Location: ../index.php?error=1');
    }
} else {
    // The correct POST variables were not sent to this page. 
    echo 'Invalid Request';
}
?>