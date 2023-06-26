
<?php
include_once('core/head.php');
include 'core/init.php';
if (logged_in() === true) {

if($user_data['accesslevel']  == 2){
	echo "<center><h1>Files</h1>";
	include_once ('includes/widget/choosesemi_files_user_form.php');
}
elseif($user_data['accesslevel']  <2){
echo "<center>";

echo "<h1>Notes Management</h1>";

include_once ('includes/widget/choosesemi_files_form.php');
}
}else{
	header("Location: login.php");
}
?>
