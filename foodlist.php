<?php
session_start();

if(!isset($_SESSION['login_user2']))
{
header("location: customerlogin.php"); 
}

?>

<html>

  <head>
    <title> Explore | FRIENDS CORNER CAFE</title>
	<script>
		function upp(e)
		{
			var str=document.getElementById("search").value;
			var a=String.fromCharCode(e.which);
			var b=a.toUpperCase();
			var str1=str.concat(b);
			e.preventDefault();
			document.getElementById("search").value=str1;
		}
		function color()
		{
			document.getElementById("colorBURGER").className += "btn btn-info form-control";	
			document.getElementById("colorPIZZA").className += "btn btn-warning  form-control";
		}
	</script>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/foodlist.css">
<link rel="stylesheet" type = "text/css" href ="css/back.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>

  <body onload="color()">
<button onclick="topFunction()" id="myBtn" title="Go to top">
      <span class="glyphicon glyphicon-chevron-up"></span>
    </button>
    <script type="text/javascript">
      window.onscroll = function()
      {
        scrollFunction()
      };

      function scrollFunction(){
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          document.getElementById("myBtn").style.display = "block";
        } else {
          document.getElementById("myBtn").style.display = "none";
        }
      }

      function topFunction() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>


    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">FRIENDS CORNER CAFE</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>

          </ul>
<?php
if(isset($_SESSION['login_user1'])){

?>



          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile2.php"><span class="glyphicon glyphicon-user"></span> Welcome<?php echo $_SESSION['login_user1']; ?></a></li>
	<li><a href="view_order_details.php">MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>

<?php
}
else if (isset($_SESSION['login_user2'])) {
  ?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li class="active" ><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span>Food Zone </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart  (<?php
              if(isset($_SESSION["cart"])){
              $count = count($_SESSION["cart"]); 
              echo "$count"; 
            }
              else
                echo "0";
              ?>) </a></li>
	<li><a href="order.php">Orders </a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
  <?php        
}
else {

  ?>



<ul class="nav navbar-nav navbar-right">
            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-user"></span> Sign Up <span class="caret"></span> </a>
                <ul class="dropdown-menu">
              <li> <a href="customersignup.php"> User Sign-up</a></li>
            </ul>
            </li>

            <li><a href="#" class="dropdown-toggle active" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><span class="glyphicon glyphicon-log-in"></span> Login <span class="caret"></span></a>
              <ul class="dropdown-menu">
              <li> <a href="customerlogin.php"> User Login</a></li>
            </ul>
            </li>
          </ul>
<?php
}
?>




        </div>

      </div>
    </nav>
<div class="jumbotron" style="height: 250px;">
  <div class="container text-center">
    <h1>Welcome To FRIENDS CORNER CAFE....'</h1>      
    <!--p>Let FOOD be the solution to all PROBLEMS</p-->
  </div>
</div>

<div class="container" style="margin-top:50px;" >
<form method="GET" action="foodlist.php">
	<div class="input-group">
	<input type="text" class="form-control" placeholder="Search" id="search" name="search" onkeypress="upp(event)">
	<div class="input-group-btn">
	<button class="btn btn-primary" type="submit" id="submit" name="submit"><i class="glyphicon glyphicon-search"></i></button>
	</div>
	</div>
</form>
</div>
<?php
require 'connection.php';
$conn = Connect();
$f_name="5698545123";
if (isset($_GET['submit']))
{
	$f_name= $_GET['search'];
	$query="SELECT * FROM food WHERE locate('".$f_name."',f_name);";
	$result= mysqli_query($conn, $query);
	if (mysqli_num_rows($result) > 0)
	{
  		$count=0;

  		while($row= mysqli_fetch_assoc($result))
		{
    		if ($count == 0)
      			echo "<div class='row'>";
?>
<div class="col-md-3">

<form method="post" action="cart.php?action=add&id=<?php echo $row["f_id"]; ?>">
<div class="mypanel" align="center";>
<img src="<?php echo $row["f_img_src"]; ?>" class="img-responsive">
<h4 class="text-dark"><?php echo $row["f_name"]; ?></h4>
<h5 class="text-danger">&#8377; <?php echo $row["f_rate"]; ?>/-</h5>
<h5 class="text-info">Quantity: <div class="form-group"><input type="number"  id="quantity"   name="quantity" min="1"  max="20" value="1"  style="width:60px;">
</h5>
<input type="hidden" name="hidden_name" value="<?php echo $row["f_name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["f_rate"]; ?>">
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
</div>
</form>
      
     
</div>

<?php
$count++;
if($count==4)
{
  echo "</div>";
  $count=0;
}
}
?>



</div>
</div>
<?php
}
else
{
  ?>

  <div class="container">
    <div class="jumbotron">
      <center>
         <label style="margin-left: 5px;color: red;"> <h1>Oops! No Food Is Avaiable</h1> </label>
        <p></p>
      </center>
       
    </div>
  </div>

  <?php

}
}
?>
<br><br>
<?php
	$sql1 = "SELECT DISTINCT(f_type) FROM food";
	$result1 = mysqli_query($conn, $sql1);
	 while($row1= mysqli_fetch_assoc($result1))
{
$ftype=$row1['f_type'];
?>
<div class="container" style="width:95%">
<button type="button"  class="form-control" id="color<?php echo $ftype ;?>" data-toggle="collapse" data-target="#<?php echo $ftype ;?>"><?php echo $ftype ;?></button>
  <div id="<?php echo $ftype ;?>" class="collapse">
<br>
<!-- Display all Food from food table -->
<?php

$sql = "SELECT * FROM `food` WHERE f_type='".$ftype."' AND NOT locate('".$f_name."',f_name)  ORDER BY f_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0)
{
  $count=0;

  while($row = mysqli_fetch_assoc($result)){
    if ($count == 0)
      echo "<div class='row'>";

?>
<div class="col-md-3">

<form method="post" action="cart.php?action=add&id=<?php echo $row["f_id"]; ?>">
<div class="mypanel" align="center";>
<img src="<?php echo $row["f_img_src"]; ?>" class="img-responsive">
<h4 class="text-dark"><?php echo $row["f_name"]; ?></h4>
<h5 class="text-danger">&#8377; <?php echo $row["f_rate"]; ?>/-</h5>
<h5 class="text-info">Quantity: <div class="form-group">
  <input type="number" class="form-control" id="quantity" name="quantity" min="1" value="1" max="20" style="width:60px;">
</div></h5>
<input type="hidden" name="hidden_name" value="<?php echo $row["f_name"]; ?>">
<input type="hidden" name="hidden_price" value="<?php echo $row["f_rate"]; ?>">
<input type="submit" name="add" style="margin-top:5px;" class="btn btn-success" value="Add to Cart">
</div>
</form>
      
     
</div>

<?php
$count++;
if($count==4)
{
  echo "</div>";
  $count=0;
}
}
?>



</div>
</div>
<?php
}
else
{
  ?>

  <div class="container">
    <div class="jumbotron">
      <center>
         <label style="margin-left: 5px;color: red;"> <h1>Oops! No Food is available.</h1> </label>
        <p>Stay Hungry...! :P</p>
      </center>
       
    </div>
  </div>

  <?php

}

?>
</div> 
<br>
<?php
}
?>
</body>
</html>