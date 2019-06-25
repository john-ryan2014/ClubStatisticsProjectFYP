<!DOCTYPE html>
<html lang="en">
<head>
  <title>Frees Conceded</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"> </script>
  
</head>
<?php
session_start();
if(!isset($_SESSION["Username"])){
header("Location: Login.php");
exit(); }
?>
<body >

<div class="container text-center" style="color:black; font-size:4em">
  <p> GAA Club Statistics </p>     
   <h2>The statistics you need!</h2>
</div>
<br>

<div >
  <ul class="nav nav-tabs nav-justified" >
    <li style="background-color:red"><a href="Home.html" >Home</a></li>
    <li style="background-color:slategrey"><a href="Enter New Match Details.php">Enter New Match Details</a></li>
    <li style="background-color:green"><a href="View Player Statistics.php">View Team Statistics</a></li>
	<li style="background-color:purple"><a href="Individual Players.php">View Individual Players</a></li>
	<li style="background-color:blue"><a href="Suggested 15.php">Request Starting 15</a></li>
    <li style="background-color:salmon"><a href="Log Out.php">Log Out</a></li>
  </ul>
</div>
<br><br>
	<?php
	$servername = "localhost";
	$username = "root";
	$password = "";

	//Create connection
	$connector = mysql_connect($servername,$username,$password)
		or die("Unable to connect");
	$selected = mysql_select_db("mydb", $connector)
		or die("Unable to connect");

	$manager = $_SESSION['Username'];
	$result = mysql_query("SELECT * FROM players WHERE ManagerUsername = '$manager' ORDER BY Frees DESC LIMIT 10");

	?>
	<style>
	body 
	{
		background-image: url("Stadium.jpg");
		background-repeat: no-repeat;
		background-size: cover;
		background-position: centered;
		color:white;
	
	}

	a{
	color: white;
	}
	table 
	{
		border-collapse: collapse;
		width: 80%;
		
	}
	th 
	{
		border: 1px solid #dddddd;
		text-align: center;
		padding: 8px;
		background-color: #871414;
	}

	td
	{
		border: 1px solid #dddddd;
		text-align: center;
		padding: 8px;
		
	}

	tr:nth-child(even) 
	{
		background-color: #871414;
	}
	
	#chart-container
	{
		width: 60%;
		height: 450px;
		display: inline-block;
		background-color: #871414;
	}
	#chart-container2
	{
		width: 33%;
		height: 450px;
		display: inline-block;
		float:right;
		background-color: #871414;
	}
	
	
	</style>
	<div width="100%" style="background-color: #871414">
		<h2 class="text-center"> Frees Conceded </h2>
	</div>	
	<br><br>
	<div class="container">
	<table class="table">
	 <thead >
		  <tr >
			<th>Place:</th>
			<th>Player Name:</th>
			<th>Position:</th>
			<th>Frees Conceded: </th>
			
		  </tr>
	 </thead>
	 
	 <tbody>
	 <?php
		$i = 1;
		while( $row = mysql_fetch_array( $result ) )
			{
				
				echo "<tr >";
				echo "<td >". $i."</td>"; 
				echo "<td >" .$row['Name']."</td>";
				echo "<td>".$row['Position'] ."</td>";
				echo "<td>".$row['Frees'] ."</td>";
				echo "</tr>";
				$i++;
			}

	  ?>  
	</tbody>
	</table></div>
	<br><br>
	<div  style="background-color:#871414; margin-left:5%; margin-right:5%;" width="90%" >
	<div id="chart-container">
		<canvas id="mycanvas" ></canvas>
	</div>
	<div id="chart-container2">
		<canvas id="mycanvas2" ></canvas>
    </div>
	</div>
	<script>
	$(document).ready(function(){
		$.ajax({
		url: "http://localhost/chartData.php",
			method: "GET",
			success: function(data) {
				console.log(data);
				var player = [];
				var score = [];
				
				Chart.defaults.global.defaultFontColor = '#fff';
				for(var i in data) 
				{	
					
						player.push( data[i].Name);
						score.push(data[i].Frees);
					
				}

				var chartdata = {
					labels: player,
					datasets : [
						{
							label: 'Frees Against ',
							
							backgroundColor: 'rgba(250, 250, 250, 0.75)',
							borderColor: 'rgba(200, 200, 200, 0.75)',
							hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
							hoverBorderColor: 'rgba(200, 200, 200, 1)',
							data: score,
							scaleStartValue : 0
						}
					]
				};

				var ctx = $("#mycanvas");
				

				var barGraph = new Chart(ctx, {
					type: 'bar',
					data: chartdata
					
				});
			},
			error: function(data) {
				console.log(data);
			}
		});
	});
	
	$(document).ready(function(){
		$.ajax({
		url: "http://localhost/chartData.php",
			method: "GET",
			success: function(data) {
				console.log(data);
				var player = [];
				var score = [];

				for(var i in data) 
				{
					if (data[i].Frees >= 1)
					{
						player.push( data[i].Name);
						score.push(data[i].Frees);
					}
				}
				
				var chartdata = {
					labels: player,
					datasets : [
						{
							label: 'Frees Against',
							backgroundColor:"rgba(250,250,198,.1)",
							borderColor: "rgba(250,250,198,1)",
							hoverBackgroundColor: 'rgba(200, 200, 200, 1)',
							pointBackgroundColor: "rgba(179,181,198,1)",
							data: score
						}
					]
				};

				var ctx = $("#mycanvas2");

				var barGraph = new Chart(ctx, {
					type: 'radar',
					data: chartdata,
					options: 
					{
						scale: 
						{
							reverse: false,
							ticks: 
							{
								beginAtZero: true,
								showLabelBackdrop: false
							}
						}
					}});
			},
			error: function(data) {
				console.log(data);
			}
		});
	});
	</script>
    
	<div class="row">
		<a href = "View Player Statistics.php">
			<button  class="btn btn-primary col-sm-10" style="margin-left:8%; margin-right:6%">Return to all statistics</button>
		</a>
	</div>
	<?php mysql_close($connector); ?>
</body>
</html>