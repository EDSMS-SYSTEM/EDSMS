<?php
include 'core/init.php';
$tit = $_POST['title'];
$date = $_POST['date'];
$teach = $_POST['teacher'];
$desc =  $_POST['descr'];
$oldtitle = $_GET['oldtitle'];
$hours = $_POST['hours'];

if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{
	$results_id=$con->prepare("UPDATE seminars SET semtitle=? , semdate=? , semteacher=? , seminfo=? , sem_hours=? WHERE semtitle=?");
	$results_id->bindParam(1,$tit);
	$results_id->bindParam(2,$date);
	$results_id->bindParam(3,$teach);
	$results_id->bindParam(4,$desc);
	$results_id->bindParam(5,$hours);
	$results_id->bindParam(6,$oldtitle);
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




?>