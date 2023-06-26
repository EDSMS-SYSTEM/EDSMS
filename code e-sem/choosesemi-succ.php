<?php
include_once('core/head.php');
include 'core/init.php';
if (logged_in() === true) {

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');

//include_once('includes/widget/header-nav.php');
echo "<br><br><center>";
echo "<h1>Successful Candidates Management</h1>";
include_once ('includes/widget/choosesemi_succ_form.php');
}else{
	header("Location: login.php");
}
?>