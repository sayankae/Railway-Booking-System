<?php
session_start();
	include("connection.php");
	include("function.php");
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//read from database to search ther user
		$e_id = $_POST['e_id'];
		$e_password = $_POST['password'];


		//check if first and name is valid and password is empty of not
		if(!empty($e_id) && !empty($e_password)){
			//saving inside database
			$query = "select * from employee where e_id = '$e_id' limit 1";
			$result = mysqli_query($con,$query);

			if ($result){
				if($result && mysqli_num_rows($result)>0){
					$employee_data = mysqli_fetch_assoc($result);
					if($employee_data['e_password'] === $e_password){
							$_SESSION['e_id'] = $employee_data['e_id'];
							header("Location: e_index.php");
							die;
					}
					//Wrong Password Message
					else{
						echo '<script type="text/javascript">alert("Wrong Password")</script>';	
					}
				}
			}
			else
				echo '<script type="text/javascript">alert("Wrong Employee ID or Password")</script>';

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
			<div style = "font-size: 20px; margin: 10px; color: white; ">Employee Only</div>
			<label for = "e_id">Employee ID</label>
			<input id = "text" type = "text" name = "e_id"><br><br>
			<label for = "password">Password</label>
			<input id = "text" type = "password" name = "password"><br><br>
			<input id = "button" type = "submit" value= "Login" ><br><br>
			<a href = "login.php">Not an Employee?Click here for customer login page</a><br><br>
		</form>
	</div>
</body>
</html>