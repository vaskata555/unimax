

<html>
    <head>
    
    
    
   

     </head>
     <body>
   
     <?php
    require_once('templates/dbConfig.php');
   
?>
     <?php include('templates/header.php');
     include('templates/footer.php');
    
    ?>
     <?php
    if (isset($_SESSION['sessionId'])) {
        echo "You are logged in!";
    } else {
        echo "Home";
    }

?>



         <?php  $id = $_GET['id'];
    $result = $db->query("SELECT * FROM images3 where id = $id");
   
     while($row = $result->fetch_assoc() ){ 
         ?>
         <div class="galleryproduct"> 
     <div class="galleryprodutscreen"> 
         
         
          
     <h1><?php echo ($row['title']); ?></h1>  
     <br>   
     <div class="wholeproductpage">
     <div class="allimageproductbox">
    <img class="product-image"  src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>" /> 
          <div class="small-images"> <img   src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>" /> </div>
     </div>
       <div class="producttextcontainer">  <?php echo("<span class=producttextspan >".$row['long_desc']."</span>"); ?></div>
     </div>

      
     
         
      <!-- <div class="text"> <?php echo ($row['short_desc']); ?></div> -->
      
</div>
<div class="pricefield">
<?php echo "цена: ".($row['price']); ?>
<br>
<?php echo "<form method='post' action=''>";
echo"<input type='hidden' name='code' value=".$row['code']." />";
//echo "<td><a href='shoppingcard.php?code=".$row['code']."'class='buynowbutton''". "'>Купи сега</a> ";
echo"<button type='submit' class='buynowbutton'>Buy Now</button>";
echo"</form>";
?>

     </div>

     </div>
    
    <?php } ?>
     </body>
     </html>
     <?php
$status="";
if (isset($_POST['code']) && $_POST['code']!=""){
$code = $_POST['code'];
$result = mysqli_query($db,"SELECT * FROM `images3` WHERE `code`='$code'"
);
$row = mysqli_fetch_assoc($result);
$id_product = $row['id'];
$title = $row['title'];
$code = $row['code'];
$price = $row['price'];
$image = $row['image'];
$cartArray = array(
	$code=>array(
    'id'=>$id_product,
	'title'=>$title,
	'code'=>$code,
	'price'=>$price,
	'quantity'=>1,
	'image'=>$image)
);

if(empty($_SESSION["shopping_cart"])) {
    $_SESSION["shopping_cart"] = $cartArray;
    $status = "<div class='box'>Product is added to your cart!</div>";
   
}else{
    $array_keys = array_keys($_SESSION["shopping_cart"]);
    if(in_array($code,$array_keys)) {
	$status = "<div class='box' style='color:red;'>
	Product is already added to your cart!</div>";	
    } else {
    $_SESSION["shopping_cart"] = array_merge(
    $_SESSION["shopping_cart"],
    $cartArray
    );
    $status = "<div class='box'>Product is added to your cart!</div>";
	}

	}
}
?>
<?php
if(!empty($_SESSION["shopping_cart"])) {
$cart_count = count(array_keys($_SESSION["shopping_cart"]));
?>
<div class="cart_div">
<a href="shoppingcard.php"><img src="cart-icon.png" /> Cart<span>
<?php echo $cart_count; ?></span></a>
</div>
<?php
}

?>
<?php echo $status;?>