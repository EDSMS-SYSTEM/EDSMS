$(document).ready(function() {

$("#formadd").hide();

$(".anenf").hide();
$(".enenf").hide();
$("#done").hide();



    $(".activate").click(function(){
        var username = $(this).attr("id");

		$.ajax(
		{
			type:"post",
			data:"username=" + username ,
			url:"functions/enable_user.php",
            success:function(res)
			{
				alert(res);
				location.reload();
			}
		});
    }); 



 $(".deactive").click(function(){
        var username = $(this).attr("id");

		$.ajax(
		{
			type:"post",
			data:"username=" + username ,
			url:"functions/disable_user.php",
            success:function(res)
			{
				alert(res);
				location.reload();
			}
		});
    }); 
    
   

	 $(".del").click(function(){
        var username = $(this).attr("id");

		$.ajax(
		{
			type:"post",
			data:"username=" + username ,
			url:"functions/delete_user.php",
            success:function(res)
			{
				alert(res);
				location.reload();
			}
		});
    }); 

$("#emf").click(function(){
	$("#formadd").toggle();
});

$("#emf2").click(function(){
	$(".anenf").toggle();
	$(".enenf").toggle();
});

$(".paron").click(function(){
	var userid = $(this).attr("id");
	var semid = $(this).attr("name");

	var option=-1;

	$('select').each(function(){
    var id = $(this).attr("id");
    if(id==userid)
      option= $(this).val();
});
	$.ajax(
		{
			type:"post",
			data:"userid=" + userid + "&semid=" +semid + "&apousia=0" + "&ora=" +option,
			url:"update_parousiologio.php",
            success:function(res)
			{
				if(res=="no"){
					alert("You have already put in absence of specific student for specific time");
					return;
				}
					$("#done").show();
				$("#done").fadeOut(3000);
			}
		});
});
 
$(".apon").click(function(){
	var userid = $(this).attr("id");
	var semid = $(this).attr("name");
var option=-1;

	$('select').each(function(){
    var id = $(this).attr("id");
    if(id==userid)
      option= $(this).val();
});
	$.ajax(
		{
			type:"post",
			data:"userid=" + userid + "&semid=" +semid + "&apousia=1" + "&ora=" +option,
			url:"update_parousiologio.php",
            success:function(res)
			{
				if(res=="no"){
					alert("You have already put in absence of specific student for specific time");
					return;
				}
				$("#done").show();
				$("#done").fadeOut(3000);
			}
		});
});
 


$(".success").click(function(){
	var userid = $(this).attr("id");
	var semid = $(this).attr("name");

	$.ajax(
		{
			type:"post",
			data:"userid=" + userid + "&semid=" +semid + "&success=1" ,
			url:"updatesuccess.php",
            success:function(res)
			{
				alert(res);
				location.reload();
			}
		});
});

$(".fail").click(function(){
	var userid = $(this).attr("id");
	var semid = $(this).attr("name");

	$.ajax(
		{
			type:"post",
			data:"userid=" + userid + "&semid=" +semid + "&success=0" ,
			url:"updatesuccess.php",
            success:function(res)
			{
				alert(res);
				location.reload();
			}
		});
});
 

 
 $(".deluserfromseminar").click(function(){
	var userid = $(this).attr("id");
	var semid = $(this).attr("name");
 
	var ans = confirm('Are you sure?');
	
	if(ans){
 
	$.ajax(
		{
			type:"post",
			data:"userid=" + userid + "&semid=" +semid ,
			url:"deluserfromseminar.php",
            success:function(res)
			{
				location.reload();
			}
		});
		}
});

 $(".addtosemi").click(function(){
	var userid = $(this).attr("id");
	var semid = $(this).attr("name");
 
	var ans = confirm('Are you sure?');
	
	if(ans){
 
	$.ajax(
		{
			type:"post",
			data:"userid=" + userid + "&semid=" +semid ,
			url:"addusertoseminar.php",
            success:function(res)
			{
				location.reload();
			}
		});
		}
});





  $(".moveiper").click(function(){
	var userid = $(this).attr("id");
	var semid = $(this).attr("name");
 
	var ans = confirm('Are you sure?');
	
	if(ans){
	$.ajax(
		{
			type:"post",
			data:"userid=" + userid + "&semid=" +semid ,
			url:"moveuperexecute.php",
            success:function(res)
			{
				alert("x");
				location.reload();
			}
		});
		}
})



});