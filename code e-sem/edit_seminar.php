<?php include_once('core/head.php');
include 'core/init.php';
if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');

//include_once('includes/widget/header-nav.php');

$title = $_GET['title'];
$aa = $_GET['aa'];

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
			$semhours = $newarray['sem_hours'];

			echo "<center><h1>Edit Seminar</h1>";
			echo "<div class=\"container\">";
		
		echo "<form class=\"form-horizontal\" action=\"edit_seminar_execute.php?oldtitle=$title\" method=\"POST\">";
			echo "<div class=\"form-group\">";
			echo "<label class=\"control-label  col-sm-2\" for=\"title\">Title</label>";
			echo "<div class=\"col-sm-10\">";
			echo "<textarea class=\"form-control\" cols=\"35\" rows=\"4\" name=\"title\">$title</textarea>";
			echo "</div></div>";
			echo "<div class=\"form-group\">";
			echo "<label class=\"control-label  col-sm-2\" for=\"title\">Date</label>";
			echo "<div class=\"col-sm-10\">";
			echo "<input class=\"form-control\" type=\"date\" value =\"$date\"name=\"date\" id=\"date\"  size=\"10\">";

			echo "</div></div>";
			echo "<div class=\"form-group\">";
			echo "<label class=\"control-label  col-sm-2\" for=\"title\">Teacher</label>";
			echo "<div class=\"col-sm-10\">";
			echo "<input class=\"form-control\" type=\"text\" name=\"teacher\" value=\"$semteacher\" size=\"25\"></input>";
		echo "</div></div>";
		echo "<div class=\"form-group\">";
		echo "<label class=\"control-label  col-sm-2\" for=\"title\">Description</label>";
		echo "<div class=\"col-sm-10\">";
		echo "<textarea class=\"form-control\" name=\"descr\" rows=9 cols=40>$seminfo</textarea><br><br>";
		echo "</div></div>";
		echo "<div class=\"form-group\">";
		echo "<label class=\"control-label  col-sm-2\" for=\"title\">Duration</label>";
			echo "<div class=\"col-sm-10\">";
		echo "<input class=\"form-control\" type=\"number\" name=\"hours\" value=\"$semhours\" size=\"25\"></input>";
		echo "</div></div>";
		echo "<input type=\"submit\" value=\"Submit\" onclick=\"return confirm('Are you sure?')\" > </input>";

		echo "</form></div>";
		echo " <br><a onclick=\"javscript: history.go(-1)\" href=\"\">Back</a>";
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