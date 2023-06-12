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
  $sql = "SELECT * FROM users1 WHERE id = ?";
  $stmt = mysqli_prepare($db, $sql);
  mysqli_stmt_bind_param($stmt, "i", $shopid);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);
 
  
  if(mysqli_num_rows($result)>0){
      foreach($result as $row){
  
  ?>
  <div class="headeredit">
          <h1>Edit User</h1>
      </div>
  <div class="formedit">
  <form class="profilecheck" method="POST">
  
  <label class="profilelabel">Име</label><br>
  <input type="text" name="first_name" class="profile_first_name" value="<?php echo $row['first_name'] ?>" required></input><br>
  <label class="profilelabel">Фамилия</label><br>
  <input type="text" name="last_name" class="profile_last_name" value="<?php echo $row['last_name'] ?>" required></input><br>
  <label class="profilelabel">Username</label><br>
  <input type="text" name="username" class="profile_username" value="<?php echo $row['username'] ?>" required></input><br>
  <label class="profilelabel">Email</label><br>
  <input type="text" name="email" class="profile_email" value="<?php echo $row['email'] ?>" required></input><br>
  <label class="profilelabel">Име на фирма</label><br>
  <input type="text" name="organization" class="profile_organization" value="<?php echo $row['organization'] ?>" required></input><br>
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
  
  
              <input class="submitedit" id="submit" name="submit" type="submit" value="Apply Changes">
              
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
      $sql1 = "UPDATE users1 SET username = ?, email = ?, organization = ?, first_name = ?, last_name = ?, phone_number = ?, address1 = ?, address2 = ?, post_code = ? WHERE id = ?";
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
          <h1>Последни 5 заявки</h1>
      </div>
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
        WHERE appointments.user_id = ?
        GROUP BY date DESC
        LIMIT 5;";
     $stmt = mysqli_prepare($db, $sql);
     mysqli_stmt_bind_param($stmt, "i",$shopid);
     mysqli_stmt_execute($stmt);
     $result = mysqli_stmt_get_result($stmt);

if (!$result) {
    printf("Error: %s\n", mysqli_error($db));
    exit();
}
echo "<div class='calendarappointmentpreview'>";
if (mysqli_num_rows($result) > 0) {
    echo "<table class='admintableappointments'>";
    echo "<tr><th>date</th><th>час</th><th>техник</th><th>вид</th><th>име продукт</th><th>user_id</th><th>име</th><th>фамилия</th><th>address</th><th>телефон</th><th>гаранция</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr>";
        
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
      <div class="alreadybought">
      
  <?php
   $shopid = $_SESSION['sessionId'];
   
   $sql1 = "SELECT * FROM payment_info where user_id = ?";
   $stmt = mysqli_prepare($db, $sql1);
   mysqli_stmt_bind_param($stmt, "i", $shopid);
   mysqli_stmt_execute($stmt);
   $result1 = mysqli_stmt_get_result($stmt);
  
if (mysqli_num_rows($result1) > 0) {
  
  while ($row1 = mysqli_fetch_assoc($result1)) {
    $code = $row1['code'];
    $title = $row1['title'];
    $order_number = $row1['order_number'];
    $order_date =$row1['order_date'];
    $warranty_date=$row1['warranty_date'];
    $quantity= $row1['quantity'];
    $price= $row1['price'];
  $sql2 = "SELECT * FROM images3 where code = ?";
  $stmt = mysqli_prepare($db, $sql2);
   mysqli_stmt_bind_param($stmt, "s", $code);
   mysqli_stmt_execute($stmt);
   $result2 = mysqli_stmt_get_result($stmt);
 
   
if (mysqli_num_rows($result2) > 0) {
  
  while ($row2 = mysqli_fetch_assoc($result2)) {
    ?>
     <div class="product-row">
    <div class="image-column">
    <?php $image_unescaped = ($row2['image']) ;
$image_escaped = str_replace("/","\\",$image_unescaped) ?>
  <div class="small-images"> <img   src="<?php echo  $image_escaped ;?>" /> </div>
  </div>

<div class="details-column">
      <div class="detail-row">
        <div class="label">Title:</div>
        <div class="value"><?php echo $title; ?></div>
      </div>
      <div class="detail-row">
        <div class="label">Order Number:</div>
        <div class="value"><?php echo $order_number; ?></div>
      </div>
      <div class="detail-row">
        <div class="label">Date:</div>
        <div class="value"><?php echo $order_date; ?></div>
      </div>
      <div class="detail-row">
        <div class="label">Warranty Date:</div>
        <div class="value"><?php echo $warranty_date; ?></div>
      </div>
      <div class="detail-row">
        <div class="label">Quantity:</div>
        <div class="value"><?php echo $quantity; ?></div>
      </div>
      <div class="detail-row">
        <div class="label">Price:</div>
        <div class="value"><?php echo $price; ?></div>
      </div>
      <a href="invoices/payment_invoice_<?php echo $order_number; ?>.pdf" download>Фактура тук</a>
    </div>
  </div>
  <?php } ?>
  <?php }}?>
 
   
    
  
  <?php 
}
  
  ?>
  </div>
</div>
<?php include('templates/footer.php'); ?>