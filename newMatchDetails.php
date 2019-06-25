<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password,"mydb");
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 


$name = mysqli_real_escape_string($conn, $_REQUEST['name']);
$minutes = mysqli_real_escape_string($conn, $_REQUEST['minutes']);
$points = mysqli_real_escape_string($conn, $_REQUEST['points']);
$assists = mysqli_real_escape_string($conn, $_REQUEST['assists']);
$hooks_blocks = mysqli_real_escape_string($conn, $_REQUEST['hooks_blocks']);
$puckouts_kickouts = mysqli_real_escape_string($conn, $_REQUEST['puckouts']);
$frees = mysqli_real_escape_string($conn, $_REQUEST['frees']);
$yellow = mysqli_real_escape_string($conn, $_REQUEST['yellow']);
$red = mysqli_real_escape_string($conn, $_REQUEST['red']);
$points_against = mysqli_real_escape_string($conn, $_REQUEST['points_against']);
$performance = mysqli_real_escape_string($conn, $_REQUEST['performance']);
$opposition = mysqli_real_escape_string($conn, $_REQUEST['opposition']);
session_start();
$manager = $_SESSION['Username'];

// attempt insert query execution
$sql = "UPDATE players 
SET MinutesPlayed = MinutesPlayed +'$minutes',PointsScored = PointsScored + $points,Assists = Assists + '$assists', HooksBlocks=HooksBlocks+'$hooks_blocks',
    PuckoutsWon=PuckoutsWon+'$puckouts_kickouts',Frees=Frees+'$frees', Yellow=Yellow+'$yellow', Red=Red+'$red', PointsAgainst=PointsAgainst+'$points_against',
	Performance=Performance+'$performance'
WHERE Name='$name' AND ManagerUsername='$manager';";

$sql .= "UPDATE game 
SET Opposition = '$opposition', MinutesPlayed ='$minutes',PointsScored = $points,Assists = '$assists', HooksBlocks='$hooks_blocks',
    PuckoutsWon='$puckouts_kickouts',Frees='$frees', Yellow='$yellow', Red='$red', PointsAgainst='$points_against',
	Performance='$performance'
WHERE Name='$name' AND ManagerUsername='$manager'";
if(mysqli_multi_query($conn, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 
// close connection
mysqli_close($conn);

//redirect back to html page
header("Location: Enter New Match Details.php");
exit;
?>