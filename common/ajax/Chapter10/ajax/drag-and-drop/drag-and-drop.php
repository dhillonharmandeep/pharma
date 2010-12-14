<?php
// load helper class
require_once ('taskslist.class.php');
// create TasksList object
$myTasksList = new TasksList();
// read parameters
$action = $_GET['action'];
$content = $_GET['content'];
// clear the output
if(ob_get_length()) ob_clean();
// headers are sent to prevent browsers from caching
 
header('Expires: Fri, 25 Dec 1980 00:00:00 GMT'); // time in the past
header('Last-Modified: ' . gmdate( 'D, d M Y H:i:s') . 'GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
header('Content-Type: text/html');
// execute the client request and return the updated tasks list
echo $myTasksList->Process($content, $action);
?>
