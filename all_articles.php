<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];
    
  }
    ?>
<!doctype html>
<html lang="en">
  <head>
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap"
      rel="stylesheet"
    />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>PHP News Website</title>

    <link rel="stylesheet" href="../style.css" /><!--Credits to Om Nigam for the fix -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <script src="script.js"></script>
    <?php

          require_once 'db_connection.php';

          //Latest articles (5 max)
          if(!is_null($db_connection)){
            $statement = $db_connection->prepare('SELECT * FROM articles ORDER BY Date DESC');
            $statement->execute();
            $articles = $statement->fetchAll(PDO::FETCH_OBJ);
          }

          $nDate = date("Y-m-d");

          $textmonth = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
          $nyear = substr($nDate, 0, 4);
          $nmonth = substr($nDate, 5, 2);
          $navdate = substr($nDate, 8, 4);

          if($navdate == 1 || $navdate == 21 || $navdate == 31)
            $ith = "st";
          else if($navdate == 2 || $navdate == 22)
            $ith = "nd";
          else if ($navdate == 3 || $navdate == 23)
            $ith = "rd";
          else
            $ith = "th";

          $nfulldate = date("l").", ".ltrim($navdate, 0).$ith." ".$textmonth[$nmonth - 1].", ".$nyear;
          ?>
  </head>
  <body>
    <!-- Pata nahi isko write() naam se kya dushmani hai? -->

    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
    <!--navbar lol-->
    <nav class="navbar navbar-expand-lg bg-dark navbar-dark fixed-top">
      <div class="container-fluid">
        <!--Main Logo-->
        <a class="navbar-brand" href="index.php">The Daily Lorem</a>
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

        <!--Navbar ke buttons-->
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <!--Home-->
            <li class="nav-item">
              <a class="nav-link" aria-current="page" href="index.php#home">Home</a>
            </li>
            <!--About Us-->
            <li class="nav-item">
              <a class="nav-link" href="../AboutUs.php">About Us</a>
            </li>
            <li class="nav-item">
              <a
                class="nav-link"
                href="all_articles.php"
              >
                Articles
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" aria-current = "page" href = "index.php#contact">Contact Us</a>
            </li>
          </ul>
          <form class="d-flex" action = "../search.php" method = "post" enctype = "multipart/form-data">
          
            <input
              class="form-control me-2"
              type="search"
              name="search"
              placeholder="Search"
              aria-label="Search"
            />
            
            <button class="btn btn-outline-success" type="submit">
              Search
            </button>
            
          </form>
        </div>
      </div>
    </nav>
    <nav
      class="navbar second-navbar fixed-top navbar-expand-sm navbar-light bg-dark navbar-dark"
    >
      <p id="dates"><?= $nfulldate ?></p>
    </nav>
        <br><br><br><br><br>
        <div class="container border">
        <h1 style = "font-size: 450%; text-decoration: underline;">All News</h1>
          <!-- Yaha se saari news -->
         <?php foreach ($articles as $key => $article):
           $textmonth = array("January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December");
           $year = substr($article->Date, 0, 4);
           $month = substr($article->Date, 5, 2);
           $date = substr($article->Date, 8, 4);
 
           if($date == 1 || $date == 21 || $date == 31)
             $ith = "st";
           else if($date == 2 || $date == 22)
             $ith = "nd";
           else if ($date == 3 || $date == 23)
             $ith = "rd";
           else
             $ith = "th";
 
           $fulldate = ltrim($date, 0).$ith." ".$textmonth[$month - 1].", ".$year; 
         ?> 
          <div class="col-lg-12">
            <div class="card">
              <div class="card-header">
                <h3><img src = "./images/<?= $article->cover?>" style = "margin:2rem; border: 0.25rem solid #000000;" class = "img-fluid"><a href = "article.php?id=<?= $article->id?>" class = "title"><?= $article->title ?></a></h3>
              </div>
            <div class="card-body">
              <p class="date"><?= $article->Date?></p>
              <p class="content"><b>By: Author</b></p>
              <p class="content">
              <?= $article->description ?>
              </p>
            </div>
          </div>
          <?php endforeach;?>
        </div>
        
        </div>
    
    <center>
      <footer id="footer">
        <p>
          Copyright ©Lorem 2024-25. </p>
      </footer>
    </center>
  </body>
</html>