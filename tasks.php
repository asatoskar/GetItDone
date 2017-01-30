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

</script>


</head>
<body>

<form name="main" action="/project/tasks.php" method="post">

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
        <li class="active"><a href="/project/tasks.php">My Tasks</a></li>
        <li><a href="/project/game.php">Play a Game</a></li>

        
      </ul>
      
      <ul class="nav navbar-nav navbar-right"><br>
        <li><input type="submit" name="signout" value="Sign Out" class ="btn btn-primary"></li><br>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
<br><br><br>

<div class="col-md-12">
<?php
session_start();
$dbc=mysqli_connect('localhost', 'root', '', 'todo') or die("Error connecting to database.");
if(isset($_SESSION['username']))
{


$username=$_SESSION['username'];


if(isset($_POST['signout']))
{
 unset($_SESSION['username']);
 session_destroy();
 echo "You have successfully signed out.";

}
else
{


$query_refresh="DELETE FROM tasks WHERE duedate<NOW()";
mysqli_query($dbc, $query_refresh);

if(isset($_POST['addtask']))
{ 
   $task=$_POST['add'];
   $year=$_POST['year'];
   $month=$_POST['month'];
   $day=$_POST['day'];
   $hour=$_POST['hour'];
   $min=$_POST['min'];
   $datetime=$year.'-'.$month.'-'.$day.'-'.$hour.'-'.$min.'-00';
   $date=$year.'-'.$month.'-'.$day;
   $date_arr=explode('-',$date);
   if(checkdate($date_arr[1],$date_arr[2],$date_arr[0]))
{
   if($task==="" or $task===null)
   echo "<h3>Please enter task desciption.</h3>";
   else
   {
   if((strtotime($datetime))>=time())
   {
   $query3="INSERT INTO tasks(id,username,task,time,duedate) VALUES (NULL,'$username','$task',NOW(),'$datetime')";
   mysqli_query($dbc, $query3) or die("Error adding task.");
   }
else
echo "<h1>Entered date has already passed. Please enter valid date.</h1>";
}
}
else
echo '<h3>Due date entered for task is invalid. Select valid date</h3>';

}


if(isset($_POST['deletetask']))
{

if(!empty($_POST['todelete']))
{
foreach($_POST['todelete']as $delete_id)
{
$query2="DELETE FROM tasks WHERE id='$delete_id'";
mysqli_query($dbc, $query2);
}
}
else
echo '<h3>You did not select any tasks to delete.</h3>';
}



$query1="SELECT id,task,duedate FROM tasks WHERE username='$username' ORDER BY duedate ASC";
$result=mysqli_query($dbc,$query1);

echo '<h1><img src="/project/images/tasks_icon.png"> your tasks</h1><br>';
echo '<div class="col-md-6"><h3>Task</h3></div>
<div class="col-md-6"><h3>Due</h3></div><br>';

while($row=mysqli_fetch_array($result))
{
$duedate=strtotime($row['duedate']);
echo '<div class="col-md-12">';
echo '<div class="col-md-6"><input type="checkbox" value="'.$row['id'].'" name="todelete[]" />'.$row['task'].'</div>';

echo '<div class="col-md-6">'.date('H:i d/m/y',$duedate).'</div>';
echo '</div>';

}

echo '<div class="col-md-12"><br><br><br>
<input type="text" name="add" />

<br>Due on:

Day:
<select name="day">
<option value="01">1</option>
<option value="02">2</option>
<option value="03">3</option>
<option value="04">4</option>
<option value="05">5</option>
<option value="06">6</option>
<option value="07">7</option>
<option value="08">8</option>
<option value="09">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
<option value="24">24</option>
<option value="25">25</option>
<option value="26">26</option>
<option value="27">27</option>
<option value="28">28</option>
<option value="29">29</option>
<option value="30">30</option>
<option value="31">31</option>
</select>

Month:
<select name="month">
<option value="01">Jan</option>
<option value="02">Feb</option>
<option value="03">Mar</option>
<option value="04">Apr</option>
<option value="05">May</option>
<option value="06">Jun</option>
<option value="07">Jul</option>
<option value="08">Aug</option>
<option value="09">Sep</option>
<option value="10">Oct</option>
<option value="11">Nov</option>
<option value="12">Dec</option>
<br>
</select>

Year:
<select name="year">
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>
<option value="2020">2020</option>
</select>

Hour:
<select name="hour">
<option value="00">0</option>
<option value="01">1</option>
<option value="02">2</option>
<option value="03">3</option>
<option value="04">4</option>
<option value="05">5</option>
<option value="06">6</option>
<option value="07">7</option>
<option value="08">8</option>
<option value="09">9</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
</select>

Minutes:
<select name="min">
<option value="00">00</option>
<option value="10">10</option>
<option value="20">20</option>
<option value="30">30</option>
<option value="40">40</option>
<option value="50">50</option>
</select>



<input type="submit" name="addtask" value="Add Task" class="btn btn-default"/>
</div><br>';
echo  '<div class="col-md-12"><br><input type="submit" name="deletetask" value="Delete Selected Tasks" class="btn btn-default"/></div>';
echo '<div class="col-md-12"><br><input type="submit" name="refresh" value="Refresh" /></div>';
mysqli_close($dbc);
}
}
else
echo "<h1>You are not signed in.</h1>";
?>
</form>

</div>

<script src="http://code.jquery.com/jquery.min.js"></script>
<script src="/project/bootstrap-3.3.4-dist/js/bootstrap.min.js"></script>
</body>
</html>