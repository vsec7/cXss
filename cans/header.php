<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="theme-color" content="#000">
    <title>cXss</title>

    <link href="../assets/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/bootstrap4-neon-glow.min.css">
    <link rel="shortcut icon" type="image/png" href="../assets/images/bug.png"/>
  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-<?=$warna;?> fixed-top">
      <div class="container">
        <a class="navbar-brand" href="index.php"><span class="fa fa-bug">cXss</span></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="#">Captured : <?=$t;?>
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="payload.php">Payload</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="?logout">Logout</a>
            </li>                        
          </ul>
        </div>
      </div>
    </nav>

    <br>
    <hr>
    <br>
