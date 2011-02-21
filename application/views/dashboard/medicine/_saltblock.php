<?php
/** 
 * _saltblock.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Dec 17, 2010
 */
?>
      <fieldset id="salts" style="padding:10px;float:left;margin-top:20px;width:95%;">
<?php 
    $salt_count = 0;// default value
    if(isset($_POST['salt_count'])) $salt_count = $_POST['salt_count']; 
  //  echo "<script>alert('".$_POST['salt_count']."');</script>";
?>
        <input type="hidden" name="salt_count" id="salt_count" value="<?= $salt_count?>"/>
        <div style="float:right; position: relative; width: 100%; text-align: right">
          <span class="add"><a href="#" onclick="addSalt();return false">Add a salt</a></span>
          <span class="delete"><a href="#" onclick="deleteSalt();return false">Delete last salt</a></span>
        </div>
        <legend style="margin-left:0px;font-size:12px;height:16px;line-height:16px">Salts</legend>

<?php
    // Loop through and create $salt_count no of divs
    for($i = 1; $i <= $salt_count; $i++){
?>
        <div id="salt_<?=$i?>">
          <div class="formrowhalf">
            <label class="formfield">Salt <?=$i?> Name <span class="required">*</span></label>
            <?=form_input(array('id'=>'msalt_'.$i.'name', 'name'=>'msalt_'.$i.'name', 'class' => 'fields', 'size' => '50', 'onfocus' => "init(this, '/salt/ajaxquery/');", 'onkeyup' => "handleKeyUp(event)"), set_value('msalt_'.$i.'name') )?>
            <?=form_error('msalt_'.$i.'name', '<p class="msgForm msgError">', '</p>')?>
          </div>
          <div class="formrowhalf">
            <label class="formfield">Salt <?=$i?> Dosage <span class="required">*</span></label>
            <?=form_input(array('id'=>'msalt_'.$i.'dosage', 'name'=>'msalt_'.$i.'dosage', 'class' => 'fields'), set_value('msalt_'.$i.'dosage') )?>
            <?=form_error('msalt_'.$i.'dosage', '<p class="msgForm msgError">', '</p>')?>
          </div>
        </div>
<?php
    // Loop through and create $salt_count no of divs
    }//for($i = 0; $i < $salt_count; $i++){
?>
      </fieldset>