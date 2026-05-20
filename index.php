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
    <script src="https://kit.fontawesome.com/94cfaa2a16.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../style.css" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <?php

          require_once 'db_connection.php';
          
          //Latest articles (5 max)
          if(!is_null($db_connection)){
            $statement = $db_connection->prepare('SELECT * FROM articles ORDER BY Date DESC LIMIT 3');
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
          <style>
				      /* Additional styles for dark mode */
				      body.dark-mode {
				      		background-color: #343a40;
				      		color: white;
				      }

				      .card.dark-mode {
				      		background-color: #495057;
				      		border-color: #6c757d;
				      }
		      </style>
  </head>
  <body>
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
              <a class="nav-link" aria-current="page" href="#home">Home</a>
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
              <a class="nav-link" aria-current = "page" href = "#contact">Contact Us</a>
            </li>
            
          </ul>
          <label class="switch">
      
      <input type="checkbox" id="toggle-mode" onclick="myFunction()">
      <span class="slider round" style = "z-index: 0;"><i class="fa-regular fa-sun" style = "color: black; padding: 0.1rem; font-size: 19px;"></i><i class="fa-regular fa-moon" style = "color: black; padding: 0.5rem; font-size: 19px;"></i></span>
    </label>
          <form class="d-flex" action = "../search.php" method = "post">
          
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
      <p id="dates"><?= $nfulldate?></p>
    </nav>
      <section id="home">
        <br><br><br><br><br>
        <div class="container border">
          <h1 style = "font-size: 450%; text-decoration: underline;">Latest News</h1>
          <!-- Yaha se saari news -->
         <?php foreach ($articles as $key => $article):
           //Change date format
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
            <div class="card" id = "news">
              <div class="card-header">
                <h3 class = "card-title"><img src = "./images/<?= $article->cover?>" style = "margin:2rem; border: 0.25rem solid #000000; width: 200px" class="img-fluid"><br><a href = "article.php?id=<?= $article->id?>" class="title"><?= $article->title ?></a></h3>
                
              </div>
            <div class="card-body">
              <p class="date"><?= $fulldate?></p>
              <p class="content"><b>By: Author</b></p>
              <p class="content">
              <?= $article->description ?>
              </p>
            </div>
          </div>
          <?php endforeach;?>
        </div>
        
        </div>
      </section>

    <!-- Contact Us (Stop stalking me)-->
    <?php
    $errors = [];
    if(isset($_POST) && count($_POST) > 0){
      $email = isset($_POST['email'])  && !empty($_POST['email']) && trim($_POST['email']) != '' ? htmlspecialchars($_POST['email']) : null;
      $message = isset($_POST['message'])  && !empty($_POST['message']) && trim($_POST['message']) != '' ? htmlspecialchars($_POST['message']) : null;
      $date = date('y-m-d');

      if(!is_null($email) && !is_null($message)){
        require_once 'db_connection.php';

        $save_message = $db_connection->prepare('INSERT INTO messages(Date, email, message) VALUES (?, ?, ?)');

        try{
          $saved_message = $save_message->execute([$date, $email, $message]);
          if($saved_message){
            $success = 'Message sent successfully!';
          }
        }catch(PDOException $e){
          $errors[] = "An error occured when messaging" . $e;
        }
      }else{
        $errors[] = 'All fields are required';
      }
    }
    ?>
    <section id="contact">
      <div class="container-fluid">
        <h1>Contact Us</h1>
        <p>
          Do you have any questions? Please do not hesitate to contact us
          directly. Our team will be happy to help you.
        </p>
        <form action="" method = "post" enctype = "multipart/form-data">
         <div class="row" style="padding: 6%">
            <div class="col-lg-5">
              <input
              type="email"
              placeholder="Enter your Email"
              name = "email"
              id="Email"
              class="form-control"
             />
            </div>

          <div class="col-lg-5">
            <input
              type="text"
              id="Message"
              name = "message"
              placeholder="Enter your Message"
              class="form-control"
            />
          </div>
          <div class="col-lg-2">
            <button
              type="submit"
              onclick=""
              class="btn btn-md btn-block btn-primary"
              style="width: 200px"
            >
              Send
            </button>
          </div>
          <?php if(isset($errors) && count($errors)> 0): ?>
      <ul style = "padding:1rem; margin: 0; margin-bottom: 1rem; color: red;">
    <?php foreach($errors as $error) : ?>
      <li><?= $error ?></li>
    <?php endforeach ?>
    </ul>
    <?php endif ?>

    <?php if(isset($success)): ?>
      <p style = "padding:1rem; margin: 0; margin-bottom: 1rem; color: limegreen;">
      <?= $success ?>
    
    </p>
    <?php endif ?>
          </div>
        </form>
      </div>
    </section>
    <center>
      <footer id="footer">
        <p>
          Copyright ©Lorem 2024-25. </p>
      </footer>
    </center>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
		<script>
				$(document).ready(function() {
						$('#toggle-mode').click(function() {
								$('body').toggleClass('dark-mode');
								$('.card').toggleClass('dark-mode');
								const isDarkMode = $('body').hasClass('dark-mode');
								$('#theme-style').attr('href', isDarkMode ? 'style2.css' : 'style.css');
						});
				});
		</script>
  </body>
</html>
