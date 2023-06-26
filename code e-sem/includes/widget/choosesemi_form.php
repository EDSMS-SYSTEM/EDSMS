<?php

echo "<form action=\"parousiologio.php\" method=\"post\">";

echo "Please choose a seminar: <br>";
$st = $con->prepare("SELECT semid,semtitle FROM seminars");
$st->execute();

echo "<select name=\"seminario\">";

foreach ($st->fetchAll() as $row) {

	$semid = $row['semid'];
	$semtitle = $row['semtitle'];
  echo "<option value=$semid>$semtitle</option>";
}
echo "</select>";
echo "<br><br>";
echo "<input type=\"submit\" class=\" btn btn-primary\" value=\"Open\">" ;


echo "</form>";
?>