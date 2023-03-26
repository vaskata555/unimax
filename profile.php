<?php include('templates/header.php');
     include('templates/footer.php');
    
    ?>
<?php
if (!isset($_SESSION['sessionId']) || ($type != "user"&&$type !="admin"&&$type !="manager")) {
    header("Location: ../unimax/login.php?error=PleaseLoginToAccessThisPage");
    exit();
}
?>
<div class="profilecheckbox">
<?php
  // shopping cart is not empty, display the div
  $shopid =$_SESSION['sessionId'];
  $sql = "SELECT * FROM users1 WHERE id = $shopid";

  $result = mysqli_query($db,$sql);
  
  //echo"<div class='floatingvalue'>";
  //while($row = $result1->fetch_assoc() ){
  //echo $floatingval="user with id=".$id." username= ".$row['username']." and email= ".$row['email']." had been selected";
  // Check if the form is submitted
  //}
  //echo "</div>";
  
  
  if(mysqli_num_rows($result)>0){
      foreach($result as $row){
  
  ?>
  <div class="headeredit">
          <h1>Edit User</h1>
      </div>
  <div class="formedit">
  <form method="POST">
  
  <label class="profilelabel">Име</label>
  <input type="text" name="first_name" value="<?php echo $row['first_name'] ?>"required></input>
  <label class="profilelabel">Фамилия</label>
  <input type="text" name="last_name" value="<?php echo $row['last_name'] ?>"required></input>
  <label class="profilelabel">Username</label>
  <input type="text" name="username" value="<?php echo $row['username'] ?>"required></input>
  <label class="profilelabel">Email</label>
  <input type="text" name="email" value="<?php echo $row['email'] ?>"required></input>
  <label class="profilelabel">Име на фирма</label>
  <input type="text" name="organization" value="<?php echo $row['organization'] ?>"required></input>
 
  <label class="profilelabel">Адрес за доставка</label>
  <input type="text" name="address1" value="<?php echo $row['address1'] ?>"></input>
  <label class="profilelabel">Адрес за фактуриране</label>
  <input type="text" name="address2" value="<?php echo $row['address2'] ?>"></input>
  <label class="profilelabel">Телефонен Номер</label>
  <input type="text" name="phone_number" value="<?php echo $row['phone_number'] ?>"required></input>
  <label class="profilelabel">пощенски код</label>
  <input type="text" name="post_code" value="<?php echo $row['post_code'] ?>" ></input>
  
  
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