<?php
/** 
 * login.php
 * Description	:
 * 
 * 
 * Created by	: harman
 * Created on 	: Sep 23, 2010
 */
 ?>
 	 <?= form_open(base_url().'main/login')?>
	<fieldset>
		<legend>Login form</legend>
		<ul>
			<li>
				<label>Email</label>
				<?=form_input('email', set_value('email'))?>
				<?=form_error('email')?>
			</li>
			<li>
				<label>Password</label>
				<?=form_input('password')?>
				<?=form_error('password')?>
			</li>
			<li>
				<?=form_submit('', 'login')?>
			</li>
		</ul>
	</fieldset>
	<?= form_close() ?>