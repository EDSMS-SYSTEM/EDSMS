<?php session_start(); ?>
<?php

include "connection2.php";


$semid = $_GET['id'];

$st = $con->prepare('DELETE FROM userseminars WHERE userid=? AND semid=?');
$st->bindParam(1,$_SESSION['id']);
$st->bindParam(2,$semid);
$st->execute();

echo "<script>window.location = 'register_seminar.php'</script>";

?>