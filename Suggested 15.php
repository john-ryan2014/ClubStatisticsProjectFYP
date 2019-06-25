<!DOCTYPE html>
<html lang="en">
<head>
  <title>Suggested 15</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
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

table {
    width: 70%;
	border: 1px solid white;
    
	margin-left:15%; 
    margin-right:15%;
	background-color:#116618;
	color:white;
	font-size: 1.4em;
}

table, td, th {
    
    padding: 5px;
	text-align: center;
	padding-top:2em;
	padding-bottom: 3em;
}


</style>

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
<div align="center">
	<h3><span class="label label-primary">The team suggested is based on overall performance from all statistics </span></h3>
</div>

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
$result = mysql_query("SELECT * FROM players WHERE ManagerUsername = '$manager'");

function average($val,$val2)
{
	if($val== 0)
	{
		return 0;
	}
	else
	{
		$val = ($val/$val2) * 70;
		return intval($val);
	}
}

$certainty = 0;
$points = 0;
$forwards = array();
$defenders = array();
$midfielders = array();
$Goalkeepers = array();

while( $row = mysql_fetch_array( $result ) )
{
	$points = 0;
	if($row['Position'] == "Forward")
	{
		if(average($row['PointsScored'],$row['MinutesPlayed']) >= 3)
		{
			$points += 1;
		}
		else if(average($row['PointsScored'],$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		if(average($row['Assists'],$row['MinutesPlayed']) >= 3)
		{
			$points += 1;
		}
		else if(average($row['Assists'],$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		if(average($row['PuckoutsWon'] ,$row['MinutesPlayed']) >= 3)
		{
			$points += 1;
		}
		else if(average($row['PuckoutsWon'] ,$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		if(average($row['HooksBlocks'] ,$row['MinutesPlayed'])>= 3)
		{
			$points += 1;
		}
		else if(average($row['HooksBlocks'] ,$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		if(average($row['Performance'],$row['MinutesPlayed']) >= 9)
		{
			$points += 1;
		}
		else if(average($row['Performance'],$row['MinutesPlayed']) >= 7)
		{
			$points += 0.5;
		}
		
		
		$attacker= array($row['Name']=>$points);
		$forwards = $forwards + $attacker;
	
	}
	else if($row['Position'] == "Defender")
	{
		if(average($row['PuckoutsWon'] ,$row['MinutesPlayed']) >= 3)
		{
			$points += 1;
		}
		else if(average($row['PuckoutsWon'] ,$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		if(average($row['HooksBlocks'] ,$row['MinutesPlayed']) >= 3)
		{
			$points += 1;
		}
		else if(average($row['HooksBlocks'] ,$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		if(average($row['Frees'] ,$row['MinutesPlayed']) >= 3)
		{
			$points -= 1;
		}
		else if(average($row['Frees'] ,$row['MinutesPlayed']) == 2)
		{
			$points -= 0.5;
		}
		
		if(average($row['PointsAgainst'] ,$row['MinutesPlayed']) >= 3)
		{
			$points -= 1;
		}
		else if(average($row['PointsAgainst'] ,$row['MinutesPlayed']) == 2)
		{
			$points -= 0.5;
		}
		
		if(average($row['Performance'],$row['MinutesPlayed']))
		{
			$points += 1;
		}
		else if(average($row['Performance'],$row['MinutesPlayed']))
		{
			$points += 0.5;
		}
		
		$defender= array($row['Name']=>$points);
		$defenders = $defenders + $defender;
	}
	else if($row['Position'] == "Midfielder")
	{
		if(average($row['PointsScored'],$row['MinutesPlayed']) >= 3)
		{
			$points += 1;
		}
		else if(average($row['PointsScored'],$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		if(average($row['Assists'],$row['MinutesPlayed']) >= 3)
		{
			$points += 1;
		}
		else if(average($row['Assists'],$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		if(average($row['PuckoutsWon'] ,$row['MinutesPlayed']) >= 3)
		{
			$points += 1;
		}
		else if(average($row['PuckoutsWon'] ,$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		if(average($row['HooksBlocks'] ,$row['MinutesPlayed']) >= 3)
		{
			$points += 1;
		}
		else if(average($row['HooksBlocks'] ,$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		if(average($row['Frees'] ,$row['MinutesPlayed']) >= 3)
		{
			$points -= 1;
		}
		else if(average($row['Frees'] ,$row['MinutesPlayed']) == 2)
		{
			$points -= 0.5;
		}
		
		if(average($row['PointsAgainst'] ,$row['MinutesPlayed']) >= 3)
		{
			$points -= 1;
		}
		else if(average($row['PointsAgainst'] ,$row['MinutesPlayed']) == 2)
		{
			$points -= 0.5;
		}
		
		if(average($row['Performance'],$row['MinutesPlayed']) >= 3)
		{
			$points += 1;
		}
		else if(average($row['Performance'],$row['MinutesPlayed']) >= 1)
		{
			$points += 0.5;
		}
		
		$midfielder= array($row['Name']=>$points);
		$midfielders = $midfielders + $midfielder;
	}
	else if($row['Position'] == "Goalkeeper")
	{
		if($row['Performance'] >= 7)
		{
			$points += 1;
		}
		$Goalkeeper= array($row['Name']=>$points);
		$Goalkeepers = $Goalkeepers + $Goalkeeper;
	}
	
	
}

$a = 0;
$b = 0;
$c = 0;
$d = 0;

$squadNum = 15;
arsort($forwards);
echo "<table > <tr>";
foreach($forwards as $x => $x_value) 
{
	if($a >= 6)
	{
		break;
	}
	$a++;
	$certainty = intval(($x_value/4) * 100);
	if($certainty <= 0)
	{
		echo "<td>".$squadNum.". " . $x ." <span class='badge' style='background-color:red; color:black'>".$certainty ."%</span></td>";
	}
	else
	{
		echo "<td>".$squadNum.". " . $x ." <span class='badge' style='background-color:white; color:black'>".$certainty ."%</span></td>";
	}
	$squadNum--;
	if($a == 3)
	{
		echo "</tr><tr>";
	}
    
}
echo "</tr></table>";



echo"<table><tr>";
arsort($midfielders);
$squadNum = 9;

foreach($midfielders as $x => $x_value) 
{
	if($b >= 2)
	{
		break;
	}
	$b++;
	$certainty = intval(($x_value/5) * 100);
    if($certainty <= 0)
	{
		echo "<td>".$squadNum.". " . $x ." <span class='badge' style='background-color:red; color:black'>".$certainty ."%</span></td>";
	}
	else
	{
		echo "<td>".$squadNum.". " . $x ." <span class='badge' style='background-color:white; color:black'>".$certainty ."%</span></td>";
	}
	$squadNum--;
    
}
echo "</tr></table>";

echo "<table><tr>";
arsort($defenders);

$squadNum = 7;
foreach($defenders as $x => $x_value) 
{
	if($c >= 6)
	{
		break;
	}
	$c++;
	$certainty = intval(($x_value/3) * 100);
	if($certainty <= 0)
	{
		echo "<td>".$squadNum.". " . $x ." <span class='badge' style='background-color:red; color:black'>".$certainty ."%</span></td>";
	}
	else
	{
		echo "<td>".$squadNum.". " . $x ." <span class='badge' style='background-color:white; color:black'>".$certainty ."%</span></td>";
	}
	$squadNum--;
	if($c == 3)
	{
		echo "</tr><tr>";
	}
}


echo "</tr></table>";

arsort($Goalkeepers);

echo "<table><tr>";
foreach($Goalkeepers as $x => $x_value) 
{
	if($d >= 1)
	{
		break;
	}
	$d++;
	$certainty = intval(($x_value/1) * 100);
    echo "<td> 1." . $x ." <span class='badge' style='background-color:white; color:black'>".$certainty ."%</spam></td></tr></table>";
	
}

?>
<br>
<div class="container" align="center">
<span class='badge' style='background-color:white; color:black'> % </span> <p>equal to the certainty factor percentage to decide if a player should be starting.</p>
</div>
</body>
</html>

