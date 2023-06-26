	// Συνάρτηση που ελέγχει αν τα πλήκτρα που πατιούνται είναι αριθμοί
	// Χρειάζεται για την εισαγωγή σωστών τηλεφώνων
	// http://authors.aspalliance.com/aspxtreme/abkd/script/valid_alpha.aspx

	function isNumber( evt ) 
	{
		var keyCode = evt.which ? evt.which : evt.keyCode;
		number = ( keyCode >= '0'.charCodeAt ( ) &&
				   keyCode <= '9'.charCodeAt ( ) ) || 
				 ( keyCode >= 8 && keyCode <= 46 );
		return ( number );
	}

	// Συνάρτηση ελέγχου φόρμας για την σωστή εισαγωγή των στοιχείων του χρήστη
	function checkform ( form )
	{
		if (form.lname.value == "") 
		{
			alert( "Παρακάλω συμπληρώστε το επώνυμό σας." );
			form.lname.focus();
			return false ;
		}
		if (form.lname.value.length > 30)
		{
			alert( "Το επώνυμό σας πρέπει να είναι μέχρι 30 χαρακτήρες." );
			form.lname.focus();
			return false ;
		}
		if (form.fname.value == "") 
		{
			alert( "Παρακάλω συμπληρώστε το όνομα σας." );
			form.fname.focus();
			return false ;
		}
		if (form.fname.value.length > 30)
		{
			alert( "Το όνομα σας πρέπει να είναι μέχρι 30 χαρακτήρες." );
			form.fname.focus();
			return false ;
		}

		if(form.email.value == "")
		{
				alert("Παρακαλώ συμπληρώστε το email σας.");
				form.email.focus();
				return false;
		}

		//Έλεγχος εγκυρότητας email
		var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
		if(form.email.value.match(emailExp)){
		}
		else
		{
		alert("Εισάγετε έγκυρο e-mail");
		form.email.focus();
		return false;
		}

		if (form.username.value == "") 
		{
			alert( "Παρακαλώ συμπληρώστε το όνομα χρήστη" );
			form.username.focus();
			return false ;
		}
	
		var username = document.getElementById('username');
		var min = 3;
		var max = 15;
		var uInput = username.value;
	
		if(uInput.length >= min && uInput.length <= max){
		}else{
		alert("Παρακαλώ εισάγετε όνομα χρήστη μεταξύ " +min+ " και " +max+ " χαρακτήρων");
		username.focus();
		return false;
		}
		
		if (form.password.value == "") 
		{
			alert( "Παρακαλώ συμπληρώστε το password σας." );
			form.password.focus();
			return false ;
		}
		if (form.password.value.length < 6 || form.password.value.length > 20)
		{
			alert( "Για την δική σας ασφάλεια, το password πρέπει να είναι μεταξύ 6 και 20 χαρακτήρων" );
			form.password.focus();
			return false ;
		}
		if (form.password2.value == "") 
		{
			alert( "Παρακαλώ ξανασυμπληρώστε το password σας." );
			form.password2.focus();
			return false ;
		}
		if (form.password2.value.length < 6 || form.password2.value.length > 20)
		{
			alert( "Για την δική σας ασφάλεια, το password πρέπει να είναι μεταξύ 6 και 20 χαρακτήρων" );
			form.password2.focus();
			return false ;
		}
		if (form.password.value != form.password2.value) 
		{
			alert( "Τα password που πληκτρολογήσατε δεν ταιριάζουν! Παρακαλώ ξαναδοκιμάστε" );
			form.password.value = "";
			form.password2.value = "";
			form.password.focus();
			return false ;
		}
		
		
		if (form.phone.value.length != 10)
		{
			alert( "Το τηλέφωνο πρέπει να είναι της μορφής π.χ. 2461025612 [10 ψηφία] !" );
			form.phone.focus();
			return false ;
		}
		if (form.mobile.value == "") 
		{
			alert( "Παρακαλώ συμπληρώστε το κινητό σας τηλέφωνο." );
			form.mobile.focus();
			return false ;
		}
		if (form.mobile.value.length != 10)
		{
			alert( "Το κινητό σας πρέπει να είναι της μορφής π.χ. 6944123456 [10 ψηφία] !" );
			form.mobile.focus();
			return false ;
		}
		
		
		if (form.town.value == "") 
		{
			alert( "Παρακαλώ συμπληρώστε τη Πόλη κατοικίας σας." );
			form.town.focus();
			return false ;
		}

			if (form.address.value == "") 
		{
			alert( "Παρακαλώ συμπληρώστε τη διεύθυνση σας." );
			form.address.focus();
			return false ;
		}

		return true ;
	}