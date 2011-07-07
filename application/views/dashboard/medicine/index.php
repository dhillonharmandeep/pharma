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
  <p class="msgInfo">
    Click on the medicine name to view details. 
  </p>

	<span class="add"><a href="<?= base_url()?>medicine/add">	Add a new medicine</a></span>
<?php 
	$this->load->view('dashboard/ajax/search', array('search_module' => 'medicine'));
	$this->load->view('dashboard/ajax/filter', array('filter'=> $filter,'destination' => 'medicine'));
?>
			<table class="t_results">
			<caption>	
				All Medicines: Lists all medicine (10 per page) 
				<strong>[Total Records : <?php echo $tot_count?>]</strong>
			</caption>
			<tr>
        <th>Name</th>
        <th>Quantity</th>
        <th>Dosage</th>
				<th>Type</th>
        <th>Company</th>
        <th>Notes</th>
				<th colspan="3">Actions</th>
			</tr>
		<?if(isset($medicines) && is_array($medicines) && count($medicines)>0):?>
		  <?php $count = 1;?>
			<?foreach($medicines as $medicine):?>
			<?php
			   if ($count%2 == 0) echo "<tr class=\"even\">";
			   else echo "<tr class=\"odd\">"; 
			   $count++;
			?>
				
					<td><a href="<?php echo base_url().'medicine/edit/'.$medicine->id;?>"><?=$medicine->name?></a></td>
          <td><?=$medicine->quantity?></td>
          <td><?=$medicine->dosage?></td>
		  <td><?php if(isset($medicine->medicine_type)) echo $medicine->medicine_type; ?></td>
          <td><?=$medicine->company_name?></td>
          <td><?=strlen($medicine->notes)<25?$medicine->notes:substr($medicine->notes, 0, 25).'...'?></td>
          <td><?=anchor(base_url().'medicine/view/'.$medicine->id, '<img src="'.base_url().'common/admin/images/icons/view.png" alt="View" width="18" height="18" />')?></td>
          <td><?=anchor(base_url().'medicine/edit/'.$medicine->id, '<img src="'.base_url().'common/admin/images/icons/edit.png" alt="Edit" width="18" height="18" />')?></td>
		  <td><?=anchor(base_url().'medicine/delete/'.$medicine->id, '<img src="'.base_url().'common/admin/images/icons/remove.png" alt="Remove" width="18" height="18" />', array('onclick' => "return confirm('Are you sure you wish to delete the medicine?');"))?></td>
				</tr>
			<?endforeach?>
		<?else:?>
			<tr>
				<td colspan="7">No medicine in the database</td>
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
