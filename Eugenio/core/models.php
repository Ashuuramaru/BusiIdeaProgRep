<?php  

function insertCardGame($pdo, $cardgamename, $country, $language) {

	$sql = "INSERT INTO trading_card_game (cardgamename, country, language) VALUES(?,?,?)";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$cardgamename, $country, $language]);

	if ($executeQuery) {
		return true;
	}
}



function updateCardGame($pdo, $cardgamename, $country, 
	$language,  $trading_card_game_id) {

	$sql = "UPDATE trading_card_game
				SET cardgamename = ?,
					country = ?, 
					language = ?
				WHERE trading_card_game_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$cardgamename, $country, 
		$language, $trading_card_game_id]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteCardGame($pdo, $trading_card_game_id) {
	$deleteCardGameCard = "DELETE FROM cards WHERE trading_card_game_id = ?";
	$deleteStmt = $pdo->prepare($deleteCardGameCard);
	$executeDeleteQuery = $deleteStmt->execute([$trading_card_game_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM trading_card_game WHERE trading_card_game_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$trading_card_game_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllCardGame($pdo) {
	$sql = "SELECT * FROM trading_card_game";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getCardGameByID($pdo, $trading_card_game_id) {
	$sql = "SELECT * FROM trading_card_game WHERE trading_card_game_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$trading_card_game_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}





function getCardsByCardGame($pdo, $trading_card_game_id) {
	
	$sql = "SELECT 
				cards.card_name_id AS card_name_id,
				cards.card_name AS card_name,
				cards.boosterbox_set AS boosterbox_set,
				cards.rarity AS rarity,
				CONCAT(web_devs.first_name,' ',web_devs.last_name) AS project_owner
			FROM cards
			JOIN trading_card_game ON cards.trading_card_game_id = trading_card_game.trading_card_game_id
			WHERE cards.trading_card_game_id = ? 
			GROUP BY cards.card_name;
			";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$trading_card_game_id]);
	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}


function insertCards($pdo, $card_name, $boosterbox_set, $rarity, $trading_card_game_id) {
	$sql = "INSERT INTO cards (card_name, boosterbox_set, rarity, trading_card_game_id) VALUES (?,?,?,?)";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$card_name, $boosterbox_set, $rarity, $trading_card_game_id]);
	if ($executeQuery) {
		return true;
	}

}

function getCardsByID($pdo, $card_name_id) {
	$sql = "SELECT 
				cards.card_name_id AS card_name_id,
				cards.card_name AS card_name,
				cards.boosterbox_set AS boosterbox_set,
				cards.rarity AS rarity,
				CONCAT(trading_card_game.cardgamename,') AS cardGame_name
			FROM cards
			JOIN trading_card_game ON cards.trading_card_game_id = trading_card_game.trading_card_game_id
			WHERE cards.card_name_id  = ? 
			GROUP BY cards.card_name";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$card_name_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function updateCards($pdo, $card_name, $boosterbox_set, $rarity, $card_name_id) {
	$sql = "UPDATE cards
			SET card_name = ?,
				boosterbox_set = ?,
				rarity = ?
			WHERE card_name_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$card_name, $boosterbox_set, $rarity, $card_name_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteCards($pdo, $card_name_id) {
	$sql = "DELETE FROM cards WHERE card_name_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$card_name_id]);
	if ($executeQuery) {
		return true;
	}
}




?>