<?php
 header('Content-Type: application/json'); 
// Database conectivity
$con=mysqli_connect("localhost","etech_atul","atul@001","etech_ajaxassignment") or die("Connection error : ".mysqli_connect_error());

$sql="SELECT * FROM user_data ORDER BY id DESC LIMIT 5";

$result=mysqli_query($con,$sql);
$rows=array();
while($record=mysqli_fetch_assoc($result)){
$rows[]=$record;
}
 $r=json_encode($rows);
 echo $r;

?>


