<?php 
	$servername = "localhost";
	$username = "root";
	$password = "root";
	$conn = new mysqli($servername, $username, $password);
	
	if ($conn->connect_error) {
		die("Conexão falhou: " . $conn->connect_error);
	}
	
	$databaseName = "trabalhoweb";
	$query = "SHOW DATABASES LIKE '$databaseName'";
	$result = $conn->query($query);
	
	if ($result) {
		if ($result->num_rows > 0) {
			$conn->select_db($databaseName);
			//---------------------------------------------------
			$tableQueryclans = "SHOW TABLES LIKE 'clans'";
			$tableResult = $conn->query($tableQueryclans);
			if ($tableResult->num_rows == 0) {
				$createTableQueryclans = "
					CREATE TABLE clans (
						clan_id INT NOT NULL AUTO_INCREMENT,
						clan_name VARCHAR(100) NOT NULL,
						clan_password VARCHAR(100),
						PRIMARY KEY (clan_id)
					);
				";
				if ($conn->query($createTableQueryclans) === TRUE) {
				} else {
				}
			} else {
			}
			//-------------------------------------------------
			$tableQueryusers = "SHOW TABLES LIKE 'users'";
			$tableResult = $conn->query($tableQueryusers);
			if ($tableResult->num_rows == 0) {
				$createTableQueryusers = "
					CREATE TABLE users(
						user_id INT NOT NULL AUTO_INCREMENT,
						clan_id INT,
						username VARCHAR(100) NOT NULL,
						email VARCHAR(200) NOT NULL,
						password VARCHAR(200) NOT NULL,
						CONSTRAINT PKUSER PRIMARY KEY (user_id),
						CONSTRAINT FKUSERCLAN FOREIGN KEY (clan_id) REFERENCES clans(clan_id)
					);
				";
				if ($conn->query($createTableQueryusers) === TRUE) {
				} else {
				}
			} else {
			}
			//-----------------------------------------------
			$tableQueryhistoric = "SHOW TABLES LIKE 'historic'";
			$tableResult = $conn->query($tableQueryhistoric);
			if ($tableResult->num_rows == 0) {
				$createTableQueryhistoric = "
					CREATE TABLE historic (
						match_id SERIAL,
						user_id INT NOT NULL,
						points INT NOT NULL,
						date_match TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
						CONSTRAINT PKHISTORIC PRIMARY KEY(match_id),
						CONSTRAINT FKHISTORICUSER FOREIGN KEY (user_id) REFERENCES users(user_id)
					);
				";
				if ($conn->query($createTableQueryhistoric) === TRUE) {
				} else {
				}
			} else {
			}
			//-----------------------------------------------
		} else {
			$createDatabaseQuery = "CREATE DATABASE $databaseName";
			if ($conn->query($createDatabaseQuery) === TRUE) {
				$conn->select_db($databaseName);
				//-------------------------------------
				$createTableQueryclans = "
					CREATE TABLE clans (
						clan_id INT NOT NULL AUTO_INCREMENT,
						clan_name VARCHAR(100) NOT NULL,
						clan_password VARCHAR(100),
						PRIMARY KEY (clan_id)
					);
				";
				if ($conn->query($createTableQueryclans) === TRUE) {
				} else {
				}
				//-------------------------------------------------
				$createTableQueryusers = "
					CREATE TABLE users(
						user_id INT NOT NULL AUTO_INCREMENT,
						clan_id INT,
						username VARCHAR(100) NOT NULL,
						email VARCHAR(200) NOT NULL,
						password VARCHAR(200) NOT NULL,
						CONSTRAINT PKUSER PRIMARY KEY (user_id),
						CONSTRAINT FKUSERCLAN FOREIGN KEY (clan_id) REFERENCES clans(clan_id)
					);
				";
				if ($conn->query($createTableQueryusers) === TRUE) {
				} else {
				}
				//---------------------------------------------
				$createTableQueryhistoric = "
					CREATE TABLE historic (
						match_id SERIAL,
						user_id INT NOT NULL,
						points INT NOT NULL,
						date_match TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
						CONSTRAINT PKHISTORIC PRIMARY KEY(match_id),
						CONSTRAINT FKHISTORICUSER FOREIGN KEY (user_id) REFERENCES users(user_id)
					);
				";
				if ($conn->query($createTableQueryhistoric) === TRUE) {
				} else {
				}
				//--------------------------------------------
			} else {
			}
		}
	} else {
	}
	
	$conn->close();
	session_start();

	include("../inc/connection.php");
	include("../inc/functions.php");
	
	if($_SERVER['REQUEST_METHOD'] == "POST")
	{

		$username = $_POST['username'];
		$password = $_POST['password'];

		if(!empty($username) && !empty($password))
		{

			$query = "select * from users where username = '$username' limit 1";
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
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
			<form method="post" id="loginForm" class="formLogin">
				<h1 id="top">Login</h1>
				<p>Digite os seus dados de acesso nos campos abaixo.</p>
				<label for="username">Login</label>
				<input id="text" type="text" name="username" autofocus="true">
				<label for="password">Senha</label>
				<input id="text" type="password" name="password" autofocus="true">

				<input id="button" type="submit" value="Logar" class="btn">

				<a href="signup.php">Clique para se Cadastrar</a>
			</form>
		</div>
	</main>
</body>
</html>