<?php
session_start();
	include("connection.php");
	include("function.php");
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//read from database to search ther user
		$p_email = $_POST['email'];
		$p_password = $_POST['password'];


		//check if first and name is valid and password is empty of not
		if(!empty($p_email) && !empty($p_password)){
			//saving inside database
			$query = "select * from passenger where p_email = '$p_email' limit 1";
			$result = mysqli_query($con,$query);

			if ($result){
				if($result && mysqli_num_rows($result)>0){
					$user_data = mysqli_fetch_assoc($result);
					if($user_data['p_password'] === $p_password){
							$_SESSION['p_id'] = $user_data['p_id'];
							header("Location: index.php");
							die;
					}
					//Wrong Password Message
					else{
						echo '<script type="text/javascript">alert("Wrong Password")</script>';	
					}
				}
			}
				echo 'Wrong Username or Password';

		}
		else{
			echo '<script type="text/javascript">alert("Please enter valid information")</script>';	
		}
	}

?>


<!DOCTYPE html>
<!DOCTYPE html>
<html>
	<style>
		header {
		  background-color: DeepSkyBlue;
		  padding: 3px;
		  text-align: center;
		  font-size: 35px;
		  color: white;
		}
	</style>
<header>
	<h2>Indian Railways</h2>
</header>
<body>
	<style type = "text/css">
		#text{
			height: 25px;
			border-radius: 5px;
			padding: 4px;
			border: solid thin #aaa;
			width: 100
		}

		#button{
			padding: 10px;
			width: 100px;
			color: white;
			background-color: MediumBlue;
			border: none;
		}
		#box{
			background-color: grey;
			margin: auto;
			width: 300px;
			padding: 20px;
		}
	</style>
	<div id = "box">
		<form method = "post">
			<div style = "font-size: 20px; margin: 10px; color: white; ">Login</div>
			<label for = "email">Email ID</label>
			<input id = "text" type = "text" name = "email"><br><br>
			<label for = "password">Password</label>
			<input id = "text" type = "password" name = "password"><br><br>
			<input id = "button" type = "submit" value= "Login" ><br><br>
			<a href = "signup.php">New User?Click here to Signup</a><br><br>
			<a href = "homepage.html" >Homepage</a><br><br>
		</form>
	</div>
</body>
</html>