<!DOCTYPE html>
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
</head>
<html>

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
        <li><a href="/project/signup.php">Sign Up</a></li>
        <li class="active"><a href="/project/signin.php">Sign In</a></li>
        <li><a href="/project/tasks.php">My Tasks</a></li>
        <li><a href="/project/game.php">Play a Game</a></li>

        
      </ul>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<br><br><br>


<?php
$dbc=mysqli_connect('localhost','root','','todo') or die("Error connecting to database");
if(isset($_POST['submit']))
{
$ent_username=$_POST['username'];
$ent_password=$_POST['password'];

$query1="SELECT * FROM signup WHERE username='$ent_username'";
$result1=mysqli_query($dbc,$query1);
if($result1==false)
{
echo "<h1>That username does not exist</h1><br>";
}

else
{
$query2="SELECT password FROM signup WHERE username='$ent_username'";
$result2=mysqli_query($dbc,$query2);

while($row=mysqli_fetch_array($result2))
{
  $stored_pass=$row['password'];
}
if($stored_pass==$ent_password)
{
echo "You have successfully signed in! Click My Tasks to view your tasks or to Sign Out.<br>";

session_start();

$_SESSION['username']= $ent_username;

}

}

}

else
{
echo '
<div class="col-md-12">
<br><h1><img src="/project/images/signin_icon.png"> sign in</h1><br>
<div class="col-md-12"><form action="/project/signin.php" method="post">
<h3>Username:</h3><input type="text" name="username" /><br><br>
<h3>Password:</h3><input type="password" name="password" /><br><br>
<input type="submit" value="Sign In" name="submit" class="btn btn-default"/>
</form>
</div>
</div>';
}
?>


</html>