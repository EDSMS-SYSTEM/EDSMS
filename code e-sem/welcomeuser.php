<?php include_once('core/head.php') ?>

<?php

if(!isset($_SESSION))
	die("Πρέπει να συνδεθείτε για να έχετε πρόσβαση σε αυτή τη σελίδα");

if($_SESSION['user_access'] != 2)
	die('Μόνο οι μαθητές έχουν πρόσβαση σε αυτή τη σελίδα.');


echo "<br><br><b> <div align=\"right\"> Καλώς ήρθες " .$_SESSION['user_name']. " <b> <a href=\"logout.php\"> Αποσύνδεση</a></b> </div></b> </b> ";
echo "<br><br><center> <h1>Κεντρικό Μενού Μαθητή/Σπουδαστή</h1> <hr><br>";
echo "<a href=\"register_seminar.php\"><font size=\"4\">Εγγραφή Σεμιναρίων</font></a><br><br>";

$id = $_SESSION['user_id'];
echo "<a href=\"show_history.php?userid=$id\"><font size=\"4\">Προβολή Ιστορικού</font></a>";
echo "<br><br><a href=\"edituser.php?userid=$id\"><font size=\"4\">Επεξεργασία Προφίλ Μαθητή/Σπουδαστή</font></a>";
echo "</center>";
echo "<HR>";
?>