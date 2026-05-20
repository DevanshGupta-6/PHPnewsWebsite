<?php 
   
    $db_host = '(Write ur host name here)';
    $db_name = '(Write name of database here)';
    $db_username = '(Write your username here)';
    $db_password = '(Write password here)';
    $dsn = 'mysql:dbname='. $db_name.';host='.$db_host;

    $db_connection = new PDO($dsn, $db_username, $db_password);

    $pdo_options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
    ];