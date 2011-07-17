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
	<span class="add"><a href="<?= base_url()?>mtype/add">	Add a new medicine type</a></span>
<?php 
  $this->load->view('dashboard/ajax/search', array('search_module' => 'medicine_type'));
?>
	</p>
			
	<table class="t_results">
		<caption>All Medicine types: Lists all medicine types (10 per page) <strong>[Total Records : <?php echo $tot_count?>]</strong></caption>
		<tr>
	        <th>Name</th>
			<th colspan="2">Actions</th>
		</tr>
	<?if(isset($mtypes) && is_array($mtypes) && count($mtypes)>0):?>
	  <?php $count = 1;?>
		<?foreach($mtypes as $mtype):?>
		<?php
		   if ($count%2 == 0) echo "<tr class=\"even\">";
		   else echo "<tr class=\"odd\">"; 
		   $count++;
		?>
				
			<td><a href="<?php echo base_url().'mtype/edit/'.$mtype->id;?>"><?=$mtype->name?></a></td>
	        <td><?=anchor(base_url().'mtype/edit/'.$mtype->id, '<img src="'.base_url().'common/admin/images/icons/edit.png" alt="Edit" width="18" height="18" />')?></td>
			<td><?=anchor(base_url().'mtype/delete/'.$mtype->id, '<img src="'.base_url().'common/admin/images/icons/remove.png" alt="Remove" width="18" height="18" />', array('onclick' => "return confirm('Are you sure you wish to delete?');"))?></td>
		</tr>
		<?endforeach?>
	<?else:?>
		<tr>
			<td colspan="7">No medicine types in the database</td>
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
