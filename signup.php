<?php 
session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($user_name) && !empty($password) && !empty($email) && !is_numeric($username))
		{

			$user_id = random_num(20);
			$query = "insert into users (user_id,username,email,password) values ('$user_id','$username','$email','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			echo "Entre com informação válida!";
		}
	}
?>


<!DOCTYPE html>
<html>
<head>
	<title>Cadastro</title>
</head>
<body>

	<div id="box">
		
		<form method="post">
			<div>Cadastrar</div>

			Username: <input id="text" type="text" name="username"><br><br>
			E-mail:   <input id="text" type="text" name="email"><br><br>
			Password: <input id="text" type="password" name="password"><br><br>
			
			<input id="button" type="submit" value="Cadastrar"><br><br>

			<a href="login.php">Clique para logar</a><br><br>
		</form>
	</div>
</body>
</html>