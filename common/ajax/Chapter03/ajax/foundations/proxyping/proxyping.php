<?php
// load the error handling module
require_once('error_handler.php');
// make sure the user's browser doesn't cache the result
header('Expires: Wed, 23 Dec 1980 00:30:00 GMT');
header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
header('Cache-Control: no-cache, must-revalidate');
header('Pragma: no-cache');
// retrieve the parameters
$num = 1; // this is hardcoded on the server
$min = $_GET['min'];
$max = $_GET['max'];
// holds the remote server address and parameters
$serverAddress = 'http://www.random.org/cgi-bin/randnum';
$serverParams = 'num=' . $num . // how many random numbers to generate
                '&min=' . $min . // the min number to generate
                '&max=' . $max; // the max number to generate
// retrieve the random number from foreign server
$randomNumber = file_get_contents($serverAddress . '?' . $serverParams);
// output the random number
echo $randomNumber;
?>
