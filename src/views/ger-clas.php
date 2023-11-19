<?php

session_start();

    include("../inc/connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {   
        $acao = $_POST["acao"];

        if ($acao == "criar") {
            $clan_name = $_POST["clan_name"];
            $clan_id = $_POST["clan_id"];

            
            $sql = "INSERT INTO Clans (clan_id, clan_name) VALUES ('$clan_id', '$clan_name')";
            if ($conn->query($sql) === TRUE) {
                $clan_id = $conn->insert_id;

                $user_id = $_SESSION["user_id"];
                $sqlUpdateUser = "UPDATE Users SET clan_id = $clan_id WHERE id = $user_id";
                $conn->query($sqlUpdateUser);

                echo "Clã criado com sucesso!";
            } else {
                echo "Erro ao criar clã: " . $conn->error;
            }
        } elseif ($acao == "entrar") {
            $idClanEscolhido = $_POST["id_clan"];

            $user_id = $_SESSION["user_id"];
            $sqlUpdateUser = "UPDATE usuarios SET clan_id = $idClanEscolhido WHERE id = $user_id";
            $conn->query($sqlUpdateUser);

            echo "Você se juntou a um clã!";
        }
    }
    $conn->close();
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
    <select name="acao" id="acao">
        <option value="criar">Criar Clã</option>
        <option value="entrar">Entrar em Clã Existente</option>
    </select>

    <br>
    
    <div id="criar-cla" style="display:none;">
        <label for="nome_clan">Nome do Clã:</label>
        <input type="text" name="nome_clan">


    </div>

   
    <div id="entrar-cla" style="display:none;">
        <label for="id_clan">Escolha um Clã:</label>
        <select name="id_clan">
            <?php
            $sql = "SELECT * FROM Clans";
            $result = $conn->query($sql);

            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['id_clan'] . "'>" . $row['nome_clan'] . "</option>";
            }
            ?>
        </select>
    </div>

    <br>

    <input type="submit" value="Enviar">
</form>

</body>
</html>