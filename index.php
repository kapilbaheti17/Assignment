<?php
session_start();
?>
<?php
function getEmail()
{
	if(isset($_COOKIE["email"]))
	{
		return $_COOKIE["email"];
	}
	else
		return "";
}
function getPassword()
{
	if(isset($_COOKIE["password"]))
	{
		return $_COOKIE["password"];
	}
	else
		return "";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login Form</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2>Assignment Page</h2>
  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home">Login</a></li>
    <li><a data-toggle="pill" href="#menu1">Sign UP!</a></li>
  </ul>
  
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active"><br>
	  <div class="panel panel-primary">
      <div class="panel-heading">Welcome to Login Form</div>
      <div class="panel-body"><h3>Hello!</h3></div>
	  </div>
	  <form class="form-horizontal" role="form" action="index.php" method="post">
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="l_email" value=<?php echo getEmail()?>> 
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="l_pass" value=<?php echo getPassword()?>>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <div class="checkbox">
          <label><input type="checkbox" name="rem"> Remember me</label>
        </div>
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name="l_button">Login</button>
      </div>
    </div>
  </form>
    </div>
    <div id="menu1" class="tab-pane fade">
      <br>
	   <div class="panel panel-primary">
      <div class="panel-heading">Welcome to Sign UP! Form</div>
      <div class="panel-body"><h3>Get Started!</h3></div>
	  </div>
	  <form class="form-horizontal" role="form" action="index.php" method="post">
	  <div class="form-group">
      <label class="control-label col-sm-2" for="name">Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" id="name" placeholder="Enter your name" name="name">
      </div>
	  </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" id="email" placeholder="Enter email" name="s_email">
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="pwd">Password:</label>
      <div class="col-sm-10">          
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="s_pass">
      </div>
    </div>
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" class="btn btn-default" name="s_button">Sign UP</button>
      </div>
    </div>
  </form>
      <p></p>
    </div>
  </div>
</div>

</body>
</html>
<?php

$host = "localhost";
$uname = "root";
$pass = "root";
$dbname = "assignment";

$con = mysqli_connect($host,$uname,$pass,$dbname);


if(isset($_POST["s_button"]))
{
	$u = $_POST["name"];
	$e = $_POST["s_email"];
	$p = $_POST["s_pass"];
	
	
	$res = "Select * from user where Email = '${e}'";
	
	$t = mysqli_query($con,$res);
	
	if(mysqli_num_rows($t)==0)
	{
	
		$q = "Insert into user values('${u}','${e}','${p}')";
		mysqli_query($con,$q);
		echo "<script>alert('Successfully Signed Up')</script>";
	}
	else
	{
		echo "<script>alert('Email Already Registered')</script>";
	}
}

else if(isset($_POST["l_button"]))
{
	
	$em = $_POST["l_email"];
	$lp = $_POST["l_pass"];

	$y = "Select * from user where Email = '${em}' and Password = '${lp}'";
	
	$rf = mysqli_query($con,$y);
	
	if(mysqli_num_rows($rf)==0)
	{
		echo "<script>alert('Does Not Exist Sign UP first')</script>";
	}
	else
	{
		if(!isset($_POST["rem"]))
		{
			$_SESSION['email'] = $em;
			$_SESSION['password'] = $lp;
			echo '<script>alert("Welcome")</script>';
		}
		else
		{
			$_SESSION['email'] = $em;
			$_SESSION['password'] = $lp;
			setcookie("email",$em,time()+60*60*24);
			setcookie("password",$lp,time()+60*60*24);
			echo '<script>alert("Welcome")</script>';
		}
		header("location:profile.php");
		exit();
	}	
}
?>