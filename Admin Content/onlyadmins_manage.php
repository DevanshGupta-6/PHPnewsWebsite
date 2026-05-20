<?php
    session_start();
    if(!isset($_SESSION['logged_admin'] )){
        header('Location: login.php');
    }

    require_once '../db_connection.php';

          //Latest articles (5 max)
          if(!is_null($db_connection)){
            $statement = $db_connection->prepare('SELECT * FROM articles ORDER BY Date DESC');
            $statement->execute();
            $articles = $statement->fetchAll(PDO::FETCH_OBJ);
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
    <title>Admin Page - The Daily Lorem</title>

    <link rel="stylesheet" href="../style.css" /><!--Credits to Om Nigam for the fix -->
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
          <a class="nav-link" href = "onlyadmins_view_messages.php">View Messages</a>
        </li>
      </ul>    
      </div> </div>
    </nav>
    <br><br><br>
    <h2>Edit, delete or change articles</h2>
    <table width = "100%" height = "50%" class = "admin_content">
        <?php foreach($articles as $key=>$article): ?>
          <form action = "" method = "POST">
        <tr>
            <td><a href = "../article.php?id=<?= $article->id?>"><?= $article->title ?></a></td>
            <td><?= $article->Date ?></td>
            <td><a href = "article_edit.php?id=<?= $article->id?>">Edit</a></td>
            <td><a  onclick = "return confirm('Are You sure about that?')" href = "onlyadmins_delete.php?id=<?=$article->id ?>"><input type = "hidden" value = "Delete">Delete</a></td>
        </tr>
        </form>
        <?php endforeach;?>
    </table>
</body>
</html>