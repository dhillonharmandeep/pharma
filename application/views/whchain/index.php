<?php
/** 
 * index.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 22, 2010
 */
$this->load->view('dashboard/_header', $title);
?>
<div id="main">
	<div id="content">
		<div class="jquery_tab">
			<div class="content_block">
				<h2 class="jquery_tab_title"><?php echo $heading?></h2>
					<?if($this->session->flashdata('flashError')):?>
						<div class="message error">
							<p><?=$this->session->flashdata('flashError')?></p>
						</div>
					<?endif?>
					<?if($this->session->flashdata('flashWarning')):?>
						<div class="message warning">
							<p><?=$this->session->flashdata('flashWarning')?></p>
						</div>
					<?endif?>
					<?if($this->session->flashdata('flashConfirm')):?>
						<div class="message success">
							<p><?=$this->session->flashdata('flashConfirm')?></p>
						</div>
					<?endif?>
					<p><a href="<?= base_url()?>whchain/add">Add a warehouse chain</a></p>
					
						<table id="table_liquid" cellspacing="0">
						<caption>All Warehouses: Lists all warehouses (10 per page)</caption>
						<tr>
							<th>Chain Name</th>
							<th>Address</th>
							<th>Suburb</th>
							<th>Postcode</th>
							<th>State</th>
							<th>Edit</th>
							<th>Remove</th>
						</tr>
					<?if(isset($warehouses) && is_array($warehouses) && count($warehouses)>0):?>
						<?foreach($warehouses as $warehouse):?>
							<tr>
								<td><a href="<?php echo base_url().'whchain/view/'.$warehouse->id;?>"><?=$warehouse->chain_name?></a></td>
								<td><a href="<?php echo base_url().'whchain/view/'.$warehouse->id;?>"><?=$warehouse->address?></a></td>
								<td><?=$warehouse->suburb?></td>
								<td><?=$warehouse->postcode?></td>
								<td><?=$warehouse->state?></td>
								<td><?=anchor(base_url().'whchain/edit/'.$warehouse->id, 'Edit')?></td>
								<td><?=anchor(base_url().'whchain/delete/'.$warehouse->id, 'Remove')?></td>
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

			</div><!--end content_block-->
		</div><!-- end jquery_tab -->
	</div><!--end content-->
</div><!--end main-->

<?php
$this->load->view('dashboard/_leftmenu', array('dashboard' => true));
$this->load->view('dashboard/_footer');
