
<?php session_start(); ?>

<html>

<head>
<link rel="stylesheet" href="styles/style.css" type="text/css">
	<script src="scripts/jquery-1.11.2.min.js"></script>
<script src="scripts/usersscript.js"></script>
	<title></title>

<body>



<?php

if(!isset($_SESSION))
	die("Πρέπει να συνδεθείτε για να έχετε πρόσβαση σε αυτή τη σελίδα");

if($_SESSION['user_access']  > 1)
	die('Μόνο οι διαχειριστές έχουν πρόσβαση σε αυτή τη σελίδα.');


echo "<br><br><b> <div align=\"right\"> Καλώς ήρθες " .$_SESSION['user_name']. " <b> <a href=\"logout.php\"> Αποσύνδεση</a></b> </div></b> </b> ";
echo "<br><br><b><div align=\"right\"> <a href=\"mainp.php\">Επιστροφή στη κεντρική σελίδα</a></div></b> </b>";
echo "<br><br><center>";

 $semid = $_POST['seminario'];


 include "connection2.php";

$st = $con->prepare("SELECT userid FROM maxpart WHERE semid=?");
$st->bindParam(1,$semid);
$st->execute();


echo "<table border=1>";
$counter=0;
echo "<tr><td><b>A/A</b></td><td><b>Ονοματεπώνυμο</b></td><td><b>Ενέργεια</b></td></tr>";
foreach ($st->fetchAll() as $row) {
	$userid = $row['userid'];
	$counter++;
	$st1=$con->prepare("SELECT * FROM users WHERE id=?");
	$st1->bindParam(1,$userid);
	$st1->execute();

	foreach($st1->fetchAll() as $r){
		$name = $r['lastname'] . " " . $r['firstname'];
		echo "<tr><td>$counter</td><td>$name</td><td><button class=\"moveiper\" id=\"$userid\" name=\"$semid\">Μετακίνηση</button></td></tr>";
	}
}


echo "</table>";

?>

</body>

</html>