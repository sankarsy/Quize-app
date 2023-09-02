<?php
// $servername ="localhost";
// $username ="root";
// $password ="";
// $dbname ="project";

// $con= mysqli_connect($servername,$username,$password,$dbname);
// if($con){
//     echo "connection ok";
// }
// else{
//     echo "connection failed";
// }
session_start();

$name = "";
$email = "";
$errors = array(); 
$_SESSION['success'] = "";

include("config.php");

if(isset($_POST['submit']))
{
	$name = $_POST['name'];
	$email = $_POST['email'];
    $password = $_POST['password'];
	$number = $_POST['mobilenumber'];
	
	$result = mysqli_query($con,"insert into users values('$name','$email','$password','$number')");
	if($result)
	{	
		$_SESSION['name'] = $name;
		$_SESSION['success'] = "You are now logged in";
		// echo "Registration Successfully";
		header("location:login.php?mes=<p class='correct'>Registration Successfully .please login Here</P>");
	}
	else{
		echo "failed:";
	}
}


?>