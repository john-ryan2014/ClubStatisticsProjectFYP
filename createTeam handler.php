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
$phone_number = mysqli_real_escape_string($conn, $_REQUEST['phone']);
$position = mysqli_real_escape_string($conn, $_REQUEST['position']);
session_start();
$manager = $_SESSION['Username'];
// attempt insert query execution
$sql = "INSERT INTO players (ManagerUsername, Name, Phone_Number, position) VALUES ('$manager','$name','$phone_number','$position');";
$sql .= "INSERT INTO game (ManagerUsername,Name, position) VALUES ('$manager','$name','$position')"; 
if(mysqli_multi_query($conn, $sql)){
    echo "Records added successfully.";
} else{
    echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
}
 
// close connection
mysqli_close($conn);

//redirect back to html page
header("Location: Create Team.php");
exit;
?>