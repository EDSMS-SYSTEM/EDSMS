
<?php include_once('core/head.php'); ?>

<head>
 <link href="styles/login.css" rel="stylesheet">
<title>
Εγγραφή χρήστη
</title>
</head>

<body>
<div class="container">
	   <div align="center"class="col-lg-12" >
		<h1 class="form-signin-heading">Register</h1><br>
		<b>(*)Required.</b>
		<form class="form-signin" action="sign.php" method="post"style="    max-width: 451px;">
		
		
		<table class="table table-striped"style="border: 0px">
		<tr><td>
		<label for="lname">Last name (*)</label></td><td>		
		<input   name="lname" type="text" size="30"  onkeydown="
		if (!isLetter( event ) ) {
		alert ( 'Παρακαλώ μόνο γράμματα!' );
		return false;
		}" class="form-control" placeholder="Last Name" required autofocus>
		</td></tr>
		<tr><td>
		<label for="fname">First name (*)</label>
		</td><td>
		<input id="fname" name="fname" type="text" size="30" class="form-control" placeholder="First Name" required >
		</td></tr>
		<tr><td>
		<label for="date">Birthday (*)</label>
		</td><td>
		<input type="date" name="date" id="date"  size="10"class="form-control" placeholder="Birthday" required >
		 
		</td></tr><tr><td>
		<label for="email">Email (*)</label>
		</td><td>
		<input id="email" name="email" type="email" size="30" class="form-control" placeholder="Email" required>
		</td></tr>
		<tr><td>
		<label for="username">Username (*)</label>
		</td><td>
		<input id="username" name="username" type="text" size="30"class="form-control" placeholder="User Name" required >
		</td></tr>
		<tr><td>
		<label for="password">Password (*)</label>
		</td><td>
		<input id="password" name="password" type="password" size="30"class="form-control" placeholder="Password" required >
		</td></tr>
		<tr><td>
		<label for="password2">Confirm password (*)</label>
		</td><td>
		<input id="password2" name="password2" type="password" size="30"class="form-control" placeholder="Password Confirm" required >
		</td></tr>
		<tr><td>
		<label for="phone">Phone</label>
		</td><td>
		<input id="phone" name="phone" type="tel" size="30" class="form-control" placeholder="Phone" >
		</td></tr>
		<tr><td>
		<label for="mobile">Mobile (*)</label>
		</td><td>
		<input id="mobile" name="mobile" type="tel" size="30" class="form-control" placeholder="Mobile" required >
		</td></tr>
		<tr><td>
		<label for="town">City (*)</label>
		</td><td>
		<input id="town" name="town" type="text" size="30"class="form-control" placeholder="City" required >
		</td></tr>
		<tr><td>
		<label for="address">Address (*)</label>
		</td><td>
		<input id="address" name="address" type="text" size="30"class="form-control" placeholder="Address" required >
		</td></tr>
		<tr><td>
		<input name="Submit"  type="submit" value="Submit"class="btn btn-lg btn-primary btn-block"></td>
		<td>
		<input value="Reset" type="reset"class="btn btn-lg btn-primary btn-block"></td></tr>
		</table></div>
		<p align="center">
		<a href="index.php">Back</a></p>
		<p><div id="msgdiv"></div></p>
		
		</form></div></div>
		

</body>

</html>