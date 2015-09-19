<?php
date_default_timezone_set('America/Denver');
require_once __DIR__ . '/../vendor/autoload.php';
include_once 'starship.php';
use SWAPI\SWAPI;

$swapi = new SWAPI;
$jsonMapper = new JsonMapper;
$jsonMapper->bEnforceMapType = false;
$swapi->setMapper($jsonMapper);


function compare_cost_asc($a,$b){
	return $a->cost_in_credits > $b->cost_in_credits; 
}
function compare_cost_desc($a,$b){
	return $a->cost_in_credits < $b->cost_in_credits; 
}
function filterByPrice($vehicle, $price, $type){
	if($price != ""){
		$diff = $vehicle->cost_in_credits - $price;
		if ($type == "greater"){
			if($diff > 0) {
				return true;
			}
		} else if ($type == "less"){
			if($diff < 0) {
				return true;
			}
		} else {  // Assume equal if no other option is given
			if($diff === 0){
				return true;
			}
		}

	}
	// Return true by default
	return true;
}
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
	} while ($temp->hasNext());


  return $things;
  }

// Header
echo "<h1><a href='/index.php'>Starwars</a></h1>";

// Body
if (isset($_GET["starshipDetails"])) {
	echo displayStarship($swapi->getFromUri($_GET["starshipDetails"]),$swapi);
} else  {
	$shipName  = "";
	if(isset($_GET["searchByShipName"])) {
		$shipName = $_GET["searchByShipName"];
	}

	$vehicles = loadAllStuff($swapi->vehicles());

	if(isset($_GET["sortByPrice"])){
		echo "<div>NOTE: 0 denotes a cost or price is not given</div><br/>";
		if($_GET["sortByPrice"] == "asc"){
			usort($vehicles,'compare_cost_asc');
		} else {
			usort($vehicles,'compare_cost_desc'); // probably could just use !
		}

	}

	$priceFilter = "";
	$priceFilterType = "";
	if(isset($_GET["filterByPrice"])){
		$priceFilter = $_GET["filterByPrice"];
	}
	if(isset($_GET["filterByPriceType"])){
		$priceFilterType = $_GET["filterByPriceType"];
	}

	for($i =0; $i<count($vehicles);$i++){
		if($shipName == "" || stripos($vehicles[$i]->name,$shipName)){
			if(filterByPrice($vehicles[$i],$priceFilter,$priceFilterType)){
	//			echo $vehicles[$i]->url;
				echo displayMinimalStarship($vehicles[$i]) . '</br>';
			}
		}
	}	

}


// Footer