<?php
include_once('core/head.php');
?>
<title></title>
<?php
include 'core/init.php';

if (logged_in() === true) {

 //include('includes/widget/header-nav.php');	
 
 function isRegisted($semid)
		{
			
		 include "connection2.php";
	$results_id = $con->prepare("SELECT * FROM userseminars WHERE semid=?");
	$results_id->bindParam(1,$semid);
	$results_id->execute();
	
	if($results_id->rowCount())
	{
		
		foreach ($results_id->fetchAll() as $semi){
			$id = $semi['userid'];
			$sid = $semi['semid'];
			
			if($id == $_SESSION['id']	&& $sid == $semid)
				return true;
		}
			
	}
	return false;
}
	
  function registed($i)
  {
	 include "connection2.php";
	$results_id = $con->prepare("SELECT * FROM userseminars WHERE semid=?");
	$results_id->bindParam(1,$i);
	$results_id->execute();
	
	if($results_id->rowCount())
	{
		$registed=0;
		foreach ($results_id->fetchAll() as $semi){
			$registed++;
		}
		return $registed;

		
	}
	else
		return 0;
  }

  if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{
	$results_id = $con->prepare("SELECT * FROM seminars");
	$results_id->execute();
	

echo "<center><h1>Sign to seminar</h1>";
	if($results_id->rowCount())
	{
		echo "<div class='table-responsive'><table class='table table-striped'>";
		echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">Title</font></b></td><td><b><font size=\"4\">Date</font></b></td><td><b><font size=\"4\">Duration</font></b></td><td><b><font size=\"4\">Teacher</font></b></td><td><b><font size=\"4\">Participants Number</font></b></td><td colspan=2><b><font size=\"4\">Actions</font></b></td></tr>";
		$counter=0;
		foreach ($results_id->fetchAll() as $semi){
		
			$counter++;
			$id = $semi['semid'];
			$title = $semi['semtitle'];
			$semd = $semi['semdate'];
			$semhours = $semi['sem_hours'];


		include "connection2.php";
		$stt = $con->prepare("SELECT maxparticipants,semteacher FROM seminars WHERE semid=?");
		$stt->bindParam(1,$id);
		$stt->execute();

		foreach($stt->fetchAll() as $r){
			   $maxp = $r['maxparticipants'];
			   $teach = $r['semteacher'];
		}
		  		
			$num=1;
			echo "<tr>";
			echo "<td><font size=\"3\">$counter</font></td>";
			echo "<td><font size=\"3\">$title</font></td>";
			echo "<td><font size=\"3\">$semd</font></td>";
			echo "<td><font size=\"3\">$semhours</font></td>";
			echo "<td><font size=\"3\">$teach</font></td>";
			$register  = registed($id);
				echo "<td><font size=\"3\">$register / $maxp</font></td>";
			if (!isRegisted($id)){
				echo "<form action=\"addtoseminar.php?id=$id\" method=\"POST\">";
				echo "<td><div class='btn-group'><input type=\"submit\" class=\"btn btn-primary  btn-success\" name='$id' value=\"Sign in\" enabled>";
				echo "<input type=\"submit\" class=\"btn btn-primary disabled btn-danger\" name='$id' value=\"Sign out\" disabled>
				<a class=\"btn btn-primary\" role=\"button\" href='seminar_info.php?title=$title&aa=$num' >Infos  </a></div></td>";
				echo "</form>";
			}
				//echo "<td><button enabled >Εγγραφή</button></td><td><button disabled>Απεγγραφή</button></td>";
			else{
				//echo "<td><button disabled>Εγγραφή</button></td><td><button enabled>Απεγγραφή</button></td>";
				echo "<form action=\"deletefromseminar.php?id=$id\" method=\"POST\">";
				echo "<td><div class='btn-group'><input type=\"submit\" class=\"btn btn-primary disabled btn-success\" name='$id' value=\"Sign in\" disabled>";
				echo "<input type=\"submit\" name='$id' class=\"btn btn-primary  btn-danger\" value=\"Sign out\" enabled><a class=\"btn btn-primary\" role=\"button\" href='seminar_info.php?title=$title&aa=$num'>Infos</a></div></td>";
				echo "</form>";
			}

			echo "</tr>";
		}

		echo "</table></div>";
	}
	else
		echo('There is no seminar available.');
}


echo "<br><br><h1>Seminars in which you are registered</h1>";

	$userid = $user_data['id'];
	$results_id = $con->prepare("SELECT * FROM userseminars WHERE userid=?");
	$results_id->bindParam(1,$userid);
	$results_id->execute();
	

	if($results_id->rowCount())
	{
		echo "<div class='table-responsive'><table class='table table-striped'>";
		echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">Title</font></b></td></tr>";
		$counter=0;
		foreach($results_id->fetchAll() as $newarray){
			$counter++;
			$semid=$newarray['semid'];
	
			$results_id1 = $con->prepare("SELECT * FROM seminars WHERE semid=?");
			$results_id1->bindParam(1,$semid);
			$results_id1->execute();
			
			foreach($results_id1->fetchAll() as $newarray1)
			{
				$titl = $newarray1['semtitle'];
				echo "<tr>";
			echo "<td><font size=\"3\">$counter</font></td>";
			echo "<td><font size=\"3\">$titl</font></td></tr>";
			}
		}
	}
	else
	{
		echo "<br>Not registered in a seminar.";
	}
	}else{
	header("Location: login.php");
}
?>


</center>
</body>

</html>