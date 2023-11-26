<?php

session_start();

include("../inc/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    $acao = $_POST["acao"];

    if ($acao == "criar") {
        $clan_name = isset($_POST["clan_name"]) ? $_POST["clan_name"] : '';
        $clan_password = isset($_POST["clan_password"]) ? $_POST["clan_password"] : '';

        $sql = "INSERT INTO clans (clan_id, clan_name, clan_password) VALUES (NULL, '$clan_name', '$clan_password')";
        if ($con->query($sql) === TRUE) {
            $clan_id = $con->insert_id;

            $user_id = $_SESSION["user_id"];
            $sqlUpdateUser = "UPDATE users SET clan_id = $clan_id WHERE user_id = $user_id";
            $con->query($sqlUpdateUser);

            echo "Clã criado com sucesso!";
            header("Location: ger-clas.php"); 
            exit();
        } else {
            echo "Erro ao criar clã: " . $con->error;
        }
    } elseif ($acao == "entrar") {
        $idClanEscolhido = isset($_POST["id_clan"]) ? $_POST["id_clan"] : '';
        $clan_password_entered = isset($_POST["clan_password_entered"]) ? $_POST["clan_password_entered"] : '';
    
       
        $sqlCheckPassword = "SELECT clan_password FROM clans WHERE clan_id = $idClanEscolhido";
        $result = $con->query($sqlCheckPassword);
    
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $stored_password = $row["clan_password"];
    
            if ($clan_password_entered == $stored_password) {
                
                $user_id = $_SESSION["user_id"];
                $sqlUpdateUser = "UPDATE users SET clan_id = $idClanEscolhido WHERE user_id = $user_id";
                $con->query($sqlUpdateUser);
    
                echo "Você se juntou a um clã!";
                header("Location: ger-clans.php");
                exit();
            } else {
                echo "Senha incorreta. Tente novamente.";
            }
        }
    }
}
$con->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gerenciamento de Clãs</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/ger-clas.css">
    <script>
        function toggleFields() {
            var acao = document.getElementById("acao").value;
            var criarClaDiv = document.getElementById("criar-cla");
            var entrarClaDiv = document.getElementById("entrar-cla");
            if (acao === "criar") {
                criarClaDiv.style.display = "block";
                entrarClaDiv.style.display = "none";
            } else if (acao === "entrar") {
                criarClaDiv.style.display = "none";
                entrarClaDiv.style.display = "block";
            }
        }
    </script>
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
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" id="formLogin" class="formLogin">
                <h1>Gerenciamento de ligas</h1>
                <label for="acao" id="texto">Escolha uma ação:</label>                
                <select name="acao" id="acao" class="margin-left" onchange="toggleFields()">
                    <option value="criar">Criar liga</option>
                    <option value="entrar">Entrar em liga Existente</option>
                </select>
                <button type="button" class="btn" class="margin-left">Click Me!</button>
                <br>
                <div id="criar-cla" style="display:none;">
                <div>
                    <label for="clan_name">Nome da liga:</label><br>
                    <input type="text" name="clan_name">
                    </div>
                    <div>
                    <label for="clan_password">Senha da liga:</label><br>
                    <input type="password" name="clan_password">
                    </div>
                    <input type="submit" class="btn" class="margin-left" value="Click Me!">
                </div>
                <div id="entrar-cla" style="display:none;">
                    <label for="id_clan">Escolha uma liga:</label><br>
                    <select name="id_clan">
                        <?php
                        include("../inc/connection.php"); 
                        $sql = "SELECT * FROM clans";
                        $result = $con->query($sql);
                        while ($row = $result->fetch_assoc()) {
                            echo "<option value='" . $row['clan_id'] . "'>" . $row['clan_name'] . "</option>";
                        }
                        $con->close();
                        ?>
                    </select><br>
                    <label for="clan_password_entered">Senha da liga:</label><br>
                    <input type="password" name="clan_password_entered"><br>
                    <input type="submit" class="btn" class="margin-left" value="Click Me!">
                </div>
                <br>
                </div>
            </form>
        </div>
    </main>
</body>
</html>
