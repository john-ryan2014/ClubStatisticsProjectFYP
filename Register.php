<!DOCTYPE html>
<html lang="en">
<head>
  <title>Registration</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>


<body >

<div class="container text-center" style="color:black; font-size:4em">
  <p> GAA Club Statistics </p>     
   <h2>The statistics you need!</h2>
</div>
<br>

<style>
body {
    background-image: url("Stadium.jpg");
    background-repeat: no-repeat;
	background-size: cover;
    background-position: centered;
	color:black;
	
}

a{
color: white;
}

input[type=text], input[type=password] {
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    box-sizing: border-box;
	text-align: center;
}


button {
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    cursor: pointer;
    width: 100%;
}


.cancelbtn {
    padding: 14px 20px;
    background-color: #f44336;
}


.cancelbtn,.signupbtn {
    float: left;
    width: 50%;
}


.container {
    padding: 16px;
}


.clearfix::after {
    content: "";
    clear: both;
    display: table;
}


@media screen and (max-width: 300px) {
    .cancelbtn, .signupbtn {
       width: 100%;
    }
}
</style>

<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$con = new mysqli($servername, $username, $password,"mydb");
// Check connection
if ($con->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

// If form submitted, insert values into the database.
if (isset($_REQUEST['Username'])){
	$name = stripslashes($_REQUEST['name']);
	$name = mysqli_real_escape_string($con,$name);
    $email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);  
	$username = stripslashes($_REQUEST['Username']);
	$username = mysqli_real_escape_string($con,$username); 
	$email = stripslashes($_REQUEST['email']);
	$email = mysqli_real_escape_string($con,$email);
	$password = stripslashes($_REQUEST['psw']);
	$password = mysqli_real_escape_string($con,$password);
	$team = stripslashes($_REQUEST['team']);
	$team = mysqli_real_escape_string($con,$team);
	
    $query = "INSERT into `users` (Name, Username, Password, Email, TeamName)
			  VALUES ('$name','$username', '".md5($password)."', '$email', '$team')";
        $result = mysqli_query($con,$query);
        if($result)
		{
            echo "<div class='form' style='color:white'>
			<h3>You are registered successfully.</h3>
			<br/>Click here to <a href='login.php'>Login</a></div>";
        }
    }else{

?>



<div >
  <ul class="nav nav-tabs nav-justified" >
    <li style="background-color:red"><a href="Login.php" >Login</a></li>
    <li class="active" style="background-color:green"><a href="Register.php">Sign Up</a></li>
  </ul>
</div>
<br><br>

<h2 align="center" style="color:white">Registration Form</h2>

<form method="post" style="border:1px solid #ccc">
  <div class="container" >
    <div align="center">
    <h3><span class="label label-danger">Full Name:</span></h3>
    <input type="text" placeholder="Full Name" name="name" required>
    </div>
	
    <div align="center">
    <h3><span class="label label-danger">Email:</span></h3>
    <input type="text" placeholder="Enter Email" name="email" required>
    </div>
  
    <div align="center">
	<h3><span class="label label-danger">Username (must contain no spaces):</span></h3>
    <input type="text" placeholder="Username" name="Username" required>
	</div>
	
	<div align="center">
    <h3><span class="label label-danger">Password:</span></h3>
	<input type="password" placeholder="Enter Password" name="psw" required>
	</div>
	
	<div align="center">
    <h3><span class="label label-danger">Repeat Password:</span></h3>
    <input type="password" placeholder="Repeat Password" name="psw-repeat" required>
	</div>
	
	<div align="center">
	<h3><span class="label label-danger">Team Name:</span></h3>
    <input type="text" placeholder="Team Name" name="team" required>
	</div>
	
    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Sign Up</button>
    </div>
  </div>
</form>
<?php } ?>


</body>
</html>