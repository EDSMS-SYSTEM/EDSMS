<?php


$userid = $_POST['userid'];
$semid = $_POST['semid'];

include "connection2.php";

$st = $con->prepare("INSERT INTO userseminars(semid,userid) VALUES (?,?)");
$st->bindParam(1,$semid);
$st->bindParam(2,$userid);
$st->execute();

?>