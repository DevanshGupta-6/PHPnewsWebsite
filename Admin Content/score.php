<?php
    session_start();
    if(!isset($_SESSION['logged_admin'] )){
    header('Location: login.php');
  }
    require_once '../db_connection.php';

    if(!is_null($db_connection)){
        $statement = $db_connection->prepare('SELECT * FROM scores');
        $statement->execute();
        $articles = $statement->fetchAll(PDO::FETCH_OBJ);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Simple user authentication check (you can improve this)
    
        $team1_score = (int)$_POST['team1_score'];
        $team2_score = (int)$_POST['team2_score'];
        
        $save_post = $db_connection->prepare("UPDATE scores SET St. Marys = $team1_score, St. Francis = $team2_score WHERE id = 1");
        echo json_encode(['status' => 'success']);
    }