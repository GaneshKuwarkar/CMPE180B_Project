<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname="gym_system";
// Create connection
// $conn = new mysqli($servername, $username, $password);
$conn=mysqli_connect($servername,$username,$password,$dbname);
// Check connection
if ($conn->connect_error) {
  die("Connection to DB failed: " . $conn->connect_error);
}
echo "Connected to DB successfully";

?> 