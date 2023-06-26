<?php 

require'core/init.php';



if (empty($_POST) == FALSE) {
	
$lname = $_POST['lname'];
$fname = $_POST['fname'];
//$date = $_POST['date'];
$email = $_POST['email'];
$username = $user_data['username'];
//$pass = $_POST['password'];
//$confpass = $_POST['password2'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$town = $_POST['town'];
$addr = $_POST['address'];



if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{
		$results_id=$con->prepare("UPDATE users SET lastname=?,firstname=?,email=?,phone=?,mobile=?,town=?,address=? WHERE username=?");
		$results_id->bindParam(1,$lname);
		$results_id->bindParam(2,$fname);
		$results_id->bindParam(3,$email);
		$results_id->bindParam(4,$phone);
		$results_id->bindParam(5,$mobile);
		$results_id->bindParam(6,$town);
		$results_id->bindParam(7,$addr);
		$results_id->bindParam(8,$username);
		$results_id->execute();
		
	if($results_id == true)
	{
		$success[]="User $username successfully updated.";
	}
	else
	{
		print("Could not insert record!");
	}
}
 }else{
 	
 }
include 'core/head.php ';
//include_once('includes/widget/header-nav.php');
echo output_success($success);

?>