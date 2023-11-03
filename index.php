<?php 
session_start();

	include("src/inc/connection.php");
	include("src/inc/functions.php");

	$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
	<title>Jogo Digitação</title>
</head>
<body>

	<a href="src/views/logout.php">Logout</a>
	<h1>Pagina principal</h1>

	<br>
	Oie, <?php echo $user_data['username']; ?>
</body>
</html>