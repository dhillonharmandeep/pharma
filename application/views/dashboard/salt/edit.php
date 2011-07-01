<?php
/** 
 * edit.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 22, 2010
 */
$this->load->view('dashboard/structure/_header', $title);
$this->load->view('dashboard/structure/_leftmenu', array('heading' => $heading." '$salt->name'"));
?>
  <p class="back"><a href="<?= base_url()?>salt">Back to salt listings</a></p>
    
	<?php echo validation_errors('<p class="msgForm msgError">', '</p>'); ?>    

  <?= form_open(base_url().'salt/edit/'.$salt->id)?>
  <fieldset>
    <legend>Salt details</legend>
    
      <div class="formrowhalf">
        <label class="formfield">Name <span class="required">*</span></label>
        <div class="disabled-form"><?php echo $salt->name;?></div>
        <?=form_error('name', '<p class="msgForm msgError">', '</p>')?>
      </div>
		<div class="formrowhalf">
			<label class="formfield">Tags</label>
			<?=form_input(array('id'=>'tags', 'name'=>'tags', 'class' => 'fields', 'style' => 'width:340px'), set_value('tags', $salt->tags) )?>
			<?=form_error('tags', '<p class="msgForm msgError">', '</p>')?>
		</div>
      
      <div class="formrow">
        <?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
      </div>
  </fieldset>
  <?= form_close()?>
<?php
$this->load->view('dashboard/structure/_footer');