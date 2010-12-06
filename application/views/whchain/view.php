<?php
/** 
 * view.php
 * Description	:
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 5, 2010
 */
$this->load->view('dashboard/_header', $title);
?>
<div id="main">
	<div id="content">
		<div class="jquery_tab">
			<div class="content_block">
				<h2 class="jquery_tab_title"><?php echo $heading.": '$warehouse->chain_name' ( $warehouse->state )"?></h2>
				
				<p><a href="<?= base_url()?>whchain">Back to chains listings</a></p>
				
				<p>Address: <?php echo $warehouse->address.", ".$warehouse->suburb.", ".$warehouse->postcode?></p>

	<?php
		if($warehouse->lat == 0 || $warehouse->lng == 0){
			echo "<div class=\"message error\"><p>No lat/lng info available for this address</p></div>";
		} 
		else {
	?>
			    <script src="http://maps.google.com/maps?file=api&v=2&key=ABQIAAAADy2F1JZevUhmdpyOnYpvZhSQgF_ruoSu5-Aul0WSoybPltiq_xSyJz2q9ilFoYa9x1PK1Nl1egaTRA"
			            type="text/javascript"></script>
			
			    <script type="text/javascript">
			    //<![CDATA[
			
			    var iconBlue = new GIcon(); 
			    iconBlue.image = 'http://labs.google.com/ridefinder/images/mm_20_blue.png';
			    iconBlue.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
			    iconBlue.iconSize = new GSize(12, 20);
			    iconBlue.shadowSize = new GSize(22, 20);
			    iconBlue.iconAnchor = new GPoint(6, 20);
			    iconBlue.infoWindowAnchor = new GPoint(5, 1);
			
			    var iconRed = new GIcon(); 
			    iconRed.image = 'http://labs.google.com/ridefinder/images/mm_20_red.png';
			    iconRed.shadow = 'http://labs.google.com/ridefinder/images/mm_20_shadow.png';
			    iconRed.iconSize = new GSize(12, 20);
			    iconRed.shadowSize = new GSize(22, 20);
			    iconRed.iconAnchor = new GPoint(6, 20);
			    iconRed.infoWindowAnchor = new GPoint(5, 1);
			
			    var customIcons = [];
			    customIcons["restaurant"] = iconBlue;
			    customIcons["bar"] = iconRed;
			
			    function load() {
			      if (GBrowserIsCompatible()) {
			        var map = new GMap2(document.getElementById("map"));
			        map.addControl(new GSmallMapControl());
			        map.addControl(new GMapTypeControl());
			        map.setCenter(new GLatLng(<?= $warehouse->lat?>, <?= $warehouse->lng?>), 13);
			
				var point = new GLatLng(parseFloat('<?= $warehouse->lat?>'), parseFloat('<?= $warehouse->lng?>'));
			        var marker = createMarker(point, '<?= $warehouse->chain_name?>', '<?= $warehouse->address?>', 'bar');
			        map.addOverlay(marker);
			      }
			    }
			
			    function createMarker(point, name, address, type) {
			      var marker = new GMarker(point, customIcons[type]);
			      var html = "<b>" + name + "</b> <br/>" + address;
			      GEvent.addListener(marker, 'click', function() {
			        marker.openInfoWindowHtml(html);
			      });
			      return marker;
			    }
			    //]]>
			  </script>
			
			    <div id="map" style="width: 500px; height: 300px"></div>
				<script type="text/javascript">
					load();
				</script>

	<?php
		} //if($warehouse->lat == 0 || $warehouse->lng == 0){
	?>
			</div><!--end content_block-->
		</div><!-- end jquery_tab -->
	</div><!--end content-->
</div><!--end main-->

<?php
$this->load->view('dashboard/_leftmenu', array('dashboard' => false));
$this->load->view('dashboard/_footer');