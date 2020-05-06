<?php 

include_once 'database.php';

$json = json_decode(file_get_contents("https://vbarbaresi.opendatasoft.com/api/records/1.0/search/?dataset=atp-rankings&sort=-current_rank&facet=current_rank&facet=player_country"));

foreach ($json->records as $player) {
	$country = insertCountryIntoDatabase($player->fields->player_country);

	insertPlayerIntoDatabase(
		$player->fields->player_name, 
		$player->fields->current_rank, 
		$player->fields->player_points
	);
}

header('Location:../index.php');

function insertCountryIntoDatabase($name)
{
	$sql = "SELECT * FROM country WHERE country='{$name}';";
	$country = $GLOBALS['conn']->query($sql)->fetch_assoc();

	if (isset($country)) {
		return $country;
	}
		
	$sql = "INSERT INTO country (country) VAlUES ('{$name}');";
	$GLOBALS['conn']->query($sql);
}

function insertPlayerIntoDatabase($name, $rank, $points)
{
	$sql = "SELECT * FROM player WHERE name='{$name}';";
	$player = $GLOBALS['conn']->query($sql)->fetch_assoc();
	
	if (isset($player)) {
		// Update player's points and rank
	} else {
		$sql = "INSERT INTO player (name, rank, points) VAlUES ('$name', '$rank', '$points');";
		$GLOBALS['conn']->query($sql);
	}
	
}