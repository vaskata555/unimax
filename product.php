

<html>
    <head>
    
    
    
   

     </head>
     <body>
   
     <?php
    require_once('templates/dbConfig.php');
   
?>
     <?php include('templates/header.php');
    
    
    ?>
     <?php
    if (isset($_SESSION['sessionId'])) {
        echo "You are logged in!";
    } else {
        echo "Home";
    }

?>



         <?php  $id = $_GET['id'];
    $sql = "SELECT * FROM images3 WHERE id = ?";
    $stmt = mysqli_prepare($db, $sql);
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
   
     while($row = $result->fetch_assoc() ){ 
         ?>
         <div class="galleryproductsuggestion"> 
     <div class="galleryprodutscreen"> 
         
         
          
     <h1><?php echo ($row['title']); ?></h1>  
     <br>   
     <div class="wholeproductpage">
     <div class="allimageproductbox">
    <?php $image_unescaped = ($row['image']) ;
    $image_escaped = str_replace("/","\\",$image_unescaped) ?>
    <img class="imagebd"  src="<?php echo  $image_escaped ;?>"/>
         
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
 $sql = "SELECT * FROM `images3` WHERE `code` = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "s", $code);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
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
<?php 
   $id = $_GET['id'];

  $sql = "SELECT * FROM images3 where id = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

   while($row = $result->fetch_assoc() ){ 
    $price = $row['price'];
    $price1 = $price - 200;
    $price2 = $price + 200;
   }

   $sql = "SELECT * FROM images3 WHERE price BETWEEN ? AND ? AND id <> ? LIMIT 4";
   $stmt = mysqli_prepare($db, $sql);
   mysqli_stmt_bind_param($stmt, "ddd", $price1, $price2, $id);
   mysqli_stmt_execute($stmt);
   $result = mysqli_stmt_get_result($stmt); ?> 
 
 <br>

 <div class="container2suggestion">
 <div class="container1suggestion">
  
 <?php if($result->num_rows > 0){ ?> 

       <?php while($row = mysqli_fetch_assoc($result)){ ?> 
           
         <div class="item">
        <?php $image_unescaped = ($row['image']) ;
        $image_escaped = str_replace("/","\\",$image_unescaped) ?>
             <a href='product.php?id=<?= $row['id'] ?>' class="product-link">
             <img class="imagebdsuggestion"  src="<?php echo  $image_escaped ;?>"/>
             
        
             <div class="overlaysuggestion">
              <!-- <?php echo ($row['file_name']); ?> -->
            
            
              <div class="textproducts"> <?php echo ($row['short_desc']); ?>
             </div></div>
              </div>
              
       
       
              </a>
      
           
           
       
       <?php } ?> 
       
       


<?php }else{ ?> 
   <p class="status error">Image(s) not found...</p> 
<?php } ?>
</div>
 </div>
 <?php  include('templates/footer.php'); ?>