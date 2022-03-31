<?php
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

$obj = readJson("https://simplonline-v3-prod.s3.eu-west-3.amazonaws.com/media/file/json/23fb8b5c-7e95-40d0-8029-b075b23d4dbf.json");
$neighbourhoods = $obj->quartiers;
$services = $obj->services;

foreach ( $neighbourhoods as $neighbourhood ) {
	// var_dump($neighbourhood);
	// echo "<br>";
}
foreach ( $services as $service ) {
	// var_dump($neighbourhood);
	// echo "<br>";
}
// var_dump($obj);
// var_dump($obj->quartiers[0]->population); // Access population data
// var_dump($obj->quartiers[0]->plastiques->PET); // Access PET data
// var_dump($obj->quartiers[0]->papier); // Access paper data

//Iterate through the carbon emissions

$obj2 = readJson("https://simplonline-v3-prod.s3.eu-west-3.amazonaws.com/media/file/json/800839d2-1f0e-4b59-b300-bd0286f346c2.json");
foreach ( $obj2 as $item ) {

}
// var_dump($obj2);
// var_dump($obj2->papier->incineration); // Access paper data
// var_dump($obj2->plastiques->PET->incineration); // Access paper data

