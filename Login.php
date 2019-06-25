<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login</title>
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
	color:white;
	
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

session_start();

if (isset($_POST['Username']))
{  
	$username = stripslashes($_REQUEST['Username']);
	$username = mysqli_real_escape_string($con,$username);
	$password = stripslashes($_REQUEST['psw']);
	$password = mysqli_real_escape_string($con,$password);
	//Checking is user existing in the database or not
        $query = "SELECT * FROM `users` WHERE Username='$username'
				  and Password='".md5($password)."'";
	$result = mysqli_query($con,$query) or die(mysql_error());
	$rows = mysqli_num_rows($result);
        if($rows==1)
		{
			$_SESSION['Username'] = $username;
            // Redirect user to home page
			header("Location: Home.html");
        }
		else
		{
			echo "<div class='form'>
			<h3>Username/password is incorrect.</h3>
			<br/>Click here to <a href='login.php'>Login</a></div>";
		}
}else{
?>


<div >
  <ul class="nav nav-tabs nav-justified" >
    <li class="active" style="background-color:red"><a href="Login.php" >Login</a></li>
    <li style="background-color:green"><a href="Register.php">Sign Up</a></li>
  </ul>
</div>
<br><br>

<h2 align="center">Login Form</h2>

<form method="post" style="border:1px solid #ccc ">
  <div class="container" >
    
  
    <div align="center">
	<label><b>Username ( Must contain no spaces ) </b></label>
    <input type="text" placeholder="Username" name="Username" style="color:black" required>
	</div>
	
	<div align="center">
    <label><b>Password</b></label>
	<input type="password" placeholder="Enter Password" name="psw" style="color:black" required>
	</div>
	
    <div class="clearfix">
      <button type="button" class="cancelbtn">Cancel</button>
      <button type="submit" class="signupbtn">Log In</button>
    </div>
  </div>
</form>
<?php } ?>
</body>
</html>