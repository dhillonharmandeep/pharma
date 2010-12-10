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
    Click on the chain name/address to view details for this chain. 
  </p>

	<p class="add"><a href="<?= base_url()?>whchain/add">	Add a warehouse chain</a></p>
					
			<table class="t_results">
			<caption>All Warehouses: Lists all warehouses (10 per page)</caption>
			<tr>
				<th>Chain Name</th>
				<th>Address</th>
				<th>Suburb</th>
				<th>Postcode</th>
				<th>State</th>
				<th colspan="2">Actions</th>
			</tr>
		<?if(isset($warehouses) && is_array($warehouses) && count($warehouses)>0):?>
		  <?php $count = 1;?>
			<?foreach($warehouses as $warehouse):?>
			<?php
			   if ($count%2 == 0) echo "<tr class=\"even\">";
			   else echo "<tr class=\"odd\">"; 
			   $count++;
			?>
				
					<td><a href="<?php echo base_url().'whchain/view/'.$warehouse->id;?>"><?=$warehouse->chain_name?></a></td>
					<td><a href="<?php echo base_url().'whchain/view/'.$warehouse->id;?>"><?=$warehouse->address?></a></td>
					<td><?=$warehouse->suburb?></td>
					<td><?=$warehouse->postcode?></td>
					<td><?=$warehouse->state?></td>
					<td><?=anchor(base_url().'whchain/edit/'.$warehouse->id, '<img src="'.base_url().'common/admin/images/icons/edit.png" alt="edit" width="18" height="18" />')?></td>
					<td><?=anchor(base_url().'whchain/delete/'.$warehouse->id, '<img src="'.base_url().'common/admin/images/icons/remove.png" alt="remove" width="18" height="18" />')?></td>
				</tr>
			<?endforeach?>
		<?else:?>
			<tr>
				<td colspan="7">No warehouses in the database</td>
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
