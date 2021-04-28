<?php
session_start();
	include("connection.php");
	include("function.php");
	$employee_data = checkelogin($con);
	echo "Employee ID:",$employee_data['e_id'];
	$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
	if($_SERVER["REQUEST_METHOD"] == "POST"){
		$t_id = $_POST['t_id'];
		$t_name = $_POST['t_name'];
		$t_from = $_POST['from'];
		$t_to = $_POST['to'];
		$t_dist = $_POST['dist'];
		$t_arr = $_POST['arrive'];
		$t_dest = $_POST['departure'];

		//check if train already exist 
		checkTrain($t_id);
		//check if destination and source is same place or not
		if($t_to == $t_from){
			echo '<script type="text/javascript">window.alert("Source and Destination cannot be same.")</script>';
		}
		//add train to train table
		else{
			$query = "insert into train (t_id, t_name, t_from, t_to, t_dist, t_arr, t_dest) values ('$t_id', '$t_name', '$t_from', '$t_to', '$t_dist', '$t_arr', '$t_dest')";
			mysqli_query($con,$query);
			echo '<script type="text/javascript">window.alert("Succesfully Train Added")</script>';
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
			<div style = "font-size: 20px; margin: 10px; color: white; ">Add Train</div>
			<label for = "t_id">Train ID</label>
			<input type="text" id = "text" name="t_id"><br><br>
			<label for = "t_name">Train Name</label>
			<input type="text" id = "text" name="t_name"><br><br>
			<label for = "to">To</label>
			<select name = "to" id = "text">
				<?php
					$resultSet = $mysqli->query("select st_name from station;");
					while($rows = $resultSet->fetch_assoc()){
						$t_to = $rows['st_name'];
						echo "<option value = '$t_to'>$t_to</option>";
				}
				?>
			</select><br><br>
			<label for = "from">From</label>
			<select name = "from" id = "text">
				<?php
					$resultSet = $mysqli->query("select st_name from station");
					while($rows = $resultSet->fetch_assoc()){
						$t_from = $rows['st_name'];
						echo "<option value = '$t_from'>$t_from</option>";
				}
				?>
			</select><br><br>
			<label for = "dist">Distance</label>
			<input type="text" id = "text" name="dist"><br><br>
			<label for = "arrive">Arrive</label>
			<input type="time" id="text" name="arrive"><br><br>
			<label for = "departure">Departure</label>
			<input type="time" id="text" name="departure"><br><br>
			<input id = "button" type = "submit" value= "Submit" ><br><br>
			<button type="reset" value="Reset">Reset</button>
		</form>
	</div>
	<a href = "e_index.php">Go back to menu page</a><br><br>

</body>
</html>