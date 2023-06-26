
<?php session_start(); ?>

<?php

$userid = $_POST['userid'];
$semid = $_POST['semid'];

include "connection2.php";

$st=$con->prepare("SELECT count(*) FROM userseminars WHERE semid=?");
$st->bindParam(1,$semid);
$st->execute();

foreach($st->fetchAll() as $r)
  $curr =$r[0];
$st=$con->prepare("SELECT maxparticipants FROM seminars WHERE semid=?");
$st->bindParam(1,$semid);
$st->execute();
foreach($st->fetchAll() as $r)
  $max =$r[0];


if($curr < $max){
	  $st=$con->prepare("INSERT INTO userseminars(semid,userid) VALUES (?,?)");
	  $st->bindParam(1,$semid);
	  $st->bindParam(2,$userid);
	  $st->execute();

	  $st=$con->prepare("DELETE FROM maxpart WHERE userid=? AND semid=?");
	  $st->bindParam(1,$userid);
	  $st->bindParam(2,$semid);
	  $st->execute();
}
else{

	
}

?>