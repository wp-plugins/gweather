<?php

/*
Plugin Name: Gweather
Plugin URI: http://www.smesolutions.co.za/
Description: Get the current weather conditions and the forecast weather for your chosen city in Celcius or Farhenheit
Author: Mouring Kolhoff
Version: 1.10
License: GPL
Author URI: http://www.smesolutions.co.za
Min WP Version: 2.5
*/ 

// Add a new shortcode for gweather
add_shortcode('gweather', 'gweather_func');


function gweather_c($city,$country,$credit) {
    $city=str_replace ( ' ', '%20', $city );
	if($credit=="1")
	{$credit_url="<tr><td colspan='4'>Weather Plugin Courtesy of <a class='wp-link' href='http://www.atoz.co.za' title='AtoZ Business Directory South Africa'>AtoZ Business Directory South Africa</a></td></tr>";}
    $string = "<!-- start of gweather content by gweather plugin v1.00 - http://www.citynews.co.za -->\n";
	$img_url = "http://www.google.com";
	$weather_url = "http://www.google.com/ig/api?weather=$city,$country";
	if( $xmlData = file_get_contents($weather_url) ) 
	{ 
    $xml = new SimpleXMLElement($xmlData); 
	$current_temp=$xml->weather->current_conditions->temp_c->attributes();
	$current_cond=$xml->weather->current_conditions->condition->attributes();
	$current_hum=$xml->weather->current_conditions->humidity->attributes();
	$city_info=$xml->weather->forecast_information->city->attributes(); 
    if(!trim($current_cond=="")){$current_cond="and $current_cond";}
    // Display basic information
	$string .="<table class=\"gweather\"><th colspan='4'><strong>Current conditions for $city_info</strong></th>";
	$string .="<tr><td colspan='4'>$current_temp &deg;C $current_cond</td></tr><tr>";
	foreach( $xml->weather->forecast_conditions as $i => $result ) 
    { 
        // Display forecasts (next 4 days)
		$string.="<td width=\"25%\">";		
        $string.="<b>".$result->day_of_week->attributes()."</b><br/>"; 
        $string.=convert($result->low->attributes())."&deg;C|"; 
        $string.=convert($result->high->attributes())."&deg;C<br/>"; 
        $string.="<img src='".$img_url.$result->icon->attributes()."' alt='".$result->condition->attributes()."'/><br/>"; 
        $string.=$result->condition->attributes()."<br/>"; 
		$string.="</td>";		
    }	
    $string .="</tr>$credit_url</table>";
	$string .= "\n<!-- End of gweather content -->\n";
    return $string;
}
}

function gweather_f($city,$country,$credit) {
    $city=str_replace ( ' ', '%20', $city );
	if($credit=="1")
	{$credit_url="<tr><td colspan='4'>Weather Plugin Courtesy of <a class='wp-link' href='http://www.citynews.co.za' title='City News South Africa'>City News South Africa</a></td></tr>";}
    $string = "<!-- start of gweather content by gweather plugin v1.00 - http://www.citynews.co.za -->\n";
	$img_url = "http://www.google.com";
	$weather_url = "http://www.google.com/ig/api?weather=$city,$country";
	if( $xmlData = file_get_contents($weather_url) ) 
	{ 
    $xml = new SimpleXMLElement($xmlData); 
	$current_temp=$xml->weather->current_conditions->temp_f->attributes();
	$current_cond=$xml->weather->current_conditions->condition->attributes();
	$current_hum=$xml->weather->current_conditions->humidity->attributes();
	$city_info=$xml->weather->forecast_information->city->attributes(); 
    if(!trim($current_cond=="")){$current_cond="and $current_cond";}    
    // Display basic information
	$string .="<table class=\"gweather\"><th colspan='4'><strong>Current conditions for $city_info</strong></th>";
	$string .="<tr><td colspan='4'>$current_temp &deg;F $current_cond</td></tr><tr>";
	foreach( $xml->weather->forecast_conditions as $i => $result ) 
    { 
        // Display forecasts (next 4 days)
		$string.="<td width=\"25%\">";		
        $string.="<b>".$result->day_of_week->attributes()."</b><br/>"; 
        $string.=$result->low->attributes()."&deg;F|"; 
        $string.=$result->high->attributes()."&deg;F<br/>"; 
        $string.="<img src='".$img_url.$result->icon->attributes()."' alt='".$result->condition->attributes()."'/><br/>"; 
        $string.=$result->condition->attributes()."<br/>"; 
		$string.="</td>";		
    }	
    $string .="</tr>$credit_url</table>";
	$string .= "\n<!-- End of gweather content -->\n";
    return $string;
}
}
// ###

function gweather_func($atts) {
	
	extract(shortcode_atts(array(
	  'city' => 'pretoria',
		'country' => 'ZA',
		'temp' => 'C',
		'credit' => '0',
	), $atts));

	if(strtolower($temp)=="c"){return gweather_c($city,$country,$credit);}
	else {return gweather_f($city,$country,$credit);}
}

function convert($temp) 
{ 
    // Converting Fahrenheit To Celsius 
	$temperature = round((5/9)*($temp-32)); 
	return $temperature; 
}						
?>