
<?php
include_once('core/head.php');
include 'core/init.php';
if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page');


echo "<center>";

echo "<h1>Attendance Book</h1></center>";
echo "<center><form action=\"parousiologio.php\" method=\"post\">";

echo "Please Choose A Seminar: <br>";

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
echo "<input class=\"btn btn-primary \" type=\"submit\" value=\"Open\">" ;


echo "</form></center>";
}else{
	header("Location: login.php");
}
?>