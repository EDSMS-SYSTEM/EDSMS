<head>
<link rel="stylesheet" href="styles/style.css" type="text/css">
</head>

<?php session_start(); ?>

<?php


if(!isset($_SESSION))
	die("Πρέπει να συνδεθείτε για να έχετε πρόσβαση σε αυτή τη σελίδα");

if($_SESSION['user_access']  > 1)
	die('Μόνο οι διαχειριστές έχουν πρόσβαση σε αυτή τη σελίδα.');


echo "<br><br><b> <div align=\"right\"> Καλώς ήρθες " .$_SESSION['user_name']. " <b> <a href=\"logout.php\"> Αποσύνδεση</a></b> </div></b> </b> ";
echo "<br><br><b><div align=\"right\"> <a href=\"mainp.php\">Επιστροφή στη κεντρική σελίδα</a></div></b> </b>";
echo "<br><br><center>";

echo "<form action=\"moveuperfinal.php\" method=\"post\">";

echo "Παρακαλώ επιλέξτε το σεμινάριο της επιλογής σας: <br>";

include "connection2.php";

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
echo "<input type=\"submit\" value=\"Συνέχεια\">" ;


echo "</form>";

?>