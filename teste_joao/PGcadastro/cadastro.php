<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>
    <link rel="stylesheet" href="cadastro.css">
</head>

<body>
    <div class="page">
        <form method="POST" class="formLogin" id="formLogin">
            <h1 id="top">Cadastro</h1>

            <label for="username">Nome de usuario</label>
            <input type="text" placeholder="Digite seu Username" autofocus="true" id="username" />
            <div id="errorusername" class="error"></div>

            <label for="email1">Email</label>
            <input type="email" placeholder="Digite seu Email" autofocus="true" id="email1" />
            <div id="erroremail1" class="error"></div>

            <label for="email2">Confirme seu Email</label>
            <input type="email" placeholder="Confirme seu Email" autofocus="true" id="email2" />
            <div id="erroremail2" class="error"></div>

            <label for="password1">Senha</label>
            <input type="password" placeholder="Digite sua senha" id="password1" />
            <div id="errorpassword1" class="error"></div>

            <label for="password2">Confirme sua senha</label>
            <input type="password" placeholder="Confirme sua senha" id="password2" />
            <div id="errorpassword2" class="error"></div>
            
            <input type="submit" value="ENVIAR" class="btn" id="enviar" />
        </form>
    </div>
    <script src="cadastro.js" defer></script>
</body>

</html>
