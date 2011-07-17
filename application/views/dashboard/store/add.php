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
?>
<script type="text/javascript">
  function checkType(dd){
    // Clear the value of the chainbg
    window.document.getElementById('chainbg').value = "";    
  
    if (dd.value == '' || dd.value == 'Ind'){
      // hide the chainbg_div
      window.document.getElementById('chainbg_div').style.display = "none";
    }
    else{
      // show the chainbg_div
      window.document.getElementById('chainbg_div').style.display = "block";

      // Set the type
      if(dd.value == 'Chain'){
        window.document.getElementById('chainbg').onfocus = function () { 
            init(this, '/chainbg/ajaxquery/', 'Chain'); 
        };
      }
      else if(dd.value == 'BG'){
        window.document.getElementById('chainbg').onfocus = function () { 
            init(this, '/chainbg/ajaxquery/', 'BG'); 
        };
      }
    }
  }
</script>   

	<p class="back"><a href="<?= base_url()?>store">Back to store listings</a></p>

	<?= form_open(base_url().'store/add')?>
	<fieldset onclick="hideSuggestions();">
		<legend>Store details</legend>
    
      <div class="formrowhalf">
				<label class="formfield">Name <span class="required">*</span></label>
				<?=form_input(array('id'=>'name', 'name'=>'name', 'class' => 'fields', 'size' => '60'), set_value('name') )?>
				<?=form_error('name', '<p class="msgForm msgError">', '</p>')?>
			</div>
      <div class="formrowhalf">
        <label class="formfield">Type <span class="required">*</span></label>
        <?=form_dropdown('type', array('' => '',
                        'Chain' => 'Chain', 
                        'BG' => 'Banner Group',
                        'Ind' => 'Independent'), set_value('type'), 'class="fields" onchange="checkType(this);"')?>
        <?=form_error('type', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrow" id="chainbg_div" <?php if (!isset($_POST['type']) || ($_POST['type'] == 'Ind' || $_POST['type'] == '')) echo "style=\"display:none\"";?> >
        <?php if (isset($_POST['type'])) $type = $_POST['type']; else $type = ''; ?> 
        <label class="formfield">Chain/Banner Group <span class="required">*</span></label>
        <?=form_input(array('id'=>'chainbg', 'name'=>'chainbg', 'class' => 'fields', 'size' => '60', 'onfocus' => "init(this, '/chainbg/ajaxquery/', '".$type."');", 'onkeyup' => "handleKeyUp(event)"), set_value('chainbg') )?>
        <div id="scroll">
          <div id="suggest">
          </div>
        </div>
        <?=form_error('chainbg', '<p class="msgForm msgError">', '</p>')?>
      </div>
 		<div class="formrow">
			<label class="formfield">Tags</label>
			<?=form_input(array('id'=>'tags', 'name'=>'tags', 'class' => 'fields', 'style' => 'width:600px'), set_value('tags') )?>
			<?=form_error('tags', '<p class="msgForm msgError">', '</p>')?>
		</div>
     <div class="formrow">
        <label class="formfield">Street </label>
        <?=form_input(array('id'=>'street', 'name'=>'street', 'class' => 'fields', 'size' => '100'), set_value('street'))?>
        <?=form_error('street', '<p class="msgForm msgError">', '</p>')?>
      </div>
     <div class="formrow">
        <label class="formfield">Clean Address (Geocode Friendly) </label>
        <?=form_input(array('id'=>'clean_address', 'name'=>'clean_address', 'class' => 'fields', 'size' => '100'), set_value('clean_address'))?>
        <?=form_error('clean_address', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrow">
        <label class="formfield">Street Line 2</label>
        <?=form_input(array('id'=>'street2', 'name'=>'street2', 'class' => 'fields', 'size' => '100'), set_value('street2'))?>
        <?=form_error('street2', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Suburb </label>
        <?=form_input(array('id'=>'suburb', 'name'=>'suburb', 'class' => 'fields'), set_value('suburb'))?>
        <?=form_error('suburb', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">City </label>
        <?=form_input(array('id'=>'city', 'name'=>'city', 'class' => 'fields'), set_value('city'))?>
        <?=form_error('city', '<p class="msgForm msgError">', '</p>')?>
      </div>
			<div class="formrowhalf">
				<label class="formfield">Postcode </label>
				<?=form_input(array('id'=>'postcode', 'name'=>'postcode', 'class' => 'fields', 'size' => '4'), set_value('postcode'))?>
				<?=form_error('postcode', '<p class="msgForm msgError">', '</p>')?>
			</div>
			<div class="formrowhalf">
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
      <div class="formrow">
        <label class="formfield">Website</label>
        <?=form_input(array('id'=>'website', 'name'=>'website', 'class' => 'fields', 'size' => '60'), set_value('website'))?>
        <?=form_error('website', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Email 1</label>
        <?=form_input(array('id'=>'email1', 'name'=>'email1', 'class' => 'fields', 'size' => '50'), set_value('email1'))?>
        <?=form_error('email1', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Email 2</label>
        <?=form_input(array('id'=>'email2', 'name'=>'email2', 'class' => 'fields', 'size' => '50'), set_value('email2'))?>
        <?=form_error('email2', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Email 3</label>
        <?=form_input(array('id'=>'email3', 'name'=>'email3', 'class' => 'fields', 'size' => '50'), set_value('email3'))?>
        <?=form_error('email3', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Tel 1</label>
        <?=form_input(array('id'=>'tel1', 'name'=>'tel1', 'class' => 'fields'), set_value('tel1'))?>
        <?=form_error('tel1', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Tel 2</label>
        <?=form_input(array('id'=>'tel2', 'name'=>'tel2', 'class' => 'fields'), set_value('tel2'))?>
        <?=form_error('tel2', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Tel 3</label>
        <?=form_input(array('id'=>'tel3', 'name'=>'tel3', 'class' => 'fields'), set_value('tel3'))?>
        <?=form_error('tel3', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Fax 1</label>
        <?=form_input(array('id'=>'fax1', 'name'=>'fax1', 'class' => 'fields'), set_value('fax1'))?>
        <?=form_error('fax1', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Fax 2</label>
        <?=form_input(array('id'=>'fax2', 'name'=>'fax2', 'class' => 'fields'), set_value('fax2'))?>
        <?=form_error('fax2', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Fax 3</label>
        <?=form_input(array('id'=>'fax3', 'name'=>'fax3', 'class' => 'fields'), set_value('fax3'))?>
        <?=form_error('fax3', '<p class="msgForm msgError">', '</p>')?>
      </div>
			<div class="formrow">
				<?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
			</div>
	</fieldset>
	<?= form_close()?>
<?php
$this->load->view('dashboard/structure/_footer');