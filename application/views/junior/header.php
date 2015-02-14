
<html>
<head>
	<title><?php echo $title ?> - Lista utilizatorilor</title>
	
	<style type="text/css" media="all">
		p{
			color: #36C;
		}
		<!-- adaug/modific users -->
		#overlay {
			visibility: hidden;
			position: absolute;
			left: 0px;
			top: 0px;
			width:100%;
			height:100%;
			text-align:center;
			z-index: 1000;
			background-image:url("/ci_junior/img/transpBlue25.png");
			
		}
		#overlay div {
			width:500px;
			margin: 100px auto;
			background-color: #fff;
			border:1px solid #000;
			padding:15px;
			text-align:left;
		}
		<!-- grupe varsta -->
		#overlay_grupev {
			visibility: hidden;
			position: absolute;
			left: 0px;
			top: 0px;
			width:100%;
			height:100%;
			text-align:center;
			z-index: 2000;
			background-image:url("/ci_junior/img/transpBlue25.png");
			
		}
		#overlay_grupev div {
			width:500px;
			margin: 100px auto;
			background-color: #fff;
			border:1px solid #000;
			padding:15px;
			text-align:left;
		}
		<!-- editare grupe varsta -->
		#overlay_editgr {
			visibility: hidden;
			position: absolute;
			left: 0px;
			top: 0px;
			width:100%;
			height:100%;
			text-align:center;
			z-index: 3000;
			background-image:url("/ci_junior/img/transpBlue25.png");
			
		}
		#overlay_editgr div {
			width:500px;
			margin: 100px auto;
			background-color: #fff;
			border:1px solid #000;
			padding:15px;
			text-align:left;
		}
		
	</style>
	
	<!--<meta charset="utf-8">-->
	<!--<link rel="stylesheet" type="text/css" href="css/stil.css" />-->
	<!--<link rel="stylesheet" href="//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css">
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>-->
	
	<!--<script>
		$( tr ).tooltip();
	</script>-->
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.3.2.min.js"></script>
	<script language="javascript" type="text/javascript">
	
	window.onload = function() {
		oSort[0] = 0;
		ford(1);
		fhead();
	};
	
	//ordine de sortare si marcare cap tabel
	var oSort=[0,0,0,0,0,0];
	var thead_m = ['','','','','',''];
	//filtru
	var vFilt="-";
	//id stergere codgrupv
	var v_codgrupv=0;
	
	//apelat de butonul Save form_listaut
	$(document).ready(function() {
      $("#driver").click(function(event){
		var valid = validform();
		//alert('dupa valid');
		if (!valid) {
			//alert('Forma nu este complectata corect');
			return;
		}
		var username=document.form_listaut.username.value
		var password=document.form_listaut.password.value
		var name=document.form_listaut.name.value
		var email=document.form_listaut.email.value	
		var phone=document.form_listaut.phone.value
		var description=document.form_listaut.description.value
		var codtipu=document.form_listaut.codtipu.value
		var codgrupv=document.form_listaut.codgrupv.value
		var cda_am=document.form_listaut.cda_am.value	
		 $("#stage").load('junior/load_feedback', {"username":username, "password":password, "name":name, "email":email, "phone":phone,
													"description":description, "codtipu":codtipu, "codgrupv":codgrupv, "cda_am":cda_am });
      });
   });
   //apelat de butonul close form_listaut
   $(document).ready(function() {
      $("#driver_close").click(function(event){
		  stergfilt();
		  vFilt=vFilt="-" ;
		  $("#ajaxDiv").load('junior/refresh_lista'+'/'+escape(vFilt));
		  oSort[0] = 0;
		  ford(1);
		  setTimeout(function(){ fhead() ;},500);
     });
   });
   //apelat de butonul filtrare
   $(document).ready(function() {
      $("#driver_filtrare").click(function(event){
		  filt();
		  $("#ajaxDiv").load('junior/refresh_lista'+'/'+escape(vFilt));
		  oSort[0] = 0;
		  ford(1);
		  setTimeout(function(){ fhead() ;},500);
     });
   });
   
  //declansat de butonul save form_editgr
  $(document).ready(function() {
      $("#driver_egr").click(function(event){
		var dengrupv=document.form_editgr.dengrupv.value;
		if (dengrupv == ""){
			alert('Complectati campul Grupa varsta');
			document.form_editgr.dengrupv.focus();
			return ;
			}
		 $("#stage_egr").load('junior/load_feedback_egr', {"dengrupv":dengrupv });
      });
   });
   //declansat de butonul close form_editgr
   $(document).ready(function() {
      $("#driver_close_egr").click(function(event){
		  //stergfilt();
		  //vFilt=vFilt="-" ;
		  $("#ajaxDiv_gr").load('junior/refresh_grupev');
		  document.getElementById("stage_grupe").innerHTML = "feedback vizual stergere grupe varsta";
		  //oSort[0] = 0;
		 // ford(1);
		  //setTimeout(function(){ fhead() ;},500);
     });
   });
    //declansat de butonul close form_grupev
   $(document).ready(function() {
      $("#driver_close_grv").click(function(event){
		  //stergfilt();
		  //vFilt=vFilt="-" ;
		  $("#codgrupv").load('junior/refresh_grupev_popup');
		  //oSort[0] = 0;
		 // ford(1);
		  //setTimeout(function(){ fhead() ;},500);
     });
   });
    //declansat de butonul Stegere form_grupev
   $(document).ready(function() {
      $("#driver_sterg_gr").click(function(event){
		  //stergfilt();
		  //vFilt=vFilt="-" ;
		  //$("#codgrupv").load('junior/refresh_grupev_popup');
		  $("#stage_grupe").load('junior/load_sterg_grv', {"codgrupv":v_codgrupv});
		  //oSort[0] = 0;
		 // ford(1);
		  //setTimeout(function(){ fhead() ;},500);
     });
   });
   
