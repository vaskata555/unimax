<?php include('templates/header.php');
     include('templates/footer.php');
    
    ?> 
<?php
$type = $_SESSION['sessionUsertype'];
 if (!isset($_SESSION['sessionId']) || $type != "admin" ) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
?>
 
   
   

<div id="sidebar">
		<ul>
			<li><a href="#">Dashboard</a></li>
			<li><a href="useroverview.php">Users</a></li>
			<li><a href="productsoverview.php">Products</a></li>
			<li><a href="#">Orders</a></li>
		</ul>
	</div>
    <div id="content">
<div class="firstadminpanel">
    <?php
    if (isset($_SESSION['sessionId'])) {


        echo "Hello user: ";
        echo $_SESSION['sessionUser'];
        echo $type = $_SESSION['sessionUsertype'];
        if($type=="admin"){
        echo '<a href="admin_dashboard.php" class="btnbrand">Admin Dashboard</a>';
        echo'  ';
        echo '<a href="upload.php" class="btnbrand">upload product</a>';
        }
    } else {
        echo "Home";
    }
    ?>
    <p>USER NAVIGATION EDITS AND DELETE</p>



</div>