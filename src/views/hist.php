<?php 

session_start();

	include("../inc/connection.php");

    $points = $_POST['points'];
    $user_id = $_POST['user_id'];
    $match_id = $_POST['match_id'];
    
    
    $sql = "SELECT COUNT(*) as count FROM usuarios WHERE user_id = '$user_id'";
    $result = $conn->query($sql);
    
    if ($result && $result->fetch_assoc()['count'] > 0) {
        
        $sql_insert = "INSERT INTO Hist (match_id, user_id, points) VALUES ('$match_id', '$user_id', '$points')";
        
        if ($conn->query($sql_insert) === TRUE) {
            echo "Pontos salvos com sucesso!";
        } else {
            echo "Erro ao salvar pontos: " . $conn->error;
        }
    } else {
       
        echo "Erro: O user_id fornecido não é válido.";
    }
    
   
    $conn->close();

?>