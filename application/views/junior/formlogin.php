
<html>
<head>
	<title>Login Form</title>
</head>
<body>

<?php echo validation_errors(); ?>

<?php $attributes = array('name' => 'formlogin'); ?>
<?php echo form_open('junior', $attributes); ?>

<h4>Username</h4>
<!--<?php echo form_error('username'); ?> -->
<input type="text" name="username" value="<?php echo set_value('username'); ?>" size="20" />

<h4>Password</h4>
<!--<?php echo form_error('password'); ?> -->
<input type="password" name="password" value="<?php echo set_value('password'); ?>" size="32" />
<br/ >
<br/ >
<div>
	<input type="submit" value="Login" />
</div>

<br/ >
<br/ >

<a href="junior/reset_password">Reset password</a>

</form>

</body>
</html>