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
	<p class="back"><a href="<?= base_url()?>salt">Back to salt listings</a></p>
	  

	<?= form_open(base_url().'salt/add')?>
	<fieldset>
		<legend>Salt details</legend>
    
      <div class="formrow">
				<label class="formfield">Name <span class="required">*</span></label>
				<?=form_input(array('id'=>'name', 'name'=>'name', 'class' => 'fields'), set_value('name') )?>
				<?=form_error('name', '<p class="msgForm msgError">', '</p>')?>
			</div>
			<div class="formrow">
				<?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
			</div>
	</fieldset>
	<?= form_close()?>
<?php
$this->load->view('dashboard/structure/_footer');