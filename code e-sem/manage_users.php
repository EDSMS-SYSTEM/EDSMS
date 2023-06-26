
	<?php
include_once('core/head.php');
include 'core/init.php';
if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');

//include_once('includes/widget/header-nav.php');


if($user_data['accesslevel'] == 0)
  echo "<center><h1>Participants Management</h1>";
else
	echo "<center><h1>Add User</h1>";
?>

<button id="emf" class="btn btn-primary">Add New</button>
<br><br>
<button id="emf2" class="btn btn-primary">Enabled\Disabled users</button>

<br>
<div class="container">
<form class="form-horizontal" id="formadd" action="add_user.php" method="post">
		<h1>Add New</h1>
		<div class="form-group">
		<label class="control-label  col-sm-2"for="lname">Last name (*)</label>
		<div class="col-sm-10">
		<input class="form-control"   name="lname" type="text" size="30"  onkeydown="
		if (!isLetter( event ) ) {
		alert ( 'Please only letters!' );
		return false;
		}"required/>
		</div></div>
		<div class="form-group">
		<label class="control-label  col-sm-2"for="fname">First name (*)</label>
		<div class="col-sm-10">
		<input class="form-control" id="fname" name="fname" type="text" size="30" required/>
		</div></div>
		<div class="form-group">
		<label class="control-label  col-sm-2"for="date">Birthday (*)</label>
		<div class="col-sm-10">
		<input class="form-control" type="date" name="date" id="date"  size="10"required/>
		</div></div> 
		<div class="form-group">
		<label class="control-label  col-sm-2"for="email">Email (*)</label>
		<div class="col-sm-10">
		<input class="form-control" id="email" name="email" type="text" size="30" required/>
		</div></div>
		<div class="form-group">
		<label class="control-label  col-sm-2"for="username">Username (*)</label>
		<div class="col-sm-10">
		<input class="form-control" id="username" name="username" type="text" size="30"required/>
		</div></div>
		<div class="form-group">
		<label class="control-label  col-sm-2"for="password">Password (*)</label>
		<div class="col-sm-10">
		<input class="form-control" id="password" name="password" type="password" size="30"required/>
		</div></div>
		<div class="form-group">
		<label class="control-label  col-sm-2"for="password2">Retype password (*)</label>
		<div class="col-sm-10">
		<input class="form-control" id="password2" name="password2" type="password" size="30"required/>
		</div></div>
		<div class="form-group">
		<label class="control-label  col-sm-2"for="phone">Phone</label>
		<div class="col-sm-10">
		<input class="form-control" id="phone" name="phone" type="tel" size="30"  onkeydown="
		if ( !isNumber ( event ) ) {
		alert ( 'Please only numbers!' );
		return false;
		}"/>
		</div></div>
		<div class="form-group">
		<label class="control-label  col-sm-2"for="mobile">Mobile (*)</label>
		<div class="col-sm-10">
		<input class="form-control" id="mobile" name="mobile" type="tel" size="30"  onkeydown="
		if ( !isNumber ( event ) ) {
		alert ( 'Please only numbers!' );
		return false;
		}"required/>
		</div></div>
		<div class="form-group">
		<label class="control-label  col-sm-2"for="town">City (*)</label>
		<div class="col-sm-10">
		<input class="form-control" id="town" name="town" type="text" size="30"required/>
		</div></div>
			<div class="form-group">
		<label class="control-label  col-sm-2"for="address">Address (*)</label>
		<div class="col-sm-10">
		<input class="form-control" id="address" name="address" type="text" size="30"required/>
		</div></div>

		<div class="form-group">
		<label class="control-label  col-sm-2"for="appr">Condition</label>
		<div class="col-sm-10">
			<select class="form-control" name="appr" >
				<option value="0">Disabled</option>
				<option value="1" selected>Enabled</option>
			</select>
		</div></div>
		<input name="Submit" id="formsub"  type="submit" value="Submit" class="btn btn-primary">
		<input value="Reset" type="reset" class="btn btn-primary"></td>
		<p>
		<b>(*)Required.</b></p>
		<p><div id="msgdiv"></div></p>
		</form></div>
<br><br><br><br>
<?php

echo "<b><font class=\"anenf\" size=\"6\">Disabled users</font></b>";
echo "<div class='table-responsive'><table class=\"anenf table table-striped\" >";

echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">First name</font></b></td><td><b><font size=\"4\">Last name</font></b></td><td><b><font size=\"4\">Username</font></b></td><td><b><font size=\"4\">Phone</font></b></td><td><b><font size=\"4\">Mobile</font></b></td><td><b><font size=\"4\">City</font></b></td><td><b><font size=\"4\">Address</font></b></td><td colspan=3><b><font size=\"4\">Actions</font></b></td></tr>";
if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}


