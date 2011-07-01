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
$this->load->view('dashboard/structure/_leftmenu', array('heading' => "Price for '".$price->medicine_name."' for '".$price->store_name."'"));
?>
  <p class="back"><a href="<?= base_url()?>price">Back to all price listings</a></p>
    
	<?php echo validation_errors('<p class="msgForm msgError">', '</p>'); ?>    
  <?= form_open(base_url().'price/edit/'.$price->id)?>
  <fieldset>
    <legend>Medicine price details</legend>
      <div class="formrow">
        <div class="ui-widget">
          <div style="float:left;margin-right:50px;width:180px">
            <strong class="formfield">Medicine</strong>
            <?=form_input(array('id'=>'medicine', 'name'=>'medicine', 'class' => 'fields disabled', 'disabled' =>'disabled'), set_value('medicine', $price->medicine_name) )?>
            <?=form_error('medicine_id', '<p class="msgForm msgError">', '</p>')?>
            <input type="hidden" id="medicine_id" name="medicine_id" value="<?php echo set_value('medicine_id', $price->medicine_id); ?>"/>
  
          </div>
          
          <div style="float:left;margin-right:50px;width:180px">
            <strong class="formfield">Store</strong>
            <?=form_input(array('id'=>'store', 'name'=>'store', 'class' => 'fields disabled', 'disabled' =>'disabled'), set_value('store', $price->store_name) )?>
            <?=form_error('store_id', '<p class="msgForm msgError">', '</p>')?>
            <?=form_error('chainbg_id', '<p class="msgForm msgError">', '</p>')?>
            <input type="hidden" id="store_id" name="store_id" value="<?php echo set_value('store_id', $price->store_id); ?>"/>
            <input type="hidden" id="chainbg_id" name="chainbg_id" value="<?php echo set_value('chainbg_id', $price->chainbg_id); ?>"/>
          </div>

          <div style="float:left;margin-right:50px;width:180px">
            <strong class="formfield">Price *</strong>
            <?=form_input(array('id'=>'price', 'name'=>'price', 'class' => 'fields'), set_value('price', $price->price) )?>
            <?=form_error('price', '<p class="msgForm msgError">', '</p>')?>
          </div>
        </div>
      </div>

     
  
      <div class="formrow">
        <?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
      </div>
  </fieldset>
  <?= form_close()?>
<?php
$this->load->view('dashboard/structure/_footer');