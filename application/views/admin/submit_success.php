<?php
/** 
 * submit_success.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 5, 2010
 */
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Register Success</title>
</head>
<body>
<h1>Registeration Successful</h1>
<div id="signup_form">
	<p>Welcome to pharmaseek.com.au <?php echo $username; ?>!!!</p>
	<p>You can now proceed to the <?php echo anchor('login','login'); ?></p>
</div>
</body>
</html>