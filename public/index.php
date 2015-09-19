<?php
date_default_timezone_set('America/Denver');
require_once __DIR__ . '/../vendor/autoload.php';
include_once 'starship.php';
use SWAPI\SWAPI;

$swapi = new SWAPI;
$jsonMapper = new JsonMapper;
$jsonMapper->bEnforceMapType = false;
$swapi->setMapper($jsonMapper);


function loadAllStuff($call){
	$i = 0;
	$things = [];
	// Iterate through all pages of vehicles
	do {
	    if (!isset($temp)) {
	        $temp = $call->index();
	    } else {
	        // The getNext, getPrevious of Collection indicate whether more pages follow
	        $temp = $temp->getNext();
	    }
	    foreach ($temp as $v) {
	    	$things[$i] = $v;
	    	$i++;
	       // echo sprintf("%s - %s\n", $v->name, $v->url);
	    }
	    // for now just deal with the first page to speed up development
	} while (false && $temp->hasNext());


  return $things;
  }

// Header
echo "<h1><a href='/index.php'>Starwars</a></h1>";

// Body
if (isset($_GET["starshipDetails"])) {
	echo displayStarship($swapi->getFromUri($_GET["starshipDetails"]),$swapi);
} else  {
	if(isset($_GET["searchByShipName"])) {
		$shipName = $_GET["searchByShipName"];
	}
	$vehicles = loadAllStuff($swapi->vehicles());
	for($i =0; $i<count($vehicles);$i++){
		if($shipName == "" || stripos($vehicles[$i]->name,$shipName)){
//			echo $vehicles[$i]->url;
			echo displayMinimalStarship($vehicles[$i]) . '</br>';
		}
	}	

}


// Footer