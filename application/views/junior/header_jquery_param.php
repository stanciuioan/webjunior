<html>
<head>
	<title><?php echo $title ?> - Lista utilizatorilor</title>
	
	<!--<script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script language="javascript" type="text/javascript" src="http://cdn.datatables.net/1.10.4/js/jquery.dataTables.min.js"></script>
	<link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.4/css/jquery.dataTables.css" />  -->
	
	<!--<link rel="stylesheet" type="text/css" href="style.css" />-->
	<!--<script language="javascript" type="text/javascript">
		$(document).ready(function() {
			$('#example').DataTable();
		} );
		//$(document).ready(function() {
		//	$('#example').dataTable( {
		//		"order": [[ 3, "desc" ]]
		//	} );
		//} );
	</script> -->
	<script language="javascript" type="text/javascript" src="http://code.jquery.com/jquery-1.11.1.min.js"></script>
	<script language="javascript" type="text/javascript">
	/////////////////////////////////////////////
	$(document).ready(function() {
		$("th").click(function(event) {
			var id_es = event.target.id;
			alert("id element sortare: "+id_es);
			ajaxFunction(id_es);
			
		});
	});
	////////////////////////////////////////////
	//$(document).ready(function() {
    //  $("th").click(function() {
    //    alert("Hello world!");
    //  });
	//});
		//$(document).ready(function() {
		//	$("th").click(function(event) {
		//		alert("id element: "+event.target.id);
		//	});
		//});
	
	<!--
	function sayHello() {
		alert("Hello World");
	}
	
	<!-- 
	//Browser Support Code
	function ajaxFunction(id_elemsort){
	//alert("intru in ajaxFunction");
	var ajaxRequest;
	//var id_elemsort;
 // The variable that makes Ajax possible!
	/////////////////////////////////////////////
	//$(document).ready(function() {
	//	$("th").click(function(event) {
	//		var id_elemsort = event.target.id;
			//alert("id element sortare: "+id_elemsort);
	//	});
	//});
	////////////////////////////////////////////
	
	try{
		// Opera 8.0+, Firefox, Safari
		ajaxRequest = new XMLHttpRequest();
	}catch (e){
		// Internet Explorer Browsers
		try{
			ajaxRequest = new ActiveXObject("Msxml2.XMLHTTP");
		}catch (e) {
			try{
				ajaxRequest = new ActiveXObject("Microsoft.XMLHTTP");
			}catch (e){
				// Something went wrong
				alert("Your browser broke!");
				return false;
			}
		}
	}
	
	//var id = ele.id;
	//alert("id= "+id);
	// Create a function that will receive data 
	// sent from the server and will update
	// div section in the same page.
	ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
      var ajaxDisplay = document.getElementById('ajaxDiv');
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
	}
	}
	// Now get the value from user and pass it to
	// server script.
	//var id_elemsort='username';
	var param_sort = document.getElementById(id_elemsort).value;
	var queryString = "?nume_get=" + param_sort ;
	alert("junior/ajax_example" + queryString);
	ajaxRequest.open("GET", "junior/ajax_example" + 
                              queryString, true);
	ajaxRequest.send(null); 
	//alert("ies din ajaxFunction");
	
 //-->
 }
 	</script>
</head>
<body> 
	<center>
		<h1>Lista utilizatorilor</h1>
		

		
		
		
