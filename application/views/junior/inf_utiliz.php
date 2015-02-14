
<html>

<head>
	<title><?php echo $title ?> - Informatii user </title>
	<!--<link rel="stylesheet" type="text/css" href="ci_junior/css/inf_utiliz.css" />-->
	<style type="text/css" media="all">
		p{
			color: #36C;
		}
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
	</style>
	
	<script type="text/javascript" src="http://code.jquery.com/jquery-1.3.2.min.js"></script>

	<script language="javascript" type="text/javascript">
	//apelat de butonul Save
	$(document).ready(function() {
		$("#driver_u").click(function(event){
		var valid = validform_liut();
		if (!valid) {
			return;
		}
		var username=document.form_liut.username.value;
		var name=document.form_liut.name.value;
		var email=document.form_liut.email.value;	
		var phone=document.form_liut.phone.value;
		var description=document.form_liut.description.value;
		var codgrupv=document.form_liut.codgrupv.value;	
		$("#stage_u").load('junior/update_feedback', {"username":username, "name":name, "email":email, "phone":phone,
													"description":description, "codgrupv":codgrupv });
      });
	});
	//apelat la Close
	$(document).ready(function() {
      $("#driver_uc").click(function(event){
		  var username=document.form_liut.username.value;
          $("#ajaxDiv_u").load('junior/refresh_infu',{"username":username });
      });
	});
   
		function overlay_m(username,dentipu,name,email,phone,dengrupv,description,codtipu,codgrupv) {
			
			document.getElementById("idpar").innerHTML = "Editare user";
			document.getElementById("stage_u").innerHTML = "feedback vizual";
			
			document.form_liut.username.value=username;
			document.form_liut.name.value=name;
			document.form_liut.email.value=email;
			document.form_liut.phone.value=phone;
			document.form_liut.description.value=description;
			document.form_liut.codtipu.value=codtipu;
			document.form_liut.codgrupv.value=codgrupv;
			
			document.form_liut.username.disabled=true;
			document.form_liut.password.disabled=true;
			document.form_liut.codtipu.disabled=true;
			
			overlay();
			
		}
		
		function overlay() {
			el = document.getElementById("overlay");
			el.style.visibility = (el.style.visibility == "visible") ? "hidden" : "visible";
		}
		
function validateEmailAddress() {
	var patt = /\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b/i ;
	//  [a-zA-Z0-9_.-]+@[a-zA-Z0-9_.-]+\.[a-zA-Z]{2,4}+
	var address = document.form_liut.email.value ;
	if(patt.test(address) == false) {
		alert('Invalid Email Address');
		document.form_liut.email.value="";
		document.form_liut.email.focus();
		return false;
	}
}
function validatePhoneNumber(){
	//alert('validate phone number');
	var patt = /^\(?([2-9][0-9]{2})\)?[-. ]?([2-9](?!11)[0-9]{2})[-. ]?([0-9]{4})$/;
	var phonenumber = document.form_liut.phone.value ;
	if(patt.test(phonenumber) == false) {
		alert('Invalid Phone Number');
		document.form_liut.phone.value="";
		document.form_liut.phone.focus();
		return false;
	}
}

//validare forma form_liut la save
function validform_liut(){
	//alert('validform');
				
	var name=document.form_liut.name.value;
		if (name == ""){
			alert('Complectati campul Name');
			document.form_liut.name.focus();
			return false;
		}
	var email=document.form_liut.email.value	;
		if (email == ""){
			alert('Complectati campul E-mail');
			document.form_liut.email.focus();
			return false;
		}
	var phone=document.form_liut.phone.value;
		if (phone == ""){
			alert('Complectati campul Phone');
			document.form_liut.phone.focus();
			return false;
		}
	var description=document.form_liut.description.value;
		if (description == ""){
			alert('Complectati campul Description');
			document.form_liut.description.focus();
			return false;
		}
	var codgrupv=document.form_liut.codgrupv.value;
		if (codgrupv < 1){
			alert('Complectati campul Grupe de varsta');
			document.form_liut.codgrupv.focus();
			return false;
		}
	//alert('return true');
	return true;
}

	</script>
</head>

<body> 
	<center>
		<h1>Informatii user</h1>
	<div id='ajaxDiv_u'>
		<table border='1' >
		<?php foreach ($user as $user_item): ?>
			<tr><th align="left">username</th><td><?php echo $user_item['username'];?></td></tr>
			<tr><th align="left">tipuser</th><td><?php echo $user_item['dentipu'];?></td></tr>
			<tr><th align="left">name</th><td><?php echo $user_item['name'];?></td></tr>
			<tr><th align="left">email</th><td><?php echo $user_item['email'];?></td></tr>
			<tr><th align="left">phone</th><td><?php echo $user_item['phone'];?></td></tr>
			<tr><th align="left">grupa varsta</th><td><?php echo $user_item['dengrupv'];?></td></tr>
			<tr><th align="left">description</th><td><?php echo $user_item['description'];?></td></tr>
		<?php endforeach ?>

		</table>
	<!--</div>-->
		<br/ ><br/ >
	
	<p>
		<input type="button" value="Editare" onclick = "overlay_m('<?php echo $user_item['username'];?>','<?php echo $user_item['dentipu'];?>',
		'<?php echo $user_item['name'];?>','<?php echo $user_item['email'];?>','<?php echo $user_item['phone'];?>','<?php echo $user_item['dengrupv'];?>',
		'<?php echo $user_item['description'];?>','<?php echo $user_item['codtipu'];?>','<?php echo $user_item['codgrupv'];?>')" />
	</p>
	</div>
	<!--modala-->
	<form name="form_liut">
<div id="overlay">
	<div>
		<p id="idpar">Content you want the user to see goes here.</p><br />
		
		<label for="username">Username</label>
		<input  id="username" type="text" name="username" size="20" /><br />
		<label for="password">Password</label>
		<input  id="password" type="password" name="password" size="32" /><br />
		<label for="name">Name</label>
		<input  id="name" type="text" name="name" size="30" /><br />
		<label for="email">E-mail</label>
		<input  id="email" type="email" name="email" size="40" onchange="validateEmailAddress()" /><br />
		<label for="phone">Phone</label>
		<input   id="phone" type="text" name="phone" size="10"  onchange="validatePhoneNumber()" /><br />
		<label for="description">Description</label>
		<input  id="description" type="text" name="description" size="50" /><br />

		<label for="codtipu">Tip user</label>
			<select  id="codtipu" name="codtipu">
				<?php foreach ($tipuser as $tipuser_item): ?>
					<option value=<?php echo $tipuser_item['codtipu']; ?>><?php echo $tipuser_item['dentipu']; ?></option>
				<?php endforeach; ?>
			</select><br />
		
		<label for="codgrupv">Grupa de varsta</label>
		<select  id="codgrupv" name="codgrupv">
            <?php foreach ($categorii as $categorii_item): ?>
				<option value=<?php echo $categorii_item['codgrupv'];?>><?php echo $categorii_item['dengrupv']; ?></option>
            <?php endforeach; ?>
		</select><br/ ><br/ >
		
		<input id="driver_u" type="button" value="Save" /><br/ ><br/ >
		 Click here to [<a id="driver_uc" href='#' onclick='overlay()'>close</a>]
	</div>
	<div id="stage_u" style="background-color:yellow;">
          feedback vizual
   </div>
</div>
</form>
	<!--modala-->
	</center>
</body>
</html>