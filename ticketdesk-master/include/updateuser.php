<?php
include_once 'connect.php';
 
$error_msg = "";
$success = "";
$mysqli= dbConnect();

if (isset($_POST['id'],$_POST['username'], $_POST['email'], $_POST['p'])) {
    // Sanitize and validate the data passed in
    $userid =$_POST['id'];
    $groupId =$_POST['groupId'];
    $usertype =$_POST['UserType'];
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="alert alert-danger">The email address you entered is not valid</p>';
    }
 
    $password = filter_input(INPUT_POST, 'p', FILTER_SANITIZE_STRING);
    if (strlen($password) != 128) {
        // The hashed pwd should be 128 characters long.
        // If it's not, something really odd has happened
        $error_msg .= '<p class="error">Invalid password configuration.</p>';
    }
  
    if (empty($error_msg)) {
        // Create a random salt
        //$random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE)); // Did not work
        $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
 
        // Create salted password 
        $password = hash('sha512', $password . $random_salt);
 
        // Insert the new user into the database 
        if ($insert_stmt = $mysqli->prepare("UPDATE `users` SET username= '$username', email='$email', password='$password', salt= '$random_salt',UserType='$usertype',groupid = '$groupId' WHERE id='$userid'")) {
            // $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt,$userid);
            // Execute the prepared query.
            if (! $insert_stmt->execute()) {
                header('Location: ../error.php?err=Registration failure: Update');
            } else {
                 $success .= '<p class="alert alert-success">User has been updated.</p>';
                //echo '<META http-equiv="refresh" content="3;URL=./index.php">';
                header('Location:manageusers.php');
            }
        }
    }
}
?>
