<?php
include_once('core/head.php');
?>
<title>Edit</title>
<?php
include 'core/init.php';
//include_once('includes/widget/header-nav.php');
if (logged_in() === true) {

$userid=$_GET['userid'];
if($user_data['accesslevel'] != 0){
if($user_data['id'] != $userid)
	die('Δεν έχετε πρόσβαση σε στοιχεία άλλων.');
}
echo "<form action='edit_user.php' method='post'>";
echo "<center><h1>Edit profile</h1>";
echo "<div class=\"table-responsive\">";
echo "<table  class=\"table table-striped\">";
$st = $con->prepare("SELECT * from users WHERE id=?");
$st->bindParam(1,$userid);
$st->execute();

echo "<tr><td><b><font size=\"4\">Username</font></b></td><td><b><font size=\"4\">First name</font></b></td><td><b><font size=\"4\">Last name</font></b></td><td><b><font size=\"4\">Email</font></b></td><td><b><font size=\"4\">Phone</font></b></td><td><b><font size=\"4\">Mobile</font></b></td><td><b><font size=\"4\">City</font></b></td><td><b><font size=\"4\">Address</font></b></td><td colspan=3><b><font size=\"4\">Action</font></b></td></tr>";
$num=1;
	if($st->rowCount())
	{
		foreach($st->fetchAll() as $newarray){
			$fname = $newarray['firstname'];
			$lname = $newarray['lastname'];
			$username = $newarray['username'];
			$phone = $newarray['phone'];
			$mobile = $newarray['mobile'];
			$town = $newarray['town'];
			$address = $newarray['address'];
			$email = $newarray['email'];
			$acc = $newarray['accesslevel'];

			if($user_data['accesslevel'] == 1){
				if($acc <2)continue;
			}
					
			echo "<tr><td><font size=\"3\"><p>$username</p></font></td><td><font size=\"3\"><input  name='fname'  type='text'   onkeydown='' value=$fname required></font></td><td><font size=\"3\"><input  name='lname'  type='text'   onkeydown='' value=$lname required></font></td><td><font size=\"3\"><input  name='email'  type='email'   onkeydown='' value=$email required></font></td><td><font size=\"3\"><input  name='phone'  type='number' size='12'  onkeydown='' value=$phone></font></td><td><font size=\"3\"><input  name='mobile'  type='number' size='12'  onkeydown='' value=$mobile required></font></td><td><font size=\"3\"><input  name='town'  type='text'   onkeydown='' value=$town required></font></td><td><font size=\"3\"><input  name='address'  type='text'   onkeydown='' value='$address' required></font></td><td><input name='Submit' class='btn btn-primary' type='submit' value='Save'/></td></tr>";
		
		}
	}
}	

echo "</table></div>";
echo "</center>";
	
?>
	