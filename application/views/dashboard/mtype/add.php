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
	<p class="back"><a href="<?= base_url()?>mtype">Back to medicine type listings</a></p>
	  

	<?= form_open(base_url().'mtype/add')?>
	<fieldset>
		<legend>Medicine type details</legend>
    
		<div class="formrowhalf">
			<label class="formfield">Name <span class="required">*</span></label>
			<?=form_input(array('id'=>'name', 'name'=>'name', 'class' => 'fields'), set_value('name') )?>
			<?=form_error('name', '<p class="msgForm msgError">', '</p>')?>
		</div>
		<div class="formrowhalf">
			<label class="formfield">Tags</label>
			<?=form_input(array('id'=>'tags', 'name'=>'tags', 'class' => 'fields', 'style' => 'width:340px'), set_value('tags') )?>
			<?=form_error('tags', '<p class="msgForm msgError">', '</p>')?>
		</div>
		<div class="formrow">
			<?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
		</div>
	</fieldset>
	<?= form_close()?>
<?php
$this->load->view('dashboard/structure/_footer');