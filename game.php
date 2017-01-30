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
        <li><a href="/project/signup.php">Sign Up</a></li>
        <li><a href="/project/signin.php">Sign In</a></li>
        <li><a href="/project/tasks.php">My Tasks</a></li>
        <li class="active"><a href="/project/game.php">Play a Game</a></li>

        
      </ul>
     
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<br><br><br>
<div class="col-md-12">
<form action="/project/game.php" method="post">
<h1>Play Rock, Paper, Scissors</h1>
<?php

if(isset($_POST['play']))
{
 $user_choice=$_POST['choice'];
 $comp_choice=rand(1,3);
 
 if($user_choice==$comp_choice)
 {
  echo "Computer played the same option. Tie!<br>";
 }

 if($user_choice==1&&$comp_choice==2)
 {
  echo "Computer played Paper. Computer wins!<br>";
 }
 if($user_choice==1&&$comp_choice==3)
 {
  echo "Computer played Scissors. User wins!<br>";
 }
 if($user_choice==2&&$comp_choice==1)
 {
  echo "Computer played Rock. User wins!<br>";
 }
 if($user_choice==2&&$comp_choice==3)
 {
  echo "Computer played Scissors. Computer wins!<br>";
 }
 if($user_choice==3&&$comp_choice==1)
 {
  echo "Computer played Rock. Computer wins!<br>";
 }
 if($user_choice==3&&$comp_choice==2)
 {
  echo "Computer played Paper. User wins!<br>";

 }
}


echo '<input type="radio" value="1" name="choice" />Rock<br>
<input type="radio" value="2" name="choice" />Paper<br>
<input type="radio" value="3" name="choice" />Scissors<br>
<input type="submit" name="play" value="Play"/>';

?>
</form>
</div>
</body>
</html>