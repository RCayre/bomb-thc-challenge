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
      else {
      	if ($_GET && isset($_GET['file'])) {
			include($_GET['file']);
		}
      }
    }
  }
  else{
     header("Location: index.php");
  }



