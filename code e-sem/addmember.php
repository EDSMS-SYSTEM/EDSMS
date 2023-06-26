<?php session_start()?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="EN" lang="EN" dir="ltr">
<head profile="http://gmpg.org/xfn/11">
<link rel="stylesheet" href="styles/style.css" type="text/css">
<title>ΕΡΓΑΣΤΗΡΙΟ ΑΤΜΟΣΦΑΙΡΙΚΗΣ ΡΥΠΑΝΣΗΣ ΚΑΙ ΠΕΡΙΒΑΛΛΟΝΤΙΚΗΣ ΦΥΣΙΚΗΣ | Εγγραφή Χρήστη</title>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="imagetoolbar" content="no" />
<link rel="stylesheet" href="styles/layout.css" type="text/css" />
<!--Συνάρτηση ελέγχου εγκυρότητας της φόρμας-->
<script type="text/javascript" src="scripts/form_validation.js"></script>
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
	
	<!--Εισαγωγή χρήστη στην βάση δεδομένων και έλεγχος εγκυρότητας δεδομένων-->
	<center><h1 class="title"><b><font color='#3366CC' size="4">ΕΓΓΡΑΦΗ ΧΡΗΣΤΗ</font></b></h1></center>
	<center><h1>Παρακαλώ συμπληρώστε τα παρακάτω στοιχεία</h1></center>
	  <ul><ul><ul><ul>
		<?php  if ($message_=="")
		{ ?>
	   <div align="right" style="padding-right:400px;">
		<form onsubmit='return checkform(this);' action="addmemberexecute.php" enctype="multipart/form-data" method="post">
		<p>
		<label for="username">Όνομα Χρήστη</label>
		<input id="username" name="username" type="text" size="30" />
		</p>
		<p>
		<label for="password">Συνθηματικό</label>
		<input id="password" name="password" type="password" size="30" />
		</p>
		<p>
		<label for="password2">Επιβεβαίωση</label>
		<input id="password2" name="password2" type="password" size="30" />
		</p>
		<p>
		<label for="lname">Επώνυμο</label>
		<input id="lname" name="lname" type="text" size="30"/></p>
		<p>
		<label for="fname">Όνομα</label>
		<input id="fname" name="fname" type="text" size="30"/></p>
		<p>
		<label for="phone">Τηλέφωνο</label>
		<input id="phone" name="phone" type="text" size="30"  onkeydown="
		if ( !isNumber ( event ) ) {
		alert ( 'Παρακαλώ μόνο αριθμούς!' );
		return false;
		}"/>
		</p>
		<p>
		<label for="mobile">Κινητό</label>
		<input id="mobile" name="mobile" type="text" size="30"  onkeydown="
		if ( !isNumber ( event ) ) {
		alert ( 'Παρακαλώ μόνο αριθμούς!' );
		return false;
		}"/>
		</p>
		<p>
		<label for="email">e-mail</label>
		<input id="email" name="email" type="text" size="30" />
		</p>
		<input name="Submit" type="submit" value="Εγγραφή"/>
		<input value="Καθαρισμός φόρμας" type="reset"></td>
		</form>
		<?php }
		else
		{
		echo $message_;
		}
		?>
	   </div>
	</ul></ul></ul></ul>
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