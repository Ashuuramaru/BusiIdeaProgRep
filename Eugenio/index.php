<?php require_once 'core/dbConfig.php'; ?>
<?php require_once 'core/models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="styles.css">
</head>
<body>
	<h1>Welcome To Trading Card Shop. Add new cards!</h1>
	<form action="core/handleForms.php" method="POST">
		<p>
			<label for="cardgamename">Card Game Name</label> 
			<input type="text" name="cardgamename">
		</p>
		<p>
			<label for="country">Country</label> 
			<input type="text" name="country">
		</p>
		<p>
			<label for="language">Language</label> 
			<input type="text" name="language">
			<input type="submit" name="insertCardGameBtn">
		</p>
	</form>
	<?php $getAllCardGame = getAllCardGame($pdo); ?>
	<?php foreach ($getAllCardGame as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 300px; margin-top: 20px;">
		<h3>Card Game Name: <?php echo $row['cardgamename']; ?></h3>
		<h3>Country: <?php echo $row['country']; ?></h3>
		<h3>Language: <?php echo $row['language']; ?></h3>


		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewcards.php?trading_card_game_id=<?php echo $row['trading_card_game_id']; ?>">View Cards</a>
			<a href="editwebdev.php?trading_card_game_id=<?php echo $row['trading_card_game_id']; ?>">Edit</a>
			<a href="deletewebdev.php?trading_card_game_id=<?php echo $row['trading_card_game_id']; ?>">Delete</a>
		</div>


	</div> 
	<?php } ?>
</body>
</html>