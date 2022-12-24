<?php require("server.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Forgot Password</title>

  <!-- Compiled and minified CSS -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800" rel="stylesheet">  

  <!-- Custom Style -->
  <link rel="stylesheet" href="assets/css/main.min.css">

  <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
  <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
  <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
  <link rel="manifest" href="favicon/site.webmanifest">
</head>
<body>
  <header>
    <div class="row parent-row">
      <!-- Image -->
      <div class="col s1 l7 hide-on-med-and-down">
        <div class="flex-v-center">
          
        </div>
      </div>
      <!-- Form -->
      <div class="col s12 l5">
        <div class="center-align form-align">
            <h4> Email Verify </h4>
          <div class="row">
            <form action="" method="POST" autocomplete="off" class="col s12">
              <?php include("errors.php") ?>
              <div class="row flex-h-center mb-0">
                <div class="input-field col s8">
                  <input type="text" name="email_id" id="email">
                  <label for="email_id">Enter your email</label>
                </div>
              </div>  
              <button type="submit" name="email_verify" class="waves-effect waves-light btn">OK</button>
            </form>
          </div>
        </div>
      </div>
    </div>

  </header>
    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <script src="assets/js/main.js"></script>
</body>
</html>