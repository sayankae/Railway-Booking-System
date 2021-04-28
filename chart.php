<?php
session_start();
	include("connection.php");
	include("function.php");
	$employee_data = checkelogin($con);
	echo "Employee ID:",$employee_data['e_id'];
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
			<div style = "font-size: 20px; margin: 10px; color: white; ">Train</div>
			<label for = "t_id">Train ID</label>
			<input id = "text" type = "text" name = "t_id"><br><br>
			<label for = "date">Date</label>
			<input type="date" id = "date" name="date"><br><br>
			<label for = "password">Your Password</label>
			<input id = "text" type = "password" name = "password"><br><br>
			<input id = "button" type = "submit" value= "Create Chart" ><br><br>
			<a href = "e_index.php">Go back to menu page</a><br><br>
		</form>
	</div>
	<p>
		Chart generated on:
		<script> document.write(new Date().toLocaleDateString()); </script>
	</p>
	<?php
		$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
		if($_SERVER["REQUEST_METHOD"] == "POST"){
			$flag = 0;
			$t_id = $_POST['t_id'];
			$e_password = $_POST['password'];
			$date = $_POST['date'];
			//check password again
			if(!empty($t_id) && !empty($e_password)){
				if($employee_data['e_password'] === $e_password){
					$query = "select t_id from train";
					$result = $mysqli->query($query);
					//Checking if train exist
					while($row = $result->fetch_assoc()){
						if($t_id == $row['t_id']){
							$flag = 1;
							$newquery = "select passenger.p_fname, passenger.p_age, ticket.tc_pnr, ticket.tc_seat, ticket.tc_class from passenger inner join ticket on passenger.p_id=ticket.p_id and ticket.t_id = '$t_id'and ticket.tc_valid = '1' and ticket.tc_date = '$date' ";
							$newresult = $mysqli->query($newquery);
							if($newresult && mysqli_num_rows($newresult)>0){
								$smallquery = "select t_name from train where t_id = '$t_id' ";
								$smallresult = $mysqli->query($smallquery);
								//Printing Train Name
								while($train_name = $smallresult->  fetch_assoc()){
									echo "<h2 style='text-align: center;'><u>".$train_name['t_name']."</u></h2>";
								}							
								echo "<style>
										table, th, td {
										  border: 1px solid black;
										}
										</style>
									<table style = 'margin-left: auto; 
  											margin-right: auto;'>
									<tr>
										<th>Name</th>
										<th>Age</th>
										<th>PNR</th>
										<th>Seat</th>
										<th>Class</th>
									</tr>
									";
								//Filling Train Table
								while($newrow = $newresult->fetch_assoc()){
									
									echo "<tr><td>".$newrow['p_fname']."</td><td>".$newrow['p_age']."</td><td>".$newrow['tc_pnr']."</td><td>".$newrow['tc_seat']."</td><td>".$newrow['tc_class']."</td></tr>";
								}
								echo "</table>";
							}
							else{
								echo "0 result";
							}
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
</body>
</html>