<?php
/** 
 * googlemaps_helper.php
 * Description	: The helper functions for google maps api
 * 
 * 
 * Created by	: Harman Dhillon
 * Created on 	: Nov 28, 2010
 */

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Geocodes the address passed and returns the latlong using google maps api
 * @param $address The address to geocode
 * @return associative array containing the lat-long. Contains (lat=>error, lng=>error) if geocode fails
 */
function _calculateLatLng($address)
{
	define("MAPS_HOST", "maps.google.com");
	define("KEY", "ABQIAAAADy2F1JZevUhmdpyOnYpvZhSQgF_ruoSu5-Aul0WSoybPltiq_xSyJz2q9ilFoYa9x1PK1Nl1egaTRA");

	// Initialize delay in geocode speed
	$delay = 0;
	$base_url = "http://" . MAPS_HOST . "/maps/geo?output=xml" . "&key=" . KEY;

	
	$geocode_pending = true;

	while ($geocode_pending) {
		$request_url = $base_url . "&q=" . urlencode($address. ", Australia");
		$xml = simplexml_load_file($request_url) or die("url not loading");

		$status = $xml->Response->Status->code;
		if (strcmp($status, "200") == 0) {
			// Successful geocode
			$geocode_pending = false;
			$coordinates = $xml->Response->Placemark->Point->coordinates;
			$coordinatesSplit = explode(",", $coordinates);
			// Format: Longitude, Latitude, Altitude
			$lat = $coordinatesSplit[1];
			$lng = $coordinatesSplit[0];

			return array('lat'=>$lat, 'lng' => $lng);
		} else if (strcmp($status, "620") == 0) {
			// sent geocodes too fast
			$delay += 100000;
		} else {
			// failure to geocode
			$geocode_pending = false;
		}
		usleep($delay);

	}

	return array('lat'=>'error', 'lng' => 'error');
}
