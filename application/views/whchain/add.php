<?php
/** 
 * add.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 22, 2010
 */
$this->load->view('dashboard/structure/_header', $title);
$this->load->view('dashboard/structure/_leftmenu', $heading);
?>
	<p class="back"><a href="<?= base_url()?>whchain">Back to chains listings</a></p>
	  

	<?= form_open(base_url().'whchain/add')?>
	<fieldset>
		<legend>Chain details</legend>
    
      <div>
				<label class="formfield">Chain Name <span class="required">*</span></label>
				<?=form_input(array('id'=>'chain_name', 'name'=>'chain_name', 'class' => 'fields'), set_value('chain_name') )?>
				<?=form_error('chain_name', '<p class="msgForm msgError">', '</p>')?>
			</div>
			<div>
				<label class="formfield">Address </label>
				<?=form_input(array('id'=>'address', 'name'=>'address', 'class' => 'fields', 'size' => '100'), set_value('address'))?>
				<?=form_error('address', '<p class="msgForm msgError">', '</p>')?>
			</div>
			<div>
				<label class="formfield">Suburb </label>
				<?=form_input(array('id'=>'suburb', 'name'=>'suburb', 'class' => 'fields'), set_value('suburb'))?>
				<?=form_error('suburb', '<p class="msgForm msgError">', '</p>')?>
			</div>
			<div>
				<label class="formfield">Postcode </label>
				<?=form_input(array('id'=>'postcode', 'name'=>'postcode', 'class' => 'fields', 'size' => '4'), set_value('postcode'))?>
				<?=form_error('postcode', '<p class="msgForm msgError">', '</p>')?>
			</div>
			<div>
				<label class="formfield">State <span class="required">*</span></label>
				<?=form_dropdown('state', array('' => '',
												'ACT' => 'Australian Capital Territory', 
												'NSW' => 'New South Wales', 
												'NT' => 'Northern Territory', 
												'QLD' => 'Queensland', 
												'SA' => 'Southern Australia', 
												'TAS' => 'Tasmania', 
												'VIC' => 'Victoria', 
												'WA' => 'Western Australia'), set_value('state'), 'class="fields"')?>
				<?=form_error('state', '<p class="msgForm msgError">', '</p>')?>
			</div>
			<div>
				<?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
			</div>
	</fieldset>
	<?= form_close()?>
<?php
$this->load->view('dashboard/structure/_footer');