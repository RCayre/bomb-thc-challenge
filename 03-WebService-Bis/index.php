<?php
require_once('functions.php');
$user_cookie = "";
$user = "";
  if(isset($_COOKIE["auth"])) {
	$user_cookie = 	$_COOKIE["auth"];
	$user = decrypt($user_cookie); 	
	if (isValid($user)){
		if (strcmp($user,"admin") === 0){
      header("Location: admin.php");
		}else {
			header("Location: welcome.php");
			die();
		}
	}

   }
   else{
	echo "why i go here?";
   }

?>
<html>
    <head>
        <title>ECB</title>
        <link rel="stylesheet" media="screen" href="/css/bootstrap.css" />
        <link rel="stylesheet" media="screen" href="/css/bombTHC.css" />
    </head>
    <body>
      <div class="container-narrow">
        <div class="header">
          <div class="navbar navbar-fixed-top">
            <div class="nav-collapse collapse">
              <ul class="nav navbar-nav">
                  <li><a href="/register.php">Register</a></li>
                              </ul>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        <div class="body-content">


<div class="row">
  <div class="col-lg-12">
      <h1>ECB is your friend</h1>
      <p>Welcome to the challenge on ECB encryption.</p>
      <p>The objective of this step is to find a way to get logged in as the user "admin" using his cookie...</p>
        <p>You will need to create a user (<a href="/register.php">register</a>)to bypass the authentication.</p>
  	<p>Hint: Try create user name "aaaaaaaa" and "aaaaaaaaaaaaaaaa" to understand what's happenned to their cookie (length, model, etc.)</p>
  </div>
</div>



        </div>
      </div>


    </body>
</html>


