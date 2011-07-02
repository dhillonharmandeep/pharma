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
	<?if(isset($scripts) && is_array($scripts) && count($scripts)>0):?>
		<p>The following scripts are available:</p>
		<ul>
		<?foreach($scripts as $script => $sname):?>
			<li><a href="<?php echo base_url().'scripts/'.$script;?>"><?=$sname?></a></li>
		<?endforeach?>
		</ul>
	<?else:?>
			<p class="msgError">No scripts available</p>
	<?endif?>
<?php
$this->load->view('dashboard/structure/_footer');
