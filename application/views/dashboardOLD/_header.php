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
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="description" content="Reflect Template" />
		<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
        <title>Pharmaseek - <?php echo $title;?></title>
        <link rel="stylesheet" href="<?php echo base_url(); ?>common/admin/css/style_all.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>common/admin/css/style1.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>common/admin/css/my.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>common/admin/css/jquery-ui.css" type="text/css" media="screen" />
        <link rel="stylesheet" href="<?php echo base_url(); ?>common/admin/css/jquery.wysiwyg.css" type="text/css" media="screen" />
        
        <!--Internet Explorer Trancparency fix-->
        <!--[if IE 6]>
        <script src="<?php echo base_url(); ?>common/admin/js/ie6pngfix.js"></script>
        <script>
          DD_belatedPNG.fix('#head, a, a span, img, .message p, .click_to_close, .ie6fix');
        </script>
        <![endif]--> 
        
        <script type='text/javascript' src='<?php echo base_url(); ?>common/admin/js/jquery.js'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>common/admin/js/jquery-ui.js'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>common/admin/js/jquery.wysiwyg.js'></script>
        <script type='text/javascript' src='<?php echo base_url(); ?>common/admin/js/custom.js'></script>
    </head>
    
    <body>
        <div id="top">
            <div id="head">
            	<h1 class="logo">
                	<a href="#">pharmaseek.com.au</a>
                </h1>
                <div class="head_memberinfo">
                	<div class="head_memberinfo_logo">
                    	<span>1</span>
                    	<img src="<?php echo base_url(); ?>common/admin/images/unreadmail.png" alt=""/>
                    </div>
                    
                    <span class='memberinfo_span'>
                   		 Welcome <a href="#"><?= $this->session->userdata('firstname')." ".$this->session->userdata('lastname') ?></a>
                    </span>
                    
                    <span class='memberinfo_span'>
                    	<a href="#">Settings</a>
                    </span>
                    
                    <span>
                    	<?php echo anchor('admin/logout','Logout'); ?>
                    </span>
                    
                    <span class='memberinfo_span2'>
                    	<a href="#">1 Private Message recieved</a>
                    </span>
                </div><!--end head_memberinfo-->
            
            </div><!--end head-->
         	<div id="bg_wrapper">
