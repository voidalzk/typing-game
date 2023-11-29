<?php

session_start();
include("../inc/connection.php");
$user_id = $_SESSION["user_id"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["letterspoints"])) {
    $points = $_POST["letterspoints"];
    $sql = "INSERT INTO HISTORIC (USER_ID, POINTS) VALUES ('$user_id', '$points')";
    $con->query($sql);
}
$sqlHighestScore = "SELECT MAX(points) as highestScore FROM historic WHERE user_id = '$user_id'";
$resultHighestScore = $con->query($sqlHighestScore);
$highestScore = $resultHighestScore->fetch_assoc()['highestScore']; 
$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="..\public\jogo.css">
  <title>Speed Typing</title>
</head>

<body>
  <header class="p-3  menu">
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
    <div id="content">
      <div class="button" id="divButton">
        <button type="button" class="btn btn-warning btn-lg" style="font-size: 50px;" id="button">JOGAR</button>
        <P id="texto">Faça seus dedos voarem pelo teclado com o jogo de digitação e em 60 segundos descubra quem é o
          mais
          rapido </P>
      </div>
    </div>
    <div id="timer_structure">
      <div class="timer" id="timer"></div>
    </div>
    <div class="containerJogo">
      <div class="quote-display" id="quoteDisplay"></div>
      <textarea id="quoteInput" class="quote-input" autofocus></textarea>
    </div>
    <div class="result" id="divResults">
      <div class="titleResult">
        <div class="pointsResult" id="pointsResult">
          <h3>Pontos da partida:</h3>
          <h4 id="matchResult"></h4>
          <h3>Recorde</h3>
          <h4 id="highScore"><?php echo $highestScore;?></h4>
            <button id="ButtonRestart" type="button" class="btn btn-warning btn-lg" style="font-size: 50px;"> Jogar
              novamente</button><br><br>
        </div>
      </div>
    </div>
  </main>
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
  <script src="..\public\game.js" defer></script>
</body>

</html>