<?php


$userid = $_POST['userid'];
$semid = $_POST['semid'];
$success = $_POST['success'];




include "connection2.php";

try{
if($success==1){
	$st=$con->prepare("SELECT * from seminars WHERE semid=?");
	$st->bindParam(1,$semid);
	$st->execute();

	foreach($st->fetchAll() as $row){
		$semtitle = $row['semtitle'];
		$semdate = $row['semdate'];
		$semteacher = $row['semteacher'];
		$seminfo = $row['seminfo'];
	}

	$st=$con->prepare("INSERT INTO history VALUES ('$userid','$semtitle','$semdate','$semteacher','$seminfo')");
	$st->execute();


	$st=$con->prepare("DELETE FROM userseminars WHERE semid=? AND userid=?");
	$st->bindParam(1,$semid);
	$st->bindParam(2,$userid);
	$st->execute();

	$st=$con->prepare("SELECT lastname,firstname FROM users WHERE id=?");
	$st->bindParam(1,$userid);
	$st->execute();


	foreach($st->fetchAll() as $row){
		$lname = $row['lastname'];
		$fname = $row['firstname'];
	}
$content = "Συγχαρητήρια $lname $fname , παρακολουθήσατε με επιτυχία το σεμινάριο $semtitle";
$fp = fopen($_SERVER['DOCUMENT_ROOT'] . "/Epituxon.txt","wb");
fwrite($fp,$content);
fclose($fp);

echo "success";
}
else{

	$st=$con->prepare("SELECT * from seminars WHERE semid=?");
	$st->bindParam(1,$semid);
	$st->execute();

	foreach($st->fetchAll() as $row){
		$semtitle = $row['semtitle'];
		$semdate = $row['semdate'];
		$semteacher = $row['semteacher'];
		$seminfo = $row['seminfo'];
	}


	$st=$con->prepare("DELETE FROM userseminars WHERE semid=? AND userid=?");
	$st->bindParam(1,$semid);
	$st->bindParam(2,$userid);
	$st->execute();

	echo "faillure";

}
}catch(PDOException $e){echo $e->getMessage();}


?>