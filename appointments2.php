<?php
require_once 'templates/header.php';
require_once 'templates/footer.php';

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
<div class="sidebar">
		<ul>
			<li><a href="#">Dashboard</a></li>
			<li><a href="useroverview.php">Users</a></li>
			<li><a href="productsoverview.php">Products</a></li>
			<li><a href="#">Orders</a></li>
            <li><a href="appointments2.php">Appointments</a></li>
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

$sql = "SELECT DISTINCT appointments.id,appointments.date,appointments.time,appointments.user_id, technician.name as technician_name, appointment_type_name as appointment_type_name,payment_info.title as title, users1.first_name as first_name, users1.last_name as last_name, users1.address1 as address1, users1.phone_number as phone_number,payment_info.warranty_date as warranty_date 
        FROM appointments 
        JOIN appointment_type ON appointments.appointment_type_id = appointment_type.appointment_type_id
        JOIN technician ON appointments.technician_id = technician.id
        JOIN users1 ON appointments.user_id = users1.id
        JOIN payment_info ON appointments.user_id = payment_info.user_id
        WHERE date = '$date'
        GROUP BY appointments.id";
        

$result = mysqli_query($db, $sql);

if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
echo "<div class='calendarappointmentpreview'>";
if (mysqli_num_rows($result) > 0) {
    echo "<table class='admintableappointments'>";
    echo "<tr><th>ID</th><th>date</th><th>time</th><th>technician</th><th>appointment type</th><th>product title</th><th>user_id</th><th>first_name</th><th>last_name</th><th>address</th><th>phone_number</th><th>warranty_date</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['date'] . "</td>";
        echo "<td>" . $row['time'] . "</td>";
        echo "<td>" . $row['technician_name'] . "</td>";
        echo "<td>" . $row['appointment_type_name'] . "</td>";
        echo "<td>" . $row['title'] . "</td>";
        echo"<td>" .  $row['user_id'] . "</td>";
        echo"<td>" .  $row['first_name'] . "</td>";
        echo"<td>" .  $row['last_name'] . "</td>";
        echo"<td>" .  $row['address1'] . "</td>";
        echo"<td>" .  $row['phone_number'] . "</td>";
        echo"<td>" .  $row['warranty_date'] . "</td>";
        echo "<td><a href='edit_user.php?id=".$row['id']."'class='adminbutton''". "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
      
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}
  
?>

