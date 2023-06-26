<?php
		if($user_data['accesslevel'] == 0){
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

		echo "<p class='navbar-brand'>Admin Control Panel</p></div>";
		echo "<div id='navbar' class='navbar-collapse collapse'><ul class='nav navbar-nav navbar-right'>";
		echo "<li class='navbar-brand'>Welcome " .$user_data['username']. "</li><li> <a href=\"logout.php\">Logout</a></li></ul>";
		echo "<form class='navbar-form navbar-right'><input type='text' id='search'  class='form-control' placeholder='Search...'></form</div></div></nav>";
		
		
		echo " <div class='container-fluid'><div class='row'><div class='col-sm-3 col-md-2 row-offcanvas-left sidebar'>";
	echo "<ul class='nav nav-sidebar'>" ;
	
		echo "<li class='testick '><a href=\"manage_seminars.php\" target='iframe_a'><font size=\"4\">Seminars Management</font></a></li>";
		echo "<li class='testick'><a href=\"manage_users.php\" target='iframe_a'><font size=\"4\">Participants Management</font></a></li>";
		echo "<li class='testick'><a href=\"manage_users_semi.php\" target='iframe_a'><font size=\"4\">Seminar Participants Management</font></a></li>";
		echo "<li class='testick'><a href=\"choosesemi.php\"  target='iframe_a' ><font size=\"4\">Attendance Book</font></a></li>";
		echo "<li class='testick'><a href=\"choosesemi-succ.php\" target='iframe_a'><font size=\"4\">Successful Candidates Management</font></a></li>";
		echo "<li class='testick'><a href=\"manage_teachers.php\" target='iframe_a'><font size=\"4\">Teachers Management</font></a></li>";
		echo "<li class='testick'><a href=\"choosesemi_files.php\" target='iframe_a'><font size=\"4\">Notes management</font></a></li>";
		echo "<li class='testick'><a href=\"manage_news.php\" target='iframe_a'><font size=\"4\">Announcements Management</font></a></li>";
		echo "</ul></div></div></div>";
		echo "<iframe height='100%'  name='iframe_a' align='right'></iframe>";
		echo "<hr>";}
?>
<script>
	$("#search").keyup(function(){
        var search = $(this).val();

		$.ajax(
		{
			type:"post",
			data: "search1=" + search,
			url:"search.php",
            success:function(res)
			{
				alert(res);
				
			}
		});
  }); 
</script>
<script> 
$('#offcanvasleft').click(function() {
  $('.row-offcanvas-left').toggleClass('sidebar');
});
</script>
<script>

    
	$(".testick").click(function(){
        $(".testick").removeClass('active');
			$(this).addClass('active');	
    });
		
	
</script>
