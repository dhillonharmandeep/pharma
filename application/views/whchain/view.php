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
$this->load->view('dashboard/structure/_leftmenu', $heading.": '$warehouse->chain_name' ( $warehouse->state )");
?>
	<p>
	<span class="back"><a href="<?= base_url()?>whchain">Back to chains listings</a></span>
  <span class="edit"><a href="<?= base_url()?>whchain/edit/<?=$warehouse->id?>">Edit details</a></span>
  <span class="delete"><a href="<?= base_url()?>whchain/delete/<?=$warehouse->id?>">Delete this whchain</a></span>
	</p>
				
				<p>Address: <?php echo $warehouse->address.", ".$warehouse->suburb.", ".$warehouse->postcode?></p>

	<?php
		if($warehouse->lat == 0 || $warehouse->lng == 0){
			echo "<div class=\"message error\"><p>No lat/lng info available for this address</p></div>";
		} 
		else {
	?>
			
    <div id="map" style="width: 600px; height: 400px"></div>
	<script type="text/javascript">
		load(<?= $warehouse->lat?>, <?= $warehouse->lng?>, '<?= $warehouse->chain_name?>', '<?= $warehouse->address?>');
	</script>

	<?php
		} //if($warehouse->lat == 0 || $warehouse->lng == 0){
	?>

<?php
$this->load->view('dashboard/structure/_footer');