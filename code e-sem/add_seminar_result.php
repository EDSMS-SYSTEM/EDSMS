<?php

//include "manage_seminars.php";
include_once('core/head.php');
include 'core/init.php';

$title = $_POST['title'];
$date = $_POST['date'];
$teacher_name = $_POST['teachname'];
$info = $_POST['info'];
$maxpart = $_POST['maxpart'];
$hours = $_POST['hours'];


if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{	
	
	$results_id = $con->prepare("SELECT semtitle FROM seminars");
	$results_id->execute();
	$already=false;
	if($results_id->rowCount())
	{
			foreach($results_id->fetchAll() as $newarray){
			$us = $newarray['semtitle'];
			if($us==$title)
				$already = true;
		}
	}

	if($already)
	{
		
		die("<font color=\"red\">$title is already posted, please enter a new one.</font>");
	}

	$results_id=$con->prepare("INSERT INTO seminars(semtitle, semdate, semteacher, seminfo, maxparticipants, sem_hours) VALUES (?,?,?,?,?,?)");
		$results_id->bindParam(1,$title);
		$results_id->bindParam(2,$date);
		$results_id->bindParam(3,$teacher_name);
		$results_id->bindParam(4,$info);
		$results_id->bindParam(5,$maxpart);
		$results_id->bindParam(6,$hours);
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