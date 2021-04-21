<?php
session_start();
	include("connection.php");
	include("function.php");
	$employee_data = checkelogin($con);
	echo "Employee ID:",$employee_data['e_id'];
	$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$flag = 0;
		$t_id = $_POST['t_id'];
		$e_password = $_POST['password'];
		//check password again
		if(!empty($t_id) && !empty($e_password)){
			if($employee_data['e_password'] === $e_password){
				$query = "select t_id from train";
				$result = $mysqli->query($query);
				//Checking if train exist
				while($row = $result->fetch_assoc()){
					if($t_id == $row['t_id']){
						//remove train
						cancelTrain($t_id);
						$flag = 1;
						echo '<script type="text/javascript">window.alert("Succesfully Train Canceled")</script>';
					}
				}
				if($flag == 0){
					echo "Train not found";
				}
			}
			else{
				echo '<script type="text/javascript">window.alert("Wrong Password")</script>';
			}
		}
		else{
			echo '<script type="text/javascript">window.alert("Please put valid information")</script>';
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
			<div style = "font-size: 20px; margin: 10px; color: white; ">Cancel Train</div>
			<label for = "t_id">Train ID</label>
			<input id = "text" type = "text" name = "t_id"><br><br>
			<label for = "password">Your Password</label>
			<input id = "text" type = "password" name = "password"><br><br>
			<input id = "button" type = "submit" value= "Cancel" ><br><br>
			<a href = "e_index.php">Go back to menu page</a><br><br>
		</form>
	</div>
</body>
</html>