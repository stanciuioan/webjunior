
<html>
<head>
<title>Login Email</title>
</head>

<body>

<?php echo validation_errors(); ?>

<?php $attributes = array('name' => 'formemail'); ?>
<?php echo form_open('junior/reset_password', $attributes); ?>

<h4>Email Address: </h4>
<input type="email" name="email" size="32" />

<p>
	<input type="submit" name="submit" value="Get New Password"/>
	<input type="reset" name="Reset" value="Reset" />
</p>

</form>

</body>
</html>