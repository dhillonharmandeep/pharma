<?php
// load the list of feeds
require_once ('config.php');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>AJAX RSS Reader</title>
    <link rel="stylesheet" type="text/css" href="rss_reader.css"/>
    <script src="rss_reader.js" type="text/javascript"></script>
  </head>
  <body>
    <h1>AJAX RSS Reader</h1>
    <div id="feeds">
      <h2>Feeds</h2>
      <ul id="feedList">
      <?php
        // Display feeds
        for ($i = 0; $i < count($feeds); $i++)
        {
          echo '<li id="feed-' . $i . '"><a href="javascript:void(0);" ';
          echo 'onclick="getFeed(document.getElementById(\'feed-' . $i . 
               '\'), \'' . urlencode($feeds[$i]['feed']) . '\');">';
          echo $feeds[$i]['title'] . '</a></li>';
        }
      ?> 
      </ul>
    </div>
    <div id="content">
      <div id="loading" style="display:none">Loading feed...</div>
      <div id="feedContainer" style="display:none"></div>
      <div id="home">
        <h2>About the AJAX RSS Reader</h2>
        <p>
          The AJAX RSS reader is only a simple application that provides 
          basic functionality for retrieving RSS feeds.
        </p>
        <p>
          This application is presented as a case study in 
          <a href="https://www.packtpub.com/ajax_php/book"> Building
          Responsive Web Applications with AJAX and PHP</a> 
          (Packt Publishing, 2006).
        </p>
      </div>
    </div>
  </body>
</html>
