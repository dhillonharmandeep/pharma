<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
    <title>AJAX Suggest and Autocomplete</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link href="<?php echo base_url(); ?>common/admin/ajax/suggest.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>common/admin/ajax/suggest.js"></script>
  </head>
  <body>
    <noscript>
      Your browser does not support JavaScript!!
    </noscript>
    <div id="content" onclick="hideSuggestions();">
    
    <form name="formname" id="formid">
      <div>
        <div id="message">Enter the first letters of your function:</div>
        <input type="text" onfocus="init(this, '/ajax/newquery/');" name="chainbg" id="chainbg" maxlength="70"
               size="69" onkeyup = "handleKeyUp(event)" value="" />
        <input type="text" onfocus="init(this, '/ajax/newquery/');" name="chainbg2" id="chainbg2" maxlength="70"
               size="69" onkeyup = "handleKeyUp(event)" value="" />
        <input type="button" name="button" id="button" value="Submit" />
        <div id="scroll">
          <div id="suggest">
          </div>
        </div>
      </div>
    </form>
    </div>  
  </body>
</html>