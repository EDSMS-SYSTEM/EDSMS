<?php
include_once('core/head.php');
?>
<title></title>
<?php
include 'core/init.php';

if (logged_in() === true) {
	
	echo "<center><h1>News</h1></center>";
	
	$access=1;
	$semid1=0;
	$results1 = $con->prepare("SELECT * FROM news WHERE semid=? AND access_level>?");
		$results1->bindParam(1,$semid1);
		$results1->bindParam(2,$access);
		$results1->execute();
		$a1=$results1->fetchAll();
				
	$userid = $user_data['id'];
	$results_id = $con->prepare( "SELECT * FROM news INNER JOIN userseminars ON news.semid=userseminars.semid AND news.access_level>? AND userseminars.userid = ?");
	$results_id->bindParam(1,$access);
	$results_id->bindParam(2,$userid);
	$results_id->execute();
	$a=$results_id->fetchAll();
	$a2=array_merge($a1,$a);			
?><div class="container">
    <div class="row">
    		<div class="col-md-4"></div>
    	<div class="col-md-4">
            <!-- Carousel
            ================================================== -->
            <div id="myCarousel" class="carousel slide">        
                <div class="carousel-inner">           
                    
             <?php       	
	if($results_id->rowCount())
	{
				$counter=0;
		
		foreach($a2 as $newarray2)
			{	$counter++;
				$name = $newarray2['name'];
				$author = $newarray2['author'];
				$date = $newarray2['date'];
				$body = $newarray2['body'];
				if(strlen($body)> 120)
			{
					$body = iconv_substr($body, 0, 120 , 'UTF-8');
					$body = $body . ".....";
			}
				
				?>
						<?php $item_class = ($counter == 1) ? 'item active' : 'item'; ?>
                    	<div class="<?php echo $item_class; ?>"> 
                        <div class="caption">
                       	  <h4><?php echo "$name";?></h4>
                            <p><?php echo "$body";?></p><a href='news_form.php?title=<?php echo "$name"; ?>'  >Show More </a>
                        </div>
                    </div>
                   
                    	
                        
                 
                  
                    
                 
	
	<?php	
	}
		
	?> 
	 </div>
	 <ol class="carousel-indicators">
	 	<?php
	 	for ($i=0; $i < $counter; $i++) {
	 		$class1 = ($i == 0) ? "class='active'" :'' ; 
			 echo "<li data-target=\"#myCarousel\" data-slide-to=\"$i\" $class1></li>";
		 }
		?>
                   </ol>                                                                 
            </div><!-- End Carousel -->  
    	</div>
    </div>
</div><script>$('#myCarousel').carousel({
    	interval:   4000
});</script><br /><?php			
		// }
	}
	

echo "<center><h1>Seminars you are watching</h1></center>";

	$userid = $user_data['id'];
	$results_id = $con->prepare("SELECT * FROM userseminars WHERE userid=?");
	$results_id->bindParam(1,$userid);
	$results_id->execute();
	

	if($results_id->rowCount())
	{
		echo "<div class='table-responsive'><table class='table table-striped'>";
		echo "<tr><td><b><font size=\"4\">ID</font></b></td><td><b><font size=\"4\">Seminar Title</font></b></td><td><b><font size=\"4\">Duration</font></b></td><td><b><font size=\"4\">Absences</font></b></td></tr>";
		$counter=0;
		foreach($results_id->fetchAll() as $newarray){
			$counter++;
			$semid=$newarray['semid'];
	
			$results_id1 = $con->prepare("SELECT * FROM seminars WHERE semid=?");
			$results_id1->bindParam(1,$semid);
			$results_id1->execute();
			
			foreach($results_id1->fetchAll() as $newarray1)
			{
				$titl = $newarray1['semtitle'];
				$diar = $newarray1['sem_hours'];
				
				echo "<tr>";
				echo "<td><font size=\"3\">$counter</font></td>";
				echo "<td><font size=\"3\">$titl</font></td>";
				echo "<td><font size=\"3\">$diar</font></td>";
				
				$st2 = $con->prepare("SELECT present,absent FROM attendancebook WHERE userid=? AND semid=?");
				$st2->bindParam(1,$userid);
				$st2->bindParam(2,$semid);
				$st2->execute();
				
				if($st2->rowCount())
				{
				foreach($st2->fetchAll() as $row2){
				$apousies = $row2['absent'];
				$parousies = $row2['present'];
					}
				}else {
					
					$apousies = 0;
				}
echo "<td><font size=\"3\">$apousies</font></td></tr>";
			}
			
			
			}
		}
	
	else
	{
		echo "<br>Not registered in a seminar.";
	}
	
			
		

		

		
		
	

		

}
else{
	header("Location: login.php");
}
?>