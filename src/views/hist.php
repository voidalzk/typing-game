<?php
session_start();
include("../inc/connection.php");


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matchResult'])) {
    $points = $_POST['matchResult'];
    $user_id = $_POST['user_id'];
    $match_id = $_POST['match_id'];

    $sql = "SELECT COUNT(*) as count FROM usuarios WHERE user_id = '$user_id'";
    $result = $con->query($sql);

    if ($result && $result->fetch_assoc()['count'] > 0) {
        $sql_insert = "INSERT INTO historic (match_id, user_id, points) VALUES ('$match_id', '$user_id', '$points')";
        $con->query($sql_insert);
    }
}

$con->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/hist.css">
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
                    <a href="logout.php"><button type="button" class="btn btn-warning">Logout</button></a>
                </div>
            </div>
        </div>
    </header>
    <main>
        <h2>Histórico de partidas</h2>
        <div class="results">
            <?php
            include("../inc/connection.php");

            if (!isset($_SESSION['user_id'])) {
                header("Location: login.php");
                exit();
            }

            $user_id = $_SESSION['user_id'];


            $currentDate = date("Y-m-d");
            $weekStartDate = date("Y-m-d", strtotime('last Monday', strtotime($currentDate)));
            $sqlWeeklyScore = "SELECT SUM(points) as weeklyScore FROM historic WHERE user_id = '$user_id' AND date_match >= '$weekStartDate'";
            $resultWeeklyScore = $con->query($sqlWeeklyScore);
            $weeklyScore = $resultWeeklyScore->fetch_assoc()['weeklyScore'];


            $sqlTotalScore = "SELECT SUM(points) as totalScore FROM historic WHERE user_id = '$user_id'";
            $resultTotalScore = $con->query($sqlTotalScore);
            $totalScore = $resultTotalScore->fetch_assoc()['totalScore'];


            $sqlHighestScore = "SELECT MAX(points) as highestScore FROM historic WHERE user_id = '$user_id'";
            $resultHighestScore = $con->query($sqlHighestScore);
            $highestScore = $resultHighestScore->fetch_assoc()['highestScore'];
            echo "<div class='HeaderResults'>";
            echo "<h3>Pontuação Semanal: $weeklyScore</h3>";
            echo "<h3>Pontuação Total: $totalScore</h3>";
            echo "<h3>Maior Pontuação Atiginda: $highestScore</h3></div>";
            ?>
            <div class="form">
                <form method="post" action="">
                    <label for="order_by">Ordenar por:</label>
                    <select name="order_by" id="order_by">
                        <option value="date_match">Data</option>
                        <option value="points">Pontuação</option>
                    </select>
                    <label for="order_type">Tipo de ordenação:</label>
                    <select name="order_type" id="order_type">
                        <option value="desc">Descendente</option>
                        <option value="asc">Ascendente</option>
                    </select>
                    <button type="submit">Ordenar</button>
                </form>
            </div>
            <?php
            $sql = "SELECT * FROM historic WHERE user_id = '$user_id'";
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $order_by = $_POST['order_by'];
                $order_type = $_POST['order_type'];
                $sql = "SELECT * FROM historic WHERE user_id = '$user_id' ORDER BY $order_by $order_type";
            }
            $result = $con->query($sql);

            if ($result && $result->num_rows > 0) {
                echo "<table>";
                echo "<tr><th>Match ID</th><th>Pontos</th><th>Data do Jogo</th></tr>";

                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row['match_id'] . "</td>";
                    echo "<td>" . $row['points'] . "</td>";
                    echo "<td>" . $row['date_match'] . "</td>";
                    echo "</tr>";
                }

                echo "</table>";
            } else {
                echo "<p>Nenhum histórico disponível.</p>";
            }

            $con->close();
            ?>
        </div>
    </main>
</body>

</html>