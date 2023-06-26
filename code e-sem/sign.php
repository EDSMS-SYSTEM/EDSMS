<?php 

require'core/init.php';


if (empty($_POST) == FALSE) {
	
$lname = $_POST['lname'];
$fname = $_POST['fname'];
$date = $_POST['date'];
$email = $_POST['email'];
$username = $_POST['username'];
$pass = $_POST['password'];
$confpass = $_POST['password2'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$town = $_POST['town'];
$addr = $_POST['address'];
echo user_exists($username);	
	if(empty($username) == TRUE || empty($pass) == TRUE){
			$errors[] = 'Username or Password are Empty';
		
	}elseif (user_exists($username) != FALSE){
			$errors[] = 'Username already exists.';
	}elseif ($pass != $confpass){
			$errors[] = 'Wrong Password.';
	}else{
		reg_isert($lname,$fname,$date,$email,$username,$pass,$phone,$mobile,$town,$addr);
		$errors[]="You have succesfully add user:". $username ."";
		header('Location: index.php');
		echo output_errors($errors);
	}
 }else{
 	
 }
include 'core/head.php ';
if (logged_in() == true) {
	header('Location: index.php');
	
} else {
	include 'registration_form.php';
}if($errors!=null){
echo output_errors($errors);	
}

?>