else
{
	$results_id=$con->prepare("SELECT * FROM users WHERE aprooved=0 AND accesslevel=2");
	$results_id->execute();
		
	$num=1;
	if($results_id->rowCount())
	{
		foreach($results_id->fetchAll() as $newarray){
			$fname = $newarray['firstname'];
			$lname = $newarray['lastname'];
			$username = $newarray['username'];
			$phone = $newarray['phone'];
			$mobile = $newarray['mobile'];
			$town = $newarray['town'];
			$address = $newarray['address'];

			$acc = $newarray['accesslevel'];

			if($user_data['accesslevel'] == 1){
				if($acc <2)continue;
			}
					
			echo "<tr><td><font size=\"3\">$num</font></td><td><font size=\"3\">$fname</font></td><td><font size=\"3\">$lname</font></td><td><font size=\"3\">$username</font></td><td><font size=\"3\">$phone</font></td><td><font size=\"3\">$mobile</font></td><td><font size=\"3\">$town</font></td><td><font size=\"3\">$address</font></td>";
			
?>
			<!--<td><?php echo "<a href='delete_seminar.php?title=".$title."'" ?> onclick="return confirm('Να διαγραφεί σίγουρα;') " </a>Ενεργοποίηση</td>
			
			-->
			
			<td><div class="btn-group">
				<button class="activate btn btn-primary btn-success" id=<?php echo "$username" ?> >Enable</button>
			
			<?php
				if($user_data['accesslevel'] == 0 ){
			?>
			<button class="edit btn btn-primary" id=<?php echo "$username" ?> >Edit</button>
				<button class="del btn btn-primary btn-danger" id=<?php echo "$username" ?> >Delete</button>
			
			
			
				
			</div></td>
			<?php
			  }
			?>
			<?php

			echo "</tr>";

			$num++;

		}
	}
	else
	{
		print("<br><font class=\"anenf\" color=\"red\">There was no disabled user found </font>");
	}
}
echo "</table></div>";
//mysql_close($connect);

echo "<b><font class=\"enenf\" size=\"6\">Enabled users</font></b> <br>";
echo "<div class='table-responsive'><table class=\"enenf table table-striped\" >";
echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">First name</font></b></td><td><b><font size=\"4\">Last name</font></b></td><td><b><font size=\"4\">Username</font></b></td><td><b><font size=\"4\">Phone</font></b></td><td><b><font size=\"4\">Mobile</font></b></td><td><b><font size=\"4\">City</font></b></td><td><b><font size=\"4\">Address</font></b></td><td colspan=3><b><font size=\"4\">Actions</font></b></td></tr>";
if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}


else
{
	$results_id=$con->prepare("SELECT * FROM users WHERE aprooved=1 AND accesslevel=2");
	$results_id->execute();
		
	$num=1;
	if($results_id->rowCount())
	{
		foreach($results_id->fetchAll() as $newarray){
			$fname = $newarray['firstname'];
			$lname = $newarray['lastname'];
			$username = $newarray['username'];
			$phone = $newarray['phone'];
			$mobile = $newarray['mobile'];
			$town = $newarray['town'];
			$address = $newarray['address'];
			$acc = $newarray['accesslevel'];

			if($user_data['accesslevel'] == 1){
				if($acc <2)continue;
			}
			echo "<tr><td><font size=\"3\">$num</font></td><td><font size=\"3\">$fname</font></td><td><font size=\"3\">$lname</font></td><td><font size=\"3\">$username</font></td><td><font size=\"3\">$phone</font></td><td><font size=\"3\">$mobile</font></td><td><font size=\"3\">$town</font></td><td><font size=\"3\">$address</font></td>";

?>
			<!--<td><?php echo "<a href='delete_seminar.php?title=".$title."'" ?> onclick="return confirm('Να διαγραφεί σίγουρα;') " </a>Ενεργοποίηση</td>
			
			-->

			<td><div class="btn-group">
				<button class="deactive btn btn-primary btn-warning" id=<?php echo "$username" ?> >Disable</button>
			
			<?php
				if($user_data['accesslevel'] == 0 ){
			?>
			<button class="edit btn btn-primary" id=<?php echo "$username" ?> >Edit</button>
				<button class="del btn btn-primary btn-danger" id=<?php echo "$username" ?> >Delete</button>
			
			
			
				
			</div></td>
			<?php
			   }
			?>
			<?php

			echo "</tr>";

			$num++;

		}
	}
	else
	{
		print("<font class=\"enenf\" color=\"red\">There was no enabled user found </font>");
	}
}
echo "</table></div>";

}else{
	header("Location: login.php");
}
?>

<br><br>




</body>

</html>