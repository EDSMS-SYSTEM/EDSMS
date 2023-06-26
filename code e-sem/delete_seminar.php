<?php
include 'core/init.php';
if (logged_in() === true) {
	
if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');
$title = $_GET['title'];

if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{
		
		$results = $con->prepare("SELECT semid FROM seminars WHERE semtitle=?");
		$results->bindParam(1,$title);
		$results->execute();
		$row=$results->fetch();
		echo "$row[0]";
		$results_id=$con->prepare('DELETE FROM seminars WHERE semid=?');
		$results_id->bindParam(1,$row[0]);
		$results_id->execute();
	if($results_id == true)
	{
		

		echo "<script type='text/javascript'>";
		echo "window.location='manage_seminars.php'";
		echo "</script>";
	}
	else
	{
		print("Could not insert record!");
	}
}


}else{
	header("Location: login.php");
}

?>