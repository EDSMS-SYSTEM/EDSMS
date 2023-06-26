<?php include_once('core/head.php') ?>
<?php session_start(); ?>

<?php

if(!isset($_SESSION))
	die("Πρέπει να συνδεθείτε για να έχετε πρόσβαση σε αυτή τη σελίδα");

if($_SESSION['user_access'] != 1)
	die('Μόνο οι καθηγητές έχουν πρόσβαση σε αυτή τη σελίδα.');


echo "<br><br><b> <div align=\"right\"> Καλώς ήρθες " .$_SESSION['user_name']. " <b> <a href=\"logout.php\"> Αποσύνδεση</a></b> </div></b> </b> ";
echo "<br><br><center> <h1>Κεντρικό Μενού Καθηγητή</h1> <hr><br>";
echo "<a href=\"choosesemi.php\">Παρουσιολόγιο</a><br><br>";
echo "<a href=\"manage_users_semi.php\">Εγγραφή-Διαγραφή Μαθητών/Σπουδαστών (Σεμινάρια)</a><br><br>";
echo "<a href=\"choosesemi-succ.php\">Διαχείριση Επιτυχόντων</a><br><br>";
echo "<a href=\"manage_seminars.php\">Διαχείριση Σεμιναρίων</a><br><br>";
echo "<a href=\"manage_users.php\">Διαχείριση Μαθητών/Σπουδαστών</a><br><br>";
echo "</center>";
echo "<hr>";
?>