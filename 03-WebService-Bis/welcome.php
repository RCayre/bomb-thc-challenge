<?php
require_once('functions.php');
$user_cookie = "";
$user = "";
  if(!isset($_COOKIE["auth"])) {
     header("Location: index.php");
     die();
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
