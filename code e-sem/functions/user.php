<?php

function user_exists($username){
	require './connection2.php';
	$results = $con->prepare("SELECT username FROM users WHERE username = :name");
	$results->bindParam(':name',$username);
	$results->execute();
	$row = $results->rowCount();
	echo $row;
	if($row>0){
		
		return  $row ;
	
	}else{
		return FALSE;
	}
	
}

function user_id_from_username($username){
	require './connection2.php';
	$results = $con->prepare("SELECT id FROM users WHERE username =?");
	$results->bindParam(1,$username);
	$results->execute();
	$row=$results->fetch();
	return $row[0];
}
function user_aprooved($username,$password){
	require './connection2.php';
	$results = $con->prepare("SELECT aprooved,accesslevel FROM users WHERE username =? AND password =? ");
	$results->bindParam(1,$username);
	$results->bindParam(2,$password);
	$results->execute();
	$row=$results->fetch();
	if($row[0] == 0 && $row[1] ==2){
		return false;
	}else{
		return true;
	}
}
function login($username, $password){
	require './connection2.php';
	$user_id = user_id_from_username($username);
	$results = $con->prepare("SELECT id FROM users WHERE username = ? AND password = ? ");
	$results->bindParam(1,$username);
	$results->bindParam(2,$password);
	$results->execute();
	$row = $results->rowCount();
	
	if($row>0 && user_aprooved($username, $password) == true){
		
		return  $user_id ;
	
	}else{
		return "false";
	}
	
}

function user_data($user_id){
	require './connection2.php';
	$data=array();
	$user_id = (int)$user_id;
	$func_num_args = func_num_args();
	$func_get_args = func_get_args();
	if ($func_num_args > 1) {
		unset($func_get_args[0]);
		$field =  implode(', ', $func_get_args) ;
		$data = $con->prepare("SELECT " . $field . " FROM users WHERE id = ? ");
		$data->bindParam(1,$user_id);
		$data->execute();
		$row=$data->fetchAll();
		 foreach ($row as $data) {}
		return $data;
	}
}
function reg_isert($lname,$fname,$date,$email,$username,$pass,$phone,$mobile,$town,$addr){
	require './connection2.php';
	
	$st=$con->prepare("INSERT INTO users(lastname,firstname,date_born,email,username,password,phone,mobile,town,address,aprooved) VALUES('$lname','$fname','$date','$email','$username','$pass','$phone','$mobile','$town','$addr','0')");
	$st->execute();
}
function logged_in(){
return (isset($_SESSION['id']))? true : false ;
	
}
?>