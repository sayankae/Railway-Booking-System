<?php
session_start();
	include("connection.php");
	include("function.php");
	$mysqli = NEW MySQLi('localhost','root','','passenger_detail');
	$user_data = check_login($con);
	//If not booked revert back to index
	$flag = 0;
	$query = "select * from ticket";
	$result = $mysqli->query($query);
	while($row = $result->fetch_assoc()){
		if($user_data['p_id'] == $row['p_id']){
			$flag = 1;	
		}
	}
	if($flag == 0){
		header("Location: index.php");
		die;
	}
	//Collecting information from ticket table
	$p_id = $user_data['p_id'];
	$date = 0;
	$pnr = 0;
	$train_id = 0;
	$class = 0;
	$seat = 0;
	$price = 0;
	$from = 0;
	$to = 0;
	$arrive = 0;
	$departure = 0;
	$t_name = 0;
	$dist = 0;
    $plat = 0;
	$query = "select * from ticket where p_id = '$p_id' ";
	$result = $mysqli->query($query);
	while($row = $result->fetch_assoc()){
			$date = $row['tc_date'];
			$pnr = $row['tc_pnr'];
			$train_id = $row['t_id'];
			$class = $row['tc_class'];
			$seat = $row['tc_seat'];
			$price = $row['tc_price'];
            $valid = $row['tc_valid'];
            $plat = $row['tc_plat'];
	}
	$query = "select * from train where t_id = '$train_id' ";
	$result = $mysqli->query($query);
	while($row = $result->fetch_assoc()){
			$from = $row['t_from'];
			$to = $row['t_to'];
			$arrive = $row['t_arr'];
			$departure = $row['t_dest'];
			$t_name = $row['t_name'];
			$dist = $row['t_dist'];
	}
    //If user wants to cancel the ticket
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $cancel = $_POST['cancel'];
        delTicket($pnr);
    }

?>




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
<p>Ticket status: :<?php 
    if ($valid)
        echo "Valid";
    else
        echo "<mark>Invalid. Train is canceled. Please cancel your ticket and book a new ticket</mark>";
    ?>
    </p>
<head>
    <style>
        .ticket {
        	display: block;
            margin-left: 20%;
            margin-right: 10%;
            position: relative;
            width: 50%;
        }
  
        .pnr {
            position: absolute;
            top: 35px;
            left : 350px;
            color: white;
        }
  
        .name {
            position: absolute;
            top: 70px;
            left: 50px;
        }

        .lname {
            position: absolute;
            top: 100px;
            left: 50px;
        }

        .age {
            position: absolute;
            top: 125px;
            left: 50px;
        }

        .gender {
            position: absolute;
            top: 125px;
            left: 130px;
        }

        .train_from {
            position: absolute;
            top: 155px;
            left: 50px;
        }

        .train_dist {
            position: absolute;
            top: 155px;
            left: 370px;
        }

        .train_plat {
            position: absolute;
            top: 185px;
            left: 370px;
        }

        .train_to {
            position: absolute;
            top: 185px;
            left: 50px;
        }

        .date {
            position: absolute;
            top: 215px;
            left: 50px;
        }

        .class {
            position: absolute;
            top: 245px;
            left: 50px;
        }

        .arrival {
            position: absolute;
            top: 215px;
            left: 200px;
        }

        .seat {
            position: absolute;
            top: 245px;
            left: 200px;
        }

        .departure {
            position: absolute;
            top: 215px;
            left: 370px;
        }

        .price {
            position: absolute;
            top: 245px;
            left: 370px;
        }

        .train_id {
            position: absolute;
            top: 70px;
            left: 300px;
        }

  		.train_name {
            position: absolute;
            top: 100px;
            left: 300px;
        }

        .tagline{
        	position: absolute;
        	top: 276px;
        	left: 200px;
        	color: orange;
        }

    </style>
</head>
</body>
	<div class="container">
    <div class="ticket">
        <img src="img/booked_ticket.png">
       	<h3 class="pnr">PNR:
        	<?php 
        		echo $pnr;
        	 ?>
       	</h3>
        <h3 class="name">Name:
        	<?php 
        		echo $user_data['p_fname'];
        	 ?>
        </h3>
        <h3 class="lname">Surname:
        	<?php 
        		echo $user_data['p_lname'];
        	 ?>
       	</h3>
        <h4 class="age">Age:
        	<?php 
        		echo $user_data['p_age'];
        	 ?>
        </h4>
        <h4 class="gender">Gender:
        	<?php 
        		echo $user_data['p_gender'];
        	 ?>
        </h4>
        <h4 class="date">Date:
        	<?php 
        		echo $date;
        	 ?>
        </h4>
        <h4 class="train_from">From:
        	<?php 
        		echo $from;
        	 ?>
        </h4>
        <h4 class="train_to">To:
        	<?php 
        		echo $to;
        	 ?>
        </h4>
        <h4 class="train_dist">Distance(in KM):
        	<?php 
        		echo $dist;
        	 ?>
        </h4>
        <h4 class="train_plat">Platform:
            <?php 
                echo $plat;
             ?>
        </h4>
        <h4 class="train_id">Train Number:
        	<?php 
        		echo $train_id;
        	 ?>
        </h4>
        <h4 class="arrival">Arrive:
        	<?php 
        		echo $arrive;
        	 ?>
        </h4>
        <h4 class="departure">Departure:
        	<?php 
        		echo $departure;
        	 ?>
        </h4>
        <h4 class="seat">Seat No:
        	<?php 
        		echo $seat;
        	 ?>
        </h4>
        <h4 class="class">Class:
        	<?php 
        		echo $class;
        	 ?>

        </h4>
        <h4 class="train_name">Train Name:
        	<?php 
        		echo $t_name;
        	 ?>
        </h4>
        <h4 class="price">Price:
        	<?php 
        		echo $price;
        	 ?>
        </h4>
        <h4 class="tagline">We wish you a safe and happy journey!</h4>
	</div>
	<button onclick="window.print()">Print this ticket</button><br><br>
    <form method="post">
    <button type="submit" value="cancel">Cancel the ticket</button><br><br>
    <a href = "index.php">Go back to menu page</a><br><br>
    </form>
</html>

