<?php 

include 'includes/database.php';

function getAllPlayers() {
	$players = null;
	$sql = "SELECT player.name, player.points, player.rank, country.country, player.player_image, country_image, player.player_id
		FROM player
		INNER JOIN country
		ON player.country_id=country.country_id
		ORDER BY player.rank ASC";
	$result = $GLOBALS['conn']->query($sql);
	while ($row = $result->fetch_assoc()) {
		$players[] = $row;
	}
	return $players;
}

function getPlayersById() {
	$id = $_GET['id'];
	$players = null;
	$sql = "SELECT player.name, player.points, player.rank, country.country, player.player_image, country_image, player.player_id
		FROM player
		INNER JOIN country
		ON player.country_id=country.country_id
		WHERE player_id='$id'";
	$result = $GLOBALS['conn']->query($sql);
	while ($row = $result->fetch_assoc()) {
		$players[] = $row;
	}
	return $players;
}

function getPlayerByCountry() {
	$name = $_POST['name'];
	$options = null;
	$sql = "SELECT player.name, player.points, player.rank, country.country, player.player_image, country_image
		FROM player
		INNER JOIN country
		ON player.country_id=country.country_id
		WHERE country='$name'";
	$result = $GLOBALS['conn']->query($sql);
	while ($row = $result->fetch_assoc()) {
		$options[] = $row;
	}
	return $options;
}

function searchPlayers() {
	$search = $_POST{'search'};
	$players = null;
	$sql = "SELECT player.name, player.points, player.rank, country.country, player.player_image, country_image, player.player_id
		FROM player
		INNER JOIN country
		ON player.country_id=country.country_id
		WHERE name
		LIKE '%$search%'";
	$result = $GLOBALS['conn']->query($sql);
	while ($row = $result->fetch_assoc()) {
		$players[] = $row;
	}
	return $players;
}
