<?php 

require_once 'dbConfig.php'; 
require_once 'models.php';

if (isset($_POST['insertCardGameBtn'])) {

	$query = insertCardGame($pdo, $_POST['cardgamename'], $_POST['country'], $_POST['language']);

	if ($query) {
		header("Location: ../index.php");
	}
	else {
		echo "Insertion failed";
	}

}


if (isset($_POST['editCardGameBtn'])) {
	$query = updateCardGame($pdo, $_POST['cardgamename'], $_POST['country'],  $_POST['language'], $_GET['trading_card_game_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Edit failed";;
	}

}




if (isset($_POST['deleteCardGameBtn'])) {
	$query = deleteCardGame($pdo, $_GET['trading_card_game_id']);

	if ($query) {
		header("Location: ../index.php");
	}

	else {
		echo "Deletion failed";
	}
}




if (isset($_POST['insertNewCardsBtn'])) {
	$query = insertCards($pdo, $_POST['cardName'], $_POST['boosterBoxSet'], $_POST['rarity'], $_GET['trading_card_game_id']);

	if ($query) {
		header("Location: ../viewcards.php?trading_card_game_id=" .$_GET['trading_card_game_id']);
	}
	else {
		echo "Insertion failed";
	}
}




if (isset($_POST['editCardsBtn'])) {
	$query = updateCards($pdo, $_POST['cardName'], $_POST['boosterBoxSet'], $_POST['rarity'],$_GET['trading_card_game_id']);

	if ($query) {
		header("Location: ../viewcards.php?trading_card_game_id=" .$_GET['trading_card_game_id']);
	}
	else {
		echo "Update failed";
	}

}




if (isset($_POST['deleteCardsBtn'])) {
	$query = deleteCards($pdo, $_GET['card_name_id']);

	if ($query) {
		header("Location: ../viewcards.php?trading_card_game_id=" .$_GET['trading_card_game_id']);
	}
	else {
		echo "Deletion failed";
	}
}




?>