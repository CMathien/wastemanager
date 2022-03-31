<?php
require_once("Waste.php");
require_once("CompostableWaste.php");
require_once("RecycableWaste.php");

//? Testing read data from JSON

/**
 * Read JSON and generate an object with the JSON data
 *
 * @param  mixed $url
 * @return Object
 */
function readJSON($url) {
	$data = file_get_contents($url);
	$obj = json_decode($data);
	return $obj;
}

//Iterate through the neighbourhoods and services

$obj = readJson("https://simplonline-v3-prod.s3.eu-west-3.amazonaws.com/media/file/json/f9769452-b096-4bc9-b09c-d44b0b30d413.json");
// $neighbourhoods = $obj->quartiers;
// $services = $obj->services;

// foreach ( $neighbourhoods as $neighbourhood ) {
// 	// var_dump($neighbourhood);
// 	// echo "<br>";
// }
// foreach ( $services as $service ) {
// 	// var_dump($neighbourhood);
// 	// echo "<br>";
// }
var_dump($obj); echo "<br>";
var_dump($obj->quartiers[0]->population); echo "<br>"; // Access population data
var_dump($obj->quartiers[0]->plastiques->PET); echo "<br>"; // Access PET data
var_dump($obj->quartiers[0]->papier); // Access paper data

//Iterate through the carbon emissions

$obj2 = readJson("https://simplonline-v3-prod.s3.eu-west-3.amazonaws.com/media/file/json/baba819c-c8b6-41e6-be23-4d19196e8735.json");
foreach ( $obj2 as $key => $item ) {
	if ( $key == "plastics" ) {
		foreach ( $item as $plastic => $type ) {
			$$plastic = new RecycableWaste();
			$$plastic->setRecyclingEmissions();
		}
	}
	else {
		if ( isset($item->compostage) ) $$key = new CompostableWaste();
		elseif ( isset($item->recyclage) ) $$key = new RecycableWaste();
		else $$key = new Waste();
	}
}

// print_r(Waste::$instances);
// var_dump($obj2);
// var_dump($obj2->papier->incineration); // Access paper data
// var_dump($obj2->plastiques->PET->incineration); // Access paper data

