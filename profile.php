<?php include('templates/header.php');
     include('templates/footer.php');
    
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
  $sql = "SELECT * FROM users1 WHERE id = $shopid";

  $result = mysqli_query($db,$sql);
  
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
      $sql = "UPDATE users1 SET username = '$username', email = '$email', organization = '$organization', first_name = '$first_name', last_name = '$last_name', phone_number = '$phone_number', address1 = '$address1', address2 = '$address2', post_code = '$post_code' WHERE id = '$shopid'";
      mysqli_query($db, $sql);
      
    }
   
      ?>
      </div>
      <div class="alreadybought">
  <?php
   $shopid = $_SESSION['sessionId'];
   
   $sql1 = "SELECT * FROM payment_info where user_id = $shopid";
   $result1 = mysqli_query($db, $sql1);
if (mysqli_num_rows($result1) > 0) {
  
  while ($row1 = mysqli_fetch_assoc($result1)) {
    $code = $row1['code'];
    $title = $row1['title'];
  echo "$code"."<br>";
  echo "$title"."<br>";
 // $sql2 = "SELECT * FROM products where code = $code";
 //  $result2 = mysqli_query($db, $sql2);
//if (mysqli_num_rows($result2) > 0) {
 // }
 // while ($row2 = mysqli_fetch_assoc($result2)) {
 // }
  ?>
<div class="small-images"> <img   src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>" /> </div>
  <?php }?>
   <h1><?php echo ($row['title']); ?></h1>  
     <?php echo base64_encode($row['image']);?>" /> 
          <div class="small-images"> <img   src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>" /> </div>
     </div>
       <div class="producttextcontainerdash">  <?php echo("<span class=producttextspan >".$row['long_desc']."</span>"); ?></div>
       
     </div>
     <?php echo $row['title']; ?>
     <?php echo "цена: ".($row['price']); ?>
     </div>
    
  
  <?php 
}
  
  ?>
</div>