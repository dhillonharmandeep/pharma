<?php
/** 
 * view.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 5, 2010
 */
$this->load->view('dashboard/structure/_header', array('title' => $title, 'googlemaps' =>true));
$this->load->view('dashboard/structure/_leftmenu', array('heading' => $heading.": '$chainbg->name' ( $chainbg->state )"));
?>
	<p>
	<span class="back"><a href="<?= base_url()?>chainbg">Back to listings</a></span>
  <span class="edit"><a href="<?= base_url()?>chainbg/edit/<?=$chainbg->id?>">Edit details</a></span>
  <span class="delete"><a href="<?= base_url()?>chainbg/delete/<?=$chainbg->id?>">Delete this chain/bg</a></span>
  <span class="eye"><a href="<?php echo base_url().'store/chainbg/'.$chainbg->id;?>">Stores under this</a></span>
	</p>
	
	<div class="fieldset">
	  <h2><?php echo $chainbg->name;?> details:</h2>
    <div>
       <span class="label">Tags</span>
       <span class="value">
         <?php echo $chainbg->tags; ?>
       </span>
    </div>
    <div>
       <span class="label">Address</span>
       <span class="value">
         <?php echo $chainbg->street.", ".$chainbg->street2.", ".$chainbg->suburb.", ".$chainbg->postcode.", ".$chainbg->city ; ?>
       </span>
    </div>
    <div>
       <span class="label">State</span>
       <span class="value">
         <?php echo $chainbg->state ; ?>
       </span>
    </div>
    <div>
       <span class="label">Website</span>
       <span class="value">
         <?php echo anchor($chainbg->website) ; ?>
       </span>
    </div>
    <?php if(!empty($chainbg->email1) || !empty($chainbg->email2) || !empty($chainbg->email3)) { ?>
    <div>
       <span class="label">Emails</span>
       <span class="value">
         <?php if (!empty($chainbg->email1)) echo mailto($chainbg->email1); ?>
         <?php if (!empty($chainbg->email2)) echo ", ".mailto($chainbg->email2); ?>
         <?php if (!empty($chainbg->email3)) echo ", ".mailto($chainbg->email3); ?>
       </span>
    </div>
    <?php }// if(!empty($chainbg->email1) || !empty($chainbg->email2) || !empty($chainbg->email3)) { ?>
    <?php if(!empty($chainbg->tel1) || !empty($chainbg->tel2) || !empty($chainbg->tel3)) { ?>
    <div>
       <span class="label">Phones</span>
       <span class="value">
         <?php if (!empty($chainbg->tel1)) echo $chainbg->tel1; ?>
         <?php if (!empty($chainbg->tel2)) echo ", ".$chainbg->tel2; ?>
         <?php if (!empty($chainbg->tel3)) echo ", ".$chainbg->tel3; ?>
       </span>
    </div>
    <?php }// if(!empty($chainbg->tel1) || !empty($chainbg->tel2) || !empty($chainbg->tel3)) { ?>
    <?php if(!empty($chainbg->fax1) || !empty($chainbg->fax2) || !empty($chainbg->fax3)) { ?>
    <div>
       <span class="label">Faxes</span>
       <span class="value">
         <?php if (!empty($chainbg->fax1)) echo $chainbg->fax1; ?>
         <?php if (!empty($chainbg->fax2)) echo ", ".$chainbg->fax2; ?>
         <?php if (!empty($chainbg->fax3)) echo ", ".$chainbg->fax3; ?>
       </span>
    </div>
    <?php }// if(!empty($chainbg->fax1) || !empty($chainbg->fax2) || !empty($chainbg->fax3)) { 

		if($chainbg->lat == 0 || $chainbg->lng == 0){
			echo "<div class=\"msgError\"><p>No lat/lng info available for this address</p></div>";
		} 
		else {
	?>
			
	  <div id="map" style="width: 600px; height: 400px"></div>
		<script type="text/javascript">
			load(<?= $chainbg->lat?>, <?= $chainbg->lng?>, '<?= $chainbg->name?>', '<?= $chainbg->street?>');
		</script>
  </div>

	<?php
		} //if($chainbg->lat == 0 || $chainbg->lng == 0){
	?>

<?php
$this->load->view('dashboard/structure/_footer');