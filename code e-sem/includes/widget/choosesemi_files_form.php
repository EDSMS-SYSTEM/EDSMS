<?php

echo "<center><form action=\"manage_files.php\" method=\"post\">";

echo "Please choose a seminar: <br>";
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

?>