<?php include('templates/header.php');
   
    
    ?>
<?php
if (!isset($_SESSION['sessionId']) || ($type != "user"&&$type !="admin"&&$type !="manager")) {
    header("Location: ../unimax/login.php?error=PleaseLoginToAccessThisPage");
    exit();
}
?>
<div class = "flexplacer">
<div class="profilecheckbox">
<?php
  // shopping cart is not empty, display the div
  $shopid =$_SESSION['sessionId'];
  $sql = "SELECT * FROM users WHERE id = ?";
  $stmt = mysqli_prepare($db, $sql);
  mysqli_stmt_bind_param($stmt, "i", $shopid);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
 
  
  if(mysqli_num_rows($result)>0){
      foreach($result as $row){
  
  ?>
  <div class="headeredit">
          <h1>Потребителска информация</h1>
      </div>
  <div class="formedit">
  <form class="profilecheck" method="POST">
  
  <label class="profilelabel">Име</label><br>
  <input type="text" name="first_name" class="profile_first_name" value="<?php echo $row['first_name'] ?>" required></input><br>
  <label class="profilelabel">Фамилия</label><br>
  <input type="text" name="last_name" class="profile_last_name" value="<?php echo $row['last_name'] ?>" required></input><br>
  <label class="profilelabel">Потребителско име</label><br>
  <input type="text" name="username" class="profile_username" value="<?php echo $row['username'] ?>" required></input><br>
  <label class="profilelabel">Имейл</label><br>
  <input type="text" name="email" class="profile_email" value="<?php echo $row['email'] ?>" required></input><br>
  <label class="profilelabel">Име на фирма</label><br>
  <input type="text" name="organization" class="profile_organization" value="<?php echo $row['organization'] ?>" disabled required></input><br>
  <label class="profilelabel">БУЛСТАТ</label><br>
  <input type="text" name="bulstat" class="profile_organization" value="<?php echo $row['bulstat'] ?>" disabled></input><br>
  <label class="profilelabel">Адрес за доставка</label><br>
  <input type="text" name="address1" class="profile_address1" value="<?php echo $row['address1'] ?>"></input><br>
  <label class="profilelabel">Адрес за фактуриране</label><br>
  <input type="text" name="address2" class="profile_address2" value="<?php echo $row['address2'] ?>"></input><br>
  <label class="profilelabel">Телефонен Номер</label><br>
  <input type="text" name="phone_number" class="profile_phone_number" value="<?php echo $row['phone_number'] ?>" required></input><br>
  <label class="profilelabel">пощенски код</label><br>
  <input type="text" name="post_code" class="profile_post_code" value="<?php echo $row['post_code'] ?>" ></input><br>
  
  
              <input class="submitedit" id="submit" name="submit" type="submit" value="Запази промените">
              
        </form>
   
      </div>
      <?php
   }
  }
  if (isset($_POST["submit"])) {
     
      $email = $_POST['email'];
      $username = $_POST['username'];
      $organization = $_POST['organization'];
      
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $phone_number = $_POST['phone_number'];
      $address1 = $_POST['address1'];
      $address2 = $_POST['address2'];
      $post_code = $_POST['post_code'];
      // Update user information in the database
      $sql1 = "UPDATE users SET username = ?, email = ?, organization = ?, first_name = ?, last_name = ?, phone_number = ?, address1 = ?, address2 = ?, post_code = ? WHERE id = ?";
      $stmt = mysqli_prepare($db, $sql1);
      mysqli_stmt_bind_param( $stmt, "ssssssssss", $username, $email, $organization,$first_name,$last_name,$phone_number,$address1,$address2,$post_code,$shopid);
      if (mysqli_stmt_execute( $stmt)) {
        echo "Промените по профилът бяха записани усешно";
    } else {
        echo "Грешка промените не бяха направени.";
    }
    mysqli_stmt_close( $stmt);
    }
   
      ?>
      </div>
      <div class="profilecheckboxapp">
      <div class="headeredit">
          <h1>Последни 10 заявки</h1>
      </div>
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
WHERE
appointments.user_id = ?
ORDER BY
appointments.id DESC
LIMIT 10";

