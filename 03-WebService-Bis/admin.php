<?php
require_once('functions.php');
$user_cookie = "";
$user = "";
  if(isset($_COOKIE["auth"])) {
  $user_cookie =  $_COOKIE["auth"];
  $user = decrypt($user_cookie); 
    if (isValid($user)){
      if (strcmp($user,"admin") != 0){
        header("Location: welcome.php");
        die();
      }
    }
  }
  else{
     header("Location: index.php");
  }
?>

<!doctype html>

<html lang="fr">
<head>
  <meta charset="utf-8">

  <title>The HTML5 Herald</title>
  <meta name="description" content="Dr Horrible's Bomb Challenge">
  <meta name="author" content="Dr Horrible">

  <link rel="stylesheet" href="style.css">
  <!--[if lt IE 9]>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
  <![endif]-->
</head>

<body>
  <header>
  </header>
<div id="video-fond">
  <video height=100 width=100 autoplay loop src="video.mp4" type="video/mp4">
</video>
</div>
<div id="dessus">
<span id="compteur">TEST 
</span>
</div>
  <script src="script.js"></script>
</body>
</html>
