<?php
/** 
 * index.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 22, 2010
 */
$this->load->view('dashboard/structure/_header', $title);
$this->load->view('dashboard/structure/_leftmenu', $heading);
?>
  <p>
	<span class="add"><a href="<?= base_url()?>salt/add">	Add a new salt</a></span>
<?php 
  $this->load->view('dashboard/ajax/search', array('search_module' => 'salt'));
?>
	</p>		
	<table class="t_results">
		<caption>All Salts: Lists all salts (10 per page) <strong>[Total Records : <?php echo $tot_count?>]</strong></caption>
		<tr>
	        <th>Name</th>
			<th colspan="2">Actions</th>
		</tr>
	<?if(isset($salts) && is_array($salts) && count($salts)>0):?>
	  <?php $count = 1;?>
		<?foreach($salts as $salt):?>
		<?php
		   if ($count%2 == 0) echo "<tr class=\"even\">";
		   else echo "<tr class=\"odd\">"; 
		   $count++;
		?>
				
			<td><a href="<?php echo base_url().'salt/edit/'.$salt->id;?>"><?=$salt->name?></a></td>
	        <td><?=anchor(base_url().'salt/edit/'.$salt->id, '<img src="'.base_url().'common/admin/images/icons/edit.png" alt="Edit" width="18" height="18" />')?></td>
			<td><?=anchor(base_url().'salt/delete/'.$salt->id, '<img src="'.base_url().'common/admin/images/icons/remove.png" alt="Remove" width="18" height="18" />', array('onclick' => "return confirm('Are you sure you wish to delete?');"))?></td>
		</tr>
		<?endforeach?>
	<?else:?>
		<tr>
			<td colspan="7">No salts in the database</td>
		</tr>
	<?endif?>
	</table>
					
	<?if(isset($pagination)):?>
		<div class="pagination">
			<?=$pagination?>
		</div>
	<?endif?>
<?php
$this->load->view('dashboard/structure/_footer');
