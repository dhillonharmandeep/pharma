<?php
// load the error handling module
require_once('error_handler.php');
require_once('friendly.class.php');
// make sure the user's browser doesn't cache the result
header('Expires: Wed, 23 Dec 1980 00:30:00 GMT'); // time in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
// retrieve the action parameter
$action = $_GET['action'];
// check availability or get new random number?
if ($action == 'GetNumber')
{

}
elseif ($action == 'CheckAvailability')
{
  // adress of page that returns buffer level
  $serverAddress = 'http://www.random.org/cgi-bin/checkbuf';
  // received buffer level is in form 'x%'
  $bufferPercent = file_get_contents($serverAddress);
  // extract the number 
  $buffer = substr($bufferPercent, 0, strlen($bufferPercent) - 2);
  // echo the number
  echo $buffer;
}
else
{
  echo 'Error talking to the server.';
}
?>
