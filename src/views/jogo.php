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
          <h3>Maior resultado:</h3>
          <h3 id="highScore">
            </h4>
            <button id="ButtonRestart" type="button" class="btn btn-warning btn-lg" style="font-size: 50px;"> Jogar
              novamente</button>
        </div>
      </div>
    </div>
  </main>
  <script src="..\public\jogo.js" defer></script>
</body>

</html>