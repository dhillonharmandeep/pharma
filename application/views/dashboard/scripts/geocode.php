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

<?= "Total ".$model." : ".$count_tot ?> <br/>
<?= $model." without geocoding found : ".$count_all ?> <br/>
<?= $model." new geocoded : ".$count_upd ?> <br/>
<?= $model." still without geocoding : ".$count_miss ?> <br/>

<?php
$this->load->view('dashboard/structure/_footer');
