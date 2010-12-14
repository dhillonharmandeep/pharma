<?php
// load error handling script and the Grid class
require_once('error_handler.php');
require_once('grid.class.php');
// the 'action' parameter should be FEED_GRID_PAGE or UPDATE_ROW 
if (!isset($_GET['action']))
{  
  echo 'Server error: client command missing.';
  exit;
}      
else 
{
  // store the action to be performed in the $action variable
  $action = $_GET['action'];
}
// create Grid instance
$grid = new Grid($action);
// valid action values are FEED_GRID_PAGE and UPDATE_ROW 
if ($action == 'FEED_GRID_PAGE')
{
  // retrieve the page number
  $page = $_GET['page'];
  // read the products on the page
  $grid->readPage($page);
}
else if ($action == 'UPDATE_ROW')
{
  // retrieve parameters
  $id = $_GET['id'];
  $on_promotion = $_GET['on_promotion'];
  $price = $_GET['price'];
 
  $name = $_GET['name'];
  // update the record
  $grid->updateRecord($id, $on_promotion, $price, $name);
}
else 
  echo 'Server error: client command unrecognized.';
// clear the output 
if(ob_get_length()) ob_clean();
// headers are sent to prevent browsers from caching
header('Expires: Fri, 25 Dec 1980 00:00:00 GMT'); // time in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT'); 
header('Cache-Control: no-cache, must-revalidate'); 
header('Pragma: no-cache');
header('Content-Type: text/xml');
// generate the output in XML format
header('Content-type: text/xml'); 
echo '<?xml version="1.0" encoding="ISO-8859-1"?>';
echo '<data>';
echo '<action>' . $action . '</action>';
echo $grid->getParamsXML();
echo $grid->getGridXML();
echo '</data>';
?>
