<?php
/** 
 * add.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 22, 2010
 */
$this->load->view('dashboard/structure/_header', array('title' => $title, 'ajax' => true));
$this->load->view('dashboard/structure/_leftmenu', $heading);
//  Load the js part of the medicine_salt 
$this->load->view('dashboard/medicine/_saltblockjs'); 
?>

	<p class="back"><a href="<?= base_url()?>medicine">Back to medicine listings</a></p>
  <div id="scroll">
    <div id="suggest">
    </div>
  </div>

<?php  //  print_r($_POST); ?>

	<?= form_open(base_url().'medicine/add')?>
	<fieldset  onclick="hideSuggestions();">
		<legend>Medicine details</legend>
      <div class="formrowhalf">
				<label class="formfield">Name <span class="required">*</span></label>
				<?=form_input(array('id'=>'name', 'name'=>'name', 'class' => 'fields'), set_value('name') )?>
				<?=form_error('name', '<p class="msgForm msgError">', '</p>')?>
			</div>
      <div class="formrowhalf">
        <label class="formfield">Quantity </label>
        <?=form_input(array('id'=>'quantity', 'name'=>'quantity', 'class' => 'fields'), set_value('quantity') )?>
        <?=form_error('quantity', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Dosage </label>
        <?=form_input(array('id'=>'dosage', 'name'=>'dosage', 'class' => 'fields'), set_value('dosage') )?>
        <?=form_error('dosage', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Company Name </label>
        <?=form_input(array('id'=>'company_name', 'name'=>'company_name', 'class' => 'fields'), set_value('company_name') )?>
        <?=form_error('company_name', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrow" id="chainbg_div">
        <label class="formfield">Medicine Type <span class="required">*</span></label>
        <?=form_input(array('id'=>'medicine_type', 'name'=>'medicine_type', 'class' => 'fields', 'size' => '60', 'onfocus' => "init(this, '/mtype/ajaxquery/');", 'onkeyup' => "handleKeyUp(event)"), set_value('medicine_type') )?>
        <?=form_error('medicine_type', '<p class="msgForm msgError">', '</p>')?>
      </div>
<?php 
$this->load->view('dashboard/medicine/_saltblock'); 
?>      
			<div class="formrow">
				<?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
			</div>
	</fieldset>
	<?= form_close()?>
<?php
$this->load->view('dashboard/structure/_footer');