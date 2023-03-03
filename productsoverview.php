<?php include('templates/header.php');
     include('templates/footer.php');
    
    ?> 
     <div id="sidebar">
		<ul>
			<li><a href="#">Dashboard</a></li>
			<li><a href="useroverview.php">Users</a></li>
			<li><a href="productsoverview.php">Products</a></li>
			<li><a href="#">Orders</a></li>
		</ul>
	</div>
    <div id="content">
    <div class="firstadminpanel">
    <?php  
    $result = $db->query("SELECT * FROM images3 ");
   
     while($row = $result->fetch_assoc() ){ 
         ?>
         <div class="galleryproduct"> 
     <div class="galleryprodutscreen"> 
         
         
          
     <h1><?php echo ($row['title']); ?></h1>  
     <br>  
     <div class="dividedashinfo"> 
     <div class="wholeproductpagedash">
     <div class="allimageproductboxdash">
    <img class="product-image"  src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>" /> 
          <div class="small-images"> <img   src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>" /> </div>
     </div>
       <div class="producttextcontainerdash">  <?php echo("<span class=producttextspan >".$row['long_desc']."</span>"); ?></div>
       
     </div>
     <?php echo "цена: ".($row['price']); ?>
     </div>
     
</div>
<div class="pricefield">

<br>

     </div>

     </div>
    
    <?php } ?>
</div>
     </div>