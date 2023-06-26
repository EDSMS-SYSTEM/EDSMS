<?php

echo "<center><form action=\"select_files.php\" method=\"post\">";

echo "Please choose a seminar: <br>";

	$userid = $user_data['id'];
	$results_id = $con->prepare("SELECT * FROM userseminars WHERE userid=?");
	$results_id->bindParam(1,$userid);
	$results_id->execute();
	


echo "<select name=\"seminario\">";

foreach ($results_id->fetchAll() as $row) {

	$semid = $row['semid'];
	$results_id1 = $con->prepare("SELECT * FROM seminars WHERE semid=?");
			$results_id1->bindParam(1,$semid);
			$results_id1->execute();
			
			foreach($results_id1->fetchAll() as $newarray1)
			{
				$titl = $newarray1['semtitle'];
  echo "<option value=$semid>$titl</option>";
}}
echo "</select>";
echo "<br><br>";
echo "<input class=\"btn btn-primary \" type=\"submit\" value=\"Open\">" ;


echo "</form></center>";

?>