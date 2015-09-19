<?php

/**
 * [displayStarship description]
 * @param  [SWAPI\Models\Vehicle] $ship [description]
 * @return [type]       [description]
 */
function displayStarship($ship){

	$retString = "<div class='starShip'>";

	$retString .= "<span>Name : {$ship->name}</span>";
	$retString .= "<span>&nbsp;Model : {$ship->model}</span>";
	$retString .= "<span>Cost : {$ship->cost_in_credits}</span>";
	$retString .= "";
	$retString .= "";
	$retString .= "";
	$retString .= "";
	$retString .= "";


	$retString .= "</div >";

	return $retString;

}

