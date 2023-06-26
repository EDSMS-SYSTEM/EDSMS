<?php

$text = $_POST['search1'];
include "connection2.php";


if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{	
	$st = $con->prepare("SELECT seminars.semtitle,users.firstname,news.name,files.name FROM seminars,users,news,files WHERE seminars.semtitle LIKE '%p' OR users.firstname LIKE '%p' OR news.name LIKE '%p' OR files.name LIKE '%p' ");
	$st->bindParam(1,$text);
	$st->execute();



	
	if($st == true)
	{
		echo'<ul>';
	foreach ($st->fetchAll() as $row) {
	echo"</li>". $row['semtitle'] ."</li>"; 
	
	}
		echo '</ul>';
	}
	else
	{
		print("Error");
	}
}



?>