<?php 

require'core/init.php';


if (empty($_POST) === FALSE) {
	
	$username = $_POST['id'];
	$password = $_POST['pass'];
	
	if(empty($username) === TRUE || empty($password) === TRUE){
			$errors[] = 'Username or Password empty';
		
	}else if (user_exists($username) == "0"){
			$errors[] = 'Username doesnt exist.';
	}else if (user_aprooved($username,$password) == false){
			$errors[] = 'You are not activated user. Please wait until the administrator activate your account.';
	}else{
		$login = login($username, $password);
		if($login == "false"){
			$errors[] = 'Wrong Userame or Password.';
			
		}else{
			if(Token::get($_POST['token'])){
			$_SESSION['id'] = $login;
			header('Location: index.php');
			exit();}
			$errors[] = 'xaxa';
		}
	}
 }else{
 	
 }
include 'core/head.php ';
if (logged_in() === true) {
	header('Location: index.php');
	
} else {
	include 'loginform.php';
}
if($errors!=null){
echo output_errors($errors);	
}
 

?>