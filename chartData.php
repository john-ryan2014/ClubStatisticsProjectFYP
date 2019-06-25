<?php
header('Content-Type: application/json');
$servername = "localhost";
$username = "root";
$password = "";

//Create connection
$connector = mysql_connect($servername,$username,$password)
    or die("Unable to connect");
    
$selected = mysql_select_db("mydb", $connector)
    or die("Unable to connect");

session_start();
$manager = $_SESSION['Username'];
$result = mysql_query("SELECT * FROM players Where MinutesPlayed >= 1 AND ManagerUsername = '$manager'");




//loop through the returned data
$data = array();
while( $row = mysql_fetch_array( $result ) )
	{
	$data[] = $row;
	}
mysql_close($connector);
print json_encode($data);
?>
