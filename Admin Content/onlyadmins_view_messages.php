<?php
    session_start();
    if(!isset($_SESSION['logged_admin'] )){
        header('Location: login.php');
    }

    require_once '../db_connection.php';

          //Latest articles (5 max)
          if(!is_null($db_connection)){
            $statement = $db_connection->prepare('SELECT * FROM messages ORDER BY Date DESC');
            $statement->execute();
            $messages = $statement->fetchAll(PDO::FETCH_OBJ);
          }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap"
      rel="stylesheet"
    />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>View Messages</title>

    <link rel="stylesheet" href="../style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
  </head>
<body>
<nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
    <div class="container-fluid">
        <!--Main Logo-->
        <a class="navbar-brand" href="./index.php">The Daily Lorem</a>
        <!--Pata nahi kya hai-->
        <button
          class="navbar-toggler"
          type="button"
          data-bs-toggle="collapse"
          data-bs-target="#navbarSupportedContent"
          aria-
          controls="navbarSupportedContent"
          aria-expanded="false"
          aria-label="Toggle navigation"
        >
          <span class="navbar-toggler-icon"></span>
        </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li>
          <a class="nav-link" href = "onlyadmins.php">Create Post</a>
        </li>
        <li>
          <a class="nav-link" href = "onlyadmins_manage.php">Manage Content</a>
        </li>
      </ul>    
      </div> </div>
    </nav>
    <br><br><br>
    <h2>View messages sent by customers</h2>
    <table width = "100%" height = "50%" class = "admin_content">
        <?php foreach($messages as $key=>$message): ?>
          <form action = "" method = "POST">
        <tr>
            <td><?= $message->Date ?></td>
            <td><?= $message->email ?></td>
            <td><?= $message->message?></td>
        </tr>
        </form>
        <?php endforeach;?>
    </table>
</body>
</html>
