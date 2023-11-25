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
                header("Location: ger-clas.php");
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

<h2>Gerenciamento de Clãs</h2>

<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
    <label for="acao">Escolha uma ação:</label>
    <select name="acao" id="acao" onchange="toggleFields()">
        <option value="criar">Criar Clã</option>
        <option value="entrar">Entrar em Clã Existente</option>
    </select>

    <br>
    
    <div id="criar-cla" style="display:none;">
        <label for="clan_name">Nome do Clã:</label>
        <input type="text" name="clan_name">
        
        <label for="clan_password">Senha do Clã:</label>
        <input type="password" name="clan_password">
    </div>

    <div id="entrar-cla" style="display:none;">
        <label for="id_clan">Escolha um Clã:</label>
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
        </select>
        
        <label for="clan_password_entered">Senha do Clã:</label>
        <input type="password" name="clan_password_entered">
    </div>

    <br>

    <input type="submit" value="Enviar">
</form>

</body>
</html>
