<?php
if($user_data['accesslevel'] == 2){
	echo " <nav class='navbar navbar-inverse navbar-fixed-top'><div class='container-fluid'><div class='navbar-header'>
	<p class=\"pull-left visible-xs\"><button id=\"offcanvasleft\" class='navbar-toggle collapsed' type=\"button\" data-toggle=\"offcanvasleft\"><span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span></button>
                </p>
		<button type='button' class='navbar-toggle collapsed' data-toggle='collapse' data-target='#navbar' aria-expanded='false' aria-controls='navbar'>
            <span class='sr-only'>Toggle navigation</span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span>
            <span class='icon-bar'></span></button>";
	echo "<a href='index.php' class='navbar-brand'>User Control Panel</a></div>";
	echo "<div id='navbar' class='navbar-collapse collapse'><ul class='nav navbar-nav navbar-right'>";
	echo "<li class='navbar-brand'>Welcome " .$user_data['username']. "</li><li> <a href=\"logout.php\">Logout</a></li></ul>  ";
	echo "<form class='navbar-form navbar-right'><input type='text' class='form-control' placeholder='Search...'></form</div></div></nav>";
	echo " <div class='container-fluid'><div class='row'><div class='col-sm-3 col-md-2 row-offcanvas-left sidebar'>";
	echo "<ul class='nav nav-sidebar'>" ;
	
	echo "<li class='testick '><a href=\"register_seminar.php\" target='iframe_a'><font size=\"4\">Sign to seminar</font></a></li>";

	$id = $user_data['id'];
	echo "<li class='testick '><a href=\"show_history.php?userid=$id\" target='iframe_a'><font size=\"4\">Show Seminars Background</font></a></li>";
	echo "<li class='testick '><a href=\"edituser.php?userid=$id\" target='iframe_a'><font size=\"4\">Edit profile</font></a></li>";
	echo "<li class='testick '><a href=\"choosesemi_files.php\" target='iframe_a'><font size=\"4\">Notes</font></a></li>";
	echo "</ul></div></div></div>";
	echo "<iframe height='100%' name='iframe_a' align='right' src='userindex.php'></iframe>";
	echo "<hr>";}
	?>
	<script> 
$('#offcanvasleft').click(function() {
  $('.row-offcanvas-left').toggleClass('sidebar');
});
</script>