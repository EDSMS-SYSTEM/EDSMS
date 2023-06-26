<?php 

include_once('core/head.php');
include 'core/init.php';
if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');

//include_once('includes/widget/header-nav.php');
echo "<br><br><center>";
echo "<h1>Seminar Participants Management</h1>";
 $semid = $_POST['seminario'];
 
 $st=$con->prepare("SELECT semtitle,semdate FROM seminars WHERE semid=?");
 $st->bindParam(1,$semid);
 $st->execute();
 
 foreach($st->fetchAll() as $res){
 $semtitle = $res['semtitle'];
 $semdate = $res['semdate'];
 }
   
 
 echo "<h2> <b>Title:$semtitle</b> </h1>";
 echo "<font color=\"blue\"> Date: </font> ";
//echo date('d') . "/" . date('m') . "/" .date('Y') . "</font>      <br><br> <div id=\"done\"> <font color=\"990440fd\">Η ενέργεια εκτελέστηκε</font> </div>";
echo "<font color=black>$semdate </font><div id=\"done\"> <font color=\"990440fd\">Success</font> </div>";
 echo " <div class='table-responsive'><table class='table table-striped'>";
 
 echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">Name</font></b></td><td><b><font size=\"4\">Actions</font></b></td></tr>";
 
 $st=$con->prepare("SELECT userid FROM userseminars WHERE semid=?");
 $st->bindParam(1,$semid);
 $st->execute();
 $counter=0;
 foreach($st->fetchAll() as $res)
 {
	$counter++;
    $st1=$con->prepare("SELECT firstname,lastname FROM users WHERE id=?");
	$userid = $res['userid'];
	$st1->bindParam(1,$userid);
	$st1->execute();
	
	foreach($st1->fetchAll() as $res1)
	{
		$lastname = $res1['lastname'];
		$firstname = $res1['firstname'];
	   echo "<tr><td><font size=\"3\">$counter</font></td><td><font size=\"3\">$lastname $firstname</font></td><td><button class=\"deluserfromseminar btn btn-primary btn-danger\" name=\"$semid\" id=\"$userid\">Delete user from seminar</button></td></tr>";
	}
 }
 
echo "</table></div>"; 


$st=$con->prepare('SELECT maxparticipants FROM seminars WHERE semid=?');
$st->bindParam(1,$semid);
$st->execute();

foreach($st->fetchAll() as $r)
  $maxpart = $r['maxparticipants'];
  
 if($counter >= $maxpart)
   echo "<br> <h2>The seminar is full so you can not record a new user</h2>";
  else{
  echo "<h2>Add user to seminar</h1>";
     $st=$con->prepare('SELECT userid FROM userseminars WHERE semid=?');
	 $st->bindParam(1,$semid);
	 $st->execute();
	 
	 $users[] = array();
	 foreach($st->fetchAll() as $r){ $users[] = $r['userid']; }
	 
	 echo " <div class='table-responsive'><table class='table table-striped'>";
	 echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">Name</font></b></td><td><b><font size=\"4\">Actions</font></b></td></tr>";
	 
	 $st = $con->prepare('SELECT * FROM users WHERE accesslevel>1');
	 $st->execute();
	 $counter=0;
	 foreach($st->fetchAll() as $r)
	 {
	   $found = false;
	   foreach($users as $u)
	   {
	     if($u == $r['id'])
		   $found=true;
	   }
	   if(!$found){
	   		$counter++;
	      $name = $r['lastname'] . " " . $r['firstname'];
		  $userid = $r['id'];
	     echo "<tr><td><font size=\"3\">$counter</font></td><td><font size=\"3\">$name</font></td><td><button class=\"addtosemi btn btn-primary btn-success\" id=\"$userid\" name=\"$semid\">Add to seminar</button></td></tr>";
	   }
	 }
	 
	 echo "</table></div>";
	 	echo " <a onclick=\"javscript: history.go(-1)\" href=\"\">Back</a>";
  }
}else{
	header("Location: login.php");
}
 ?>