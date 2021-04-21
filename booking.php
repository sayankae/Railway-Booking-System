<?php
session_start();
	include("connection.php");
	include("function.php");
	$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
	$user_data = check_login($con);
	//to check if user has already booked the ticket or not
	$query = "select * from ticket";
	$result = $mysqli->query($query);
	while($row = $result->fetch_assoc()){
		if($user_data['p_id'] == $row['p_id']){
			header("Location: index.php");
			die;	
		}
	}
		//User form information	
		if($_SERVER["REQUEST_METHOD"] == "POST"){
				//user signup information is given
				$t_to = $_POST['to'];
				$t_from = $_POST['from'];
				$date = $_POST['date'];
				$class = $_POST['class'];
				$flag = 0;
				//Checking if date is empty
				if(!empty($date)){
					$query = "select * from train";
					$result = $mysqli->query($query);
					while($rows = $result->fetch_assoc()){
						$toname = $rows['t_to'];
						$fromname = $rows['t_from'];
						$t_id = $rows['t_id'];
						$price = ticketprice($rows['t_dist'],$class);
						if(strcmp($toname, $t_to) == 0 && strcmp($fromname, $t_from) == 0){
							$flag = 1;
							break;
						}
					}
					if($flag == 0){
						echo '<script type="text/javascript">window.alert("Sorry! No train available at this route")</script>';
					}
					//Put data inside ticket table and passenger column
					else{
						$p_id = $user_data['p_id'];
						$seat = seatGenerate();
						$tc_pnr = random_num(20);
						$tc_plat = platGenerate();
						$query = "insert into ticket (tc_pnr, p_id, t_id, tc_date, tc_class, tc_seat, tc_plat, tc_price, tc_valid) values ('$tc_pnr','$p_id ', '$t_id', '$date', '$class', '$seat', '$tc_plat', '$price', '1')";
						mysqli_query($con,$query);
						$query = "update passenger set p_message = 'Succesfully Ticket is booked. Please check the booked ticket section.' where p_id = '$p_id' ";
						mysqli_query($con,$query);
						echo '<script type="text/javascript">window.alert("Succesfully Ticket is booked. Please check the booked ticket section")</script>';
					}
				}
				else{
					echo '<script type="text/javascript">window.alert("Invalid Information")</script>';
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
			<div style = "font-size: 20px; margin: 10px; color: white; ">Booking</div>
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
			<label for="class">Select Class:</label>
				  <select name="class" id="text">
				    <option value="AC1">AC1</option>
				    <option value="AC2">AC2</option>
				    <option value="AC3">AC3</option>
				    <option value="Sleeper">Sleeper</option>
				  </select>
				  <br><br>
			<label for = "date">Date</label>
			<input type="date" id = "date" name="date"><br><br>
			<input id = "button" type = "submit" value= "Submit" ><br><br>
			<button type="reset" value="Reset">Reset</button>
		</form>
	</div>
	<a href = "index.php">Go back to menu page</a><br><br>

</body>
</html>