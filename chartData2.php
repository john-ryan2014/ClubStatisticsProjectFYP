
<!DOCTYPE html>
<html>
<head>
<style>
table {
    width: 80%;
    border-collapse: collapse;
	margin-left:10%; 
    margin-right:10%;
	background-color:white;
}

table, td, th {
    
    padding: 5px;
	text-align: center;
	background-color: #053a0a;
}

th {
	background-color:#93080f;
}
</style>
</head>
<body>

<?php
$q = intval($_GET['q']);

$servername = "localhost";
$username = "root";
$password = "";
$con = mysqli_connect($servername,$username,$password,'mydb');
if (!$con) {
    die('Could not connect: ' . mysqli_error($con));
}

session_start();
$manager = $_SESSION['Username'];

mysqli_select_db($con,"mydb");
$sql = "SELECT * FROM players WHERE ID = '".$q."' AND ManagerUsername='$manager' ";
$sql2 = "SELECT * FROM game WHERE ID = '".$q."' AND ManagerUsername='$manager' ";
$result = mysqli_query($con,$sql);
$result2 = mysqli_query($con,$sql2);

//Function to get the average statistic per game for each player
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

echo "<h2>Statistics From Last Game: </H2>";	
echo "<table>
<tr>
<th>Name</th>
<th>Position</th>
<th>Minutes Played</th>
<th>Points Scored</th>
<th>Assists</th>
<th>HooksBlocks</th>
<th>Puckouts Won</th>
<th>Frees Conceded</th>
<th>Yellow Cards</th>
<th>Red Cards</th>
<th>Points Against</th>
<th>Performance</th>
</tr>";

while($row = mysqli_fetch_array($result2)) 
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
			echo "</table>";
}

echo "<h2>Total Statistics So Far: </H2>";	
echo "<table>
<tr>
<th>Name</th>
<th>Position</th>
<th>Minutes Played</th>
<th>Points Scored</th>
<th>Assists</th>
<th>HooksBlocks</th>
<th>Puckouts Won</th>
<th>Frees Conceded</th>
<th>Yellow Cards</th>
<th>Red Cards</th>
<th>Points Against</th>
<th>Performance</th>
</tr>";
while($row = mysqli_fetch_array($result)) 
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
			echo "</table>";
			
echo "<br><h2>Average Statistics Per Game: </H2>";			
echo "
<table>
<tr>
<th>Name</th>
<th>Position</th>
<th>Minutes Played</th>
<th>Points Scored</th>
<th>Assists</th>
<th>HooksBlocks</th>
<th>Puckouts Won</th>
<th>Frees Conceded</th>
<th>Yellow Cards</th>
<th>Red Cards</th>
<th>Points Against</th>
<th>Performance</th>
</tr>";

echo "<tr>";
    echo "<td><strong>" .$row['Name']."</strong></td>";
    echo "<td>".$row['Position'] ."</td>";
	echo "<td>".average($row['MinutesPlayed'],$row['MinutesPlayed']) ."</td>";
	echo "<td>".average($row['PointsScored'],$row['MinutesPlayed']) ."</td>";
	echo "<td>".average($row['Assists'],$row['MinutesPlayed']) ."</td>";
	echo "<td>".average($row['HooksBlocks'] ,$row['MinutesPlayed'])."</td>";
	echo "<td>".average($row['PuckoutsWon'] ,$row['MinutesPlayed'])."</td>";
	echo "<td>".average($row['Frees'] ,$row['MinutesPlayed'])."</td>";
	echo "<td>".average($row['Yellow'],$row['MinutesPlayed']) ."</td>";
	echo "<td>".average($row['Red'] ,$row['MinutesPlayed'])."</td>";
	echo "<td>".average($row['PointsAgainst'] ,$row['MinutesPlayed'])."</td>";
	echo "<td>".average($row['Performance'],$row['MinutesPlayed'])."</td></tr>";
echo "</table>";
echo "<br>";



echo "<table>";
echo "<tr><th colspan='2'><h2>Player Feedback: </h2></th></tr>";
echo "<tr><td><strong>Game Time: </strong></td>"; 
	if (average($row['MinutesPlayed'],$row['MinutesPlayed']) == 70)
	{
		echo "<td>Excellent, ".$row['Name']. " has played the full match all year </td></tr>" ;
	}
	else if(average($row['MinutesPlayed'],$row['MinutesPlayed']) >= 50)
	{
		echo "<td>Very Good, ".$row['Name']. " has played over 50 minutes on average of each game so far  this year</td></tr>" ;
	}
	else if(average($row['MinutesPlayed'],$row['MinutesPlayed']) > 20 && average($row['MinutesPlayed'],$row['MinutesPlayed'] < 50))
	{
		echo "<td> Poor, ".$row['Name']. " has been taken off the pitch early many times this  year </td></tr>" ;
	}
	else
	{
		echo "<td> Very poor, ".$row['Name']. " has not played any games this year. </td></tr>" ;
		break;
	}

