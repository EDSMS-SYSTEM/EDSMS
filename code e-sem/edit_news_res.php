
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
	
	$results_id = $con->prepare("SELECT id FROM news WHERE name=?");
	$results_id->bindParam(1,$name);
	$results_id->execute();	
	$row=$results_id->fetch();
	$st=$con->prepare("UPDATE news SET access_level=?,name=?,author=?,body=?,semid=? WHERE id=?");
	$st->bindParam(1,$access);
	$st->bindParam(2,$name);
	$st->bindParam(3,$auth);
	$st->bindParam(4,$body);
	$st->bindParam(5,$sem);
	$st->bindParam(6,$row[0]);
	
		$st->execute();
	//echo "$row[1]";
	if($st == true)
	{	/*echo "$row[1]";*/
		echo "<font color=\"green\">You have successfully update<b> $name </b> </font>";
		//header("Location: manage_news.php");
	}
	else
	{
		print("Could not insert record!");
	}
	
//include "manage_users.php";


?>

</body>
</html>