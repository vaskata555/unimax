<?php include('templates/header.php');

    
    ?> 

      <?php if (isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']); // Remove the error from the session after retrieving it
  } else {
    $error = ""; // Set a default value if no error is present
  } ?>


    <?php
 $type = $_SESSION['sessionUsertype'];
 if (!isset($_SESSION['sessionId']) || ($type != "user"&&$type !="admin"&&$type !="manager")) {
        header("Location: ../unimax/login.php?error=PleaseLoginToAccessThisPage");
        exit();
        

    }
    
?>
   <?php

$status="";
if (isset($_POST['action']) && $_POST['action']=="remove"){
if(!empty($_SESSION["shopping_cart"])) {
    foreach($_SESSION["shopping_cart"] as $key => $value) {
      if($_POST["code"] == $key){
      unset($_SESSION["shopping_cart"][$key]);
      $status = "<div class='box' style='color:red;'>
      Product is removed from your cart!</div>";
      }
      if(empty($_SESSION["shopping_cart"]))
      unset($_SESSION["shopping_cart"]);
      }		
}
}

if (isset($_POST['action']) && $_POST['action']=="change"){
  foreach($_SESSION["shopping_cart"] as &$value){
    if($value['code'] === $_POST["code"]){
        $value['quantity'] = $_POST["quantity"];
        break; // Stop the loop after we've found the product
    }
}
  	
}

?>
<div class="flex-cart">
 <div class="cart">
<?php
if(isset($_SESSION["shopping_cart"])){
    $total_price = 0;
?>	
<table class="tableflex">
<tbody>
<tr>
<td></td>
<td> Име на продукт </td>
<td> Количество </td>
<td> Ед цена </td>
<td> Тотал  </td>
</tr>	

<?php		
foreach ($_SESSION["shopping_cart"] as $product){
?>
<tr>
<td>
<?php $image_unescaped = ($product['image']) ;
$image_escaped = str_replace("/","\\",$image_unescaped) ?>
<img  src="<?php echo  $image_escaped; ?>"width="70" height="60" />
</td>

<td><?php echo $product["title"]; ?><br />
<form method='post' action=''>
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='action' value="remove" />
<input type='hidden' name='id_product' value="<?php echo $product["id"]; ?>" />

<button type='submit' class='remove'>Премахни</button>
</form>
</td>
<td>

<form method='post' action=''>
  <input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
  <input type='hidden' name='action' value="change" />
  <button type="submit" name="quantity" value="<?php echo max(1, $product["quantity"]-1); ?>">-</button>
  <span class='quantity-value'><?php echo $product["quantity"]; ?></span>
  <button type="submit" name="quantity" value="<?php echo $product["quantity"]+1; ?>">+</button>

</form>
</td>
<td><?php echo $product["price"]."лв "; ?></td> 
<td><?php echo $product["price"]*$product["quantity"]."лв "; ?></td>
</tr>
<?php
$total_price += ($product["price"]*$product["quantity"]);

}
?>

<tr>
<td colspan="5" align="right">
<input  type="hidden" id="t_amount" value="<?php echo $total_price ?>">
<script>
   var amountt= document.getElementById("t_amount").value; 
        console.log(amountt);
        </script>
      
<strong>Крайна сума: <?php echo $total_price."лв"; ?></strong>
</td>
</tr>
</tbody>
</table>		
  <?php 
}else{
  echo"<img src='img/emptycart.png'>";
  echo"<br>";
	echo "<h3>Количката ви е празна</h3>";
  
	}
?>

</div>



<?php
if(isset($_SESSION['shopping_cart']) && !empty($_SESSION['shopping_cart'])) {
 
  echo"<div class='payment-type'>";
  // shopping cart is not empty, display the div
  $shopid =$_SESSION['sessionId'];
  $sql = "SELECT * FROM users WHERE id = ?";
  $stmt = mysqli_prepare($db, $sql);
  mysqli_stmt_bind_param($stmt, "i", $shopid);
  mysqli_stmt_execute($stmt);
  $result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
?>
<form class="cashpayment" action="payment-processing.php" method="post">
<input type='hidden' name='code' value="<?php echo $product["code"]; ?>" />
<input type='hidden' name='id_product' value="<?php echo $product["id"]; ?>" />
<input type='hidden' name='shopid' value="<?php echo $shopid; ?>" />
<input type='hidden' name="total_price" id="total_price" value="<?php echo $total_price ?>"></input>
<label class="labelpay">Име</label>
<input type="text" name="name" class="shopping-name" value="<?php echo $row['first_name'] ?>" required>
<label class="labelpay">Фамилия</label>
  <input type="text" name="lastname" class="shopping-lastname" value="<?php echo $row['last_name'] ?>"required></input>
  <label class="labelpay">Фирма</label>
  <input type="text" name="organization" class="shopping-address1" value="<?php echo $row['organization'] ?>" disabled>
  <label class="labelpay">Bulstat</label>
  <input type="text" name="bulstat" class="shopping-address1" value="<?php echo $row['bulstat'] ?>" disabled>
  <label class="labelpay">Адрес за доставка</label>
  <input type="text" name="address1" class="shopping-address1" value="<?php echo $row['address1'] ?>" required>
<label class="labelpay">Адрес за фактуриране</label>
<input type="text" name="address2" class="shopping-address2" value="<?php echo $row['address2'] ?>" required>
<label class="labelpay">Телефонен Номер</label>
<input type="text" name="phone" class="shopping-phone" value="<?php echo $row['phone_number'] ?>"required></input>
  <label class="labelpay">пощенски код</label>
  <input type="text" name="post_code" class="shopping-postcode" value="<?php echo $row['post_code'] ?>" required>

<button type="submit" id="submit1" name="submit1" value="submit1" class="cashpayb">Наложен платеж <img class="supersmallicon" src="img\icons8-cash-96.png"></button>
<br>
<br>
<button type="submit" name="submit2" value="submit2" class="cashpaya" formaction="/unimax/checkout.php" id="btn">Плати с карта <img class="supersmallicon" src="img\icons8-card-100.png"></button>

    </form>
    <script src="http://js.stripe.com/v3/"></script>
        <script src="script.js"></script>
    
  
<?php
}
}
}
?>
    
   
</div>
</div>
<div style="clear:both;"></div>

<div class="message_box" style="margin:10px 0px;">
<?php echo $status; ?>

</div>
</div>
<?php include('templates/footer.php'); ?>