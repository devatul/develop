<?php
// Database conectivity
$con=mysqli_connect("localhost","etech_atul","atul@001","etech_ajaxassignment") or die("Connection error : ".mysqli_connect_error());

if(isset($_POST["submit"])){
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
$name=test_input($_POST["name"]);
$email=test_input($_POST["email"]);
$msg=test_input($_POST["message"]);
$date=test_input($_POST["date"]);


$sql="INSERT INTO user_data (name,email,message,date) VALUES ('$name','$email','$msg','$date')";

$result=mysqli_query($con,$sql);
if($result){
header("location:ajax.php?msg=1");
}
}
?>
<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

<script type="text/javascript">
		  $(function() {
    $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });
 
		function ajaxcall(){
			$.getJSON("result.php",
				function(results){
				
				var rowdata="<tbody>";
				$.each(results, function(i, field){
					rowdata +="<tr>";
           				$.each(field,function(keys,data){
           				rowdata +="<td>"+data+"</td>";
           				});
           				rowdata +="</tr>";
				});
				rowdata +="</tbody>";
				if($("#div1 > table").find("tbody").length>0){
				$("#div1 > table").find("tbody").remove();
				$("#div1 > table").append("<tr><th>Sr.No.</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>");
				$("#div1 > table").append(rowdata);
				}else{
				$("#div1 > table").append("<tr><th>Sr.No.</th><th>Name</th><th>Email</th><th>Message</th><th>Date</th></tr>");
				$("#div1 > table").append(rowdata);
				}		
			setTimeout(ajaxcall, 1000);
			});
		}

$(document).ready(function(){
    ajaxcall();
});

</script>

<style>
table,td,th{
border:1px solid gray;
}
</style>
<style>
 input[type=text],input[type=email],textarea{
    width: 100%;
    padding: 12px 20px;
    margin: 8px 0;
   // display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
}

input[type=submit] {
    width: 100%;
    background-color: #4CAF50;
    color: white;
    padding: 14px 20px;
    margin: 8px 0;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type=submit]:hover {
    background-color: #45a049;
}

#div2 {
    width:50%;
    margin-top:20px;
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
}

span{
color:red;
}
</style>
</head>
<body>
<div id="div1">
<table></table>
</div>

<div id="div2">
<center><?php if(isset($_GET['msg'])){
if($_GET['msg']==1){
echo '<span style="color:green">Data Inserted successfuly.</span>';
}else{
echo '<span style="color:red">Error Inserting data.</span>';
}
} ?></center>
  <form class="sub" method="POST" action="">
  
    <label for="name">Name</label>
    <input type="text" id="name" name="name"></br>

    <label for="email">Email</label>
    <input type="email" id="email" name="email"></br>

    <label for="message">Message</label>
   <textarea id="message" name="message"></textarea></br>
   
   <label for="date">Date</label>
   <input type="text" name="date" id="datepicker"></br>
  
    <input type="submit" name="submit" value="Submit">
    <span>All fields mandatory</span>
  </form>
</div>
<script>
//Name validation
function valid_name()
{
 var name=$("#name").val().trim(); //get the value of name input field
  if(name==""){ 		// checks if field is not empty
   $("#name").css({"border-color":"red"});// Error message shown if field is empty
   return false;
  }else{
   $("#name").css({"border-color":"#ccc"});
     return true;	
  }
}


//Message validation
function message()
{
 var msg1=$("#message").val().trim(); //get the value of name input field
  if(msg1===""){ 		// checks if field is not empty
   $("#message").css({"border-color":"red"});// Error message shown if field is empty
   return false;
  }else{
   $("#message").css({"border-color":"#ccc"});
     return true;	
  }
}
// Email validation function
function valid_email()
{
 var mail=$("#email").val().trim(); //get the value of email input field
  if(mail==""){ 		// checks if field is not empty
   $("#email").css({"border-color":"red"});// Error message shown if field is empty
   return false;
  }else{
   var re = '/^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/';	//Email pattern
   if(!re.test(mail)){ //Checks the email pattern is correct
     $("#email").css({"border-color":"red"});// Error if pattern do not match and return false if it match, return true
     return false;	
   }else{
    $("#email").css({"border-color":"#ccc"});
     return true;	
   }
}
}

//Date validation
function valid_date()
{
 var date=$("#datepicker").val().trim(); //get the value of name input field
  if(date==""){ 		// checks if field is not empty
   $("#datepicker").css({"border-color":"red"});// Error message shown if field is empty
   return false;
  }else{
   $("#datepicker").css({"border-color":"#ccc"});
     return true;	
  }
}
// form validation initiated here
$(document).on('submit','form.sub',function(e){ 
	if(!valid_name() || !valid_email() ||  !message() || !valid_date() ){
	  e.preventDefault();
	}
});
</script>
</body>
</html>

