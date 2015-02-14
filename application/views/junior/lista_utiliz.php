<!--<table border='1' id="example" class="display" cellspacing="0" width="100%"> -->
<div id='ajaxDiv'>
<table border='1' >
<tr>
	<th id="username" value="user.username" onclick="ajaxFunction('username','1')">username</th>
	<th id="tipuser" value="tipuser.dentipu" onclick="ajaxFunction('tipuser','2')">tip user</th>
	<th id="name" value="user.name" onclick="ajaxFunction('name','3')">name</th>
	<th id="email" value="user.email" onclick="ajaxFunction('email','4')">email</th>
	<th id="phone" value="user.phone" onclick="ajaxFunction('phone','5')">phone</th>
	<th id="dengrupv" value="grupv.dengrupv" onclick="ajaxFunction('dengrupv','6')">grupa varsta</th>
</tr>
<?php foreach ($users as $users_item): ?>
<?php echo "<tr title='".$users_item['description']."' onclick='overlay_b(\"$users_item[username]\",\"$users_item[dentipu]\",\"$users_item[name]\"
												,\"$users_item[email]\",\"$users_item[phone]\",\"$users_item[dengrupv]\",\"$users_item[description]\"
												,\"$users_item[codtipu]\",\"$users_item[codgrupv]\")'>".
				"<td>".$users_item['username']."</td>
				 <td>".$users_item['dentipu']."</td>
				 <td>".$users_item['name']."</td>
				 <td>".$users_item['email']."</td>
				 <td>".$users_item['phone']."</td>
				 <td>".$users_item['dengrupv']."<td>"
	?>
</tr>
<?php endforeach ?>
</table>
</div>
<!--rand filtrare-->
<table border='1' >
  <tr style="background-color:lightgray"><th>username</th><th>tip user</th><th>name</th><th>email</th><th>phone</th><th>grupa varsta</th><th>~</th></tr>
  <tr id="filtrare" style="background-color:blue" >
  <form name="formfilt">
    <td><input type="text" name="username_filt" id="f_username"  size="20" /></td>
	
	<td><select name="dentipu_sel" id="f_dentipu" >
      <option value=0></option>
		<?php foreach ($tipuser as $tipuser_item): ?>
				<option value=<?php echo $tipuser_item['codtipu']; ?>><?php echo $tipuser_item['dentipu']; ?></option>
		<?php endforeach; ?>
    </select></td>
	
    <td><input type="text" name="name_filt" id="f_name" /></td>
    <td><input type="text" name="email_filt" id="f_email" /></td>
    <td><input type="text" name="phone_filt" id="f_phone" size="10" /></td>
	
    <td><select name="dengrupv_sel" id="f_dengrupv">
      <option value=0></option>
		<?php foreach ($categorii as $categorii_item): ?>
				<option value=<?php echo $categorii_item['codgrupv'];?>><?php echo $categorii_item['dengrupv']; ?></option>
		<?php endforeach; ?>
    </select></td>
	
    <td> <input id="driver_filtrare" type="Button"  name="Filtru" value="Filtrare" /> </td>
  </form>
  </tr>
</table>
<!--rand filtrare-->

<p>
	<input type="button" value="Adaugare" onclick='overlay_a()'/>
	<!--<input type="button" value="Grupe varsta" onclick='overlay_gr()'/>-->
</p>

