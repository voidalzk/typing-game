<?php 
	session_start();

	include("../inc/auth.php");
	include("../inc/connection.php");
	include("../inc/functions.php");

	if($_SERVER['REQUEST_METHOD'] == "POST")
	{
		$username = $_POST['username'];
		$email = $_POST['email'];
		$c_email = $_POST['c_email'];
		$password = $_POST['password'];
		$c_password = $_POST['c_password'];

		if(!$err)
		{
	
			$query = "insert into users (username,email,password) values ('$username','$email','$password')";

			mysqli_query($con, $query);

			header("Location: login.php");
			die;
		}else
		{
			
		}
	}
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="..\public\signup.css">
</head>
<body>
	<header class="p-3 menu">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="" class="nav-link px-2 text-white">Home</a></li>
                </ul>
                <div class="text-end">
                    <a href="login.php"><button type="button"
                            class="btn btn-warning">Login</button></a>
                </div>
            </div>
        </div>
    </header>
	<main>
		<div class="page">
			<form method="post" class="formLogin" id="formLogin">
				<h1>Cadastro</h1>
				<label for="username">Username</label>
				<input id="username" type="text" name="username" autofocus="true" placeholder="Digite seu username">
				<?php 
					if (!empty($err_username)) {
						echo "<p id='error'>" .$err_username . "</p>";
					}
				?>
				<label for="email">Email</label>
				<input id="email" type="text" name="email" autofocus="true" placeholder="Digite seu Email">
				<?php 
					if (!empty($err_email)) {
						echo "<p id='error'>" . $err_email . "</p>";
					}
				?>
				<label for="c_email">Confirmar email</label>
				<input id="c_email" type="text" name="c_email" autofocus="true" placeholder="Confirme seu Email">
				<?php
					if (!empty($err_c_email)) {
						echo "<p id='error'>" . $err_c_email . "</p>";
					}
				?>
				<label for="password">Senha</label>
				<input id="password" type="password" name="password" autofocus="true" placeholder="Digite sua Senha">
				<?php 
					if (!empty($err_password)) {
						echo "<p id='error'>" . $err_password . "</p>";
					}
				?>
				<label for="c_password">Confirmar senha</label>
				<input id="c_password" type="password" name="c_password" autofocus="true" placeholder="Confirme sua senha">
				<?php
					if (!empty($err_c_password)) {
						echo "<p id='error'>" . $err_c_password . "</p>";
					}
				?>
				
				<input id="button" type="submit" value="Cadastrar" class="btn" id="enviar">
				<a href="login.php">Clique para logar</a>
			</form>
		</div>
	</main>
</body>
</html>
