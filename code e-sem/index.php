<?php 

include_once('core/head.php');
include 'core/init.php';
if (logged_in() === true) {
	
	if($user_data['accesslevel'] == 0){
		include_once('includes/welcomeadmin.php');
	}elseif($user_data['accesslevel'] == 1){
		include_once('includes/welcometeacher.php');
	}elseif($user_data['accesslevel'] == 2){
		include_once('includes/welcomeuser.php');
	}

	else{
		
	}
}else{
	header("Location: login.php");
}

?>