<?php

session_start();

include("../inc/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {   
    $acao = $_POST["acao"];

    if ($acao == "criar") {
        $clan_name = isset($_POST["clan_name"]) ? $_POST["clan_name"] : '';

        $sql = "INSERT INTO Clans (clan_id, clan_name) VALUES (NULL, '$clan_name')";
        if ($con->query($sql) === TRUE) {
            $clan_id = $con->insert_id;

            $user_id = $_SESSION["user_id"];
            $sqlUpdateUser = "UPDATE Users SET clan_id = $clan_id WHERE user_id = $user_id";
            $con->query($sqlUpdateUser);

            echo "Clã criado com sucesso!";
            header("Location: ger-clas.php"); 
            exit();
        } else {
            echo "Erro ao criar clã: " . $con->error;
        }
    } elseif ($acao == "entrar") {
        $idClanEscolhido = isset($_POST["id_clan"]) ? $_POST["id_clan"] : '';

        $user_id = $_SESSION["user_id"];
        $sqlUpdateUser = "UPDATE Users SET clan_id = $idClanEscolhido WHERE user_id = $user_id";
        $con->query($sqlUpdateUser);

        echo "Você se juntou a um clã!";
        header("Location: ger-clas.php"); 
        exit();
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
    </div>

    <div id="entrar-cla" style="display:none;">
        <label for="id_clan">Escolha um Clã:</label>
        <select name="id_clan">
            <?php
            include("../inc/connection.php"); 
            $sql = "SELECT * FROM Clans";
            $result = $con->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['clan_id'] . "'>" . $row['clan_name'] . "</option>";
            }
            $con->close();
            ?>
        </select>
    </div>

    <br>

    <input type="submit" value="Enviar">
</form>

</body>
</html>
