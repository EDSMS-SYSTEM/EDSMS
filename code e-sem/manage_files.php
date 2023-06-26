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
echo "<center><h1>Notes management</h1>";


echo "<font size=\"5\"><u>Seminar Title:</u></font> <br> <font size=\"5\"><i>$semtitle</i></font> <br><br>";

echo "<font color=\"blue\"> Date: ";
//echo date('d') . "/" . date('m') . "/" .date('Y') . "</font>      <br><br> <div id=\"done\"> <font color=\"990440fd\">Η ενέργεια εκτελέστηκε</font> </div>";
echo "<font color=black>$semdate </font><div id=\"done\"> <font color=\"990440fd\"Successfull</font> </div>";

$st = $con->prepare("SELECT id FROM files WHERE semid=?");
$st->bindParam(1,$semid);
$st->execute();

$count=0;
//echo "<div class='row'><div class='col-md-4'><a class=\"btn btn-primary\" role=\"button\" href='upload.php?title=$semtitle'> Upload</a></div></div><br>";

echo "<div class='table-responsive'><table class='table table-striped'>";
echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">File Name</font></b></td><td><b><font size=\"4\">Actions</font></b></td><td>
<a class=\"btn btn-primary\" role=\"button\" href='upload.php?title=$semtitle'> Upload New</a></td></tr>";

foreach ($st->fetchAll() as $row) {
	$count++;
	$st1=$con->prepare("SELECT name,id FROM files WHERE id=? ");
	$userid = $row['id'];
	$st1->bindParam(1,$userid);
	$st1->execute();

	foreach ($st1->fetchAll() as $row1){
		$name = $row1['name'];
		$id = $row1['id'];
		echo "<tr>";
		echo "<td><font size=\"3\">$count</font></td>";
		echo "<td><font size=\"3\">$name</font></td>";
		echo "<td><div class=\"btn-group\"><a class=\"btn btn-primary\" role=\"button\" href='download.php?id=$id' >Download</a>";
		echo "<a class=\"btn btn-danger\" role=\"button\" href='delete_file.php?title=$name'  onclick=\"return confirm('Are you sure;')\"> Delete</a></div></td>";
		echo "<td></td></tr>";
		
	}
}



echo "</table></div>";


if($count==0)
  echo "<br> <b><font color=red>No notes found in this seminar</font></b>";


// epilogi alou seminariou


include_once ('includes/widget/choosesemi_files_form.php');
}else{
	header("Location: login.php");
}
?>
</center>
</body>

</html>