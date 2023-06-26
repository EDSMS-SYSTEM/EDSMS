<?php
include_once('core/head.php');
?>
<title>Ιστορικό</title>
<?php
include 'core/init.php';
if (logged_in() === true) {



$userid = $_GET['userid'];

if($user_data['id'] != $userid)
	die('Δεν έχετε πρόσβαση σε στοιχεία άλλων.');




$st = $con->prepare("SELECT * from history WHERE userid=?");
$st->bindParam(1,$userid);
$st->execute();

//include('includes/widget/header-nav.php');

echo "<center><h1>Seminars you have attended with success </h1></center>";
echo "<div class=\"table-responsive\">";
echo "<table class=\"table table-striped\">";
echo "<tr><td><b><font size=\"4\">ID</font></b></td> <td><b><font size=\"4\">Title</font></b></td>  <td><b><font size=\"4\">Date</font></b></td>  <td><b><font size=\"4\">Teacher</font></b></td> <td><b><font size=\"4\">Infos</font></b></td><td><b><font size=\"4\">Actions</font></b></td></tr>";

$count=0;
foreach ($st->fetchAll() as $row) {
	$count++;
      $semtitle = $row['semtitle'];
      $semdate = $row['semdate'];
      $semteacher = $row['semteacher'];
      $seminfo = $row['seminfo'];

      echo "<tr>";

      echo "<td><font size=\"3\">$count</font></td>";
      echo "<td><font size=\"3\">$semtitle</font></td>";
      echo "<td><font size=\"3\">$semdate</font></td>";
      echo "<td><font size=\"3\">$semteacher</font></td>";
      echo "<td><font size=\"3\">$seminfo</font></td>";
	  echo "<td><a class=\"btn btn-primary\" role=\"button\" href='fpdf/print_cert.php?userid=$userid&semtitle=$semtitle&semdate=$semdate' target=\"_blank\" >Print Certificate</a></td>";
      echo "</tr>";
  }

echo "</table></div>";
	if($count==0)
		echo "<b>You do not have a background of seminars</b>";
		}else{
	header("Location: login.php");
}
?>
</html>