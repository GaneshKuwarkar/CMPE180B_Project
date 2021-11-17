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
// echo "Connected to DB successfully";
date_default_timezone_set('America/Los_Angeles');
function logger($level, $message){
  $requestlogFile = "../request.log";
  $errorlogFile = "../error.log";
  $date = new DateTime();
  $date = $date->format("y:m:d h:i:s");
  $message = $level ." : ".$date ."--". $message . PHP_EOL;
  if($level == "ERROR") {
    return file_put_contents($errorlogFile, $message, FILE_APPEND);
  }else {
    return file_put_contents($requestlogFile, $message, FILE_APPEND);
  }
    
}
  

?> 