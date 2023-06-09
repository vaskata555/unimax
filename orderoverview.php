<?php
require_once 'templates/header.php';


?>
<?php
$type = $_SESSION['sessionUsertype'];
 if (!isset($_SESSION['sessionId']) || $type != "admin" ) {
        header("Location: ../index.php?error=emptyfields");
        exit();
    }
?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="wrapper">

<<div class="sidebar">
		<ul>
			<li><a href="admin_dashboard.php">Dashboard</a></li>
			<li><a href="useroverview.php">Users</a></li>
			<li><a href="productsoverview.php">Products</a></li>
			<li><a href="orderoverview.php">Orders</a></li>
            <li><a href="appointments2.php">Appointments</a></li>
            <li><a href="createcategories.php">Create category</a></li>
		</ul>
	</div>
<div class="flexplaceradmin">
    <div class="">
    <form class="timepicker"method="post">
    <label for="date">Select a date:</label>
    <input type="date" id="date" name="date" value="<?php echo $date; ?>">
    <button id="submit1"type="submit">Submit</button>
</form>
    <?php
  // shopping cart is not empty, display the div
  $shopid =$_SESSION['sessionId'];
  //$sql = "SELECT * FROM users1 WHERE id = $shopid";

 

  if (isset($_POST['date'])) {
    $date = $_POST['date'];
} else {
    $date = date("Y-m-d");
}

$sql = "SELECT * FROM payment_info where order_date = ?";
     $stmt = mysqli_prepare($db, $sql);
     mysqli_stmt_bind_param($stmt, "s",$date);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);

if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
echo "<div class='calendarappointmentpreview'>";
if (mysqli_num_rows($result) > 0) {
    echo "<table class='admintableappointments'>";
    echo "<tr><th>ID</th><th>дата</th><th>вид плащане</th><th>technician</th><th>appointment type</th><th>име продукт</th><th>user_id</th><th>first_name</th><th>last_name</th><th>address</th><th>phone_number</th><th>warranty_date</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['order_date'] . "</td>";
        echo "<td>" . $row['payment_type'] . "</td>";
        echo "<td>" . $row['order_number'] . "</td>";
        echo "<td>" . $row['organization'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo"<td>" .  $row['user_id'] . "</td>";
        echo"<td>" .  $row['first_name'] . "</td>";
        echo"<td>" .  $row['last_name'] . "</td>";
        echo"<td>" .  $row['address1'] . "</td>";
        echo"<td>" .  $row['phone_number'] . "</td>";
        echo"<td>" .  $row['warranty_date'] . "</td>";
       
      
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}
  
?>
</div>
</div>
</div>

