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
    Click on the store name or the address to view details for this store. 
  </p>

	<span class="add"><a href="<?= base_url()?>store/add">	Add a new store</a></span>
  <span class="edit"><a href="<?= base_url()?>store/chainbg/">View All Independent Stores</a></span>
<?php 
  $this->load->view('dashboard/ajax/search', array('search_module' => 'store'));
?>
  
					
			<table class="t_results">
			<caption>All Stores: Lists all stores (10 per page) <strong>[Total Records : <?php echo $tot_count?>]</strong></caption>
			<tr>
        <th>Name</th>
        <th>Type</th>
				<th>Address</th>
        <th>State</th>
				<th colspan="3">Actions</th>
			</tr>
		<?if(isset($stores) && is_array($stores) && count($stores)>0):?>
		  <?php $count = 1;?>
			<?foreach($stores as $store):?>
			<?php
			   if ($count%2 == 0) echo "<tr class=\"even\">";
			   else echo "<tr class=\"odd\">"; 
			   $count++;
			?>
				
					<td><a href="<?php echo base_url().'store/view/'.$store->id;?>"><?=$store->name?></a></td>
          <td><?php echo ($store->type =='Chain'? 'Chain': (($store->type == 'BG')?'Banner Group':'Independent')); ?></td>
					<td><a href="<?php echo base_url().'store/view/'.$store->id;?>"><?=$store->street .", ".$store->suburb.", ".$store->postcode ?></a></td>
					<td><?=$store->state?></td>
          <td><?php if ($store->lat != 0 && $store->lng != 0)echo anchor(base_url().'store/view/'.$store->id, '<img src="'.base_url().'common/admin/images/icons/maps.png" alt="View" width="18" height="18" />'); ?></td>
          <td><?=anchor(base_url().'store/edit/'.$store->id, '<img src="'.base_url().'common/admin/images/icons/edit.png" alt="Edit" width="18" height="18" />')?></td>
					<td><?=anchor(base_url().'store/delete/'.$store->id, '<img src="'.base_url().'common/admin/images/icons/remove.png" alt="Remove" width="18" height="18" />', array('onclick' => "return confirm('Are you sure you wish to delete?');"))?></td>
				</tr>
			<?endforeach?>
		<?else:?>
			<tr>
				<td colspan="7">No store in the database</td>
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
