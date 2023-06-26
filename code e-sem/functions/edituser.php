<?php
include_once('core/head.php');
?>
<title>Edit</title>
<?php
include 'core/init.php';
include_once('includes/widget/header-nav.php');
if (logged_in() === true) {

$userid=$_GET['userid'];

if($user_data['id'] != $userid)
	die('No access!!.');
echo "<center>";
echo "<table  border=1>";
$st = $con->prepare("SELECT * from users WHERE id=?");
$st->bindParam(1,$userid);
$st->execute();

echo "<tr><td><b><font size=\"4\">Username</font></b></td><td><b><font size=\"4\">Name</font></b></td><td><b><font size=\"4\">Last Name</font></b></td><td><b><font size=\"4\">Email</font></b></td><td><b><font size=\"4\">Phone</font></b></td><td><b><font size=\"4\">Mobile</font></b></td><td><b><font size=\"4\">City</font></b></td><td><b><font size=\"4\">Address</font></b></td><td colspan=3><b><font size=\"4\">Actions</font></b></td></tr>";
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
					
			echo "<tr><td><font size=\"3\">$username</font></td><td><font size=\"3\"><input  name='fname'  type='text'   onkeydown='' value=$fname></font></td><td><font size=\"3\"><input  name='lname'  type='text'   onkeydown='' value=$lname></font></td><td><font size=\"3\"><input  name='email'  type='text'   onkeydown='' value=$email></font></td><td><font size=\"3\"><input  name='phone'  type='text' size='12'  onkeydown='' value=$phone></font></td><td><font size=\"3\"><input  name='mobile'  type='text' size='12'  onkeydown='' value=$mobile></font></td><td><font size=\"3\"><input  name='town'  type='text'   onkeydown='' value=$town></font></td><td><font size=\"3\"><input  name='address'  type='text'   onkeydown='' value='$address'></font></td></tr>";
		
		}
	}
}	

echo "</table>";
echo "</center>";
	
?>
	