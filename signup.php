<?php
session_start();
	include("connection.php");
	include("function.php");

	if($_SERVER["REQUEST_METHOD"] == "POST"){
		//user signup information is given
		$p_fname = $_POST['fname'];
		$p_lname = $_POST['lname'];
		$p_age = $_POST['age'];
		$p_contact = $_POST['contact'];
		$p_gender = $_POST['gender'];
		$p_email = $_POST['email'];
		$p_password = $_POST['password'];

		//check if first and name is valid and password is empty of not
		if(!empty($p_fname) && !empty($p_lname) && !empty($p_password) && !is_numeric($p_fname)){
			//Check if email already exist
			$query = "select p_email from passenger where p_email = '$p_email' limit 1";
			$result = mysqli_query($con,$query);
			if ($result){
				if($result && mysqli_num_rows($result)>0){
					$user_data = mysqli_fetch_assoc($result);
					if($user_data['p_email'] == $p_email){
							echo '<script type="text/javascript">alert("Email already exist. Please try another email")</script>';
					}
				}
			}
			else{
				//saving inside database
				$p_id = random_num(20);
				$query = "insert into passenger (p_id,p_fname,p_lname,p_age,p_contact,p_gender,p_email,p_password,p_message) values ('$p_id','$p_fname','$p_lname','$p_age','$p_contact','$p_gender','$p_email','$p_password','Empty.')";

				mysqli_query($con,$query);
				header("Location: login.php");
				die;
			}
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
			width: 100;
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
			<div style = "font-size: 20px; margin: 10px; color: white;">Signup</div>
			<label for = "fname">First name</label>
			<input id = "text" type = "text" name = "fname"><br><br>
			<label for = "lname">Last name</label>
			<input id = "text" type = "text" name = "lname"><br><br>
			<label for = "age">Age</label>
			<input id = "text" type = "text" name = "age"><br><br>
			<label for = "contact">Mobile Number</label>
			<input id = "text" type = "text" name = "contact"><br><br>
			<label for="gender">Select Gender:</label>
				  <select name="gender" id="text">
				    <option value="Male">Male</option>
				    <option value="Female">Female</option>
				    <option value="Transgender">Transgender</option>
				  </select>
				  <br><br>
			<label for = "email">Email ID</label>
			<input id = "text" type = "text" name = "email"><br><br>
			<label for = "password">Create password</label>
			<input id = "text" type = "password" name = "password"><br><br>
			<input id = "button" type = "submit" value= "Signup"><br><br>
			<a href = "login.php">Login</a><br><br>
		</form>
	</div>
</body>
</html>