
	<?php
include_once('core/head.php');
include 'core/init.php';
if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');

//include_once('includes/widget/header-nav.php');


if($user_data['accesslevel'] == 1 || $user_data['accesslevel'] == 0){
  echo "<center><h1>Announcements Management</h1>";

?>

<?php

echo "<b><font  size=\"6\">News</font></b>";
echo "<div class='table-responsive'><table class=\"table table-striped\" >";

echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">Title</font></b></td><td><b><font size=\"4\">Author</font></b></td><td><b><font size=\"4\">Date</font></b></td><td colspan=3><b><font size=\"4\">Actions</font></b></td></tr>";
if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}


else
{
	$results_id=$con->prepare("SELECT * FROM news");
	$results_id->execute();
		
	$num=1;
	if($results_id->rowCount())
	{
		foreach($results_id->fetchAll() as $newarray){
			$name = $newarray['name'];
			$body = $newarray['body'];
			$author = $newarray['author'];
			$date = $newarray['date'];
			$access = $newarray['access_level'];
			$semid = $newarray['semid'];
			
					
			echo "<tr><td><font size=\"3\">$num</font></td><td><font size=\"3\">$name</font></td><td><font size=\"3\">$author</font></td><td><font size=\"3\">$date</font></td><td><div class=\"btn-group\">";
		
  			
		?><?php echo "<a class=\"btn btn-primary\" role=\"button\" href='news_form.php?title=".$name."&aa=".$num."'" ?>  </a>Show More
			<?php echo "<a class=\"btn btn-primary\" role=\"button\" href='edit_news.php?title=".$name."&aa=".$num." '" ?>  </a>Edit
		
<?php
			if($user_data['accesslevel'] == 0){
		
			echo "<a class=\"btn btn-danger\" role=\"button\" href='delete_news.php?title=".$name."'" ?> onclick="return confirm('Are you sure;') " </a>Delete
	<?php		
		}
			?> 
			</td></div>

			<!--<td><?php echo "<a href='delete_seminar.php?title=".$title."'" ?> onclick="return confirm('Να διαγραφεί σίγουρα;') " </a>Ενεργοποίηση</td>
			
			-->
			
			
			<?php

			echo "</tr>";

			$num++;
			}
		}
	
	
}
echo "</table></div>";
?>
<button id="emf" class="btn btn-primary">Add new</button>
<br><br>


<br>
<div class="container">
<form class="form-horizontal" id="formadd" action="add_news.php" method="post">
		<h1>Add new post</h1>
		<div class="form-group">
		<label class="control-label  col-sm-2" for="sel1">Seminars</label>
  <div class="col-sm-10">
		<?php echo "<select class=\"form-control\" id='sel1' name=\"seminario\">";
			
		if($user_data['accesslevel'] == 0){
			echo "<option value=0>All</option>";
$st = $con->prepare("SELECT semid,semtitle,semteacher FROM seminars");
$st->execute();



foreach ($st->fetchAll() as $row) {

	$semid = $row['semid'];
	$semtitle = $row['semtitle'];
	
	
  echo "<option value=$semid>$semtitle</option>";
}
}
elseif ($user_data['accesslevel'] == 1) {
$name=$user_data['lastname'] . ' ' . $user_data['firstname'];
	$st = $con->prepare("SELECT semid,semtitle FROM seminars WHERE semteacher=?");
	$st->bindParam(1,$name);
$st->execute();



foreach ($st->fetchAll() as $row) {

	$semid = $row['semid'];
	$semtitle = $row['semtitle'];
	
	
  echo "<option value=$semid>$semtitle</option>";	
}}
echo "</select>"; ?>
</div></div>
<div class="form-group">
		<label class="control-label col-sm-2" for="name">Title (*)</label>
		<div class="col-sm-10">
		<input id="name" class="form-control" name="name" type="text" size="30" required/>
		</div></div>
		<div class="form-group">
		<label class="control-label col-sm-2" for="body">Text (*)</label>
		<div class="col-sm-10">
		<textarea  class="form-control" rows="5" id="body" name="body" required/></textarea>
		</div></div>
		
		<div class="form-group">
		<label class="control-label col-sm-2" for="author">Author(*)</label>
		<div class="col-sm-10">
		<input id="author" class="form-control" name="author" <?php if ($user_data['accesslevel']==1) {echo "value='$name' disabled ";
		} ?>required/>
		</div></div>
		
		<div class="form-group">
		<label class="control-label col-sm-2" for="sel2"> Available for:</label>
		<div class="col-sm-10">
			<select id="sel2" name="access" class="form-control">
				<!--<option value="0" selected>Nobody</option>-->
				<option value="1" selected>Teachers</option>
				<option value="2" >Participants</option>
				<option value="3" >Everybody</option>
			</select>
		</div></div>
		<input name="Submit" id="formsub" class="btn btn-primary" type="submit" value="Submit"/>
		<input value="Reset" class="btn btn-primary" type="reset"></td>
		<p>
		<b>(*)Required</b></p>
		<p><div id="msgdiv"></div></p>
		</form>
<br><br><br><br>

<?php



}}else{
	header("Location: login.php");
}
?>

<br><br>




</body>

</html>