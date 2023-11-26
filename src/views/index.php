<?php 
session_start();

include("../inc/connection.php");
include("../inc/functions.php");

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="..\public\index.css">
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
                    <li><a href="index.php" class="nav-link px-2 text-white">Home</a></li>
                    <li><a href="hist.php" class="nav-link px-2 text-white">Histórico</a></li>
                    <li><a href="clans.php" class="nav-link px-2 text-white">Minha liga</a></li>
                    <li><a href="ger-clans.php" class="nav-link px-2 text-white">Criar/Entrar em ligas</a></li>
                </ul>
                <div class="text-end">
                    <a href="logout.php"><button type="button"
                            class="btn btn-warning">Logout</button></a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="page">
            <?php 
            if ($user_data) {
                echo '<h1> Bem vindo, ' . $user_data['username'] . "</h1>";
            } else {
                header("Location: login.php");
                exit();
            }
            ?>
            <div class="btn" id="divButtonStart">
                <a href="jogo.php"><button type="button" class="btn btn-warning btn-lg" style="font-size: 50px;"
                    id="buttonStart">JOGAR</button></a>
            </div>
        </div>
    </main>
</body>
</html>