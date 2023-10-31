<?php 

session_start();

	include("connection.php");
	include("functions.php");


	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password) && !is_numeric($username))
		{

			$query = "select * from users where user_name = '$username' limit 1";
			$result = mysqli_query($con, $query);

			if($result)
			{
				if($result && mysqli_num_rows($result) > 0)
				{

					$user_data = mysqli_fetch_assoc($result);
					
					if($user_data['password'] === $password)
					{

						$_SESSION['user_id'] = $user_data['user_id'];
						header("Location: index.php");
						die;
					}
				}
			}
			
			echo "senha ou username errado(s)";
		}else
		{
			echo "senha ou username errado(s)";
		}
	}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Login</title>
</head>
<body>
	<div id="box">
		<form method="post">
			<div>Login</div>

			Username: <input id="text" type="text" name="username"><br><br>
			Password: <input id="text" type="password" name="password"><br><br>

			<input id="button" type="submit" value="Logar"><br><br>

			<a href="signup.php">Clique para se Cadastrar</a><br><br>
		</form>
	</div>
</body>
</html>