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
$this->load->view('dashboard/structure/_leftmenu', array('heading' => $heading.": '$store->name' ( $store->state )"));
?>
	<p>
	<span class="back"><a href="<?= base_url()?>store">Back to store listings</a></span>
  <span class="edit"><a href="<?= base_url()?>store/edit/<?=$store->id?>">Edit details</a></span>
  <span class="delete"><a onclick="return confirm('Are you sure you wish to delete?');" href="<?= base_url()?>store/delete/<?=$store->id?>">Delete this store</a></span>
	</p>
	
	<div class="fieldset">
	  <h2><?php echo $store->name;?> details:</h2>
    <div>
       <span class="label">Tags</span>
       <span class="value">
         <?php echo $store->tags; ?>
       </span>
    </div>
    <div>
       <span class="label">Type</span>
       <span class="value">
         <?php 
              if($store->type == 'Chain') $storeType = "Chain";
              else if($store->type == 'BG')$storeType = "Banner Group";
              else if($store->type == 'Ind')$storeType = "Independent";
              echo $storeType;  
         ?>
       </span>
    </div>
<?php if($store->type == 'Chain' || $store->type == 'BG') { ?>    
    <div>
       <span class="label">Parent <?= $storeType?></span>
       <span class="value">
         <?php echo $store->chainbg; ?>
       </span>
    </div>
<?php }//if($store->type == 'Chain' || $store->type == 'BG') { ?>    
    <div>
       <span class="label">Address</span>
       <span class="value">
         <?php echo $store->street.", ".$store->street2.", ".$store->suburb.", ".$store->postcode.", ".$store->city ; ?>
       </span>
    </div>
    <div>
       <span class="label">State</span>
       <span class="value">
         <?php echo $store->state ; ?>
       </span>
    </div>
    <div>
       <span class="label">Website</span>
       <span class="value">
         <?php if (!empty($store->website)) echo anchor($store->website) ; ?>
       </span>
    </div>
    <?php if(!empty($store->email1) || !empty($store->email2) || !empty($store->email3)) { ?>
    <div>
       <span class="label">Emails</span>
       <span class="value">
         <?php if (!empty($store->email1)) echo mailto($store->email1); ?>
         <?php if (!empty($store->email2)) echo ", ".mailto($store->email2); ?>
         <?php if (!empty($store->email3)) echo ", ".mailto($store->email3); ?>
       </span>
    </div>
    <?php }// if(!empty($store->email1) || !empty($store->email2) || !empty($store->email3)) { ?>
    <?php if(!empty($store->tel1) || !empty($store->tel2) || !empty($store->tel3)) { ?>
    <div>
       <span class="label">Phones</span>
       <span class="value">
         <?php if (!empty($store->tel1)) echo $store->tel1; ?>
         <?php if (!empty($store->tel2)) echo ", ".$store->tel2; ?>
         <?php if (!empty($store->tel3)) echo ", ".$store->tel3; ?>
       </span>
    </div>
    <?php }// if(!empty($store->tel1) || !empty($store->tel2) || !empty($store->tel3)) { ?>
    <?php if(!empty($store->fax1) || !empty($store->fax2) || !empty($store->fax3)) { ?>
    <div>
       <span class="label">Faxes</span>
       <span class="value">
         <?php if (!empty($store->fax1)) echo $store->fax1; ?>
         <?php if (!empty($store->fax2)) echo ", ".$store->fax2; ?>
         <?php if (!empty($store->fax3)) echo ", ".$store->fax3; ?>
       </span>
    </div>
    <?php }// if(!empty($store->fax1) || !empty($store->fax2) || !empty($store->fax3)) { 

		if($store->lat == 0 || $store->lng == 0){
			echo "<div class=\"msgError\"><p>No lat/lng info available for this address</p></div>";
		} 
		else {
	?>
			
	  <div id="map" style="width: 600px; height: 400px"></div>
		<script type="text/javascript">
			load(<?= $store->lat?>, <?= $store->lng?>, '<?= $store->name?>', '<?= $store->street?>');
		</script>
  </div>

	<?php
		} //if($store->lat == 0 || $store->lng == 0){
	?>

<?php
$this->load->view('dashboard/structure/_footer');