//setez cheie de stergere in tabela grupv
function set_cheie(cheie){
	v_codgrupv = cheie
	//alert ("codgrupv: "+v_codgrupv);
}


//marchez ordinea de sortare si marcare in thead
function ford(nrcol){
var thead=['username','tip user','name','email','phone','grupe varsta'];
var ordsort;
for (nrc = 1; nrc <= 6; nrc++){
	if (nrc == nrcol){
		if (oSort[nrc-1] == 0 || oSort[nrc-1] == 2){
			ordsort = 'ASC';
			oSort[nrc-1] = 1;
			thead_m[nrc-1] = thead[nrc-1]+' '+'&#8593';
		}
		else{
			ordsort = 'DESC';
			oSort[nrc-1] = 2;
			thead_m[nrc-1] = thead[nrc-1]+' '+'&#8595';
		}
	}
	else{
		oSort[nrc-1] = 0;
		thead_m[nrc-1] = thead[nrc-1];
	}
}
return ordsort;
}
//marcheaza ordinea de sortare in thead dupa o sortare
function fhead(){
	var thead_id=['username','tipuser','name','email','phone','dengrupv'];
	for(nrc = 1; nrc <=6 ; nrc++) {
		document.getElementById(thead_id[nrc-1]).innerHTML  = thead_m[nrc-1];
	}
}

