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

	<h1> Welcome to Indian Railways</h1>
		<button class="button" onclick='window.location.href="custom_train.php";'>Add New Train</button>
		<button class="button" onclick='window.location.href="remove_train.php";'>Remove Train</button>
		<button class="button" onclick='window.location.href="cancel_train.php";'>Cancel Train</button>
		<button class="button" onclick='window.location.href="add_remove_station.php";'>Add/Remove Station</button>
		<button class="button" onclick='window.location.href="chart.php";'>Prepare Chart For Train</button>
		<button class="button" onclick='window.location.href="e_logout.php";'>Logout</button>
</body>
</html>