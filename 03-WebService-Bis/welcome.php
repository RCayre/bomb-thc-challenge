<?php
require_once('functions.php');

$user_cookie = "";
$user = "";
  if(isset($_COOKIE["auth"])) {
  $user_cookie =  $_COOKIE["auth"];
  $user = decrypt($user_cookie); 
    if (isValid($user)){
      if (strcmp($user,"admin") === 0){
        header("Location: admin.php");
        die();
      }
    }
  }
  else{
     header("Location: index.php");
  }



?>
<html">
   
   <head>
      <title>Welcome </title>
   </head>
   
   <body>
      <h1>Welcome</h1>
      <p>You have nothing to do here.</p> 
      <h2><a href = "logout.php">Sign Out</a></h2>
   </body>
   
</html>
