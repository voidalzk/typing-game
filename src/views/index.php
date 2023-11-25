<?php 
session_start();

include("../inc/connection.php");
include("../inc/functions.php");

$user_data = check_login($con);

?>

<!DOCTYPE html>
<html>
<head>
    <title>Jogo Digitação</title>
    <style>
        
        body {
            text-align: center;
        }
        .buttons {
            position: fixed;
            top: 10px;
            right: 10px;
        }
        .buttons a {
            margin-right: 10px;
            text-decoration: none;
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="buttons">
        <a href="historico.php">Histórico</a>
        <a href="guilda.php">Clas</a>
        <a href="recorde.php">Recorde</a>
		<a href="ger-clas.php">Criar/Entrar em clãs</a>
    </div>

    <?php 
    if ($user_data) {
        echo '<a href="logout.php">Logout</a>';
        echo '<h1>Página principal</h1>';
        echo '<br>Oie, ' . $user_data['username'];
    } else {
        
        header("Location: login.php");
        exit();
    }
    ?>
</body>
</html>