<?php
include_once('core/head.php');
include 'core/init.php';
if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');



echo "<br><br><center>";
echo "<h1>Seminar Participants Management</h1>";
echo "<form action=\"userssemi.php\" method=\"post\">";

echo "Please choose a seminar: <br>";

include "connection2.php";
if($user_data['accesslevel'] == 0){
$st = $con->prepare("SELECT semid,semtitle,semteacher FROM seminars");
$st->execute();

echo "<select name=\"seminario\">";

foreach ($st->fetchAll() as $row) {

	$semid = $row['semid'];
	$semtitle = $row['semtitle'];
	
	
  echo "<option value=$semid>$semtitle</option>";
}
}
elseif ($user_data['accesslevel'] == 1) {
$name=$user_data['lastname'] . ' ' . $user_data['firstname'];
	$st = $con->prepare("SELECT semid,semtitle FROM seminars WHERE semteacher=?");
	$st->bindParam(1,$name);
$st->execute();

echo "<select name=\"seminario\">";

foreach ($st->fetchAll() as $row) {

	$semid = $row['semid'];
	$semtitle = $row['semtitle'];
	
	
  echo "<option value=$semid>$semtitle</option>";	
}}

echo "</select>";
echo "<br><br>";
echo "<input type=\"submit\" class=\"btn btn-primary\" value=\"Open\">" ;


echo "</form>";
}
else{
	header("Location: login.php");
}
?>