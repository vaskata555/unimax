<?php
require_once 'templates/header.php';
require_once 'templates/footer.php';

?>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<div class="wrapper">
<div class="flexplacer">
    <div class="">
    <?php
  // shopping cart is not empty, display the div
  $shopid =$_SESSION['sessionId'];
  $sql = "SELECT * FROM users1 WHERE id = $shopid";
  $sql1 = "SELECT * FROM payment_info WHERE user_id = $shopid";
  $result = mysqli_query($db,$sql);
  $result1 = mysqli_query($db,$sql1);
  if (isset($_POST['date'])) {
    $date = $_POST['date'];
} else {
    $date = date("Y-m-d");
}
  if(mysqli_num_rows($result)>0){
      foreach($result as $row){
  
  ?>
  
  <form class="timepicker"method="post">
    <label for="date">Select a date:</label>
    <input type="date" id="date" name="date" value="<?php echo $date; ?>">
    <button id="submit1"type="submit">Submit</button>
</form>
  <form class="appointmentcheck" method="POST">

<label class="profilelabel">Име</label><br>

  <input type="text" name="first_name" class="profile_first_name" value="<?php echo $row['first_name'] ?>" required></input><br>
  <label class="profilelabel">Фамилия</label><br>
  <input type="text" name="last_name" class="profile_last_name" value="<?php echo $row['last_name'] ?>" required></input><br>
  <label class="profilelabel">Email</label><br>
  <input type="text" pattern="^([a-zA-Z0-9_\-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([a-zA-Z0-9\-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$" title="email123@code.bg" name="email" class="profile_email" value="<?php echo $row['email'] ?>" required></input><br>
  <label class="profilelabel">Име на фирма</label><br>
  <input type="text" name="organization" class="profile_organization" value="<?php echo $row['organization'] ?>" required></input><br>
  <label class="profilelabel">Адрес</label><br>
  <input type="text" name="address1" class="profile_address1" value="<?php echo $row['address1'] ?>"></input><br>
  <label class="profilelabel">Телефонен Номер</label><br>
  <input type="text" name="phone_number" class="profile_phone_number" value="<?php echo $row['phone_number'] ?>" required></input><br>
  
  
  <label for="type">Вид посещение:</label><br>
			<select class="selectproblem" name="selectproblem" id="selectproblem" name="selectproblem" required>
                <option value="" disabled selected>Select your option</option>
				<option  value="1">Доставка</option>
				<option  value="2">Авария</option>
				<option  value="3">Монтаж</option>
			</select><br>
          
            <label class="profilelabel">Име на продукт</label><br>
            <?php   echo "<select name='product-select' id='product-select'>";
            echo '<option value="" disabled selected>Select your product</option>';
while ($row1 = mysqli_fetch_assoc($result1)) {
    echo "<option value='" . $row1['title'] . "' data-warranty='" . $row1['warranty_date'] . "'>" . $row1['title'] . "</option>";
}
echo "</select>";
echo"<br>"
?>
<label class="profilelabel">Гаранционен до</label><br>
 <input type="text" id="warranty_date" name="warranty_date" ><br>
 <button id="submit" name="submit" type="submit" >Submit</button>
 <input type="hidden" name="selected_time" id="selected_time"  value="" required></input><br>
 <input type="hidden" name="date" class="date" value="<?php echo $date ?>" required></input><br>
 <input type="hidden" name="user_id" class="user_id" value="<?php echo $row['id'] ?>" required></input><br>
            <input type="hidden" name="selected_tech" id="selected_tech"  value="" required></input><br>
 <?php if (isset($_POST['submit'])) {
    
    $technician_id= $_POST['selected_tech'];
    $appointment_type_id = $_POST['selectproblem'];
      $user_id = $_POST['user_id'];
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['email'];
     $organization = $_POST['organization'];
     $address1 = $_POST['address1'];
     $phone_number = $_POST['phone_number'];
     $title = $_POST['product-select'];
     $warranty_date = $_POST['warranty_date'];
     $date = $_POST['date'];
     $time = $_POST['selected_time'];
   if($appointment_type_id == 1){
     $sql = "INSERT INTO appointments (technician_id, appointment_type_id, user_id, title, warranty_date, date, time) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
   $stmt = mysqli_prepare($db, $sql);
  
   mysqli_stmt_bind_param($stmt, "sssssss", $technician_id, $appointment_type_id, $user_id, $title, $warranty_date, $date, $time);
   mysqli_stmt_execute($stmt);
   }else if($appointment_type_id == 2){
   $sql = "INSERT INTO appointments (technician_id, appointment_type_id, user_id, title, warranty_date, date, time) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
   $stmt = mysqli_prepare($db, $sql);
  
   mysqli_stmt_bind_param($stmt, "sssssss", $technician_id, $appointment_type_id, $user_id, $title, $warranty_date, $date, $time);
   mysqli_stmt_execute($stmt);
}else if($appointment_type_id == 3){
    $sql = "INSERT INTO appointments (technician_id, appointment_type_id, user_id, title, warranty_date, date, time) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($db, $sql);
   
    mysqli_stmt_bind_param($stmt, "sssssss", $technician_id, $appointment_type_id, $user_id, $title, $warranty_date, $date, $time);
    mysqli_stmt_execute($stmt);
    $extrabooktime = date('H:i:s', strtotime('+1 hour', strtotime($time)));
    $sql1 = "INSERT INTO appointments (technician_id, appointment_type_id, user_id,  title, warranty_date, date, time) VALUES ( ?, ?, ?, ?, ?, ?, ?)";
    $stmt1 = mysqli_prepare($db, $sql1);
    mysqli_stmt_bind_param($stmt1, "sssssss", $technician_id, $appointment_type_id, $user_id, $title, $warranty_date, $date, $extrabooktime);
    mysqli_stmt_execute($stmt1);
   
}
 }
 ?>
</form>
    <?php }}?>
