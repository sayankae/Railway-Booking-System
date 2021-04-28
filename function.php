<?php
	//Check cutomer login validity
	function check_login($con){
		if(isset($_SESSION['p_id'])){
			$id = $_SESSION['p_id'];
			$query = "select * from passenger where p_id = '$id' limit 1";
			$result = mysqli_query($con,$query);

			if($result && mysqli_num_rows($result)>0){
				$user_data = mysqli_fetch_assoc($result);
				return $user_data;
			}
		}
		else{
			header("Location: login.php");
			die;
		}
	}
	//Check employee login validity
	function checkelogin($con){
		if(isset($_SESSION['e_id'])){
			$id = $_SESSION['e_id'];
			$query = "select * from employee where e_id = '$id' limit 1";
			$result = mysqli_query($con,$query);
			if($result && mysqli_num_rows($result)>0){
				$employee_data = mysqli_fetch_assoc($result);
				return $employee_data;
			}
		}
		else{
			header("Location: e_login.php");
			die;
		}
	}
	//Generate p_id and pnr
	function random_num($length){
		$text = "";
		if($length<5){
			$length = 5;
		}

		$len = rand(4,$length);

		for($i = 0; $i<$len; $i++){
			$text .= rand(0,9);
		}
		return $text;

	}
	//Calculates ticket price
	function ticketprice($dist,$class){
		$price = 0;
		if(strcmp($class, "AC1") == 0){
			return $dist*10;
		}
		elseif(strcmp($class, "AC2") == 0){
			return $dist*7;
		}
		elseif(strcmp($class, "AC3") == 0){
			return $dist*5;
		}
		elseif(strcmp($class, "Sleeper") == 0){
			return $dist*3.4;
		}
		else{
			return $price;
		}
	}
	//Generate seat number
	function seatGenerate(){
		return(rand(1,50));
	}
	//Generate platform number
	function platGenerate(){
		return(rand(1,10));
	}
	//Deletes a ticket
	function delTicket($pnr){
		include("connection.php");
		$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
		$query = "select p_id from ticket where tc_pnr = '$pnr' ";
		$result = $mysqli->query($query);
		while($row = $result->fetch_assoc()){
			$temp = $row['p_id'];
			$newquery = "update passenger set p_message = 'Ticket Canceled Successfully.' where p_id = '$temp' ";
			mysqli_query($con,$newquery);
		}
		$query = "delete from ticket where tc_pnr = '$pnr' ";
		mysqli_query($con,$query);
		header("Location: index.php");
		die;
	}
	//Check if train exist already
	function checkTrain($t_id){
		include("connection.php");
		$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
		$query = "select t_id from train";
		$result = $mysqli->query($query);
		while($row = $result->fetch_assoc()){
			if($t_id == $row['t_id']){
				header("Location: custom_train.php");
				die;	
			}
		}
	}
	//Deletes a train
	function delTrain($t_id){
		include("connection.php");
		$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
		$query = "select p_id from ticket where t_id = '$t_id' ";
		$result = $mysqli->query($query);
		while($row = $result->fetch_assoc()){
			$temp = $row['p_id'];
			$newquery = "update passenger set p_message = 'Attention, Your Train no longer in service. We are sorry for your inconvinience. Refund will be sent within 10 days.' where p_id = '$temp' ";
			mysqli_query($con,$newquery);
		}
		$query = "delete from ticket where t_id = '$t_id' ";
		mysqli_query($con,$query);
		$query = "delete from train where t_id = '$t_id' ";
		mysqli_query($con,$query);
	}
	//Cancel a train
	function canceltrain($t_id){
		setInvalid($t_id);
	}
	//Set Invalid all the ticket of particular train id
	function setInvalid($t_id){
		include("connection.php");
		$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
		$query = "select p_id from ticket where t_id = '$t_id' ";
		$result = $mysqli->query($query);
		while($row = $result->fetch_assoc()){
			$temp = $row['p_id'];
			$newquery = "update passenger set p_message = 'Attention, Your Train is canceled due to some problem. We are sorry for your inconvinience. Refund will be sent within 10 days.' where p_id = '$temp' ";
			mysqli_query($con,$newquery);
		}
		$query = "update ticket set tc_valid = 0 where t_id = '$t_id' ";
		mysqli_query($con,$query);
	}
	//Remove Station
	function removeStation($st_name){
		include("connection.php");
		$query = "delete from station where st_name = '$st_name' ";
		mysqli_query($con,$query);
	}

