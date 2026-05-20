<?php
  session_start();
  if(isset($_SESSION['logged_admin']) ){
    header('Location: onlyadmins.php');
  }
  if(isset($_POST) && count($_POST)> 0){
    require_once("../db_connection.php");

    $email = strtoLower($_POST["email"]);
    $password = $_POST["password"];
    //Create variables for the form fields
    $empty_email = "";
    $empty_password = "";
    //check if fields are not empty
    if(empty($email) || trim($email) == ""){
      $empty_email = 'Email must not be empty';
    }

    if(empty($password) || trim($password) == ""){
      $empty_password = 'Password must not be empty';
    }
    if(empty($empty_email) && empty($empty_password)){
      $get_admin_stmt = $db_connection->prepare('SELECT * From admins WHERE email = ?');

      $get_admin_stmt->execute(array($email));

      $admin = $get_admin_stmt->fetch(PDO::FETCH_OBJ);

      if($admin){
        if(password_verify($password, $admin->password)){
          $_SESSION['logged_admin'] = $admin;

          header('Location: onlyadmins.php');
        }else{
          $invalid_password = 'Invalid Credentials';
        }
      }
      
    }
  }
?>
<!DOCTYPE html>
<html>
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
    <script>
      function show() {
  var x = document.getElementById("password");
  if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
    </script>
  </head>
  <body>
    <br><br><br><br><br>
    <h1><b>Login</b></h1>
    <br><br>
    <div id = "container">
      <div id = "col-lg-5">
      <form action = "" method = "post" class = "signin">
    <input type = "email" name = "email" placeholder = "you@gmail.com" style = "width: 350px; height: 40px">
    <p><small> <?= isset($empty_email) ? '- '. $empty_email : null ?></small></p>
    <br><br>
    <input type = "password" name = "password" placeholder = "password" style = "width: 350px; height: 40px" id = "password"><br>
    <input type = "checkbox" onclick = "show()" style = "text-align: left !important;"> Show Password
    <p><small> <?= isset($empty_password) ? '- '. $empty_password : null ?></small></p>
    <p><small> <?= isset($invalid_password) ? '- '. $invalid_password : null ?></small></p>
    
    <br><br>
    <button
      class="btn btn-md btn-block btn-primary"
      style="width: 200px"
    >
      Sign In
      </button>
      </div>
    </form>
    </div>

  </body>
</html>