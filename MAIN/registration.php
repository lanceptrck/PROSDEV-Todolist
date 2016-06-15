<?php
	session_start();
	include 'logic_registration.php';
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Sign up for potato.</title>
		<link rel = "stylesheet" type = "text/css" href = "css/style.css">
		<script src = "js/jquery-2.1.3.min.js"></script>
			<script>
  				$(document).ready(function(){
  					$(".registerBox").animate({opacity: 1, top: "15%"}, 500);
				});
			</script>
	</head>
	<body>
		<div class = "foodList">
			<div class = "header">
				<p class = "welcomeHeadName">potato.</p>
			</div>
			<div class = "registerBox">
				<form method = "POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<p class = "registerHead">Sign up for potato.</p>
					<br>
					<label><p id ="error">* required fields</p></label>
					<br>
					<br>
					<label><p id ="error" style = "color:black;"><?php echo $greeting; ?></p></label>
					<label><p id ="error"><?php echo $fnErr; ?></p></label>
					<input type = "text" placeholder = "*Firstname" class = "rBox" id = "fullname" name="firstname">
					<br>
					<br>
					<label><p id ="error"><?php echo $lnErr; ?></p></label>
					<input type = "text" placeholder = "*Lastname" class = "rBox" id = "fullname" name="lastname">
					<br>
					<br>
					<label><p id ="error"><?php echo $emErr; ?></p></label>
					<input type = "email" placeholder = "*Email" class = "rBox" id = "email" name ="email">
					<br>
					<br>
					<label><p id ="error"><?php echo $pwErr; ?></p></label>
					<input type = "password" placeholder = "*Password" class = "rBox" id = "password" name="password">
					<br>
					<br>
					<label><p id ="error"><?php echo $unErr; ?></p></label>
					<input type = "text" placeholder = "*Username" class = "rBox" id = "username" name = "username">
					<br>
					<br>
					<input type ="submit" value ="Register" class="registerButton">
					<br>
					<br>
					<a href = "index.php"><input type ="button" style ="margin-top: 0px; margin-right:55px; width: 27em; "value = "Cancel" class = "registerButton"></a>
				</form>
			</div>
		</div>
	</body>
</html>