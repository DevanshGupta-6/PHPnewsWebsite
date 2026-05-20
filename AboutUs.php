<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $search = $_POST['search'];
    
  }
    ?>
<?php
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

<html>
  <head>
    <title>About Us</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
      crossorigin="anonymous"
    ></script>
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
              <a class="nav-link" aria-current="page" href="../index.php">Home</a>
            </li>
            <!--About Us-->
            <li class="nav-item">
              <a class="nav-link" href="AboutUs.php">About Us</a>
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
              <a class="nav-link" aria-current = "page" href = "../index.php#contact">Contact Us</a>
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
    <nav class="navbar second-navbar fixed-top navbar-expand-sm navbar-light bg-dark navbar-dark"><p id="dates"><?= $nfulldate?></p></nav>
    <br><br><br><br><br>
    <script src = "script.js"></script>
    <section id = "home">
    <div class = "conatiner-fluid">
      <div class = "col-lg-12">
        <div class = "card">
          <div class = "card-header">
    <h1>About Us</h1>
          </div>
          <div class = "card-body">
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nobis corrupti voluptas earum quas debitis rerum quae eum a ipsa. Nesciunt enim cumque excepturi ratione debitis alias at expedita ipsa aliquid praesentium et vel, ad asperiores vero maiores esse! Doloremque perferendis provident nam eum odio aperiam numquam reprehenderit, commodi ratione sequi aut, corporis perspiciatis! Minus est possimus soluta rem quo aliquid!
    </p>
    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, rerum at. Pariatur, doloribus! Totam corrupti minus fuga ratione necessitatibus ut cupiditate adipisci temporibus cum laboriosam dignissimos molestias veniam, labore ex. Non eum excepturi nisi voluptatem! Numquam qui quam, debitis minima aliquid nostrum. At perspiciatis id facere laborum. Nihil maxime ut cumque doloribus vel cum animi nisi atque recusandae ratione. Error.</p>    
  </body>
</div>
 </div>
    </div>
  </div>
  </section>

    <section id = "contact-us">
      
    </section>
    <footer id = "footer">
      Copyright ©Lorem 2024-25
    </footer>
  </body>
  
  
</html>