$stmt = mysqli_prepare($db, $sql);
if (!$stmt) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}

mysqli_stmt_bind_param($stmt, "i", $shopid);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}

echo "<div class='calendarappointmentpreview'>";
if (mysqli_num_rows($result) > 0) {
    echo "<table class='admintableappointments'>";
    echo "<tr><th>дата</th><th>час</th><th>техник</th><th>вид</th><th>име продукт</th><th>име</th><th>адрес</th></tr>";

    if (!$result) {
      printf("Error: %s\n", mysqli_error($db));
      exit();
  }
  
  while ($row = mysqli_fetch_assoc($result)) {
      $appointmentID = $row['id'];
      $date = $row['date'];
      $time = $row['time'];
      $user_id = $row['user_id'];
      $technician_name = $row['technician_name'];
      $appointment_type_name = $row['appointment_type_name'];
      $title = $row['title'];
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $address1 = $row['address1'];
      $phone_number = $row['phone_number'];
      $warranty_date = $row['warranty_date'];
  
      // Rest of your code for processing the fetched data
  

        echo "<tr>";
        echo "<td>" . $date . "</td>";
        echo "<td>" . $time . "</td>";
        echo "<td>" . $technician_name . "</td>";
        echo "<td>" . $appointment_type_name . "</td>";
        echo "<td>" . $title . "</td>";
        echo "<td>" . $first_name . " " . $last_name . "</td>";
        echo "<td>" . $address1 . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No appointments found.";
}
echo "</div>";

?>
</div>
</div>
</div>

<div class="headeredit">
    <h1>Всички поръчки</h1>
</div>
<div class="alreadybought">
<?php
$sql1 = "SELECT DISTINCT o.*, od.* 
          FROM `orders` o
          JOIN `order_details` od ON o.order_number = od.order_number
          WHERE o.user_id = ?";

$stmt1 = mysqli_prepare($db, $sql1);
mysqli_stmt_bind_param($stmt1, "i", $shopid);
mysqli_stmt_execute($stmt1);
$result1 = mysqli_stmt_get_result($stmt1);

if (mysqli_num_rows($result1) > 0) {
    while ($row1 = mysqli_fetch_assoc($result1)) {
        $code = $row1['code'];
        $title = $row1['title'];
        $order_number = $row1['order_number'];
        $order_date = $row1['order_date'];
        $warranty_date = $row1['warranty_date'];
        $quantity = $row1['quantity'];
        $price = $row1['price'];

        $sql2 = "SELECT * FROM products WHERE code = ?";
        $stmt2 = mysqli_prepare($db, $sql2);
        mysqli_stmt_bind_param($stmt2, "s", $code);
        mysqli_stmt_execute($stmt2);
        $result2 = mysqli_stmt_get_result($stmt2);

        if (mysqli_num_rows($result2) > 0) {
            $row2 = mysqli_fetch_assoc($result2);

            ?>
            <div class="product-row">
                <div class="image-column">
                    <?php
                    $image_unescaped = ($row2['image']);
                    $image_escaped = str_replace("/", "\\", $image_unescaped);
                    ?>
                    <div class="small-images"><img src="<?php echo $image_escaped; ?>" /></div>
                </div>

                <div class="details-column">
                    <div class="detail-row">
                        <div class="label">Име:</div>
                        <div class="value"><?php echo $title; ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="label">Поръчка:</div>
                        <div class="value"><?php echo $order_number; ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="label">Дата:</div>
                        <div class="value"><?php echo $order_date; ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="label">Гаранция:</div>
                        <div class="value"><?php echo $warranty_date; ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="label">Количество:</div>
                        <div class="value"><?php echo $quantity; ?></div>
                    </div>
                    <div class="detail-row">
                        <div class="label">Цена:</div>
                        <div class="value"><?php echo $price; ?></div>
                    </div>
                    <a href="invoices/payment_invoice_<?php echo $order_number; ?>.pdf" download>Фактура тук</a>
                </div>
            </div>
            <?php
        }
        mysqli_stmt_close($stmt2);
    }
} else {
    echo "No orders found.";
}
mysqli_stmt_close($stmt1);
?>
</div>
</div>
<?php include('templates/footer.php'); ?>