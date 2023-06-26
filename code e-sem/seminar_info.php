
<?php

include_once('core/head.php');
include 'core/init.php';

$title = $_GET['title'];
$aa = $_GET['aa'];

if (logged_in() === true) {

//if($user_data['accesslevel']  > 1)
	//die('Only administrators have access to this page.');

//include_once('includes/widget/header-nav.php');
	if(!$con)
	{
			die("Could not connect to server " .$host . " User :" . $user);
	}
	else
	{
		$results_id = $con->prepare("SELECT * FROM seminars WHERE semtitle=?");
		$results_id->bindParam(1,$title);
		$results_id->execute();
		
		if($results_id == true)
		{
			$newarry=$results_id->fetchAll();
			foreach ($newarry as $newarray)
			{
			$title = $newarray['semtitle'];
				$date = $newarray['semdate'];
				$semteacher = $newarray['semteacher'];
				$seminfo = $newarray['seminfo'];
	
			echo "<center><h1><br><br><br>Seminar information</h1>";
			echo "<div class='table-responsive'><table class='table table-striped'>";
			echo "<tr><td><b><font size=\"4\">ID</font></b></td>";
			echo "<td><font size=\"3\">$aa</font></td></tr>";
			echo "<tr><td><b><font size=\"4\">Title</font></b></td>";
			echo "<td><font size=\"3\">$title</font></td></tr>";
			echo "<tr><td><b><font size=\"4\">Date</font></b></td>";
			echo "<td><font size=\"3\">$date</font></td></tr>";
			echo "<tr><td><b><font size=\"4\">Teacher</font></b></td>";
			echo "<td><font size=\"3\">$semteacher</font></td></tr>";
			echo "<tr><td><b><font size=\"4\">Description</font></b></td>";
			echo "<td><font size=\"3\">$seminfo</font></td></tr>";
			echo "</table></div>";
			echo " <a onclick=\"javscript: history.go(-1)\" href=\"\">Back</a>";
			}
		}
		else
		{
			print("Could not insert record!");
		}
}
}else{
	header("Location: login.php");
}


?>