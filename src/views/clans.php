<?php

session_start();

include("../inc/connection.php");

$user_id = $_SESSION["user_id"];
$sqlClanInfo = "SELECT c.clan_name, u.username FROM Clans c INNER JOIN Users u ON c.clan_id = u.clan_id WHERE u.user_id = $user_id";
$resultClanInfo = $con->query($sqlClanInfo);

$sqlClanMembers = "SELECT u.username, COALESCE(SUM(h.points), 0) as total_points 
                   FROM Users u 
                   LEFT JOIN historic h ON u.user_id = h.user_id 
                   WHERE u.clan_id = (SELECT clan_id FROM Users WHERE user_id = $user_id)
                   GROUP BY u.user_id";
$resultClanMembers = $con->query($sqlClanMembers);

$sqlClanWeeklyPoints = "SELECT COALESCE(SUM(points), 0) as weekly_points 
                        FROM historic 
                        WHERE user_id IN (SELECT user_id FROM Users WHERE clan_id = (SELECT clan_id FROM Users WHERE user_id = $user_id))
                        AND date_match >= NOW() - INTERVAL 7 DAY"; // Substitua 'date_match' pelo nome correto da coluna que armazena a data
$resultClanWeeklyPoints = $con->query($sqlClanWeeklyPoints);
$weeklyPoints = $resultClanWeeklyPoints->fetch_assoc()['weekly_points'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="clan.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Clãs</title>

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
                    <li><a href="/typing-game/teste_joao\PGjogo\jogo.php" class="nav-link px-2 text-white">Voltar ao
                            Jogo</a></li>
                </ul>
                <div class="text-end">
                    <a href=""><button type="button" class="btn btn-warning">Logout</button></a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div id="conteudo">
            <div id="estou">
                <h1>Clã em que estou</h1>
                <ul>
                <?php
                    if ($resultClanInfo->num_rows > 0) {
                        $rowClanInfo = $resultClanInfo->fetch_assoc();
                        echo "<li>{$rowClanInfo['clan_name']}</li>";
                    } else {
                        echo "<li>Não pertence a nenhuma guilda</li>";
                    }
                    ?>
                    
                </ul>

            </div>
            <div id="existente">
                <h1>Clãs existentes </h1>
                <ul>
                <?php
                    
                    $sqlOtherGuilds = "SELECT clan_name FROM Clans WHERE clan_id NOT IN (SELECT DISTINCT clan_id FROM Users)";
                    $resultOtherGuilds = $con->query($sqlOtherGuilds);

                    while ($rowOtherGuilds = $resultOtherGuilds->fetch_assoc()) {
                        echo "<li>{$rowOtherGuilds['clan_name']}</li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
        <div id="conteudo-right">
            <div id="melhor_guild">
                <h1>Membros do Clã</h1>
                <ul>
                <?php
                if ($resultClanMembers->num_rows > 0) {
                    while ($rowClanMembers = $resultClanMembers->fetch_assoc()) {
                        $username = $rowClanMembers['username'];
                        $totalPoints = $rowClanMembers['total_points'];
                        echo "<li>$username - Pontuação Acumulativa: $totalPoints</li>";
                    }
                } else {
                    echo "<li>Nenhum membro no clã</li>";
                }
            ?>
                </ul>
            </div>

        </div>

        <div id="pontuacao-semanal">
            <h1>Pontuação Semanal do Clã</h1>
            <p>Pontuação Total Semanal: <?php echo $weeklyPoints; ?></p>
        </div>
    </div>
    </main>
</body>
</html>