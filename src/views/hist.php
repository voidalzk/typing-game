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
    <title>Histórico do Usuário</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>

<h2>Histórico do Usuário</h2>

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

echo "<p>Pontuação Semanal: $weeklyScore</p>";
echo "<p>Pontuação Total: $totalScore</p>";
echo "<p>Maior Pontuação Atiginda: $highestScore</p>";

$sql = "SELECT * FROM historic WHERE user_id = '$user_id'";
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

</body>
</html>
