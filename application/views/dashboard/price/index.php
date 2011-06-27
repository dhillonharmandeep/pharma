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
	<span class="add"><a href="<?= base_url()?>price/add">	Add a new medicine type</a></span>
<?php 
  $this->load->view('dashboard/ajax/search', array('search_module' => 'medicine_type'));
?>
	</p>
	<table class="t_results">
		<caption>All Medicine types: Lists all medicine types (10 per page) <strong>[Total Records : <?php echo $tot_count?>]</strong></caption>
		<tr>
          <th>Medicine</th>
          <th>Store/Banner Group</th>
          <th>Price (Store/Banner Group)</th>
		</tr>
	<?if(isset($prices) && is_array($prices) && count($prices)>0):?>
	  <?php $count = 1;?>
		<?foreach($prices as $price):?>
		<?php
		   if ($count%2 == 0) echo "<tr class=\"even\">";
		   else echo "<tr class=\"odd\">"; 
		   $count++;
		?>
				
      <td><a href="<?php echo base_url().'medicine/view/'.$price->medicine_id;?>"><?=$price->medicine_name?></a></td>
      <td>
        <a href="<?php echo base_url().'store/view/'.$price->store_id;?>"><?=$price->store_name?></a> / 
        <a href="<?php echo base_url().'chainbg/view/'.$price->chainbg_id;?>"><?=$price->chainbg_name?> </a>
      </td>
      <td>
        <a href="<?php echo base_url().'price/edit/'.$price->store_price_id;?>"><?=$price->store_price?> </a>/ 
        <a href="<?php echo (empty($price->chainbg_price_id))?"#":base_url().'price/edit/'.$price->chainbg_price_id;?>"><?=$price->chainbg_price?></a>
      </td>
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
