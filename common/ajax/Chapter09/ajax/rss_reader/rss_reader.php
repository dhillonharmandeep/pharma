<?php
// load helper scripts
require_once ('error_handler.php');
require_once ('rss_reader.class.php');
// create a new RSS Reader instance
$reader = new CRssReader(urldecode($_POST['feed']));
// clear the output
if(ob_get_length()) ob_clean();
// headers are sent to prevent browsers from caching
header('Expires: Fri, 25 Dec 1980 00:00:00 GMT'); // time in the past
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . 'GMT');
header('Cache-Control: no-cache, must-revalidate'); 
header('Pragma: no-cache');
header('Content-Type: text/xml');
// return the news to the client
echo $reader->getFormattedXML();
?>
