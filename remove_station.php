<?php
session_start();
	include("connection.php");
	include("function.php");
	$employee_data = checkelogin($con);
	echo "Employee ID:",$employee_data['e_id'],"\n";
	$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$flag = 0;
		$st_name = $_POST['st_name2'];
		$e_password = $_POST['password2'];
		//check password again
		if(!empty($st_name) && !empty($e_password)){
			if($employee_data['e_password'] === $e_password){
				$query = "select st_name from station";
				$result = $mysqli->query($query);
				//Checking if station exist
				while($row = $result->fetch_assoc()){
					if($st_name == $row['st_name']){
						$flag = 1;
						echo '<script type="text/javascript">window.alert("Station Already Exist")</script>';
					}
				}
				if($flag == 0){
					$query = "insert into station(st_name) values('$st_name')";
					mysqli_query($con,$query);
					echo '<script type="text/javascript">window.alert("Succesfully added new station")</script>';
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

	echo '<br><br><a href = "add_remove_station.php">Go back to menu page</a><br><br>';
?>
