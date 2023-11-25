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
   
</head>
<body>
    <div class="buttons">
        <a href="hist.php">Histórico</a>
        <a href="clans.php">Clas</a>
		<a href="ger-clans.php">Criar/Entrar em clãs</a>
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