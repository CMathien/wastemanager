<?php
require_once "autoload.php";

use Files\File;
use Wastes\Emissions;
use Treatment\Treatment;

// Loading the JSON files
$file1 = new File("https://simplonline-v3-prod.s3.eu-west-3.amazonaws.com/media/file/json/f9769452-b096-4bc9-b09c-d44b0b30d413.json");
$file2 = new File("https://simplonline-v3-prod.s3.eu-west-3.amazonaws.com/media/file/json/baba819c-c8b6-41e6-be23-4d19196e8735.json");

//Loading the emissions reference values
$emissions = new Emissions();
$emissions->loadFile($file2);

// Treating wastes
$treatment = new Treatment();
$treatment->setEmissions($emissions);
$treatment->loadData($file1);


// $treatment->testCreationObjects();
$treatment->dispatchWaste();
$treatment->emissionsByService();
$treatment->globalEmissions();
$treatment->wasteRepartition();

