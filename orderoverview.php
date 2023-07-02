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
    <label for="date">Избери дата:</label>
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

$sql = "SELECT o.*,od.title AS product_title, o.user_id, o.first_name, o.last_name, o.address1, o.phone_number ,od.title
  FROM orders o
        JOIN order_details od ON o.order_number = od.order_number
        WHERE o.order_date = ?";
     $stmt = mysqli_prepare($db, $sql);
     if (!$stmt) {
        printf("Error: %s\n", mysqli_error($db));
        exit();
    }
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
    echo "<tr><th>дата</th><th>вид плащане</th><th>№ поръчка</th><th>фирма</th><th>име продукт</th><th>ID</th><th>Име</th><th>Фамилия</th><th>Адрес</th><th>Телефон</th><th>Гаранция</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr>";
       
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
    echo "Не бяха намерени поръчки за тази дата.";
}
  
?>
</div>
</div>
</div>

