<?php
include('session_m.php');

if(!isset($login_session)){
header('Location: managerlogin.php'); 
}

?>
<!DOCTYPE html>
<html>

  <head>
    <title> Manager Login | FRIENDS CORNER CAFE</title>
  </head>

  <link rel="stylesheet" type = "text/css" href ="css/edit_food_items.css">
<link rel="stylesheet" type = "text/css" href ="css/back.css">
  <link rel="stylesheet" type = "text/css" href ="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
  <script type="text/javascript" src="js/jquery.min.js"></script>
  <script type="text/javascript" src="js/bootstrap.min.js"></script>
  <script type="text/javascript">
    function display_alert()
    {
      alert("Data Updated Successfully...!!!");
    }
	function check(e)
	{
		var ch=String.fromCharCode(e.which);
    		if(!(/[0-9]/.test(ch)))
    		{
        			e.preventDefault();
  		}
		 if(e.keyCode == 32)
		{
       	 		e.preventDefault();	
    		}
	}
  </script>

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
          <a class="navbar-brand" href="index.php">FRIENDS CORNER CAFE</a>
        </div>

        <div class="collapse navbar-collapse " id="myNavbar">
          <ul class="nav navbar-nav">
            <li><a href="index.php">Home</a></li>
            <li><a href="aboutus.php">About</a></li>
            
          </ul>

          <ul class="nav navbar-nav navbar-right">
            <li><a href="profile2.php"><span class="glyphicon glyphicon-user"></span> Welcome <?php echo $login_session; ?> </a></li>
            <li class="active"> <a href="edit_food_items.php">MANAGER CONTROL PANEL</a></li>
            <li><a href="logout_m.php"><span class="glyphicon glyphicon-log-out"></span> Log Out </a></li>
          </ul>
        </div>

      </div>
    </nav>




<div class="container">
    <div class="jumbotron">
     <h1>Hello Manager! </h1>
     <p>Manage all your Cafe from here</p>

    </div>
    </div>

<div class="container">
    <div class="container">
    	<div class="col">
    		
    	</div>
    </div>

    
    	<div class="col-xs-3" style="text-align: center;">

    	<div class="list-group">
    		 <a href="view_order_details.php" class="list-group-item ">View Order Details</a>
    		<a href="view_food_items.php" class="list-group-item">View Food Items</a>
    		<a href="add_food_items.php" class="list-group-item ">Add Food Items</a>
    		<a href="edit_food_items.php" class="list-group-item active">Edit Food Items</a>
    		<a href="delete_food_items.php" class="list-group-item ">Delete Food Items</a>
       </div>
    </div>
    


    
    

<div class="col-xs-3">

  <div class="form-area" style="padding: 10px 10px 110px 10px; ">
  
    <div style="text-align: center;">
      <h3>Click On Menu <br><br></h3>
    </div>
    <?php
   
 

    if (isset($_GET['submit']))
	{
    $f_id = $_GET['f_id'];
    $f_name = $_GET['f_name'];
    $f_rate = $_GET['f_rate'];
	$f_type = $_GET['f_type'];
    $f_description = $_GET['f_description'];


    $query = mysqli_query($conn, "UPDATE food set f_name='$f_name', f_rate='$f_rate',f_type='$f_type',f_description='$f_description' WHERE f_id='$f_id'"); 
    }
    $query = mysqli_query($conn, "SELECT * FROM food ORDER BY f_id");
    while ($row = mysqli_fetch_array($query)) {

      ?>

      <div class="list-group" style="text-align: center;">
        <?php
      echo "<b><a href='edit_food_items.php?update= {$row['f_id']}'>{$row['f_name']}</a></b>";  
        ?>
      </div>


    <?php
    }
    ?>
    

    <?php
    if (isset($_GET['update'])) {
    $update = $_GET['update'];
    $query1 = mysqli_query($conn, "SELECT * FROM food WHERE f_id=$update");
    while ($row1 = mysqli_fetch_array($query1)) {

    ?>
</div>
</div>



<div class="container">
<div class="col-md-6">
 <div class="form-area" style="padding: 0px 100px 100px 100px;">
        <form action="edit_food_items.php" method="GET" autocomplete="off">
        <br style="clear: both">
          <h3 style="margin-bottom: 25px; text-align: center; font-size: 30px;"> EDIT YOUR FOOD ITEMS HERE </h3>

          <div class="form-group">
            <input class='input' type='hidden' name="f_id" id="f_id" value=<?php echo $row1['f_id'];  ?> />
          </div>

          <div class="form-group">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Food Name: </label>
            <input type="text" class="form-control" id="f_name" name="f_name" value=<?php echo $row1['f_name'];  ?> placeholder="Your Foood name" required="">
          </div>     

          <div class="form-group">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Food Price: </label>
            <input type="text" class="form-control" id="f_rate" name="f_rate" value=<?php echo $row1['f_rate'];  ?> placeholder="Your Food Price (INR)" required="" onkeypress="check(event)">
          </div>

	  <div class="form-group">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Food Type: </label>
            <input type="text" class="form-control" id="f_type" name="f_type" value=<?php echo $row1['f_type'];  ?> placeholder="Your Food Type" required="">
          </div>

          <div class="form-group">
            <label for="username"><span class="text-danger" style="margin-right: 5px;">*</span> Food Description: </label>
            <input type="text" class="form-control" id="f_description" name="f_description" value=<?php echo $row1['f_description'];  ?> placeholder="Your Food Description" required="">
          </div>

          <div class="form-group">
          <button type="submit" id="submit" name="submit" class="btn btn-primary pull-right" onclick="display_alert()" value="Display alert box" > Update </button>    
      </div>
        </form>


    <?php
}
}


  ?>
      
  </div>




</div>


<?php
mysqli_close($conn);
?>
</div>
</div>

  </body>
<br>
</html>