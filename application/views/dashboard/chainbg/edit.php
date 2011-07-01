<?php
/** 
 * edit.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 22, 2010
 */
$this->load->view('dashboard/structure/_header', array('title' => $title, 'googlemaps' =>true));
$this->load->view('dashboard/structure/_leftmenu', array('heading' => $heading." '$chainbg->name' ( $chainbg->state )"));
?>
  <p class="back"><a href="<?= base_url()?>chainbg">Back to chain/banner group listings</a></p>

	<?php echo validation_errors('<p class="msgForm msgError">', '</p>'); ?>    

  <?= form_open(base_url().'chainbg/edit/'.$chainbg->id)?>
  <fieldset>
    <legend>Chain details</legend>
    
      <div class="formrowhalf">
        <label class="formfield">Name <span class="required">*</span></label>
        <?=form_input(array('id'=>'name', 'name'=>'name', 'class' => 'fields'), set_value('name', $chainbg->name) )?>
        <?=form_error('name', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Type <span class="required">*</span></label>
        <?=form_dropdown('type', array('' => '',
                        'Chain' => 'Chain', 
                        'BG' => 'Banner Group'), set_value('type',$chainbg->type), 'class="fields"')?>
        <?=form_error('type', '<p class="msgForm msgError">', '</p>')?>
      </div>
		<div class="formrow">
			<label class="formfield">Tags</label>
			<?=form_input(array('id'=>'tags', 'name'=>'tags', 'class' => 'fields', 'style' => 'width:600px'), set_value('tags', $chainbg->tags) )?>
			<?=form_error('tags', '<p class="msgForm msgError">', '</p>')?>
		</div>
      <div class="formrow">
        <label class="formfield">Street </label>
        <?=form_input(array('id'=>'street', 'name'=>'street', 'class' => 'fields', 'size' => '100'), set_value('street',$chainbg->street))?>
        <?=form_error('street', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrow">
        <label class="formfield">Street Line 2</label>
        <?=form_input(array('id'=>'street2', 'name'=>'street2', 'class' => 'fields', 'size' => '100'), set_value('street2',$chainbg->street2))?>
        <?=form_error('street2', '<p class="msgForm msgError">', '</p>')?>
      </div>

      <?php if ($chainbg->lat != 0 && $chainbg->lng != 0 ){?>
      <div style="float:right"><div id="map" style="width: 400px; height: 250px"></div></div>
      <script type="text/javascript">
        load(<?= $chainbg->lat?>, <?= $chainbg->lng?>, '<?= $chainbg->name?>', '<?= $chainbg->street?>');
      </script>
      <?php } //if ($chainbg->lat != 0 && $chainbg->lng != 0 ){?>

      <div class="formrowfloatleft">
        <label class="formfield">Suburb </label>
        <?=form_input(array('id'=>'suburb', 'name'=>'suburb', 'class' => 'fields'), set_value('suburb',$chainbg->suburb))?>
        <?=form_error('suburb', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowfloatleft">
        <label class="formfield">City </label>
        <?=form_input(array('id'=>'city', 'name'=>'city', 'class' => 'fields'), set_value('city',$chainbg->city))?>
        <?=form_error('city', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowfloatleft">
        <label class="formfield">Postcode </label>
        <?=form_input(array('id'=>'postcode', 'name'=>'postcode', 'class' => 'fields', 'size' => '4'), set_value('postcode',$chainbg->postcode))?>
        <?=form_error('postcode', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowfloatleft">
        <label class="formfield">State <span class="required">*</span></label>
        <?=form_dropdown('state', array('' => '',
                        'ACT' => 'Australian Capital Territory', 
                        'NSW' => 'New South Wales', 
                        'NT' => 'Northern Territory', 
                        'QLD' => 'Queensland', 
                        'SA' => 'Southern Australia', 
                        'TAS' => 'Tasmania', 
                        'VIC' => 'Victoria', 
                        'WA' => 'Western Australia'), set_value('state',$chainbg->state), 'class="fields"')?>
        <?=form_error('state', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrow">
        <label class="formfield">Website</label>
        <?=form_input(array('id'=>'website', 'name'=>'website', 'class' => 'fields', 'size' => '60'), set_value('website',$chainbg->website))?>
        <?=form_error('website', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Email 1</label>
        <?=form_input(array('id'=>'email1', 'name'=>'email1', 'class' => 'fields', 'size' => '50'), set_value('email1',$chainbg->email1))?>
        <?=form_error('email1', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Email 2</label>
        <?=form_input(array('id'=>'email2', 'name'=>'email2', 'class' => 'fields', 'size' => '50'), set_value('email2',$chainbg->email2))?>
        <?=form_error('email2', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Email 3</label>
        <?=form_input(array('id'=>'email3', 'name'=>'email3', 'class' => 'fields', 'size' => '50'), set_value('email3',$chainbg->email3))?>
        <?=form_error('email3', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Tel 1</label>
        <?=form_input(array('id'=>'tel1', 'name'=>'tel1', 'class' => 'fields'), set_value('tel1',$chainbg->tel1))?>
        <?=form_error('tel1', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Tel 2</label>
        <?=form_input(array('id'=>'tel2', 'name'=>'tel2', 'class' => 'fields'), set_value('tel2',$chainbg->tel2))?>
        <?=form_error('tel2', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Tel 3</label>
        <?=form_input(array('id'=>'tel3', 'name'=>'tel3', 'class' => 'fields'), set_value('tel3',$chainbg->tel3))?>
        <?=form_error('tel3', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Fax 1</label>
        <?=form_input(array('id'=>'fax1', 'name'=>'fax1', 'class' => 'fields'), set_value('fax1',$chainbg->fax1))?>
        <?=form_error('fax1', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Fax 2</label>
        <?=form_input(array('id'=>'fax2', 'name'=>'fax2', 'class' => 'fields'), set_value('fax2',$chainbg->fax2))?>
        <?=form_error('fax2', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Fax 3</label>
        <?=form_input(array('id'=>'fax3', 'name'=>'fax3', 'class' => 'fields'), set_value('fax3',$chainbg->fax3))?>
        <?=form_error('fax3', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrow">
        <?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
      </div>
  </fieldset>
  <?= form_close()?>
<?php
$this->load->view('dashboard/structure/_footer');