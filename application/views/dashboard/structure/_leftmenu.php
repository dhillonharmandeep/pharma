<?php
/** 
 * _leftmenu.php
 * Description	: The left menu of the Admin section
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 4, 2010
 */
?>
<!--// leftcolumn edit starts -->
	<!--// Mainnavigation edit starts -->


<div id="leftcolumn">
  <div id="navigation"><img src="<?php echo base_url(); ?>common/admin/images/title_bg.png" alt="titlebg" width="180" height="49" />
    <div class="toplinks style1" id="navigationtitle"><strong>Main navigation</strong><br /> <!--// Title -->
      <br />
      <table width="175" border="0">
        <tr>
          <td width="18" align="center"><img src="<?php echo base_url(); ?>common/admin/images/icons/dashboard.png" alt="dashboard" width="16" height="13" /></td>
          <td width="130" class="navigation"><a href="<?php echo base_url()?>dashboard">Dashboard</a></td> <!--// Dashboard -->
        </tr>
        <tr>
          <td align="center"><img src="<?php echo base_url(); ?>common/icons/chainbg.png" alt="Chain/Banner Group" width="16" height="13" /></td>
          <td class="navigation"><a href="<?php echo base_url()?>chainbg">Chain/Banner Group</a></td>
        </tr>
        <tr>
          <td align="center"><img src="<?php echo base_url(); ?>common/icons/store.png" alt="Medical Store" width="18" height="12" /></td>
          <td class="navigation"><a href="<?php echo base_url()?>store">Store</a></td>
        </tr>
        <tr>
          <td align="center"><img src="<?php echo base_url(); ?>common/icons/medicine.png" alt="Medicine" width="15" height="15" /></td>
          <td class="navigation"><a href="<?php echo base_url()?>medicine">Medicine</a></td>
        </tr>
        <tr>
          <td align="center"><img src="<?php echo base_url(); ?>common/icons/salt.png" alt="Medical Salt" width="16" height="18" /></td>
          <td class="navigation"><a href="<?php echo base_url()?>salt">Medical Salt</a></td> <!--// Users -->
        </tr>
        <tr>
          <td align="center"><img src="<?php echo base_url(); ?>common/icons/mtype.png" alt="Medicine Type" width="14" height="16" /></td>
          <td class="navigation"><a href="<?php echo base_url()?>mtype">Medicine Type</a></td> <!--// Statistics -->
        </tr>
        <tr>
          <td align="center"><img src="<?php echo base_url(); ?>common/admin/images/icons/settings.png" alt="settings" width="14" height="14" /></td>
          <td class="navigation"><a href="#">Settings</a></td> <!--// Settings -->
        </tr>
        <tr>
          <td align="center"><img src="<?php echo base_url(); ?>common/admin/images/icons/support.png" alt="support" width="16" height="16" /></td>
          <td class="navigation"><a href="#">Help &amp; Support</a></td> <!--// Support -->
        </tr>
      </table>
      <br />
    </div>
  </div>
  
	<!--// leftcolumn edit ends -->
  
  <img src="<?php echo base_url(); ?>common/admin/images/navi_bg.jpg" alt="navi_bg" width="225" height="323" /><img src="<?php echo base_url(); ?>common/admin/images/navi_bg.jpg" alt="navi_bg" width="225" height="323" /><br />
  
  	<!--// articles edit starts -->
  
  <div id="latest"><img src="<?php echo base_url(); ?>common/admin/images/title_bg.png" alt="titlebg" width="180" height="49" />
    <div class="toplinks style1" id="latestitle"><strong>Latest Articles<br /> <!--// Title -->
      <br />
    </strong>
    
    
      <table>
        <tr>
          <td align="center"><a href="#"><img src="<?php echo base_url(); ?>common/admin/images/icons/add.png" alt="add" width="18" height="17" border="0" /></a></td>
          <td class="navigation"><a href="#">Add Article</a></td> <!--// Add article -->
        </tr>
          <tr>
            <td width="18" align="center"><a href="#"><img src="<?php echo base_url(); ?>common/admin/images/icons/edit.png" alt="edit" width="18" height="18" border="0" /></a></td>
            <td width="130" class="navigation"><a href="#">Artictle Title #1</a></td> <!--// Article #1... -->
        </tr>
          <tr>
            <td align="center"><a href="#"><img src="<?php echo base_url(); ?>common/admin/images/icons/edit.png" alt="edit" width="18" height="18" border="0" /></a></td>
            <td class="navigation"><a href="#">Artictle Title #2</a></td>
        </tr>
        </table>
      <br />
    </div>
  </div>
  
	<!--// articles edit ends -->
	<!--// Calendar starts -->
  
