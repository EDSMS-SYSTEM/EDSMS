<?php

$username = $_POST['username'];
include "../connection2.php";


if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{
	$results_id=$con->prepare("DELETE FROM users WHERE username = ?");
	$results_id->bindParam(1,$username);
	$results_id->execute();
	
	if($results_id == true)
	{
		echo "User $username has been deleted";
	}
	else
	{
		print("Error");
	}
}



?>