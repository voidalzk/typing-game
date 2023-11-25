<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="login.css">
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
                    <li><a href="C:\xampp\htdocs\typing-game\teste_joao\PGprincipal\principal.html"
                            class="nav-link px-2 text-secondary">Home</a></li>
                </ul>
                <div class="text-end">
                    <a href="C:\xampp\htdocs\typing-game\teste_joao\PGlogin\login.html"><button type="button"
                            class="btn btn-warning">Login</button></a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <div class="page">
            <form method="POST" class="formLogin" id="loginForm">
                <h1 id="top">Login</h1>
                <p>Digite os seus dados de acesso nos campos abaixo.</p>
                <label for="email">Login</label>
                <input type="email" id="email" placeholder="Digite seu Login" autofocus="true" />
                <label for="password">Senha</label>
                <input type="password" id="password" placeholder="Digite sua senha" />
                <a href="/">Esqueci minha senha</a>
                <a href="C:\xampp\htdocs\typing-game\teste_joao\PGcadastro\cadastro.html">Não possuo conta</a>
                <input type="submit" value="Acessar" class="btn" />
            </form>
            <script src="login.js" defer></script>
    </main>
</body>

</html>