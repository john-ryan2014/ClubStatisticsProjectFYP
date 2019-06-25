<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Player Statistics</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
$result = mysql_query("SELECT * FROM players WHERE ManagerUsername='$manager'");

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

table 
{
    border-collapse: collapse;
	background-color: green;
	
}
th
{
	background-color: #053a0a;
    text-align: center;
    padding: 6px;
}

td 
{
    border-collapse: collapse;
    text-align: center;
    padding: 6px;
}

tr:nth-child(even) 
{
    background-color: #2d8434;
}
</style>
<div class = "container" align="center">
<h2>Overall Team Statistics</h2>
</div>

<br><br>
<div class="container">
<table class="table">
 <thead>
      <tr >
        <th>Player Name</th>
        <th>Position</th>
		<th><a href="minutesPlayed.php">Minutes Played</a></th>
		<th><a href="pointsScored.php">Points Scored </a></th>
        <th><a href="assists.php">Assists</a></th>
        <th><a href="hooksBlocks.php">Hooks/Blocks</a></th>
		<th><a href="puckoutsWon.php">Puckouts Won</a></th>
        <th><a href="freesConceded.php">Frees Conceded</a></th>
        <th><a href="yellowCards.php">Yellow Cards</a></th>
		<th><a href="redCards.php">Red Cards</a></th>
        <th><a href="pointsAgainst.php">Points Against</a></th>
        <th><a href="performance.php">Performance Score</a></th>
      </tr>
 </thead>
 
 <tbody>
 <?php
    while( $row = mysql_fetch_array( $result ) )
	    {
            echo "<tr>";
            echo "<td><strong>" .$row['Name']."</strong></td>";
            echo "<td>".$row['Position'] ."</td>";
			echo "<td>".$row['MinutesPlayed'] ."</td>";
			echo "<td>".$row['PointsScored'] ."</td>";
			echo "<td>".$row['Assists'] ."</td>";
			echo "<td>".$row['HooksBlocks'] ."</td>";
			echo "<td>".$row['PuckoutsWon'] ."</td>";
			echo "<td>".$row['Frees'] ."</td>";
			echo "<td>".$row['Yellow'] ."</td>";
			echo "<td>".$row['Red'] ."</td>";
			echo "<td>".$row['PointsAgainst'] ."</td>";
			echo "<td>".$row['Performance'] ."</td>";
            echo "</tr>";
        }

  ?>  
</tbody>
</table>
</div>
<div class="container" align="center" >
<h3>Click on a statistic heading to show the results in sorted order.</h3><br>
</div>
<?php mysql_close($connector); ?>
</body>
</html>