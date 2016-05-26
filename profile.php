<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Personal Details Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
<br>
<form class="form-horizontal" action="" method="post">
	<div class="form-group">
		<label class="col-md-4 control-label" for="log_button"></label>
		<div class="col-md-4">
		<button id="sub_button" name="log_button" class="btn btn-info">Logout</button>
	</div>
</div>
</form>
<br>
<form class="form-horizontal" action="" method="post">		
<fieldset>

<!-- Form Name -->
<legend>Personal Details</legend>

<!-- Multiple Radios -->
<div class="form-group">
  <label class="col-md-4 control-label" for="radios">Gender</label>
  <div class="col-md-4">
  <div class="radio">
    <label for="radios-0">
      <input type="radio" name="radios" id="radios-0" value="Male" checked="checked">
      Male
    </label>
	</div>
  <div class="radio">
    <label for="radios-1">
      <input type="radio" name="radios" id="radios-1" value="Female">
      Female
    </label>
	</div>
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="add1">Address Line 1</label>  
  <div class="col-md-4">
  <input id="add1" name="add1" type="text" placeholder="" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="add2">Address Line 2</label>  
  <div class="col-md-4">
  <input id="add2" name="add2" type="text" placeholder="" class="form-control input-md">
    
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="contact">Contact Number</label>  
  <div class="col-md-4">
  <input id="contact" name="contact" type="text" placeholder="Enter your Number" class="form-control input-md" required="">
  <span class="help-block">Mobile</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="dob">Date of Birth</label>  
  <div class="col-md-4">
  <input id="dob" name="dob" type="text" placeholder="Enter your Date of Birth" class="form-control input-md" required="">
  <span class="help-block">YYYY/MM/DD</span>  
  </div>
</div>

<!-- Text input-->
<div class="form-group">
  <label class="col-md-4 control-label" for="city">City</label>  
  <div class="col-md-4">
  <input id="city" name="city" type="text" placeholder="Enter your City" class="form-control input-md" required="">
    
  </div>
</div>

<!-- Button -->
<div class="form-group">
  <label class="col-md-4 control-label" for="sub_button"></label>
  <div class="col-md-4">
    <button id="sub_button" name="sub_button" class="btn btn-info">Submit</button>
  </div>
</div>

</fieldset>
</form>
</body>
</html>
<?php

$con = mysqli_connect("localhost","root","root","assignment");
if(isset($_POST["log_button"]))
{
	session_destroy();
	header('location:index.php');
}
else if(isset($_POST["sub_button"]))
{
	$wr = $_SESSION['email'];
	$we = "SELECT * from profile where Email= '${wr}'";
	$qw = mysqli_query($con,$we);
	if(mysqli_num_rows($qw)==0)
	{
		$a1 = $_POST["add1"];
		$a2 = $_POST["add2"];
		$a = $a1 . $a2;
		$g = $_POST["radios"];
		$contact = $_POST["contact"];
		$date = $_POST["dob"];
		$city = $_POST["city"];
		$query = "Insert into profile values('${wr}','${a}','${contact}','${date}','${g}','${city}')";
		mysqli_query($con,$query);
		echo "<script>alert('Thank You for your details')</script>";
	}
	else
	{
		echo "<script>alert('Only One Per User Allowed')</script>";
	}
}
?>