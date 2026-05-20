<?php
  session_start();
  $errors = [];
  if(!isset($_SESSION['logged_admin'] )){
    header('Location: login.php');
  }
  function upload_image($image){
    $allowed_types = ['image/png', 'image/jpg', 'image/jpeg', 'image/avif'];

    if($image['error'] === 0){
      if(in_array($image['type'], $allowed_types)){

        $ext_token = explode('/', $image['type']);

        $file_new_name = 'news_'.microtime().'.'.$ext_token[1];
        if(move_uploaded_file($image['tmp_name'], '../images/'.$file_new_name )){
          return $file_new_name;
        }else{
          return false;
        }
      }else{
        return false;
      }
    }else{
      return false;
    }
  }
  if(isset($_POST) && count($_POST)> 0){
    $title = isset($_POST['title'])  && !empty($_POST['title']) && trim($_POST['title']) != '' ? htmlspecialchars($_POST['title']) : null;
    $description = isset($_POST['description'])  && !empty($_POST['description']) && trim($_POST['description']) != '' ? htmlspecialchars($_POST['description']) : null;
    $content = isset($_POST['content'])  && !empty($_POST['content']) && trim($_POST['content']) != '' ? htmlspecialchars($_POST['content']) : null;
    $cover_image = isset($_FILES['cover_image']) ? $_FILES['cover_image'] :null;
    $date = isset($_POST['Date'])  && !empty($_POST['Date']) && trim($_POST['Date']) != '' ? htmlspecialchars($_POST['Date']) : null;

    if(!is_null($title) && !is_null($description) && !is_null($content) && !is_null($cover_image)){
      if($file_name = upload_image($cover_image)){
        require_once '../db_connection.php';

        $save_post = $db_connection->prepare("INSERT INTO articles(title, cover, Date, description, content) VALUES(?, ?, ?, ?, ?)");

        try{
          $saved_post = $save_post->execute([$title, $file_name, $date, $description, $content]);
          if($saved_post){
            $success = 'New Post saved successfully!';
          }
        }catch(PDOException $e) {
            $errors[] = "An error occured when saving new post" . $e;
          
        }
        

        
      }else{
        $errors[] = 'Error uploading cover image';
      }
    }else{
      $errors[] = 'All the fields are required';
    }
  }

  
  ?>
<html>
  <head>
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@900&display=swap"
      rel="stylesheet"
    />
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>OnlyAdmins - The Daily Lorem</title>

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
          <a class="nav-link" href = "onlyadmins_manage.php">Manage content</a>
        </li>
        <li>
          <a class="nav-link" href = "onlyadmins_view_messages.php">View Messages</a>
        </li>
      </ul>    
      </div> </div>
    </nav>
    <style>
      body, input, button{
        margin: 1%;
      }
    </style>
    <br>
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
    
    <form action="" method = "post" enctype = "multipart/form-data">
      <div class = "container">
      <br>
        <h1>The Daily Lorem, Admin Workplace</h1><br>
      <h2>Post your News</h2>
      <div id = "col-lg-12">
        <input type = "text" name = "title" placeholder = "Title of News" style = "height: 40px; width: 500px;">
      </div>
        <div class = "col-lg-12">
          <p id="status"></p>
          <label for = "cover_image" style = "font-size: 1.5rem;">Post Cover Image</label>
          <input type = "file" name = "cover_image" id = "cover_image">
          <!--Image Preview from here-->
          <img id="output" style = "width: 200px; height: auto; ">
          <script>
      const status = document.getElementById('status');
      const output = document.getElementById('output');
      if (window.FileList && window.File && window.FileReader) {
        document.getElementById('cover_image').addEventListener('change', event => {
          output.src = '';
          status.textContent = '';
          const file = event.target.files[0];
          if (!file.type) {
            status.textContent = 'Error: The File.type property does not appear to be supported on this browser.';
            return;
          }
          if (!file.type.match('image.*')) {
            status.textContent = 'Error: The selected file does not appear to be an image.'
            return;
          }
          const reader = new FileReader();
          reader.addEventListener('load', event => {
            output.src = event.target.result;
          });
          reader.readAsDataURL(file);
        }); 
      }
    </script>
        </div>
      <div class = "col-lg-12">
        <h4>Article Description(Short)</h4>
          <input type = "text" style = "width: 500px" name = "description" placeholder = "Description">
        </div>
        <div class = "col-lg-12">
          <label for = "date">Date</label>
          <input type = "date" name = "Date">
        </div>
        <div class = "col-lg-12">
          <h4>The main content</h4>
          <textarea name = "content" style = "height: 350px; width: 1000px;"></textarea>
        </div>
        <div class = "col-lg-12">
      <button
      type="submit"
      class="btn btn-md btn-block btn-primary"
      style="width: 200px"
       >
      Submit
    </button>
    </form>
  </body>
</html>
