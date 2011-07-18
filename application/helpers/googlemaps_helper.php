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
if ( ! function_exists('_calculateLatLng'))
{
	function _calculateLatLng($address)
	{
		if(!defined("MAPS_HOST"))define("MAPS_HOST", "maps.google.com");
		if(!defined("KEY"))define("KEY", "ABQIAAAADy2F1JZevUhmdpyOnYpvZhSQgF_ruoSu5-Aul0WSoybPltiq_xSyJz2q9ilFoYa9x1PK1Nl1egaTRA");
	
		// Initialize delay in geocode speed
		$delay = 0;
		$base_url = "http://" . MAPS_HOST . "/maps/geo?output=xml" . "&key=" . KEY;
	
		
		$geocode_pending = true;
	
		while ($geocode_pending) {
			$request_url = $base_url . "&q=" . urlencode($address);
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
}

/**
 * Geocodes the address passed and returns the latlong using google maps api
 * @param $options The array storing address components
 * @return associative array containing the lat-long. Contains (lat=>error, lng=>error) if geocode fails
 */
if ( ! function_exists('_calcLatLngOfAdd'))
{
	function _calcLatLngOfAdd($options)
	{
		// calculate the address from the options
		$address = "";// variable to store address
		
		// If clean address is given, prefer it over the street address 
		if (isset($options['clean_address']) && !empty($options['clean_address']))
		{
			$address .= $options['clean_address'];
		}
		elseif (isset($options['street']) && !empty($options['street']))
		{
			$address .= $options['street'];
		}
			
		// Check for remaining sections of address as well
		if (isset($options['suburb']) && !empty($options['suburb']))
		{
			if(!empty($address))$address .= ", ";
			$address .= $options['suburb'];
		}
		
		if (isset($options['postcode']) && !empty($options['postcode']))
		{
			if(!empty($address))$address .= ", ";
			$address .= $options['postcode'];
		}
		
		if (isset($options['state']) && !empty($options['state']))
		{
			if(!empty($address))$address .= ", ";
			$address .= $options['state'];
		}		
		
		// If address is not empty - only then try to geocode
		if(!empty($address)) return _calculateLatLng($address.", Australia");
		else return array('lat'=>0, 'lng' => 0);		
	}
}