<form name="form_listaut">
<div id="overlay">
	<div>
		<p id="idp">Content you want the user to see goes here.</p><br />
		<input  id="cda_am" type="hidden" name="cda_am" value="" />
		<label for="username">Username</label>
		<input  id="username" type="text" name="username" size="20" /><br />
		<label for="password">Password</label>
		<input  id="password" type="password" name="password" size="32" onchange="validPassword1()" /><br />
		<label for="name">Name</label>
		<input  id="name" type="text" name="name" size="30" /><br />
		<label for="email">E-mail</label>
		<input  id="email" type="email" name="email" size="40"  onchange="validateEmailAddress()" /><br />
		<!--  ^[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}$.  /^([A-Za-z0-9_-.])+@([A-Za-z0-9_-.])+.([A-Za-z]{2,4})$/; pattern="\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b"   nu merge cu type="email" si pattern nu avem submit-->
		<label for="phone">Phone</label>
		<input   id="phone" type="text" name="phone" size="10"  onchange="validatePhoneNumber()" /><br />
		<!-- $pattern = '~^\(?([2-9][0-9]{2})\)?[-. ]?([2-9](?!11)[0-9]{2})[-. ]?([0-9]{4})$~';   -->
		<label for="description">Description</label>
		<input  id="description" type="text" name="description" size="50" /><br />
		
		<label for="codtipu">Tip user</label>
		<select  id="codtipu" name="codtipu">
			<option value=0></option>
			<?php foreach ($tipuser as $tipuser_item): ?>
				<option value=<?php echo $tipuser_item['codtipu']; ?>><?php echo $tipuser_item['dentipu']; ?></option>
			<?php endforeach; ?>
		</select><br/ >
		
		<label for="codgrupv">Grupa de varsta</label>
		<select  id="codgrupv" name="codgrupv">
			<option value=0></option>
            <?php foreach ($categorii as $categorii_item): ?>
				<option value=<?php echo $categorii_item['codgrupv'];?>><?php echo $categorii_item['dengrupv']; ?></option>
            <?php endforeach; ?>
		</select><br/ ><br/ >
		
		<input id="driver" type="button" value="Save" />
		<input type="button" value="Editare categorie" onclick='overlay_gr()' /><br/ ><br/ >
		 Click here to [<a id="driver_close" href='#' onclick='overlay()'>close</a>]
	</div>
	<div id="stage" style="background-color:yellow">
         feedback vizual
    </div>
</div>
</form>

<!-- grupe varsta -->
<form name="form_grupev">
<div id="overlay_grupev">
	<div ><center>
		<p>Grupe varsta</p>
		<p id='ajaxDiv_gr'>
		<table border='1' >
			<tr><th>selecteaza</th><th>grupe varsta</th></tr>
			<?php foreach ($categorii as $categorii_item): ?>
				<tr>
					<td><input type="radio" name="nume" value=<?php echo $categorii_item['codgrupv'];?> 
						onclick="set_cheie(<?php echo $categorii_item['codgrupv'];?>)"></td>
					<td><?php echo $categorii_item['dengrupv']; ?></td>
				</tr>
			<?php endforeach ?>
		</table>
		</p><br/ ><br/ >
	<input type="button" value="Adaugare" onclick='overlay_egra()'/>
	<!--<input type="button" value="Modificare" onclick='overlay_egrm()' />-->
	<input id="driver_sterg_gr" type="button" value="Stergere" /><br/ ><br/ >
	 Click here to [<a id="driver_close_grv" href='#' onclick='overlay_gr()'>close</a>]
	 <p id="stage_grupe" style="background-color:yellow">
         feedback vizual stergere grupe varsta
    </p> 
	<center></div>
</div>
</form>

<!--editare grupe varsta -->
<form name="form_editgr">
<div id="overlay_editgr">
	<div>
	<!--<input  id="cda_am" type="hidden" name="cda_am" value="" />-->
		<p id="id_pegr">Content you want the user to see goes here.</p><br />
		
		<label for="dengrupv">Grupa varsta</label>
		<input type="text" name="dengrupv" size="40" /><br /><br/ >
		
		<input id="driver_egr" type="button" value="Save" /><br /><br />
		Click here to [<a id="driver_close_egr" href='#' onclick='overlay_egr()'>close</a>]
		
		<p id="stage_egr" style="background-color:yellow">
         feedback vizual editare grupe varsta
		</p>
	</div>
</div>
</form>