//construiesc filtru
	function filt() {
		vFilt="";
		if (document.formfilt.username_filt.value!=""){
			vFilt=vFilt+" AND user.username LIKE '%"+document.formfilt.username_filt.value+"%'";
			}	
		if (document.formfilt.name_filt.value!=""){
			vFilt=vFilt+" AND user.name LIKE '%"+document.formfilt.name_filt.value+"%'";
			}
		if (document.formfilt.email_filt.value!=""){
			vFilt=vFilt+" AND user.email LIKE '%"+document.formfilt.email_filt.value+"%'";
			}
		if (document.formfilt.phone_filt.value!=""){
			vFilt=vFilt+" AND user.phone LIKE '%"+document.formfilt.phone_filt.value+"%'";
			}
		if (document.formfilt.dentipu_sel.value > 0){
			vFilt=vFilt+" AND user.codtipu= "+document.formfilt.dentipu_sel.value;
			}	
		if (document.formfilt.dengrupv_sel.value > 0){
			vFilt=vFilt+" AND user.codgrupv= "+formfilt.dengrupv_sel.value;
			}
		if (vFilt.length ==0){vFilt="-" ;}
		//alert("vFilt= "+vFilt) ;
	}

	function stergfilt() {
	//sterge filtruarea dupa o operatie de editare (adaugare/modificare)user
	document.formfilt.username_filt.value="";
	document.formfilt.name_filt.value="";
	document.formfilt.email_filt.value="";
	document.formfilt.phone_filt.value="";
	document.formfilt.dentipu_sel.value=0;
	document.formfilt.dengrupv_sel.value=0;
	filt()
	}
	
	function overlay_a()  {
		document.form_listaut.cda_am.value="A";
		document.getElementById("idp").innerHTML = "Adaugare";
		document.getElementById("stage").innerHTML = "feedback vizual";
		document.form_listaut.username.disabled=false;
		document.form_listaut.password.disabled=false;
		// setez forma modala pentru adaugare
		
		document.form_listaut.username.value='';
		document.form_listaut.password.value='';
		document.form_listaut.name.value='';
		document.form_listaut.email.value='';
		document.form_listaut.phone.value='';
		document.form_listaut.description.value='';		
		document.form_listaut.codtipu.value=0;
		document.form_listaut.codgrupv.value=0;
		
		overlay();
	}
	function overlay_b(username,dentipu,name,email,phone,dengrupv,description,codtipu,codgrupv)  {
		//alert("username: " + username + " dentipu: " + dentipu + " name: " + name+" email: "+email+" phone: "+phone+" dengrupv: "+dengrupv 
		//      + " description: "+description+ " codtipu: "+codtipu+" codgrupv: "+codgrupv);
		document.form_listaut.cda_am.value="M";
		document.getElementById("idp").innerHTML = "Modificare";
		document.getElementById("stage").innerHTML = "feedback vizual";
		document.form_listaut.username.disabled=true;
		document.form_listaut.password.disabled=true;
		
		//setez valoarea campurilor in fer.modala (din lista atilizatori)
		//document.form_listaut.username.value=username;
		document.form_listaut.username.value=username;
		document.form_listaut.name.value=name;
		document.form_listaut.email.value=email;
		document.form_listaut.phone.value=phone;
		document.form_listaut.description.value=description;
		document.form_listaut.codtipu.value=codtipu;
		document.form_listaut.codgrupv.value=codgrupv;
		
		overlay();
		
	}
	
	function overlay() {
	el = document.getElementById("overlay");
	el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
	}
	
	function overlay_gr() {
		document.getElementById("stage_grupe").innerHTML = "feedback vizual stergere grupe varsta";
		el = document.getElementById("overlay_grupev");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
	}
	function overlay_egra(){
		//  '' in dengrupv
		//document.form_editgr.cda_am.value="A";
		document.getElementById("id_pegr").innerHTML = "Adaugare grupa varsta";
		document.getElementById("stage_egr").innerHTML = "feedback vizual editare grupe varsta";
		document.form_editgr.dengrupv.value="";
		//alert('cda_am=A, id_pegr,stage_egr');
		overlay_egr();
	}
	//function overlay_egrm(codgrupv,dengrupv){
	//	//  '' in dengrupv
	//	document.form_editgr.cda_am.value="M";
	//	document.getElementById("id_pegr").innerHTML = "Modificare grupa varsta";
	//	document.getElementById("stage_egr").innerHTML = "feedback vizual editare grupe varsta";
	//	document.form_listaut.dengrupv.value=dendrupv;
	//	alert('cda_am=M, id_pegr,stage_egr, parametri');
	//	overlay_egr();
	//}
	function overlay_egr(){
		el = document.getElementById("overlay_editgr");
		el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
	}
	
	<!-- 
	//Browser Support Code
	function ajaxFunction(id_elemsort,nrcol){
		//alert('nrcol='+nrcol );
	var ordsort;
	ordsort = ford(nrcol);
	/////if (oSort[nrcol]==0 || oSort[nrcol]==2)
	/////	{ordsort='ASC'; oSort[nrcol]=1;}
	/////else
	/////	{ordsort='DESC'; oSort[nrcol]=2;}
	//alert("intru in ajaxFunction");
	//alert("id element sortare: "+id_elemsort);
	var ajaxRequest;
	//var id_elemsort;
 // The variable that makes Ajax possible!
	
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
	
	// Create a function that will receive data 
	// sent from the server and will update
	// div section in the same page.
	ajaxRequest.onreadystatechange = function(){
	if(ajaxRequest.readyState == 4){
      var ajaxDisplay = document.getElementById('ajaxDiv');
      ajaxDisplay.innerHTML = ajaxRequest.responseText;
	  //alert("aici se face marcaj in cap tabel");
	  fhead();
	}
	}
	// Now get the value from user and pass it to
	// server script.
	//var id_elemsort='username';
	var param_sort = document.getElementById(id_elemsort).value;
	var queryString = "?nume_get=" + param_sort ;
	queryString +=  "&ordsort=" + ordsort ;
	//constriesc filtru
	filt();
	queryString +=  "&filt=" + escape(vFilt) ;
	
	//alert("junior/ajax_example" + queryString);
	ajaxRequest.open("GET", "junior/ajax_example" + 
                              queryString, true);
	ajaxRequest.send(null); 
	//alert("ies din ajaxFunction");
	
 //-->
 }
 // cream functia de validare adresa email
