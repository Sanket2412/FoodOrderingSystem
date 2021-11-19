
<?php
session_start();
?>

<html>

  <head>
    <title> Home | FRIENDS CORNER CAFE </title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <link rel="stylesheet" type = "text/css" href ="css/index.css">
<link rel="stylesheet" type = "text/css" href ="css/back.css">
  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top navigation-clean-search" role="navigation">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#myNavbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php"> FRIENDS CORNER CAFE</a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav">
            	<li class="active" ><a href="index.php">Home</a></li>
            	<li><a href="aboutus.php">About</a></li>
		
           </ul>

<?php
if(isset($_SESSION['login_user1']))
{

?>
          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile2.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user1']; ?> </a></li>
            <li><a href="view_order_details.php"> MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
<?php
}
else if (isset($_SESSION['login_user2']))
 {
  ?>
           <ul class="nav navbar-nav navbar-right">
            <li><a href="profile.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $_SESSION['login_user2']; ?> </a></li>
            <li><a href="foodlist.php"><span class="glyphicon glyphicon-cutlery"></span> Food Zone </a></li>
            <li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart
              (<?php
              if(isset($_SESSION["cart"]))
	{
            	  $count = count($_SESSION["cart"]); 
            	  echo "$count"; 
            	}
              else
                	echo "0";
              ?>
             </a></li>
	<li><a href="order.php">Orders</a></li>
            <li><a href="logout_u.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
  <?php        
}
else
{
?>
	<ul class="nav navbar-nav">
	<li><a href="managerlogin.php"> Manager Login</li>
	</ul>
<?php
}

?>  
     </div>

      </div>
    </nav>



    <div class="wide">
      	<div class="col-xs-5 line"><hr></div>
        <div class="col-xs-2 logo"><img src="css/images/FC.jpg"></div>
        <div class="col-xs-5 line"><hr></div>
        <div class="tagline"><marquee>Good Mood Requires Good Food</marquee></div>
    </div>
    <br>

    <div class="orderblock">
    <h2 style="color:green">Feeling Hungry?</h2>
    <center><a class="btn btn-success btn-lg" href="customerlogin.php" role="button" > Order Now </a></center>
    </div>

    
  
</body>
</html>