<?php
require_once('functions.php');
$name = $password = "";
$cookie = "";
$nameErr = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
	if (empty($_POST["name"])){
		$nameErr = "Name is required";
	}else {
		$name = sanitize_user_input($_POST["name"]);
		if ($name === ""){
			$nameErr = "Name is not valid";
		}else{
			$cookie =  encrypt($name);
			setcookie("auth",$cookie, time() + 600,"/");
			header("Location: index.php");
		}
	}

}

?>

<!DOCTYPE HTML>  
<html>
<head>
<style>
.error {color: #FF0000;}
</style>
</head>
<body>  
<h2>Join us!</h2>
<p><span class="error">* required field.</span></p>
<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
  Name: <input type="text" name="name" value="">
  <span class="error">* <?php echo $nameErr;?></span>
  <br><br>
  Password: <input type="text" name="password" value="">
  <br><br>
  <input type="submit" name="Join" value="Join">  
</form>
</body>
</html>
