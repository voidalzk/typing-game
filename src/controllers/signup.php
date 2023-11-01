<?php 
session_start();

	include("backend/auth/auth.php");
	include("src/inc/connection.php");
	include("src/inc/functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$username = $_POST['username'];
		$email = $_POST['email'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($email) && !empty($c_email) && !empty($password) && !empty($c_password))
		{
			$user_id = random_num(20);
			$query = "insert into users (user_id,username,email,password) values ('$user_id','$username','$email','$c_email','$password','$c_password')";

			mysqli_query($con, $query);

			header("Location: src/controllers/login.php");
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
		

	<?php if($err): ?>
		Erro no cadastro.
	<?php endif; ?>
		<form method="post">
			<div>Cadastrar</div>
			Username: <input id="text" type="text" name="username"><br><br>
			E-mail:   <input id="text" type="text" name="email"><br><br>
			Confirm E-mail:<input id="text" type="text" name="c_email"><br><br>
			Password: <input id="text" type="password" name="password"><br><br>
			Confirm Password: <input id="text" type="password" name="c_password"><br><br>
			
			<input id="button" type="submit" value="Cadastrar"><br><br>

			<a href="src/controllers/login.php">Clique para logar</a><br><br>
		</form>
	</div>
</body>
</html>