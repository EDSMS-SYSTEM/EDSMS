<html>
<head>

<link rel="stylesheet" href="styles/style.css" type="text/css">
<link rel="stylesheet" href="tigra_calendar/calendar.css">
<link rel="stylesheet" href="tigra_calendar/seaglass.css">
<script language="JavaScript" src="tigra_calendar/calendar_eu.js"></script>
</head>
<body>

	   <div align="right" style="padding-right:400px;">
		<form  action="add_seminar_result.php" enctype="multipart/form-data" method="post">
		<p>
		<label for="title">Seminar title</label>
		<input id="title" name="title" type="text" size="30" />
		</p>

	<label for="date">Date</label>
		<input type="text" name="date" id="date" readonly="readonly" size="10">
		<script language="JavaScript">
			new tcal({
			'controlname': 'date'
	   });
		</script>
		

		<p>
		<label for="teachname">Proffesor</label>
		<input id="teachname" name="teachname" type="text" size="30" />
		</p>

		<p>
		<label for="info">Description</label>
		<textarea id="info" name="info"  cols="30" rows="5" > 
		</textarea>
		</p>
		
		<input name="Submit" type="submit" value="ADD"/>
		<input value="RESET" type="reset"></td>
		</form>
		

</body>

</html>