<?php
/** 
 * index.php
 * Description	: Lists all the scripts available
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Jul 1, 2011
 */
$this->load->view('dashboard/structure/_header', $title);
$this->load->view('dashboard/structure/_leftmenu', $heading);
?>
<?if(isset($error)):?>
	<div class="msgError">
		<?php echo $error;?>
	</div>
<?endif ?>

<?if(isset($states)):?>
	<h2>
<?php 
	foreach ($states as $state){
		echo "<a href=\"$destination$state\">$state</a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";		
	} 
?>
	</h2>
<? else: ?>
	<?= "Total ".$model." : ".$count_tot ?> <br/>
	<?= $model." without geocoding found : ".$count_all ?> <br/>
	<?= $model." new geocoded : ".$count_upd ?> <br/>
	<?= $model." still without geocoding : ".$count_miss ?> <br/>
<?endif ?>

<?php
$this->load->view('dashboard/structure/_footer');
