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

<div class="sidebar">
		<ul>
			<li><a href="admin_dashboard.php">Админ Панел</a></li>
      <li> <a href="upload.php">Качи продукт</a></li>
			<li><a href="useroverview.php">Потребители</a></li>
			<li><a href="productsoverview.php">Продукти</a></li>
			<li><a href="orderoverview.php">Поръчки</a></li>
            <li><a href="appointments2.php">Заявки</a></li>
            <li><a href="createcategories.php">Създай категория</a></li>
           
		</ul>
	</div>
<div class="flexplaceradmin">
    <div class="">
    <form class="timepicker"method="post">
    <label for="date">Select a date:</label>
    <input type="date" id="date" name="date" value="<?php echo $date; ?>">
    <button id="submit1"type="submit">Потвърди</button>
</form>
    <?php
  // shopping cart is not empty, display the div
  $shopid =$_SESSION['sessionId'];
  //$sql = "SELECT * FROM users WHERE id = $shopid";

 

  if (isset($_POST['date'])) {
    $date = $_POST['date'];
} else {
    $date = date("Y-m-d");
}

$sql = "SELECT DISTINCT
appointments.id,
appointments.date,
appointments.time,
appointments.user_id,
technician.name AS technician_name,
appointment_type.appointment_type_name AS appointment_type_name,
order_details.title AS title,
users.first_name AS first_name,
users.last_name AS last_name,
users.address1 AS address1,
users.phone_number AS phone_number,
orders.warranty_date AS warranty_date
FROM
appointments
JOIN appointment_type ON appointments.appointment_type_id = appointment_type.appointment_type_id
JOIN technician ON appointments.technician_id = technician.id
JOIN users ON appointments.user_id = users.id
JOIN orders ON appointments.order_id = orders.order_number
JOIN order_details ON  orders.order_number = order_details.order_number
        WHERE date = ?
        GROUP BY appointments.id";
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
    echo "<tr><th>№</th><th>Дата</th><th>час</th><th>Техник</th><th>Вид посещение</th><th>Име</th><th>потребител</th><th>Име</th><th>Фамилия</th><th>Адрес</th><th>Номер</th><th>Гаранция</th></tr>";
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
        echo "<td> <a href='deleteapp.php?id=" . $row['id'] . "'>изтрий</a></td>";
      
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Не бяха намерени заявки за тази дата.";
}
  
?>
</div>
</div>
</div>

