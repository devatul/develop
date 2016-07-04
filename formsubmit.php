<?php
// Database conectivity
$con=mysqli_connect("localhost","etech_atul","atul@001","etech_ajaxassignment") or die("Connection error : ".mysqli_connect_error());


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$name=test_input($_POST["name1"]);
$email=test_input($_POST["email"]);
$msg=test_input($_POST["msg"]);
$date1=test_input($_POST["date1"]);


$sql="INSERT INTO user_data (name,email,message,date) VALUES ('$name','$email','$msg','$date1')";

$result=mysqli_query($con,$sql);
if($result){
echo "Data Inserted Successfully.";
}

?>