<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Pharmaseek Admin - Login</title>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1" />

<!--// FOLLOWING SCRIPT IS FOR PNG FIX IE5.5/IE6-->
    

<!--[if lt IE 7]>
<script defer type="text/javascript" src="<?php echo base_url(); ?>common/admin/js/pngfix.js"></script> 
<![endif]--> 


<!--//  Styles starts -->


<link href="<?php echo base_url(); ?>common/admin/css/login.css" rel="stylesheet" type="text/css" />


</head>
<body>


<div id="logo">
  <img src="<?php echo base_url(); ?>common/admin/images/logo.png" alt="logopng" width="116" height="34" /> <!--//  Logo on upper corner -->
</div>


<div class="box">
  <div class="welcome" id="welcometitle">Welcome to Pharmaseek Admin, Please Login: <!--//  Welcome message -->
</div>

<?php 
  if ($this->session->flashdata('flashError') != '' || validation_errors()!='')
  { 
    echo '<p class="msgError">';
    echo $this->session->flashdata('flashError');
    echo validation_errors('<p class="msgError">','</p>');
  }
?>
  
  
  <div id="fields"> 
    <?php echo form_open(base_url().'login'); ?>
    <table width="333">
      <tr>
        <td width="79" height="35">
          <span class="login">USERNAME</span>
        </td>
        <td width="244" height="35"><label>
          <input name="username" type="text" class="fields" id="username" size="30" />  <!--//  Username field  -->
        </label></td>
      </tr>
      
      
      <tr>
        <td height="35">
          <span class="login">PASSWORD</span>
        </td>
        <td height="35"><input name="password" type="password" class="fields" id="password" size="30" /></td> <!--//  Password field -->
      </tr>
      
      
      <tr>
        <td height="65">&nbsp;</td>
        <td height="65" valign="middle"><label>
          <input name="button" type="submit" class="button" id="button" value="LOGIN" />
          <!--//  login button -->
        </label></td>
      </tr>
    </table>
    <?php echo form_close(); ?>
  </div>
   <div class="login" id="lostpassword"><a href="#">Lost Password?</a></div> <!--//  lost password part -->
   <div class="login" id="createaccount"><?php echo anchor('signup','Create an Account'); ?></div>
  
  
  
  <div class="copyright" id="copyright">Pharmaseek.com.au webdesign by <a href="http://www.harmandhillon.com">HarmanDhillon</a>.<br /><!--//  copyright / footer -->
  Copyright &copy; Pharmaseek.com.au 2010.
  </div>
</div>

</body>
</html>