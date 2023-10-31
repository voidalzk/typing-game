<?php 
session_start();

	include("connection.php");
	include("functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Jogo Digitação</title>
</head>
<body>

	<a href="logout.php">Logout</a>
	<h1>Pagina principal</h1>

	<br>
	Oie, <?php echo $user_data['username']; ?>
</body>
</html>