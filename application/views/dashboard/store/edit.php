<?php
/** 
 * edit.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Oct 22, 2010
 */
$this->load->view('dashboard/structure/_header', array('title' => $title, 'googlemaps' =>true, 'ajax' => true));
$this->load->view('dashboard/structure/_leftmenu', array('heading' => $heading." '$store->name' ( $store->state )"));
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
 
  <?= form_open(base_url().'store/edit/'.$store->id)?>
  <fieldset onclick="hideSuggestions();">
    <legend>Store details</legend>
    
      <div class="formrowhalf">
        <label class="formfield">Name <span class="required">*</span></label>
        <?=form_input(array('id'=>'name', 'name'=>'name', 'class' => 'fields', 'size' => '60'), set_value('name', $store->name) )?>
        <?=form_error('name', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Type <span class="required">*</span></label>
        <?=form_dropdown('type', array('' => '',
                        'Chain' => 'Chain', 
                        'BG' => 'Banner Group',
                        'Ind' => 'Independent'), set_value('type',$store->type), 'class="fields" onchange="checkType(this);"')?>
        <?=form_error('type', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrow" id="chainbg_div" <?php if ($store->type == 'Ind' || $store->type == '') echo "style=\"display:none\"";?> >
        <label class="formfield">Chain/Banner Group <span class="required">*</span></label>
        <?=form_input(array('id'=>'chainbg', 'name'=>'chainbg', 'class' => 'fields', 'size' => '60', 'onfocus' => "init(this, '/chainbg/ajaxquery/', '".$store->type."');", 'onkeyup' => "handleKeyUp(event)"), set_value('chainbg', $store->chainbg) )?>
        <div id="scroll">
          <div id="suggest">
          </div>
        </div>
        <?=form_error('chainbg', '<p class="msgForm msgError">', '</p>')?>
      </div>
      
      <div class="formrow">
        <label class="formfield">Street </label>
        <?=form_input(array('id'=>'street', 'name'=>'street', 'class' => 'fields', 'size' => '100'), set_value('street',$store->street))?>
        <?=form_error('street', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrow">
        <label class="formfield">Street Line 2</label>
        <?=form_input(array('id'=>'street2', 'name'=>'street2', 'class' => 'fields', 'size' => '100'), set_value('street2',$store->street2))?>
        <?=form_error('street2', '<p class="msgForm msgError">', '</p>')?>
      </div>

      <?php if ($store->lat != 0 && $store->lng != 0 ){?>
      <div style="float:right"><div id="map" style="width: 400px; height: 250px"></div></div>
      <script type="text/javascript">
        load(<?= $store->lat?>, <?= $store->lng?>, '<?= $store->name?>', '<?= $store->street?>');
      </script>
      <?php } //if ($store->lat != 0 && $store->lng != 0 ){?>

      <div class="formrowfloatleft">
        <label class="formfield">Suburb </label>
        <?=form_input(array('id'=>'suburb', 'name'=>'suburb', 'class' => 'fields'), set_value('suburb',$store->suburb))?>
        <?=form_error('suburb', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowfloatleft">
        <label class="formfield">City </label>
        <?=form_input(array('id'=>'city', 'name'=>'city', 'class' => 'fields'), set_value('city',$store->city))?>
        <?=form_error('city', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowfloatleft">
        <label class="formfield">Postcode </label>
        <?php $postcode = ($store->postcode == 0)?'' :$store->postcode ?>
        <?=form_input(array('id'=>'postcode', 'name'=>'postcode', 'class' => 'fields', 'size' => '4'), set_value('postcode',$postcode))?>
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
                        'WA' => 'Western Australia'), set_value('state',$store->state), 'class="fields"')?>
        <?=form_error('state', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrow">
        <label class="formfield">Website</label>
        <?=form_input(array('id'=>'website', 'name'=>'website', 'class' => 'fields', 'size' => '60'), set_value('website',$store->website))?>
        <?=form_error('website', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Email 1</label>
        <?=form_input(array('id'=>'email1', 'name'=>'email1', 'class' => 'fields', 'size' => '50'), set_value('email1',$store->email1))?>
        <?=form_error('email1', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Email 2</label>
        <?=form_input(array('id'=>'email2', 'name'=>'email2', 'class' => 'fields', 'size' => '50'), set_value('email2',$store->email2))?>
        <?=form_error('email2', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Email 3</label>
        <?=form_input(array('id'=>'email3', 'name'=>'email3', 'class' => 'fields', 'size' => '50'), set_value('email3',$store->email3))?>
        <?=form_error('email3', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Tel 1</label>
        <?=form_input(array('id'=>'tel1', 'name'=>'tel1', 'class' => 'fields'), set_value('tel1',$store->tel1))?>
        <?=form_error('tel1', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Tel 2</label>
        <?=form_input(array('id'=>'tel2', 'name'=>'tel2', 'class' => 'fields'), set_value('tel2',$store->tel2))?>
        <?=form_error('tel2', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Tel 3</label>
        <?=form_input(array('id'=>'tel3', 'name'=>'tel3', 'class' => 'fields'), set_value('tel3',$store->tel3))?>
        <?=form_error('tel3', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Fax 1</label>
        <?=form_input(array('id'=>'fax1', 'name'=>'fax1', 'class' => 'fields'), set_value('fax1',$store->fax1))?>
        <?=form_error('fax1', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Fax 2</label>
        <?=form_input(array('id'=>'fax2', 'name'=>'fax2', 'class' => 'fields'), set_value('fax2',$store->fax2))?>
        <?=form_error('fax2', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrowhalf">
        <label class="formfield">Fax 3</label>
        <?=form_input(array('id'=>'fax3', 'name'=>'fax3', 'class' => 'fields'), set_value('fax3',$store->fax3))?>
        <?=form_error('fax3', '<p class="msgForm msgError">', '</p>')?>
      </div>
      <div class="formrow">
        <?=form_submit(array('name'=>'','class'=>'button', 'value'=> 'Submit'))?>
      </div>
  </fieldset>
  <?= form_close()?>
<?php
$this->load->view('dashboard/structure/_footer');