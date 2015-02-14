<html>

	<head>
		<title>Editare user</title>
	</head>

		<body>
			<h2>Editare user</h2>

<?php echo validation_errors(); ?>

<?php $attributes = array('name' => 'form_edituser'); ?>
<?php echo form_open('junior/edit_user', $attributes); ?>
		
		<!--<?php foreach ($user as $user_item): ?>-->


	<label for="username">Username</label>
	<input type="text" name="username" size="20" value="<?php echo $user_item['username'];?>" /><br />
	
	<!--<label for="codtipu">Tip utilizator</label>
	<input type="text" name="codtipu" /><br />-->
	
	<!--<label for="password">Password</label>
	<input type="password" name="password" /><br />-->
	<!--?php echo $user_item['name']."<br />" ;?>-->
	
	
	<label for="name">Name</label>
	<input type="text" name="name" size="30" value="<?php echo $user_item['name'];?>"  /><br />
	<!--<input type="input" name="name" size="30" value=""<?php echo set_value('name'); ?>""  /><br -->
	
	<label for="email">E-mail</label>
	<input type="email" name="email" size="40" value="<?php echo $user_item['email'];?>" /><br />
	
	<label for="phone">Phone</label>
	<input type="text" name="phone" size="10" /><br />
	
	<label for="description">Description</label>
	<input type="text" name="description" size="50" /><br />
	
	<!--<label for="codgrupv">Cod grupa varsta</label>
	<input type="input" name="codgrupv" /><br />-->
	
	<label for="codgrupv">Grupa de varsta</label>
		<select  id="codgrupv" name="codgrupv">
            <?php foreach ($categorii as $categorii_item): ?>
				<option value=<?php echo $categorii_item['codgrupv'];?>><?php echo $categorii_item['dengrupv']; ?></option>
            <?php endforeach; ?>
		</select><br /><br /><br />
		
		
			<!--<?php endforeach ?>-->
	
<div>
	<!--<input type="button" value="Adaugare"/>-->
	<input type="submit" value="Save"/>
	<!--<input type="button" value="Categorii varsta">-->
</div>


</form>

		</body>
</html>
