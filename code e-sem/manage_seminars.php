
<?php 
include_once('core/head.php');
 ?>
<script type="text/javascript">
function hideform(a)
{
    if(a==1)
    document.getElementById("f1").style.display="none";
    else
    document.getElementById("f1").style.display="block";
}
</script>
<script>$("#dateField").val(new Date().toISOString().substring(0, 10));</script>
<body onload="hideform(1)">
<?php
include 'core/init.php';

if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');
//include_once('includes/widget/header-nav.php');
function getMinitext($text,$limit)
{
	$minitext= explode(" ",$text,$limit+1);
	for($i=0; $i < $limit;$i++)
	{
		$result.=$minitext[$i]. " ";
	}
	return $result;
}

echo "<center><h1>Seminars Management</h1></CENTER>";
echo "<center><div class='table-responsive'><table class='table table-striped'>";
echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">Title</font></b></td><td><b><font size=\"4\">Date</font></b></td><td><b><font size=\"4\">Teacher</font></b></td>
	<td><b><font size=\"4\">Description</font></b></td><td><b><font size=\"4\">Hours</font></b></td><td colspan=3><b><font size=\"4\">Actions</font></b></td></tr>";
if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}


else
{
	if($user_data['accesslevel'] == 0){	
	$results_id = $con->prepare("SELECT * FROM seminars");
	
	$results_id->execute();
}
elseif ($user_data['accesslevel'] == 1) {
	$name=$user_data['lastname'] . ' ' . $user_data['firstname'];
	$results_id = $con->prepare("SELECT * FROM seminars WHERE semteacher=?");
	$results_id->bindParam(1,$name);
	$results_id->execute();
	
}	
	$num=1;
	if($results_id->rowCount())
	{
		$newarry=$results_id->fetchAll();
		foreach ($newarry as $newarray)
		{
			$title = $newarray['semtitle'];
			$date = $newarray['semdate'];
			$semteacher = $newarray['semteacher'];
			$seminfo = $newarray['seminfo'];
			$semhours = $newarray['sem_hours'];
		
			if(strlen($seminfo)> 20)
			{
					$s = iconv_substr($seminfo, 0, 20 , 'UTF-8');
					$s = $s . ".....";
			}
			
			$tit = $title;
			if(strlen($title)>20)
			{
					$t = iconv_substr($title , 0 , 20 , 'UTF-8');
					$t = $t . ".....";
					$tit = $t;
			}

			echo "<tr><td><font size=\"3\">$num</font></td><td><font size=\"3\">$tit</font></td><td id=\"dateField\"><font size=\"3\">$date</font></td><td><font size=\"3\">$semteacher</font></td>";
				if(strlen($seminfo)> 20)
					echo "<td><font size=\"3\">$s</font></td>";
				else
					echo "<td><font size=\"3\">$seminfo</font></td>";
			echo "<td><font size=\"3\">$semhours</font></td>";	
?>
		<td><div class="btn-group">
		<?php 
  			if($user_data['accesslevel'] == 0){
		?>
			<?php echo "<a class=\"btn btn-danger\" role=\"button\" href='delete_seminar.php?title=".$title."'" ?> onclick="return confirm('Are you sure?') " </a>Delete
			<?php
		}
		?>
			<?php echo "<a class=\"btn btn-primary\" role=\"button\" href='edit_seminar.php?title=".$title."&aa=".$num." '" ?>  </a>Edit
		

			<?php echo "<a class=\"btn btn-primary\" role=\"button\" href='seminar_info.php?title=".$title."&aa=".$num."'" ?>  </a>Infos
			<?php echo "<a class=\"btn btn-primary\" role=\"button\" href='upload.php?title=".$title."'" ?>  </a>Upload notes
			</td></div>
			<?php echo "</tr>";

			$num++;

		}
	}
	else
	{
		print("<font color=\"red\">No seminar found! </font>");
	}
}
echo "</table></div>";

?>

<br><br>
<button class="btn btn-primary" onclick="hideform(2)">Add New</button>


<br><br>
<div class="container">
		<form class="form-horizontal" id="f1" action="add_seminar_result.php" enctype="multipart/form-data" method="post">
		<div class="form-group">
		<label class="control-label  col-sm-2"for="title">Title</label>
		<div class="col-sm-10">
		<input class="form-control"id="title" name="title" type="text"  />
		
		</div></div>
<div class="form-group">
	<label class="control-label  col-sm-2"for="date1">Date</label>
	<div class="col-sm-10">
		<input class="form-control" type="date" name="date" id="date1"  />
		
		

		</div></div>
<div class="form-group">
			
			
		<label class="control-label  col-sm-2"for="teachname">Teacher</label>
		<div class="col-sm-10">
		
		<?php
		
			$st = $con->prepare("SELECT lastname,firstname FROM users WHERE accesslevel=1");
			 
			$st->execute(); 	
		echo "<select class=\"form-control\" id=\"teachname\" name=\"teachname\">";	
		foreach ($st->fetchAll() as $row) {
		
		$semid = $row['lastname'];
		$semtitle = $row['firstname'];
		echo "$semid";
  		echo "<option value='$semid $semtitle'>$semid $semtitle</option>";
		} ?>
</select>
		</div></div>
<div class="form-group">
		<label class="control-label  col-sm-2"for="info">Description</label>
		<div class="col-sm-10">
		<textarea class="form-control" id="info" name="info"  cols="30" rows="5" > 
		</textarea>
		</div></div>
<div class="form-group">
		<label class="control-label  col-sm-2" for="hours">Duration Hours</label>
		<div class="col-sm-10">
		<input class="form-control" type="number" id="hours" name="hours" />
		
		</div></div>
<div class="form-group">
		<label class="control-label  col-sm-2" for="maxpart">Max participants Number</label>
		<div class="col-sm-10">
		<input class="form-control" type="number" id="maxpart" name="maxpart" />
		
		</div></div>

		
		<input name="Submit" type="submit" value="Submit" class="btn btn-primary"/>
		<input value="Reset" type="reset" class="btn btn-primary"></td>
</form></div>
</body>

</html><?php }else{
	header("Location: login.php");
} ?>