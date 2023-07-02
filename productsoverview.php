<?php include('templates/header.php');
    
    
    ?> 
    
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
    <div id="content">
    <div class="firstadminpanel">
    <?php  
    $result = $db->query("SELECT * FROM products ");
   
    while($row = $result->fetch_assoc() ){ 
      ?>
      <div class="galleryproductoverview"> 
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

//echo "<td><a href='shoppingcart.php?code=".$row['code']."'class='buynowbutton''". "'>Купи сега</a> ";
echo"<a href='edit_product.php?id=".$row['id']. "'class='buynowbutton'>Коригирай</a>";
echo"<br>";
echo"<a href='deleteproduct.php?id=" . $row['id'] ."'class='buynowbutton'>Премахни</a>";
echo"</form>";
?>

  </div>

  </div>
 
 <?php } ?>
</div>
     </div>
     <?php include('templates/footer.php'); ?>