</div>
<div class="calendarappointment">

<?php

$start_time = "09:00:00";
$end_time = "18:00:00";
$time_interval = "1 hour";

// Get the selected date from the form or use today's date

$sql4 = "SELECT * FROM technician";
$result4 = mysqli_query($db, $sql4);
// Loop through each technician and display the available times for each one
$technician_ids = array(); // Replace with the actual technician IDs
if (mysqli_num_rows($result4) > 0) {
    while ($row4 = mysqli_fetch_assoc($result4)) {
        $technician_ids[] = $row4['id'];
    }
}
foreach ($technician_ids as $technician_id) {
    // Query the database for booked appointments on the selected date
    $sql = "SELECT * FROM appointments WHERE technician_id = $technician_id AND date = '$date'";
    $result = mysqli_query($db, $sql);

    // Create an array of booked times
    $booked_times = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $booked_times[] = $row['time'];
    }

    // Loop through the available times and check if they are booked
    $current_time = $start_time;
    $available_times = array();
    $all_times = array();
    while (strtotime($current_time) <= strtotime($end_time)) {
        $all_times[] = $current_time;
        $current_time = date("H:i:s", strtotime("+$time_interval", strtotime($current_time)));
    }

    // Display the available appointment times for this technician
    echo "<h2>technician $technician_id</h2>";
    echo "<p>Available times for $date:</p>";
    echo "<table>";
    echo "<tr>";
    foreach ($all_times as $time) {
        // Check if the time is already booked
        $is_booked = in_array($time, $booked_times);
$count=0;
        // Generate the link with the appropriate styling and disable it if it is booked
        echo "<td>";
        if ($is_booked) {
            echo '<button  class="timegetter" id="timegetter" disabled="' . $time . '">' . $time . ' </button>';

        } else {
            echo '<button class="timegetter"id="timegetter" data-second-value="' . $technician_id . '" value="'. $time .'"">'.$time.'</button>';
        }
        echo "</td>";

        // Add a line break after every 5 columns
        if (($count + 1) % 5 == 0) {
            echo "</tr><tr>";
        }
        $count++;
    }
    echo "</tr>";
    echo "</table>";
}
?>
</div>
</div>
</div>
<script src="gettime.js"defer></script>
<script src="warrantygetter.js"defer></script>