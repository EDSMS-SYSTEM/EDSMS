
<?php


$lname = $_POST['lname'];
$fname = $_POST['fname'];
$date = $_POST['date'];
$email = $_POST['email'];
$username = $_POST['username'];
$pass = $_POST['password'];
$confpass = $_POST['password2'];
$phone = $_POST['phone'];
$mobile = $_POST['mobile'];
$town = $_POST['town'];
$addr = $_POST['address'];
$aapp = $_POST['appr'];
$pass_conf = 0;
$acce = 1;
include "connection2.php";


if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{
	
	$results_id = $con->prepare("SELECT username FROM users");
	$results_id->execute();
	$already=false;
	if($results_id->rowCount())
	{
			foreach($results_id->fetchAll() as $newarray){
			$us = $newarray['username'];
			if($us==$username)
				$already = true;
		}
	}

	if($already)
	{
		header("Location: manage_teachers.php");
		die("<font color=\"red\">Userame $us $username found in database, please enter another one.</font>");
	}


	
	$results_id=$con->prepare("INSERT INTO users(lastname,firstname,date_born,email,username,password,phone,mobile,town,address,aprooved,pass_conf,accesslevel) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)");
	$results_id->bindParam(1,$lname);
	$results_id->bindParam(2,$fname);
	$results_id->bindParam(3,$date);
	$results_id->bindParam(4,$email);
	$results_id->bindParam(5,$username);
	$results_id->bindParam(6,$pass);
	$results_id->bindParam(7,$phone);
	$results_id->bindParam(8,$mobile);
	$results_id->bindParam(9,$town);
	$results_id->bindParam(10,$addr);
	$results_id->bindParam(11,$aapp);
	$results_id->bindParam(12,$pass_conf);
	$results_id->bindParam(13,$acce);
	$results_id->execute();
		
	if($results_id == true)
	{
		echo "<font color=\"green\">You have successfully added user <b> $username </b> </font>";
		header("Location: manage_teachers.php");
	}
	else
	{
		print("Could not insert record!");
	}
}
//include "manage_users.php";


?>

</body>
</html>