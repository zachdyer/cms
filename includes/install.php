<?php
if(isset($_POST['password']) && isset($_POST['email'])) {
  install();
} 
?><!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Install Website</title>

    <!-- Bootstrap core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- fontawesome -->
    <link href="https://use.fontawesome.com/releases/v5.0.8/css/all.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="/css/simple-sidebar.css" rel="stylesheet">

</head>

<body>
  
<div class="container">
    <div class="card mt-5 mx-auto" style="max-width: 23rem;">
      <div class="card-header text-white bg-primary">
        Install Website
      </div>
      <div class="card-body">
        <form action="/index.php" method="post">
          <div class="form-group">
            <label for="title">Site Title</label>
            <input type="text" class="form-control" id="title" placeholder="Title" name="title">
          </div>
          <div class="form-group">
            <label for="password">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Email" name="email">
          </div>
          <div class="form-group">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Password" name="password">
          </div>
          <button type="submit" class="btn btn-primary">Install</button>
        </form>
      </div>
    </div>
</div><!-- /container -->
  
<!-- Bootstrap core JavaScript -->
<script src="/vendor/jquery/jquery.min.js"></script>
<script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

</body>

</html>