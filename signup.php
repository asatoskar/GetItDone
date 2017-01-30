<!DOCTYPE html>
<html>
<head>

<link rel="stylesheet" type="text/css" href="/project/bootstrap-3.3.4-dist/css/bootstrap.min.css">
<style>

@import url(http://fonts.googleapis.com/css?family=Josefin+Sans:300,400);
h1{
font-family: "Josefin Sans", sans-serif;
font-weight:normal;
font-size:40px;
color:#000000;
letter-spacing:2px;
}

h3{
font-family: "Josefin Sans", sans-serif;
font-weight:normal;
font-size:20px;
color:#000000;
}

.navbar-brand{
font-family: "Josefin Sans", sans-serif;
font-weight:bold;
}

</style>

<script>
function validate()
{
var x=document.signup.username.value;

if(x==null||x=="")
{
alert("Username is blank. Please enter a valid username.");
return false;
}

var x=document.signup.password.value;
var y=document.signup.confirm.value;

if(x.length<6)
{
alert("Password is too short. Please enter a valid password.");
return false;
}

if(x.length>10)
{
alert("Password is too long. Please enter a valid password.");
return false;
}

if(x!=y)
{
alert("Passwords do not match. Please enter the same password again to confirm it.");
return false;
}

return true;
}
</script>
</head>
<body>

<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <a class="navbar-brand" href="/project/home.php">getitdone</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="/project/about.php">About</a></li>
        <li class="active"><a href="/project/signup.php">Sign Up</a></li>
        <li><a href="/project/signin.php">Sign In</a></li>
        <li><a href="/project/tasks.php">My Tasks</a></li>
        <li><a href="/project/game.php">Play a Game</a></li>

        
      </ul>

    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<br><br><br>


<?php
$dbc=mysqli_connect('localhost', 'root', '', 'todo') or die("Could not connect to database");

if(isset($_POST['submit']))

{
$username=$_POST['username'];
$password=$_POST['password'];
$query="INSERT INTO signup(username,password) VALUES('$username','$password')";
$query2="SELECT username FROM signup where username='$username'";

$result=mysqli_query($dbc,$query2);

$rowcount=mysqli_num_rows($result);

if($rowcount==0)
{
mysqli_query($dbc,$query);
echo "<h1>Signup successful!</h1><br>";
echo 'Sign in <a href="/project/signin.php">here</a>.';
}

else
{
echo "<h1>That username already exists. Enter a different username.</h1><br>";
echo '<form name="signup" method="post" action="/project/signup.php" onsubmit="return validate()">Username: <input type="text" name="username" /><br>Password (between 6 and 10 characters): <input type="password" name="password"/><br>Confirm Password: <input type="password" name="confirm"/><br><input type="submit" value="Sign Up" name="submit"/></form>';
}



}
else
{
echo '<h1><img src="/project/images/signup_icon.png"> sign up</h1>';
echo '<form name="signup" method="post" action="/project/signup.php" onsubmit="return validate()">
<h3>Username:</h3> <input type="text" name="username" /><br>
<h3>Password (between 6 and 10 characters): </h3><input type="password" name="password"/><br>
<h3>Confirm Password:</h3> <input type="password" name="confirm"/><br>
<input type="submit" value="Sign Up" name="submit" class="btn btn-default"/></form>';

}
mysqli_close($dbc);

?>


</body>
</html>