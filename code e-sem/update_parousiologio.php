<?php

$userid = $_POST['userid'];
$semid = $_POST['semid'];

$apousia = $_POST['apousia'];
$ora = $_POST['ora'];



include "connection2.php";
$donealready=false;
$st=$con->prepare("SELECT * from presenthours WHERE semid=? and userid=? and hour=?");
$st->bindParam(1,$semid);
$st->bindParam(2,$userid);
$st->bindParam(3,$ora);
$st->execute();
foreach($st->fetchAll() as $r)
  $donealready=true;

if($donealready){
	die("no");
}
	$st=$con->prepare("SELECT * FROM attendancebook ");
	$st->execute();
	$any=false;
	foreach ($st->fetchAll() as $row) {
		$any=true;
	}
	if(!$any)
	{
		$st=$con->prepare("INSERT INTO attendancebook VALUES (?,?,0,0)");
		$st->bindParam(1,$semid);
		$st->bindParam(2,$userid);
		$st->execute();
	}

	$st = $con->prepare("INSERT INTO presenthours VALUES (?,?,?)");
	$st->bindParam(1,$semid);
	$st->bindParam(2,$userid);
	$st->bindParam(3,$ora);
	$st->execute();

if($apousia == 0)
{
	$found=false;

	$st=$con->prepare("SELECT * FROM attendancebook WHERE userid=? and semid=?");
	$st->bindParam(1,$userid);
	$st->bindParam(2,$semid);
	$st->execute();

	foreach ($st->fetchAll() as $row) {
		$found=true;
	}

	


	if(!$found){
		$st=$con->prepare("INSERT INTO attendancebook VALUES (?,?,1,0)");
		$st->bindParam(1,$semid);
		$st->bindParam(2,$userid);
		$st->execute();
	}
	else
	{

		$st=$con->prepare("UPDATE attendancebook SET present=present+1 WHERE userid=? and semid=?");
		$st->bindParam(1,$userid);
		$st->bindParam(2,$semid);
		$st->execute();
		echo "GG HA";
	
	}
}
else
{
	$found=false;


	$st=$con->prepare("SELECT * FROM attendancebook WHERE userid=? and semid=?");
	$st->bindParam(1,$userid);
	$st->bindParam(2,$semid);
	$st->execute();

	foreach ($st->fetchAll() as $row) {
		$found=true;
	}

	if(!$found){
		$st=$con->prepare("INSERT INTO attendancebook VALUES (?,?,0,1)");
		$st->bindParam(1,$semid);
		$st->bindParam(2,$userid);
		$st->execute();
	}
	else
	{
		$st=$con->prepare("UPDATE attendancebook SET absent=absent+1 WHERE userid=? and semid=?");
	$st->bindParam(1,$userid);
	$st->bindParam(2,$semid);
	$st->execute();
	echo "GG HA";
	}

}


?>