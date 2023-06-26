<?php 
session_start();
//error_reporting(0);

require 'connection2.php';
require 'functions/user.php';
require 'core/general.php';
require_once 'classes/Token.php';
if (logged_in() === TRUE){
	$session_user_id = $_SESSION['id'];
	$user_data = user_data($session_user_id,'id', 'username', 'firstname', 'password' , 'lastname', 'email', 'accesslevel');
//echo $user_data['is_admin'] ;
}
$errors = array();
$success = array();
?>