<!DOCTYPE html>
<html lang="en">
<head>
  <title>Enter New Match Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>

<?php
session_start();
if(!isset($_SESSION["Username"])){
header("Location: login.php");
exit(); }
?>
<style>
body {
    background-image: url("Stadium.jpg");
    background-repeat: no-repeat;
	background-size: cover;
    background-position: centered;
	color:white;
	
}

a{
color: white;
}
</style>

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
$result = mysql_query("SELECT Name FROM players WHERE ManagerUsername = '$manager'");
$result2 = mysql_query("SELECT Opposition FROM game WHERE ManagerUsername = '$manager'");

?>
<br>
<form action="newMatchDetails.PHP" method="post">
	<div class="form-group" align="center">
		<label  for="Name" >Player Name:</label>
		<input list="playerNames" style="color:black" name="name" required>
		<datalist id="playerNames">
		
		<?php
		while( $row = mysql_fetch_array( $result ) )
	    {
            
			echo '<option value="'. $row['Name']. '">';  
            
        }
		echo "</datalist>";
		?> 

	</div>
	<br>
	<div class="col-xs-4" align="center" >
		<label for="opposition">Opposition Team Name:</label>
		<input type="text" class="form-control" name="opposition" <?php $row2 = mysql_fetch_array( $result2 ); echo "value=".$row2['Opposition']; ?>>
	</div>
  
	<div class="col-xs-4" align="center">
		<label for="minutes">Minutes Played:</label>
		<input type="number" class="form-control" name="minutes" value="70">
	</div>
	<div class="col-xs-4" align="center">
		<label for="points">Points Scored:</label>
		<input type="number" class="form-control" name="points" min="0" value="0">
	</div>
	<div class="col-xs-4" align="center">
		<label for="assists">Assists:</label>
		<input type="number" class="form-control" name="assists" min="0" value="0">
	</div>
	<div class="col-xs-4" align="center">
		<label for="hooks_blocks">Hooks/Blocks:</label>
		<input type="number" class="form-control" name="hooks_blocks" min="0" value="0">
	</div>
	<div class="col-xs-4" align="center">
		<label for="puckouts_kickouts_won">Puck Outs/ Kick Outs Won:</label>
		<input type="number" class="form-control" name="puckouts" min="0" value="0">
	</div>
	<div class="col-xs-4" align="center">
		<label for="frees">Frees Conceded:</label>
		<input type="number" class="form-control" name="frees" min="0" value="0">
	</div>
	<div class="col-xs-4" align="center">
		<label for="yellow_cards">Yellow Cards:</label>
		<input type="number" class="form-control" name="yellow" min="0" max="2" value="0">
	</div>
	<div class="col-xs-4" align="center">
		<label for="red_cards">Red Cards:</label>
		<input type="number" class="form-control" name="red" min="0" max="1" value="0">
	</div>
	<div class="col-xs-4" align="center">
		<label for="points_against">Opposition Marker Points Scored:</label>
		<input type="number" class="form-control" name="points_against" min="0" value="0">
	</div>

	<div class="col-xs-4" align="center">
		<label for="performance">Performance Score(Out of 10): </label>
		<span id="range">&nbsp; 5</span>
		<input type="range" min="0" max="10"  class="form-control" name="performance" onchange="showValue(this.value)">
		
		<script type="text/javascript">
		function showValue(newValue)
		{
			document.getElementById("range").innerHTML=newValue;
		}
		</script>
	</div>
	
	<div style="padding:10px">
	<button type="submit" class="btn btn-primary btn-block" style="padding: 10px ">Enter This Player</button>
	</div>
	
   
</form>
<div style="padding:10px">
		<a href = "Home.html">
			<button  class="btn btn-danger btn-block">Finished</button>
		</a>
	</div>
<br>

 <?php mysql_close($connector); ?>
</body>
</html>