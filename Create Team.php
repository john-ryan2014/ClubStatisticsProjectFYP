<!DOCTYPE html>
<html lang="en">
<head>
  <title>Create New Team</title>
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
<body link="white">

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
	<h2><span class="label label-success">Please fill out the following information for each player on the team: </span></h2>
</div>

<div align="center">	
<form action="createTeam handler.php" method="post">
  
  <div class="form-group"  align="center">
    <label for="Name">Player Name:</label>
    <input type="text" class="form-control" name="name">
  </div>
  
  <div class="form-group" align="center">
    <label for="Position">Phone Number:</label>
    <input type="text" class="form-control" name="phone">
  </div>
  <div class="form-group" align="center">
  <br>
    <label for="position">Position:   </label>
	<input type="radio"  name="position" value="Forward" checked> Forward
	<input type="radio"  name="position" value="Defender"> Defender
	<input type="radio"  name="position" value="Midfielder"> Midfielder
	<input type="radio"  name="position" value="Goalkeeper"> Goalkeeper
  </div>
  <br>
  <button type="submit" class="btn btn-primary btn-block">Enter This Player</button>
  
</form>
</div>
<a href = "Home.html">
  <button  class="btn btn-danger btn-block">Finished</button>
</a>
</body>
</html>