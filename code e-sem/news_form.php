 <?php 
include_once('core/head.php');
include 'core/init.php';
 if (logged_in() === true) {

//if($user_data['accesslevel']  > 1)
	//die('Μόνο οι διαχειριστές έχουν πρόσβαση σε αυτή τη σελίδα.');

//include_once('includes/widget/header-nav.php');

$title = $_GET['title'];

if(!$con)
{
		die("Could not connect to server " .$host . " User :" . $user);
}
else
{	
	$results_id = $con->prepare("SELECT * FROM news WHERE name=?");
	$results_id->bindParam(1,$title);
	$results_id->execute();
	
	if($results_id == true)
	{
		$newarry=$results_id->fetchAll();
		foreach ($newarry as $newarray)
		{
		$name = $newarray['name'];
		$date = $newarray['date'];
		$author = $newarray['author'];
		$body = $newarray['body'];
		$access = $newarray['access_level'];
		$semid = $newarray['semid'];
		}
	}	



?>
 <html>
 <head><link href="styles/blog.css" rel="stylesheet"></head>
 <body>

    <div class="container">

      
      <div class="row">

        <div class="col-sm-8 blog-main">

          <div class="blog-post">
      <?php
      echo "<h2 class=\"blog-post-title\">$title</h2>";
      echo "<p class=\"blog-post-meta\">$date <a href=\"#\">$author</a></p>";
	  echo "<p>  $body </p>";
	  ?>
          </div><!-- /.blog-post -->
        </div><!-- /.blog-main -->
      </div><!-- /.row -->
    </div><!-- /.container -->
 </body>
</html>
 <?php 
 echo " <center><a onclick=\"javscript: history.go(-1)\" href=\"\">Back</a></center>";
}}
 ?>