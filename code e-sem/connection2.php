<?php
try{
	$con = new PDO('mysql:host=127.0.0.1;dbname=dbseminars;charset=utf8', 'root', '');
	$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$con->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
}
catch(PDOException $e){
	die('Sorry database problem.');
}
?>
