<?php
/** 
 * header.php
 * Description	: Generates the header part of the Admin section pages
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 4, 2010
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Pharmaseek - <?php echo $title;?></title>
	
	<script src="<?php echo base_url(); ?>common/admin/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo base_url(); ?>common/admin/js/dropmenu.js" type="text/javascript"></script>
	
	<script type="text/javascript" src="<?php echo base_url(); ?>common/admin/js/jquery-1.2.6.min.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>common/admin/js/jquery-ui-personalized-1.5.2.packed.js"></script>
	<script type="text/javascript" src="<?php echo base_url(); ?>common/admin/js/sprinkle.js"></script>
	
	<!--[if lt IE 7]>
	<script defer type="text/javascript" src="<?php echo base_url(); ?>common/admin/js/pngfix.js"></script> 
	<![endif]--> 
	
	<link href="<?php echo base_url(); ?>common/admin/css/styles.css" rel="stylesheet" type="text/css" />

</head>
<body>

<!--// Horisontal submenu edit starts -->

<div class="bodytext" id="submenu"> 
  <table width="493" border="0" class="class2">
    <tr>
      <td valign="middle"><a href="#">Submenu  1</a></td>
      <td valign="middle"><a href="#">Submenu  2</a></td>
      <td valign="middle"><a href="#">Submenu  3</a></td>
      <td valign="middle"><a href="#">Submenu  4</a></td>
      <td valign="middle"><a href="#">Submenu  5</a></td>
    </tr>
  </table>
</div>

<!--// Horisontal submenu edit ends -->
<!--// Logo edit starts -->

<div id="logo">
  <div align="center"><br />
    <img src="<?php echo base_url(); ?>common/admin/images/logo.png" alt="pharmaseek.com.au" width="116" height="34" /><br />
  </div>
</div>

<!--// logo edit ends -->
<!--// Arrows edit starts -->

<div id="arrows"></div>
<div class="bodytext" id="hello">Hello <a href="#"><?= $this->session->userdata('firstname')." ".$this->session->userdata('lastname') ?></a>, <img src="<?php echo base_url(); ?>common/admin/images/icons/user.png" alt="user_icon" width="22" height="25" border="0" /><br />
</div>

<!--// arrows edit ends -->
<!--// Visit site starts -->

<div id="visitsite">
  <div align="center" class="toplinks">
    <div id="visitsite_icon"><a href="#"><img src="<?php echo base_url(); ?>common/admin/images/icons/big_visitsite.png" alt="big_visitsite" width="30" height="25" border="0" /></a></div>
    <br />
    <br />
      <a href="#"><span class="toplinks">VISIT SITE</span></a></div>
</div>

<!--// Visit site edit ends -->
<!--// Users edit starts -->


<div id="users">
  <div align="center">
    <div id="users_icon"><a href="#"><img src="<?php echo base_url(); ?>common/admin/images/icons/big_users.png" alt="big_users" width="24" height="26" border="0" /></a></div>
<span class="toplinks"><br />
      <br />
      <a href="#"><span class="toplinks">USERS</span></a></span></div>
  <br />
</div>

<!--// users edit ends -->
<!--// Settings edit starts -->


<div id="settings">
  <div align="center">
    <div id="settings_icon"><a href="#"><img src="<?php echo base_url(); ?>common/admin/images/icons/big_settings.png" alt="big_settings" width="25" height="26" border="0" /></a></div>
			<span class="toplinks"><br />
      <br />
      <a href="#"><span class="toplinks">SETTINGS</span></a></span><br />
  </div>
</div>

<!--// settings edit ends -->
<!--// Logout edit starts -->

<div id="logout">
  <div align="center">
    <div id="logout_icon"><a href="admin/logout"><img src="<?php echo base_url(); ?>common/admin/images/icons/big_logout.png" alt="big_logout" width="25" height="25" border="0" /></a></div>
<span class="toplinks"><br />
      <br />
      <a href="admin/logout"><span class="toplinks">LOG OUT</span></a></span><br />
  </div>
</div>

<!--// logout edit ends -->
<!--// Dropdown edit starts -->


<div class="bodytext" id="dropdown">
<ul id="jsddm">
	<li><a href="#">What would you like to do today?</a><ul>
		<li><a href="#">Write a new Article</a></li>
		<li><a href="#">Upload Pictures</a></li>
		<li><a href="#">Add new events to Calendar</a></li>
		<li><a href="#">Edit my Profile</a></li>
        <li><a href="#">View User's Comments</a></li>
        <li><a href="#">View Statistics</a></li>
        <li><a href="#">Manage Homepage</a></li>
	  </ul>
	</li>
  </ul>
<div class="clear"> </div>
</div>

<!--// dropdown edit ends -->
