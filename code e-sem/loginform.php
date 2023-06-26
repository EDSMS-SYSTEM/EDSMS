
<?php include_once('core/head.php'); ?>
<head>
 <link href="styles/login.css" rel="stylesheet">
<title>
Login
</title>
</head>





    <div class="container">
<center> <h2 class="form-signin-heading">e-Sem</h2><h2 class="form-signin-heading">  Dynamic seminars management system</h2></center>
      <form class="form-signin" action="login.php" method="post">
       
        <label for="user" class="sr-only">User Name</label>
        <input type="text" name="id" id="user" class="form-control" placeholder="User Name" required autofocus>
        <label for="passw" class="sr-only">Password</label>
        <input type="password" name="pass" id="passw"class="form-control" placeholder="Password" required>
        <input type="hidden" name="token" value="<?php echo Token:: set(); ?>">

        <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>
      </form>
<center><a href="sign.php ">Register</a><br><br><br><br></center>
    </div> <!-- /container -->


   


</html>