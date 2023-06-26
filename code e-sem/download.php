<?php
include 'core/init.php';
if (logged_in() === true) {
if(isset($_GET['id'])) 
{
//include "connection2.php";
$id    = $_GET['id'];
$st = $con->prepare("SELECT name,type,size,content FROM files WHERE id = ?");
		$st->bindParam(1,$id);
		$st->execute();
foreach ($st->fetchAll() as $row) {
	
	$name = $row['name'];
	$type = $row['type'];
	$size=$row['size'];
	$content=$row['content'];
}
//echo "$content";
?>
<?php
header("Content-length: $size");
header("Content-type: $type");
header("Content-Disposition: attachment; filename=$name");
ob_clean();
flush();
echo stripslashes($content);
exit;
}
}else{
	header("Location: login.php");
}

?>