function validateEmailAddress() {
	var patt = /\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i ;
	//  [a-zA-Z0-9_.-]+@[a-zA-Z0-9_.-]+\.[a-zA-Z]{2,4}+
	var address = document.form_listaut.email.value ;
	if(patt.test(address) == false) {
		alert('Invalid Email Address');
		document.form_listaut.email.value="";
		document.form_listaut.email.focus();
		return false;
	}
}
//validate nr telefon NPA
function validatePhoneNumber(){
	//alert('validate phone number');
	var patt = /^\(?([2-9][0-9]{2})\)?[-. ]?([2-9](?!11)[0-9]{2})[-. ]?([0-9]{4})$/;
	var phonenumber = document.form_listaut.phone.value ;
	if(patt.test(phonenumber) == false) {
		alert('Invalid Phone Number');
		document.form_listaut.phone.value="";
		document.form_listaut.phone.focus();
		return false;
	}
}
//validare parola cu regex
function validPassword(){
	alert('validare password');
	var password=document.form_listaut.password.value;
	var patt = /[A-Z]+.+([0-9]|[!@#$%^&*()-=_+,.<>?:'"])+/ 
	alert("password: "+password);
	if(patt.test(password) == false){
		alert('Invalid Password');
		document.form_listaut.password.focus();
		return false;
	}
}
//validare parola 
function validPassword1(){
	//alert('validare password1');
	var password=document.form_listaut.password.value;
	//alert("password: "+password);
	var patt = /[A-Z]/ ;
	if(patt.test(password) == false){
		alert('Invalid Password. Parola nu contine litere mari');
		document.form_listaut.password.value="";
		document.form_listaut.password.focus();
		return;
	}
	else{
		//alert('are litere mari; verific cifre');
		var patt = /[0-9]/ ;
		if(patt.test(password) == false){
			//alert('nu are cifre; merg sa verific simbol');
			var patt = /[!@#$%^&*()_+-={}"<>?,.\/~`'|]/ ;
			if(patt.test(password) == false){
				alert('Invalid Password. Parola nu contine cifra sau simbol');
				document.form_listaut.password.value="";
				document.form_listaut.password.focus();
				return ;
			}	
		}
	}
}
//validare forma form_listaut la save
function validform(){
	//alert('validform');
	var cda_am=document.form_listaut.cda_am.value
	if (cda_am == "A"){
		var username=document.form_listaut.username.value;
			if (username == ""){
				alert('Complectati campul Username');
				document.form_listaut.username.focus();
				return false;
				}
		var password=document.form_listaut.password.value;
			if (password == ""){
				alert('Complectati campul Passord');
				document.form_listaut.password.focus();
				return false;
				}
	}			
	var name=document.form_listaut.name.value;
		if (name == ""){
			alert('Complectati campul Name');
			document.form_listaut.name.focus();
			return false;
		}
	var email=document.form_listaut.email.value	;
		if (email == ""){
			alert('Complectati campul E-mail');
			document.form_listaut.email.focus();
			return false;
		}
	var phone=document.form_listaut.phone.value;
		if (phone == ""){
			alert('Complectati campul Phone');
			document.form_listaut.phone.focus();
			return false;
		}
	var description=document.form_listaut.description.value;
		if (description == ""){
			alert('Complectati campul Description');
			document.form_listaut.description.focus();
			return false;
		}
	var codtipu=document.form_listaut.codtipu.value;
		if (codtipu < 1){
			alert('Complectati campul Tip user');
			document.form_listaut.codtipu.focus();
			return false;
		}
	var codgrupv=document.form_listaut.codgrupv.value;
		if (codgrupv < 1){
			alert('Complectati campul Grupe de varsta');
			document.form_listaut.codgrupv.focus();
			return false;
		}
	//alert('return true');
	return true;
}
 
 	</script>
</head>
<body> 
	<center>
		<h1>Lista utilizatorilor</h1>