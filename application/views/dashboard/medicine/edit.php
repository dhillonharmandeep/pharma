<?php
/** 
 * edit.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 22, 2010
 */
$this->load->view('dashboard/structure/_header', array('title' => $title, 'ajax' => true));
$this->load->view('dashboard/structure/_leftmenu', array('heading' => $heading));
//  Load the js part of the medicine_salt 
$this->load->view('dashboard/medicine/_saltblockjs'); 
?>
  <p class="back"><a href="<?= base_url()?>medicine">Back to medicine listings</a></p>

	<div style="font-size:20px">
	<?php
		if(isset($medicine->CMI1_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->CMI1_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16" />CMI1', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->CMI2_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->CMI2_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>CMI2', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->CMI3_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->CMI3_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>CMI3', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->CMI4_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->CMI4_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>CMI4', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->CMI5_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->CMI5_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>CMI5', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->CMI6_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->CMI6_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>CMI6', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->PI1_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->PI1_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>PI1', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->PI2_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->PI2_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>PI2', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->PI3_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->PI3_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>PI3', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->PI4_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->PI4_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>PI4', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->PI5_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->PI5_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>PI5', array('target'=>'_blank','style'=>"margin-right:8px"));
		if(isset($medicine->PI6_link)) echo anchor("https://www.ebs.tga.gov.au/ebs/picmi/picmirepository.nsf/pdf?OpenAgent&amp;id=".$medicine->PI6_target, '<img src="'.base_url().'common/admin/images/icons/pdf.png" alt="PDF" width="16" height="16"/>PI6', array('target'=>'_blank','style'=>"margin-right:8px"));
	?>
	</div>
	<?php echo validation_errors('<p class="msgForm msgError">', '</p>'); ?>    
  <?= form_open(base_url().'medicine/edit/'.$medicine->id)?>
  <fieldset  onclick="hideSuggestions();">
    <legend>Medicine details</legend>
    
      <div class="formrowhalf">
        <label class="formfield">Name <span class="required">*</span></label>
        <?=form_input(array('id'=>'name', 'name'=>'name', 'class' => 'fields'), set_value('name', $medicine->name) )?>
        <?=form_error('name', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Quantity </label>
        <?=form_input(array('id'=>'quantity', 'name'=>'quantity', 'class' => 'fields'), set_value('quantity', $medicine->quantity) )?>
        <?=form_error('quantity', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Dosage </label>
        <?=form_input(array('id'=>'dosage', 'name'=>'dosage', 'class' => 'fields'), set_value('dosage', $medicine->dosage) )?>
        <?=form_error('dosage', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Company Name </label>
        <?=form_input(array('id'=>'company_name', 'name'=>'company_name', 'class' => 'fields'), set_value('company_name', $medicine->company_name) )?>
        <?=form_error('company_name', '<p class="msgForm msgError">', '</p>')?>
      </div>

      <div class="formrowhalf" id="chainbg_div">
        <label class="formfield">Medicine Type <span class="required">*</span></label>
        <?=form_input(array('id'=>'medicine_type', 'name'=>'medicine_type', 'class' => 'fields', 'size' => '60', 'onfocus' => "init(this, '/mtype/ajaxquery/');", 'onkeyup' => "handleKeyUp(event)"), set_value('medicine_type', $medicine->medicine_type) )?>
        <div id="scroll">
          <div id="suggest">
          </div>
        </div>
        <?=form_error('medicine_type', '<p class="msgForm msgError">', '</p>')?>
      </div>
	<div class="formrowhalf">
		<label class="formfield">Tags</label>
		<?=form_input(array('id'=>'tags', 'name'=>'tags', 'class' => 'fields', 'style' => 'width:340px'), set_value('tags', $medicine->tags) )?>
		<?=form_error('tags', '<p class="msgForm msgError">', '</p>')?>
	</div>
      <div class="formrow">
        <label class="formfield">Notes</label>
        <?=form_textarea(array('id'=>'notes', 'name'=>'notes', 'class' => 'fields', 'rows' =>'4', 'cols' =>'120'), set_value('notes', $medicine->notes) )?>
        <?=form_error('notes', '<p class="msgForm msgError">', '</p>')?>
      </div>

      <div class="formrow">
        <label class="formfield">Description</label>
        <?=form_textarea(array('id'=>'description', 'name'=>'description', 'class' => 'fields', 'rows' =>'4', 'cols' =>'120'), set_value('description', $medicine->description) )?>
        <?=form_error('description', '<p class="msgForm msgError">', '</p>')?>
      </div>

      <div class="formrow">
     <table class="t_results">
      <caption>All salts in this medicine</caption>
      <tr>
        <th>Salt Name</th>
        <th>Dosage</th>
        <th>Delete</th>
      </tr>
    <?if(isset($medicine_salts) && is_array($medicine_salts) && count($medicine_salts)>0):?>
      <?php $count = 1;?>
      <?foreach($medicine_salts as $salt):?>
      <?php
         if ($count%2 == 0) echo "<tr class=\"even\">";
         else echo "<tr class=\"odd\">"; 
         $count++;
      ?>
        
          <td><?=$salt->salt_name?></td>
          <td>
          		<?=form_input(array('id'=>'curr_msalt_dosage_'.$salt->id, 'name'=>'curr_msalt_dosage_'.$salt->id, 'class' => 'fields'), set_value('curr_msalt_dosage_'.$salt->id, $salt->dosage) )?>
          </td>
          <td><?=anchor(base_url().'medicine/delete_salt/'.$salt->id.'/'.$medicine->id, '<img src="'.base_url().'common/admin/images/icons/remove.png" alt="Edit" width="18" height="18" />')?></td>
        </tr>
      <?endforeach?>
    <?else:?>
      <tr>
        <td colspan="7">No medicine in the database</td>
      </tr>
    <?endif?>
    </table>
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