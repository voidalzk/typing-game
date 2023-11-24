<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="principal.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <title>Speed Typing</title>
</head>

<body>
    <header class="p-3 text-bg-dark menu">
        <div class="container">
            <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                    <svg class="bi me-2" width="40" height="32" role="img" aria-label="Bootstrap">
                        <use xlink:href="#bootstrap" />
                    </svg>
                </a>

                <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                    <li><a href="" class="nav-link px-2 text-secondary">Home</a></li>
                </ul>
                <div class="text-end">
                    <a href="/typing-game/teste_joao/PGlogin/login.php"><button type="button" class="btn btn-warning">Login</button></a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container" id="divButtons">
            <div class="button" id="divButtonStart">
                <button type="button" class="btn btn-warning btn-lg" style="font-size: 50px;"
                    id="buttonStart">JOGAR</button>
            </div>
            <div class="button" id="divButtonLogin">
                <a href="/typing-game/teste_joao/PGlogin/login.php"><button type="button" class="btn btn-warning btn-lg" style="font-size: 50px;"
                    id="buttonLogin">LOGIN</button></a>
            </div>
        </div>
        <div id="timer_structure">
        <div class="timer" id="timer"  ></div>
    </div>
        <div class="containerJogo" id="containerJogo">
            <div class="quote-display" id="quoteDisplay"></div>
            <textarea id="quoteInput" class="quote-input" autofocus></textarea>
        </div>
        <script src="principal.js"></script>
    </main>
</body>

</html>