<?php
// variable initialization
$maxX = 50; // our max X
$maxY = 100; //our max Y
$maxVariation = $maxY / 7; // maximum Y variation for one step
// client tells last X value generated (defaults to -1)
if (isset($_GET['lastX']))
  $lastX = $_GET['lastX'];
else
  $lastX = -1;
// client tells last Y value generated (defaults to random)
if (isset($_GET['lastY']))
  $lastY = $_GET['lastY'];
else
  $lastY = rand(0, $maxY);
// calculate a new random number
$randomY = (int) ($lastY + $maxVariation - rand(0, $maxVariation*2));
// make sure the new Y is between 0 and $maxY
while ($randomY < 0) $randomY += $maxVariation;
while ($randomY > $maxY) $randomY -= $maxVariation;
// generate a new pair of numbers
$output = $lastX + 1 . ',' . $randomY;
// clear the output 
if(ob_get_length()) ob_clean();
// headers are sent to prevent browsers from caching
header('Expires: Fri, 25 Dec 1980 00:00:00 GMT'); // time in the past
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . 'GMT'); 
header('Cache-Control: no-cache, must-revalidate'); 
header('Pragma: no-cache');
// send the results to the client
echo $output;
?>
