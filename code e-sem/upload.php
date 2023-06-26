<html>
	<?php
include_once('core/head.php');
include 'core/init.php';

if (logged_in() === true) {
$title = $_GET['title'];

if($user_data['accesslevel']  > 1)
	die('Only administrators have access to this page.');

//include_once('includes/widget/header-nav.php');



  echo "<center><h1>Upload</h1>";

$results = $con->prepare("SELECT semid FROM seminars WHERE semtitle=?");
		$results->bindParam(1,$title);
		$results->execute();
		$row=$results->fetch();
		
?>



<body>
<form method="post" enctype="multipart/form-data">
<table width="350" border="0" cellpadding="1" cellspacing="1" class="box">
<tr> 
<td width="246">
<input type="hidden" name="MAX_FILE_SIZE" value="2000000">
<input name="userfile" class="" type="file" id="userfile"> 
</td>
<td width="80"><input name="upload" type="submit" class="btn btn-primary  " id="upload" value=" Upload "></td>
</tr>
</table>
</form>
</body>
</html>
<?php
if(isset($_POST['upload']) && $_FILES['userfile']['size'] > 0)
{
$fileName = $_FILES['userfile']['name'];
$tmpName  = $_FILES['userfile']['tmp_name'];
$fileSize = $_FILES['userfile']['size'];
$fileType = $_FILES['userfile']['type'];

$fp      = fopen($tmpName, 'r');
$content = fread($fp, filesize($tmpName));
$content = addslashes($content);
fclose($fp);
//echo "$content";
if(!get_magic_quotes_gpc())
{
    $fileName = addslashes($fileName);
}
include 'connection2.php';

$results_id=$con->prepare("INSERT INTO files (name, size, type, content, semid ) VALUES(?,?,?,?,?)");
$results_id->bindParam(1,$fileName);
	$results_id->bindParam(2,$fileSize);
	$results_id->bindParam(3,$fileType);
	$results_id->bindParam(4,$content);
	$results_id->bindParam(5,$row[0]);
	$results_id->execute();

if($results_id == true){
echo "<br>File $fileName uploaded<br>";}
else{print("Could not insert record!");}
} 


}

echo "<center><form action=\"manage_files.php\" method=\"post\">";
echo "<input type=\"hidden\" name=\"seminario\" value=$row[0]>";
echo "<input class=\"btn btn-primary \" type=\"submit\" value=\"Back\">" ;
echo "</form></center>";

?>
