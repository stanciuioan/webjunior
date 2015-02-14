<html>

	<head>
		<title>Introducere/Editare utilizatori</title>
	</head>

		<body>
			<h2>Introducere editare useri</h2>

<?php echo validation_errors(); ?>
<?php echo form_open('junior/interfata_in_ed'); ?>

	<label for="username">Username</label>
	<input type="input" name="username" /><br />
	
	<label for="codtipu">Tip utilizator</label>
	<input type="input" name="codtipu" /><br />
	
	<label for="password">Password</label>
	<input type="password" name="password" /><br />
	
	<label for="name">Name</label>
	<input type="input" name="name" /><br />
	
	<label for="email">E-mail</label>
	<input type="input" name="email" /><br />
	
	<label for="phone">Phone</label>
	<input type="input" name="phone" /><br />
	
	<label for="description">Description</label>
	<input type="input" name="title" /><br />
	
	<label for="codgrupv">Cod grupa varsta</label>
	<input type="input" name="codgrupv" /><br />
	
<div>
	<input type="button" value="Adaugare"/>
	<input type="submit" value="Inregistrare"/>
	<input type="button" value="Categorii varsta">
</div>


</form>

		</body>
</html>
