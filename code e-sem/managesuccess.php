

<?php

include_once('core/head.php');
include 'core/init.php';
if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');

//include_once('includes/widget/header-nav.php');

 $semid = $_POST['seminario'];

$st = $con->prepare("SELECT * FROM seminars WHERE semid=?");
$st->bindParam(1,$semid);
$st->execute();


foreach ($st->fetchAll() as $row) {
	$semtitle = $row['semtitle'];
	$semdate = $row['semdate'];
	$semteacher = $row['semteacher'];
	$seminfo = $row['seminfo'];
}
echo "<center><h1>Successful Candidates Management</h1>";
echo "<font size=\"5\"><u>Seminar Title:</u></font> <br> <font size=\"5\"><i>$semtitle</i></font> <br><br>";

echo "<font color=\"blue\"> Date: ";

echo "<font color=black>$semdate </font><div id=\"done\"> <font color=\"990440fd\">Successfull</font> </div>";

$st = $con->prepare("SELECT userid FROM userseminars WHERE semid=?");
$st->bindParam(1,$semid);
$st->execute();

$count=0;

echo "<div id=\"attedancebook\"><div class='table-responsive'><table class='table table-striped'>";
echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">Name</font></b></td><td><b><font size=\"4\">Absences</font></b></td><td><b><font size=\"4\">Presences</font></b></td><td colspan=2><b><font size=\"4\">Actions</font></b></td></tr>";

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
		
		$st2 = $con->prepare("SELECT present,absent FROM attendancebook WHERE userid=? AND semid=?");
		$st2->bindParam(1,$userid);
		$st2->bindParam(2,$semid);
		$st2->execute();
		if ($st2->rowCount()){
			
		
			foreach($st2->fetchAll() as $row2){
				$apousies = $row2['absent'];
				$parousies = $row2['present'];
			}
		}else{
			$apousies = 0;
			$parousies = 0;
		}

		echo "<td><font size=\"3\">$apousies</font></td><td><font size=\"3\">$parousies</font></td>";

		echo "<td><div class='btn-group'><button class=\"success btn btn-primary btn-success\" name=\"$semid\" id=\"$userid\">Success</button>";
		echo "<button class=\"fail btn btn-primary btn-danger\" name=\"$semid\" id=\"$userid\">Failure</button></div></td>";
		echo "</tr>";
		
	}
}



echo "</table></div>";
if($count==0)
  echo "<br> <b><font color=red>There is no participant in this seminar</font></b>";


// epilogi alou seminariou


include_once ('includes/widget/choosesemi_succ_form.php');
}else{
	header("Location: login.php");
}
?>
</center>
</body>

</html>