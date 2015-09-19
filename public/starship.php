<?php
/**
 * [displayStarship description]
 * @param  [SWAPI\Models\Vehicle] $ship [description]
 * @return [string]       [description]
 */
function displayMinimalStarship($ship){

	$retString = "<div class='starShip'>";

	$retString .= "<a href=index.php?starshipDetails={$ship->url}><span>Name : {$ship->name}</span></a>";
	$retString .= "<span>&nbsp;Model : {$ship->model}</span>";
	$retString .= "<span>Cost : {$ship->cost_in_credits}</span>";

	$retString .= "</div >";

	return $retString;

}

/**
 * [displayStarship description]
 * @param  [SWAPI\Models\Vehicle] $ship [description]
 * @return [string]       [description]
 */
function displayStarship($ship, $swapi){

	$retString = "<div class='starShip'>";

	$retString .= "<span>Name : {$ship->name}</span>";
	$retString .= "<span>&nbsp;Model : {$ship->model}</span>";
	$retString .= "<span>&nbsp;Cost : {$ship->cost_in_credits}</span>";
	$retString .= "<span>&nbsp;Manufacturer : {$ship->manufacturer}</span>";
	$retString .= "<span>&nbsp;length : {$ship->length}</span>";
	$retString .= "<span>&nbsp;max atmosphering speed : {$ship->max_atmosphering_speed}</span>";
	$retString .= "<span>&nbsp;cargo capacity : {$ship->cargo_capacity}</span>";
	$retString .= "<span>&nbsp;consumables : {$ship->consumables}</span>";
	$retString .= "<span>&nbsp;passengers : {$ship->passengers}</span>";
	$retString .= "<span>&nbsp;vehicle class : {$ship->vehicle_class}</span>";
	
	$retString .= "<div> <h3>Pilots</h3>";
	$numOfPilots = sizeof($ship->pilots);

	 for($i = 0; $i < $numOfPilots; $i++){
	 	preg_match("/\/api\/(\w+)\/(\d+)(\/|$)/", $ship->pilots[$i], $matches);

	 	$pilot = $swapi->characters()->get($matches[2]);
	 	// TODO add a link for the pilot
		$retString .= "<div> {$pilot->name}</div>";

	 }

	$retString .= "</div>";
	$retString .= "<div> <h3>Films</h3>";
	$numOfFilms = sizeof($ship->films);
	 for($i = 0; $i < $numOfFilms; $i++){

	 	preg_match("/\/api\/(\w+)\/(\d+)(\/|$)/", $ship->films[$i]->url, $matches);
	 	$film = $swapi->films()->get($matches[2]);
	  	// TODO add a link for the film
		 $retString .= "<div> {$film->title}</div>";

	 }

	$retString .= "</div>";

	$retString .= "</div >";

	return $retString;

}
