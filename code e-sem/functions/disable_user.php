<?php

$username = $_POST['username'];

include "../connection2.php";


if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{
	$results_id=$con->prepare("UPDATE users SET aprooved=0 WHERE username='$username'");
		$results_id->bindParam(1,$username);
		$results_id->execute();
	
	if($results_id == true)
	{
		echo "User $username has been deactivated.";
	}
	else
	{
		print("Could not insert record!");
	}
}



?>