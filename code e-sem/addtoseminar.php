
<?php include 'core/init.php'; ?>
<?php

include "connection2.php";


$semid = $_GET['id'];


$st = $con->prepare('SELECT maxparticipants FROM seminars WHERE semid=?');
$st->bindParam(1,$semid);
$st->execute();

$maxparticipants =0;
$currentparticipats = 0;

foreach ($st->fetchAll() as $row) {
	$maxparticipants = $row['maxparticipants'];
}

$st = $con->prepare('SELECT count(*) FROM userseminars WHERE semid=?');
$st->bindParam(1,$semid);
$st->execute();

foreach ($st->fetchAll() as $row) {
	$currentparticipants = $row[0];
}

if($currentparticipants >= $maxparticipants ){
	

echo "<script>alert('This seminar is full! ');</script>";
}

else
{

$st = $con->prepare('INSERT INTO userseminars VALUES (?,?)');
$st->bindParam(1,$semid);
$st->bindParam(2,$user_data['id']);
$st->execute();
}

echo "<script>window.location = 'register_seminar.php'</script>";


?>