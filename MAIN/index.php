<?php
session_start();
include 'functions.php';
loadAll();
$loggedin = false;
$reply = "Sign in to TODO.PH";
if(isset($_SESSION["username"])){
	$loggedIn_account = getAccount($_SESSION["username"]);
	header("Location: home.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST"){
	$loggedin = false;
	if(!empty($_POST["username"])){
     	$username = test_input($_POST["username"]); 
     	$loggedin = true;	
 	} 
 	else if($loggedin == false){
 		$reply = "Username or Password field is empty.";
 	}
 	if(!empty($_POST["password"])){
 		$password = test_input($_POST["password"]);
 	}
	if($loggedin == true){
 		if(verify($username, $password)){
			$_SESSION["username"] = test_input($_POST["username"]);
			header('Refresh: 1; URL = home.php');	
		}
		else if($loggedin == false){
			$reply = "";
		}
		else{
			$reply = "Username does not exist or password is wrong";
		}
	}	
}
?>

<html>
	<head>

		   <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.0/jquery.min.js"></script>
        <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

                <!-- Link to CSS file -->
        <link rel="stylesheet" href="css/login.css">
        <link rel="stylesheet" href="css/home.css">
        <link rel="shortcut icon" href="img/todoico.ico">

        <title>
            TODO.PH | Login
        </title>

	</head>

	<body>

<a href="#" data-toggle="modal" data-target="#login-modal"><img src="img/todoph logo.png" alt="Login" class="img-responsive center-block" /></a>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
    	  <div class="modal-dialog">
				<div class="loginmodal-container">
					<h1><?php echo $reply; ?></h1><br>

				  <form method = "POST" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<input type="text" name="username" placeholder="Username">
					<input type="password" name="password" placeholder="Password">
					<input type="submit" name="login" class="login loginmodal-submit" value="Login">
				  </form>
					
				  <div class="login-help">
					<a href="register.php">Register</a> - <a href="#">Forgot Password</a>
				  </div>
				</div>
			</div>
		  </div>

	</body>
</html>