<?php
/** 
 * edit.php
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
				<h2 class="jquery_tab_title"><?php echo $heading." '$warehouse->chain_name' ( $warehouse->state )"?></h2>

				<a href="<?= base_url()?>whchain">Back to chains listings</a>
				<?= form_open(base_url().'whchain/edit/'. $warehouse->id)?>
				<fieldset>
					<legend>Chain details</legend>
					<ul>
						<li>
							<label>Chain Name <span class="required">*</span></label>
							<?=form_input(array('id'=>'chain_name', 'name'=>'chain_name', 'class' => 'input-small'), set_value('chain_name', $warehouse->chain_name))?>
							<?=form_error('chain_name', '<div class="message formerror"><p>', '</p></div>')?>
						</li>
						<li>
							<label>Address </label>
							<?=form_input(array('id'=>'address', 'name'=>'address', 'class' => 'input-big'), set_value('address', $warehouse->address))?>
							<?=form_error('address', '<div class="message formerror"><p>', '</p></div>')?>
						</li>
						<li>
							<label>Suburb </label>
							<?=form_input(array('id'=>'suburb', 'name'=>'suburb', 'class' => 'input-small'), set_value('suburb', $warehouse->suburb))?>
							<?=form_error('suburb', '<div class="message formerror"><p>', '</p></div>')?>
						</li>
						<li>
							<label>Postcode </label>
							<?=form_input(array('id'=>'postcode', 'name'=>'postcode', 'class' => 'input-small'), set_value('postcode', $warehouse->postcode))?>
							<?=form_error('postcode', '<div class="message formerror"><p>', '</p></div>')?>
						</li>
						<li>
							<label>State <span class="required">*</span></label>
							<?=form_dropdown('state', array('' => '',
															'ACT' => 'Australian Capital Territory', 
															'NSW' => 'New South Wales', 
															'NT' => 'Northern Territory', 
															'QLD' => 'Queensland', 
															'SA' => 'Southern Australia', 
															'TAS' => 'Tasmania', 
															'VIC' => 'Victoria', 
															'WA' => 'Western Australia'), set_value('state', $warehouse->state))?>
							<?=form_error('state', '<div class="message formerror"><p>', '</p></div>')?>
						</li>
						<li>
							<?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Save Changes'))?>
						</li>
					</ul>
				</fieldset>
				<?= form_close()?>
			</div><!--end content_block-->
		</div><!-- end jquery_tab -->
	</div><!--end content-->
</div><!--end main-->

<?php
$this->load->view('dashboard/_leftmenu', array('dashboard' => true));
$this->load->view('dashboard/_footer');