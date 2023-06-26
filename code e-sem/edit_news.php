 <?php 
include_once('core/head.php');
include 'core/init.php';
 if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');

//include_once('includes/widget/header-nav.php');

$title = $_GET['title'];

if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{	
	$results_id = $con->prepare("SELECT * FROM news WHERE name=?");
	$results_id->bindParam(1,$title);
	$results_id->execute();
	
	if($results_id == true)
	{
		$newarry=$results_id->fetchAll();
		foreach ($newarry as $newarray)
		{
		$name = $newarray['name'];
		$date = $newarray['date'];
		$author = $newarray['author'];
		$body = $newarray['body'];
		$access = $newarray['access_level'];
		$semid = $newarray['semid'];
		}
	}	



?>

<div class="container">
<form class="form-horizontal" id="formadd1"action="edit_news_res.php" method="post" >
		<h2>Edit Post</h2>
		<div class="form-group ">
		<label class="control-label  col-sm-2" for="sel1">Seminar</label>
  <div class="col-sm-10">
		<?php	$st = $con->prepare("SELECT semid,semtitle FROM seminars");
$st->execute();

echo "<select class=\"form-control\" id='sel1' name=\"seminario\">";
echo "<option value=0>All</option>";
foreach ($st->fetchAll() as $row) {

	$semid = $row['semid'];
	$semtitle = $row['semtitle'];
  echo "<option value=$semid>$semtitle</option>";
}
echo "</select>"; ?>
</div></div>
<div class="form-group">
		<label class="control-label col-sm-2" for="name">Title (*)</label>
		<div class="col-sm-10">
		<?php echo "<input id=\"name\" class=\"form-control\" name=\"name\" type=\"text\" size=\"30\" value=\"$name\" required/>"; ?>
		</div></div>
		<div class="form-group">
		<label class="control-label col-sm-2" for="body">Text (*)</label>
		<div class="col-sm-10">
		<?php echo "<textarea  class=\"form-control\" rows=\"5\" id=\"body\" name=\"body\" value='$body' required/>$body</textarea>"; ?>
		</div></div>
		
		<div class="form-group">
		<label class="control-label col-sm-2" for="author">Author(*)</label>
		<div class="col-sm-10">
		<?php echo "<input id=\"author\" class=\"form-control\" name=\"author\" value='$author' required/>"; ?>
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
		<input name="Submit" id="formsub" class="btn btn-primary" type="submit" value="Add" />
		<input value="Reset" class="btn btn-primary" type="reset" />
		<p>
		<b>(*)Required.</b></p>
		<p><div id="msgdiv"></div></p>
		</form></div></body></html>	 
	<?php 	} } ?>