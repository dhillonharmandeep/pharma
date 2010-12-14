<?php
// variable initialization
$maxX = 50; // our max X
$maxY = 100; //our max Y
$maxVariation = $maxY / 5;
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
$randomY = $lastY + $maxVariation - rand(0, $maxVariation*2);
// make sure the new Y is between 0 and $maxY
while ($randomY < 0) $randomY += $maxVariation;
while ($randomY > $maxY) $randomY -= $maxVariation;
// generate a new pair of numbers
$output = $lastX + 1 . ',' . $randomY;
echo $output;
?>

