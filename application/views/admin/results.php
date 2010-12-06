<?php
/** 
 * results.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 18, 2010
 */
?>
<h1>Results:</h1>

<?if($this->session->flashdata('flashError')):?>
	<div class="flashError">
		Error: <?=$this->session->flashdata('flashError')?>
	</div>
<?endif?>

<?if($this->session->flashdata('flashConfirm')):?>
	<div class="flashConfirm">
		Suceess: <?=$this->session->flashdata('flashConfirm')?>
	</div>
<?endif?>