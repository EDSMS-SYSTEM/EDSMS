<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<title>ΕΡΓΑΣΤΗΡΙΟ ΑΤΜΟΣΦΑΙΡΙΚΗΣ ΡΥΠΑΝΣΗΣ ΚΑΙ ΠΕΡΙΒΑΛΛΟΝΤΙΚΗΣ ΦΥΣΙΚΗΣ | Εγγραφή Χρήστη - Αποτελέσματα</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<link rel="stylesheet" href="styles/style.css" type="text/css">
</head>
<body id="top">
<div class="wrapper row1">
  <div id="header" class="clear">
    <div class="fl_left">
	  <h1><a href="index.php"><img src="images/logo/airlab.jpg" height="60" width="180"></a>
	  <a href="index.php"><font size="5">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ΕΡΓΑΣΤΗΡΙΟ ΑΤΜΟΣΦΑΙΡΙΚΗΣ ΡΥΠΑΝΣΗΣ & ΠΕΡΙΒΑΛΛΟΝΤΙΚΗΣ ΦΥΣΙΚΗΣ</font></h1></a>
      <p>Ε.Α.Ρ. - ΠΕ.ΦΥ.</p> 
		</div>
			<div class="fl_right">
			<?php
				// Έλεγχος άν υπάρχει session και χρήστη μέσα στο σύστημα
				// Εμφάνιση login ή logout menu
				if(isset($_SESSION['choice_user']))  // Έλεγχος ύπαρξης της μεταβλητής
				{
				include "logout_menu.php";
				}
				else
				{
				include "login_menu.php";
				}
				?>			
			<!-- Εμφάνιζει στην ιστοσελίδα την λέξη επισκέπτης ή μέλος ή διαχειριστής-->
			<?php include "connect_as_user_admin_visitor.php"?>
			</div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper row2">
  <div id="topnav">
	<?php include 'menu.php';?> <!--Εμφάνιση μενού ανάλογα με την διαβάθμιση χρήστη-->
	<div  class="clear"></div>
  </div>
</div>
<!-- ####################################################################################################### -->
<div class="wrapper row4">
  <div id="container" class="clear">
    <!-- ####################################################################################################### -->
	
	<!--Εμφάνιση κατάλληλων μηνυμάτων σε περίπτωση που έχει καταχωρηθεί ή όχι το μέλος στην βάση δεδομένων-->
	<center><h1 class="title"><b><font color='#3366CC' size="4">ΕΓΓΡΑΦΗ ΧΡΗΣΤΗ - ΑΠΟΤΕΛΕΣΜΑΤΑ</font></b></h1></center>
	<br>
	 <?php 
		include ('functions/opendb.php');
		$fname=$_POST['fname'];
		$lname=$_POST['lname'];
		$email=$_POST['email'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$password2=$_POST['password2'];
		$phone=$_POST['phone'];
		$mobile=$_POST['mobile'];
		// Με τα παραπάνω παίρνουμε τις τιμές των πεδίων της φόρμας που υπήρχε στο αρχείο addmember.php και τις τοποθετούμε σε μεταβλητές
		
		//Αναζητά από την βάση δεδομένων τον συγκεκριμένο χρήστη
		$sqlcheck="SELECT * FROM site_members WHERE username='$username' "; 
		$resultcheck=mysql_query($sqlcheck); 
		$rowscheck=mysql_num_rows($resultcheck); 
		
		//Εισαγωγή χρήστη στην βάση δεδομένων
		if($rowscheck==0) 
		{ 
		  $query="INSERT INTO site_members VALUES ('id_user','$username','$password','$fname','$lname','$email','$phone','$mobile',0)";
			$result=mysql_query($query) or die (mysql_error());
			$query2="SELECT id_user from site_members ORDER BY id_user DESC ";
			$result2=mysql_query($query2) or die (mysql_error());
			$row=mysql_fetch_row($result2);
			echo "<center><font color='green' size='4'>Η καταχώρηση χρήστη πραγματοποιήθηκε με επιτυχία!</font></center><br>";

			include ('functions/closedb.php');
		}
		else
		{
			echo "<center><font color='red' size='4'>Tο Όνομα Χρήστη υπάρχει ήδη...</font></center>";
		}
	?>

    <!-- ####################################################################################################### -->
    <div class="clear"></div>
  </div>
</div>
<!-- ####################################################################################################### -->
  <div id="copyright" class="clear">
    <p align="center">Copyright &copy; 2011 - John Skordas<br>All Rights Reserved</p>
  </div>
<!-- ####################################################################################################### -->
</body>
</html>