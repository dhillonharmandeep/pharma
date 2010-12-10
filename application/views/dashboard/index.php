<?php
/**
 * dash.php
 * Description	:
 *
 *
 * Created by	: Harman Dhillon
 * Created on 	: Nov 4, 2010
 */
$this->load->view('dashboard/structure/_header', $title);
$this->load->view('dashboard/structure/_leftmenu', $heading);
?>

<!--// Right column starts -->
<div id="tabletmenu">
  <div id="tabvanilla" class="widget">

  <ul class="tabnav">
    <li class="class2"><span class="bodytext"><a href="#popular">Updates</a></span></li>
    <!--// SIDEBAR LINKS TITLE -->
    <li class="class2"><span class="bodytext"><a href="#recent">Comments</a></span></li>
    <!--// TOPTIPS TITLE -->
  </ul>
  <!--/sidebar links-->
  <div id="popular" class="tabdiv">
    <div class="bodytext">
    <strong>Latest Updates</strong><br />
          <ul style="margin-left: 10px">
            <li>Chain/Banner Group completed</li>
            <li>Salt completed</li>
            <li>Medicine Type completed</li>
            <li>Lot of fixes made for new admin skin</li>
            <li>Google Maps support added: Lat-Lng values now calculated and used</li>
          </ul>
    </div>
  </div>
    
    <div id="recent" class="tabdiv">
    <p><span class="bodytext"><strong>Latest Comments</strong><br />
    The new stylesheets implemented.</span><br /></p>
    <br />
  </div>
  </div>
</div>

<!--// Right column ends -->

  <p>
    Welcome to the admin area! The following 3 parts have been completed. 
    You can either click on the links below, or on the links in the left menu.
    All other links will not work.  
  </p>
  <ul>
  	<li><a href="<?php echo base_url()?>chainbg">Chains/Banner Groups</a></li>
  	<li><a href="<?php echo base_url()?>mtype">Medicine Types</a></li>
  	<li><a href="<?php echo base_url()?>salt">Salts</a></li>
  </ul>

<?php
$this->load->view('dashboard/structure/_footer');