echo "<br>";
if($row['Position'] == 'Forward')
{
	echo "<tr><td><strong>Scoring Ability: </strong></td>";
	if (average($row['PointsScored'],$row['MinutesPlayed']) >= 4)
	{
		echo "<td>Excellent, ".$row['Name']. " has an excellent points scored to matches played ratio. They are one of the highest scoring players in the team.</td> </tr>" ;
	}
	else if(average($row['PointsScored'],$row['MinutesPlayed']) >= 2)
	{
		echo "<td>Very Good, ".$row['Name']. " is scoring on a regular basis and they are averaging 2 to 3 points per game.</td></tr> " ;
	}
	else if(average($row['PointsScored'],$row['MinutesPlayed']) == 1)
	{
		echo "<td> Relatively Good, ".$row['Name']. " is scoring an average of one point per game. There may be room for improvement here.</td> </tr>" ;
	}
	else
	{	
		echo "<td> Very poor, ".$row['Name']. " is not scoring points on a regular basis. This will need to be improved if they are to feature in the starting team.</td> </tr>" ;
	}
}	

echo "<br>";
echo "<tr><td><strong>Work Rate: </strong></td>";
if(average($row['Assists'],$row['MinutesPlayed']) >= 2)
{
	echo "<td>This player is very good at setting up scores for other players on the team. This is a very important trait to have as they are a very valuable asset to the team."; 
}
else if(average($row['Assists'],$row['MinutesPlayed']) > 0)
{
	echo "<td> This player is reasonable good at setting up scores for other players."; 
}
else
{
	echo "<td> This player is poor at setting up other players for scores. ";
}
if(average($row['HooksBlocks'] ,$row['MinutesPlayed']) >= 4)
{
	echo " This player has an excellent turnover ratio per game. They average over 4 turnovers per game which shows that they have a top quality work rate in the team.</td></tr>";
}
else if(average($row['HooksBlocks'] ,$row['MinutesPlayed']) > 1)
{
	echo " This player has a good turnover ratio per game. They average 2 to 3 turnovers per game which shows that they have a good quality work rate in the team. </td></tr>";
}
else
{
	echo " This player has a poor turnover ratio per game. Their work rate is poor. This is an area which they will have to improve on in order to start in the team.</td> </tr>";
}

echo "<br>";
echo "<tr><td><strong>Discipline: </strong></td>";
if(average($row['Frees'] ,$row['MinutesPlayed']) >= 3 )
{
	echo "<td>Very Poor. ".$row['Name']. " has a very poor foul ratio per game. This is an area where this player will have to improve on as it will cost the team many points. </td></tr>";
}
else if(average($row['Frees'] ,$row['MinutesPlayed']) >= 1)
{
	echo"<td>Relatively Poor. ".$row['Name']. " is giving away an average of 1 or 2 frees per game. This isn't terrible but it is an area that this player can improve on. </td></tr>";
}	
else
{
	echo "<td>Excellent, ".$row['Name']. " has an very good discipline record. They have an average foul count of 0 per game which is top quality. </td></tr>";
}

if($row['Position'] == 'Defender' || $row['Position'] == 'Midfielder')
{
	echo "<br>";
	echo "<tr><td><strong>Defender Marking Ability: </strong></td>";
	if(average($row['PointsAgainst'] ,$row['MinutesPlayed']) >= 3)
	{
		echo "<td>Very Poor. This player has conceded  more than 3 points on average per game. Work will have to be done in order to get this player tighter on their man that they are marking.</td></tr>";
	}
	else if(average($row['PointsAgainst'] ,$row['MinutesPlayed']) >= 1)
	{
		echo "<td>Good , however there is plenty of room for improvement as this player has conceded either 1 or 2 points per game. They should be able to improve on this. </td></tr>";	
	}
	else
	{
		echo "<td> Excellent. This player is keeping there man that they are making scoreless each match. This is very impressive and a highly desirable trait. </td></tr>";
	}
}

echo "<br>";
echo "<tr><td><strong>Performance Level: </strong></td>";
if(average($row['Performance'],$row['MinutesPlayed']) >= 9)
{
	echo "<td> Excellent. " .$row['Name']." is one of the top performers of the team.</td> </tr>";
}
else if(average($row['Performance'],$row['MinutesPlayed']) >= 7)
{
	echo "<td> Very Good. " .$row['Name']." is consistently putting in a good performance each match. He is one of the better quality players of the team </td></tr>";
}
else if(average($row['Performance'],$row['MinutesPlayed']) >= 5)
{
	echo "<td> Average. " .$row['Name']." is putting in a good performance each game. However he is not standing out and make some mistakes throughout each game. There is room for improvement.</td></tr> ";
}
else
{
	echo "<td>Poor. ".$row['Name']." is playing below a good enough standard. Their performance contains too many mistakes and they are not performing well enough to make the starting team. There is plenty of room for improvement. </td></tr>"; 
}


}
 echo "</table></div>";

mysqli_close($con);
?>
<br> <br>
</body>
</html>
