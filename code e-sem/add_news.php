
<?php


$sem = $_POST['seminario'];
$name = $_POST['name'];
//$date = $_POST['date'];

$body = $_POST['body'];
$auth = $_POST['author'];
$access = $_POST['access'];

include "connection2.php";


if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
	
		
	$st=$con->prepare("INSERT INTO news(access_level,name,author,body,semid,date) VALUES(?,?,?,?,?,NOW())");
	$st->bindParam(1,$access);
	$st->bindParam(2,$name);
	$st->bindParam(3,$auth);
	$st->bindParam(4,$body);
	$st->bindParam(5,$sem);
	
	
		$st->execute();
	
	if($st == true)
	{
		echo "<font color=\"green\">You have successfully post<b> $name </b> </font>";
		header("Location: manage_news.php");
	}
	else
	{
		print("Could not insert record!");
	}
	
//include "manage_users.php";


?>

</body>
</html>