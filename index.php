<?php
session_start();
	include("connection.php");
	include("function.php");
	$user_data = check_login($con);
	$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
	$query = "select * from ticket";
	$result = $mysqli->query($query);
	while($row = $result->fetch_assoc()){
		if($user_data['p_id'] == $row['p_id']){
			echo "Ticket Already Booked. Check your status";
			break;
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
	<h1> Welcome to Indian Railways</h1>
	<style>
	.button {
	  background-color: #ddd;
	  border: none;
	  color: black;
	  padding: 10px 20px;
	  text-align: center;
	  text-decoration: none;
	  display: inline-block;
	  margin: 4px 2px;
	  cursor: pointer;
	  border-radius: 16px;
	  width: 40%;
	  margin-left: 25%;
	  margin-right: 20%;
	}

	.button:hover {
	  background-color: #f1f1f1;
	}
	</style>
		<button class="button" onclick='window.location.href="login.php";'>Login to different Account</button>
		<button class="button" onclick='window.location.href="cat.php";'>Booked Ticket/Status</button>
		<button class="button" onclick='window.location.href="booking.php";'>For Booking</button>
		<button class="button" onclick='window.location.href="logout.php";'>Logout</button>
	</body>
	<h1><strong>Notice</strong></h1>
	<?php
		echo "<mark>".$user_data['p_message']."</mark>";
	?>
</html>