<?php
session_start();
include("../inc/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['matchResult'])) {
    $points = $_POST['matchResult'];
    $user_id = $_POST['user_id'];
    $match_id = $_POST['match_id'];

    $sql = "SELECT COUNT(*) as count FROM users WHERE user_id = '$user_id'";
    $result = $con->query($sql);

    if ($result && $result->fetch_assoc()['count'] > 0) {
        $sql_insert = "INSERT INTO historic (match_id, user_id, points) VALUES ('$match_id', '$user_id', '$points')";
        $con->query($sql_insert);
    }
}
?>

<table>
    <thead>
        <tr>
            <th>Points</th>
            <th>Date</th>
            <th>Username</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result_select->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['points']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['username']; ?></td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<?php
$con->close();
?>

