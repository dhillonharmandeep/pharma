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
    <span class="map_ico"><a href="<?php echo base_url()?>chainbg/state/ACT">ACT</a></span>
    <span class="map_ico"><a href="<?php echo base_url()?>chainbg/state/NSW">NSW</a></span>
    <span class="map_ico"><a href="<?php echo base_url()?>chainbg/state/NT">NT</a></span>
    <span class="map_ico"><a href="<?php echo base_url()?>chainbg/state/QLD">QLD</a></span>
    <span class="map_ico"><a href="<?php echo base_url()?>chainbg/state/SA">SA</a></span>
    <span class="map_ico"><a href="<?php echo base_url()?>chainbg/state/TAS">TAS</a></span>
    <span class="map_ico"><a href="<?php echo base_url()?>chainbg/state/VIC">VIC</a></span>
    <span class="map_ico"><a href="<?php echo base_url()?>chainbg/state/WA">WA</a></span>
  </p>

  <p class="msgInfo">
    Click on the chain/banner group name to list stores for that chain/banner group<br/> 
    Click on the address to view details for this chain. 
  </p>

	<span class="add"><a href="<?= base_url()?>chainbg/add">	Add a chain/banner group</a></span>
<?php 
  $this->load->view('dashboard/ajax/search', array('search_module' => 'chainbg'));
?>
					
			<table class="t_results">
			<caption>All Chain/Banner Groups: Lists all chains/banner groups (10 per page) <strong>[Total Records : <?php echo $tot_count?>]</strong></caption>
			<tr>
        <th>Name</th>
        <th>Type</th>
				<th>Address</th>
        <th>State</th>
				<th colspan="3">Actions</th>
			</tr>
		<?if(isset($chainbgs) && is_array($chainbgs) && count($chainbgs)>0):?>
		  <?php $count = 1;?>
			<?foreach($chainbgs as $chain):?>
			<?php
			   if ($count%2 == 0) echo "<tr class=\"even\">";
			   else echo "<tr class=\"odd\">"; 
			   $count++;
			?>
				
					<td><a href="<?php echo base_url().'store/chainbg/'.$chain->id;?>"><?=$chain->name?></a></td>
          <td><?php echo ($chain->type =='Chain'? 'Chain': 'Banner Group'); ?></td>
					<td><a href="<?php echo base_url().'chainbg/view/'.$chain->id;?>"><?=$chain->street .", ".$chain->suburb.", ".$chain->postcode ?></a></td>
					<td><?=$chain->state?></td>
          <td><?php if ($chain->lat != 0 && $chain->lng != 0)echo anchor(base_url().'chainbg/view/'.$chain->id, '<img src="'.base_url().'common/admin/images/icons/maps.png" alt="View" width="18" height="18" />'); ?></td>
          <td><?=anchor(base_url().'chainbg/edit/'.$chain->id, '<img src="'.base_url().'common/admin/images/icons/edit.png" alt="Edit" width="18" height="18" />')?></td>
					<td><?=anchor(base_url().'chainbg/delete/'.$chain->id, '<img src="'.base_url().'common/admin/images/icons/remove.png" alt="Remove" width="18" height="18" />', array('onclick' => "return confirm('Are you sure you wish to delete?');"))?></td>
				</tr>
			<?endforeach?>
		<?else:?>
			<tr>
				<td colspan="7">No chain or banner group in the database</td>
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
