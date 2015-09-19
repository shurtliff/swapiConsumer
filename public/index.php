<?php
date_default_timezone_set('America/Denver');
require_once __DIR__ . '/../vendor/autoload.php';
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
	} while ($temp->hasNext());


  return $things;
  }
$vehicles = loadAllStuff($swapi->vehicles());


echo "<h1>Starwars</h1>";


for($i =0; $i<count($vehicles);$i++){
echo $vehicles[$i]->name . ' ' .  $vehicles[$i]->cost_in_credits . '</br>';
}	