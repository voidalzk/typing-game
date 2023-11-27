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
                   GROUP BY u.user_id
                   ORDER BY total_points DESC";
$resultClanMembers = $con->query($sqlClanMembers);

$sqlTotalClanPoints = "SELECT COALESCE(SUM(h.points), 0) as total_clan_points 
                       FROM Users u 
                       LEFT JOIN historic h ON u.user_id = h.user_id 
                       WHERE u.clan_id = (SELECT clan_id FROM Users WHERE user_id = $user_id)";
$resultTotalClanPoints = $con->query($sqlTotalClanPoints);
$totalClanPoints = $resultTotalClanPoints->fetch_assoc()['total_clan_points'];


$sqlClanWeeklyPoints = "SELECT COALESCE(SUM(points), 0) as weekly_points 
                        FROM historic 
                        WHERE user_id IN (SELECT user_id FROM Users WHERE clan_id = (SELECT clan_id FROM Users WHERE user_id = $user_id))
                        AND date_match >= NOW() - INTERVAL 7 DAY";
$resultClanWeeklyPoints = $con->query($sqlClanWeeklyPoints);
$weeklyPoints = $resultClanWeeklyPoints->fetch_assoc()['weekly_points'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/clans.css">
    <title>Ligas</title>
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
                    <a href=""><button type="button" class="btn btn-warning">Logout</button></a>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div id="content-left">
            <div class="headerLiga">
                <div id="Actual" class="DivsLeft">
                    <h1>Liga em que estou</h1>
                    <?php
                    if ($resultClanInfo->num_rows > 0) {
                        $rowClanInfo = $resultClanInfo->fetch_assoc();
                        echo "<h3>{$rowClanInfo['clan_name']}</h3>";
                    } else {
                        echo "<h3>Não pertence a nenhuma guilda</h3>";
                    }
                    ?>
                </div>
                <div id="pontuacao-semanal" class="DivsLeft">
                    <h1>Pontuação Semanal da Liga</h1>
                    <p>Pontuação Total Semanal: <?php echo $weeklyPoints; ?></p>
                </div>
            </div>
            <div id="melhor_guild">
                <h1>Membros da Liga</h1>
                <p>Total Pontuação da Liga: <?php echo $totalClanPoints; ?></p>

                <table>
                    <tr>
                        <th>Username</th>
                        <th>Pontuação</th>
                    </tr>
                    <?php
                    if ($resultClanMembers->num_rows > 0) {
                        while ($rowClanMembers = $resultClanMembers->fetch_assoc()) {
                            $username = $rowClanMembers['username'];
                            $totalPoints = $rowClanMembers['total_points'];
                            echo "<tr>";
                            echo "<td>$username</td>";
                            echo "<td>Pontuação Acumulativa: $totalPoints</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='2'>Nenhum membro no clã</td></tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        <div id="content-right">
            <div id="Others">
                <h1>Ligas existentes </h1>
                <table>
                    <tr>
                        <th>Nome</th>
                    </tr>
                    <?php
                    $sqlOtherGuilds = "SELECT clan_name FROM Clans";
                    $resultOtherGuilds = $con->query($sqlOtherGuilds);

                    while ($rowOtherGuilds = $resultOtherGuilds->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>{$rowOtherGuilds['clan_name']}</td>\n\n";
                        echo "<tr>";
                    }
                    ?>
                </table>
            </div>
        </div>
        </div>
        </div>
    </main>
</body>

</html>