<?php

try{
$userid = $_POST['userid'];
$semid = $_POST['semid'];

include "connection2.php"

$st=$con->prepare("DELETE FROM userseminars WHERE semid=? AND userid=?");
$st->bindParam(1,$semid);
$st->bindParam(2,$userid);
$st->execute();
}
catch(PDOException $e)
  echo $e->getMessage();


?>