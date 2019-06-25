<!DOCTYPE html>
<html lang="en">
<head>
  <title>Performance</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
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
<br><br>

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


<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else { 
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("txtHint").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET","chartData2.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
</head>
<body>

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

?>
<form>
	<div class="form-group" align="center">
		<h3><span class="label label-success">Player Name: </span></h3>
		<select style="height:50px;width:150px; color:black" name="users" onchange="showUser(this.value)">
		<option value="">Select a person:</option>
		
		<?php
		while( $row = mysql_fetch_array( $result ) )
	    {
            
			echo '<option value="'. $row['ID']. '">'.$row['Name']."</option>"  ;  
            
        }
		
		?> 
		</select>
	</div>
</form>


<br>
<div align="center" id="txtHint"><b>Please enter a player name..</b> </div>




</body>
</html>	