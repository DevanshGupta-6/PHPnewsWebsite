<?php
    session_start();
    if(!isset($_SESSION['logged_admin'] )){
      header('Location: login.php');
    }
    require_once '../db_connection.php';
    //Get the article ID
    $article_id = (int)$_GET['id'];
    
    if(!isset($_GET['id'])){
        echo 'The content you are looking for is not available.';
        header('onlyadmins.php');
    }
    

    //Get that article
    if(!is_null($db_connection)){
      $delete = $db_connection->prepare('DELETE FROM articles WHERE id = ? ');
      
      try{
        $deleted = $delete->execute([$article_id]);
        if($deleted){
            echo 'Article Deleted successfully';
            exit();
        }else{
            echo 'Could not delete';
            exit();
        }
      }catch(PDOException $e){
        echo 'Error'.$e->getMessage();
      }
    }