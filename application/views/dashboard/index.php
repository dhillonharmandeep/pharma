<?php
/**
 * dash.php
 * Description	:
 *
 *
 * Created by	: Harman Dhillon
 * Created on 	: Nov 4, 2010
 */
$this->load->view('dashboard/_header', $title);
?>

<!--// Tabbed interface starts -->


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
            <li>Lat-Lng values now calculates, stored and used</li>
            <li>Google Maps support added</li>
            <li>CSS for admin section added (for preview only)</li>
            <li>Chain Update Suburb bug fixed</li>
            <li>Changed name for warehouse to chain</li>
            <li>Warehouse CRUD added</li>
          </ul>
    </div>
	</div>
		
		<span class="bodytext"></span>
		<div id="recent" class="tabdiv">
		<p><span class="bodytext"><strong>Latest Comments</strong><br />
		The new stylesheets have been implemented.</span><br />
		<br />
	</div>
  <span class="bodytext"> </span></div>
</div>

<!--// Tabbed interface ends -->


<div id="content">
<table width="772" border="0">
  <tr>
    <th height="58" valign="middle" bgcolor="#E5E5E5" scope="col">
    <h1 align="left"><?php echo $heading?></h1>
    </th>
    <!--// H1 title -->
  </tr>
  <tr>
    <td bgcolor="#FFFFFF">
    <p class="bodytext_paragraph">
    Welcome to the admin area!   
    </p>
    <p><a href="<?php echo base_url()?>whchain">Chains</a></p>
    
    </td>
  </tr>
</table>

</div>


<?php
$this->load->view('dashboard/_leftmenu', array('dashboard' => false));
$this->load->view('dashboard/_footer');
