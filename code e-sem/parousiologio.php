<?php
include_once('core/head.php');
?>
<title>Attendance Book</title>
<?php
include 'core/init.php';
if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');
 $user=$user_data['username'];
//include('includes/widget/header-nav.php');
echo "<br><br><center>";
 $semid = $_POST['seminario'];
 	include "connection2.php";
	$st = $con->prepare("SELECT * FROM seminars WHERE semid=?");
	$st->bindParam(1,$semid);
	$st->execute();


foreach ($st->fetchAll() as $row) {
	$semtitle = $row['semtitle'];
	$semdate = $row['semdate'];
	$semteacher = $row['semteacher'];
	$seminfo = $row['seminfo'];
	$semhours = $row['sem_hours'];
}

echo "<center><h1>Attendance Book</h1></center><br><font size=\"6\"><u>Seminar Title:</u></font> <br> <font size=\"5\"><i>$semtitle</i></font> <br><br>";

echo "<font color=\"blue\"> Date: ";
//echo date('d') . "/" . date('m') . "/" .date('Y') . "</font>      <br><br> <div id=\"done\"> <font color=\"990440fd\">Η ενέργεια εκτελέστηκε</font> </div>";
echo "<font color=black>$semdate </font><div id=\"done\"> <font color=\"990440fd\">Success!</font> </div>";
$st = $con->prepare("SELECT userid FROM userseminars WHERE semid=?");
$st->bindParam(1,$semid);
$st->execute();

$count=0;

echo "<div id=\"attedancebook\"><div class='table-responsive'><table class='table table-striped'>";
echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">Participant Name</font></b></td><td><b><font size=\"4\">Hour</font></b></td><td colspan=2><b><font size=\"4\">Actions</font></b></td> </tr>";

foreach ($st->fetchAll() as $row) {
	$count++;
	$st1=$con->prepare("SELECT lastname,firstname FROM users WHERE id=? ");
	$userid = $row['userid'];
	$st1->bindParam(1,$userid);
	$st1->execute();

	foreach ($st1->fetchAll() as $row1){
		echo "<tr>";
		echo "<td><font size=\"3\">$count</font></td>";
		echo "<td><font size=\"3\">" .$row1['firstname'] . " " . $row1['lastname'] . "</font></td>";
		echo "<td><select id=$userid name=\"time\">";
		for ($x = 1; $x <= $semhours; $x++) {
    		echo "<option value=$x>$x</option>";
		}
		echo "</td><td><div class=\"btn-group \"><button class=\"apon btn btn-primary btn-danger\" name=\"$semid\" id=\"$userid\">Absent</button>";
		echo "<button class=\"paron btn btn-primary btn-success\" name=\"$semid\" id=\"$userid\">Present</button></div></td>";
		echo "</tr>";
	}
}
echo "</table></div>";

if($count==0)
  echo "<br> <b><font color=red>There is no participant in this seminar</font></b>";


// epilogi alou seminariou
if($user_data['accesslevel'] == 0){
include_once ('includes/widget/choosesemi_form.php');}
echo " <a onclick=\"javscript: history.go(-1)\" href=\"\">Back</a>";
}else{
	header("Location: login.php");
}
?>

</body>

</html>