<?php  // TODO: Create the dynamic calendar ?>
  <div id="calendar"><img src="<?php echo base_url(); ?>common/admin/images/title_bg.png" alt="titlebg" width="180" height="49" /><br />
    <div class="toplinks style1" id="calendartitle"><strong>Calendar</strong><br />
      <br />
      
      
      <table width="170" border="0"> <!--// Days -->
        <tr>
          <th scope="col"><span class="style2">M</span></th>
          <th scope="col"><span class="style2">T</span></th>
          <th scope="col"><span class="style2">W</span></th>
          <th scope="col"><span class="style2">T</span></th>
          <th scope="col"><span class="style2">F</span></th>
          <th scope="col"><span class="style2">S</span></th>
          <th scope="col"><span class="style2">S</span></th>
        </tr>
        <tr>
          <th scope="col">1</th> <!--// Week one -->
          <th scope="col">2</th>
          <th scope="col">3</th>
          <th scope="col">4</th>
          <th scope="col">5</th>
          <th scope="col">6</th>
          <th scope="col">7</th>
        </tr>
        <tr>
          <th scope="col">8</th> <!--// Week two -->
          <th scope="col">9</th>
          <th scope="col">10</th>
          <th scope="col">11</th>
          <th scope="col">12</th>
          <th scope="col">13</th>
          <th scope="col">14</th>
        </tr>
        <tr>
          <th scope="col">15</th> <!--// Week three -->
          <th scope="col">16</th>
          <th scope="col">17</th>
          <th scope="col">18</th>
          <th scope="col">19</th>
          <th scope="col">20</th>
          <th scope="col">21</th>
        </tr>
        <tr>
          <th scope="col">22</th> <!--// Week four -->
          <th scope="col">23</th>
          <th scope="col">24</th>
          <th scope="col">25</th>
          <th scope="col">26</th>
          <th scope="col">27</th>
          <th scope="col">28</th>
        </tr>
        <tr>
          <th scope="col">29</th> <!--// Week five -->
          <th scope="col">30</th>
          <th scope="col">31</th>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
          <th scope="col">&nbsp;</th>
        </tr>
      </table>
      
      
	<!--// Calendar ends -->
	<!--// Copyright starts -->
      
      
        <br />
        <br />
        <br />
        <span class="copyright"><br />
        <br />
    &copy; 2010 Pharmaseek.com.au | Web Design by <a href="http://www.harmandhillon.com">HarmanDhillon</a></span></div>
  </div>
  <img src="<?php echo base_url(); ?>common/admin/images/navi_bg.jpg" alt="navi_bg" width="225" height="323" /><br />
</div>

	<!--// Copyright ends -->
<!--// leftcolumn ends -->

<!--// Main content starts -->
<div id="content">
  <h1><?php echo $heading?></h1>
  <?if($this->session->flashdata('flashError')):?>
    <p class="msgError">
      <?=$this->session->flashdata('flashError')?>
    </p>
  <?endif?>
  <?if($this->session->flashdata('flashWarning')):?>
    <p class="msgInfo">
      <?=$this->session->flashdata('flashWarning')?>
    </p>
  <?endif?>
  <?if($this->session->flashdata('flashConfirm')):?>
    <p class="msgSuccess">
      <?=$this->session->flashdata('flashConfirm')?>
    </p>
  <?endif?>
