<?php
/** 
 * signup_form.php
 * Description	: The Signup View
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 4, 2010
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="<?php echo base_url(); ?>common/css/style.css" type="text/css" media="all">
	<title>Signup Form</title>
</head>
<body>

<?php echo form_open(base_url().'signup', array('id' => 'signup_form')); ?>
<fieldset>
	<legend>New User Signup<span class="required">*</span> Required</legend>
	<ul>
		<li class="error">
			<?php echo validation_errors(); ?>
		</li>
		<li>
			<label for="username">Username: <span class="required">*</span></label>
			<?php echo form_input('username',set_value('username')); ?>
		</li>
		<li>
			<label for="firstname">First Name: <span class="required">*</span></label>
			<?php echo form_input('firstname',set_value('firstname')); ?>
		</li>
		<li>
			<label for="lastname">Last Name: <span class="required">*</span></label>
			<?php echo form_input('lastname',set_value('lastname')); ?>
		</li>
		<li>
			<label for="password">Password: <span class="required">*</span></label>
			<?php echo form_password('password'); ?>
		</li>
		<li>
			<label for="passconf">Confirm Password: <span class="required">*</span></label>
			<?php echo form_password('passconf'); ?>
		</li>
		<li>
			<label for="email">E-mail: <span class="required">*</span></label>
			<?php echo form_input('email',set_value('email')); ?>
		</li>
		<li>
			<?php echo form_submit('','Create my account'); ?>
		</li>
	</ul>
</fieldset>
<?php echo form_close(); ?>
<p>
	<?php echo anchor('login','Login Form'); ?>
</p>

</body>
</html>
