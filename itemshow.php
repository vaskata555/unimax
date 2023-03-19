<?php $counter=0; ?> 
 

 

 
 
 
 
  <div class="container1">
   
  <?php if($result->num_rows > 0){ ?> 
 
        <?php while($row = $result->fetch_assoc()){ ?> 
            
          <div class="item">
         
              <a href='product.php?id=<?= $row['id'] ?>' class="product-link">
              <img class="imagebd"  src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>"/>
         
              <div class="overlay">
               <!-- <?php echo ($row['file_name']); ?> -->
             
             
               <div class="textproducts"> <?php echo ($row['short_desc']); ?>
              </div></div>
               </div>
               
        
        
               </a>
        <?php  $counter++; ?>
            
            
        
        <?php } ?> 
        
        


 <?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
 <?php } ?>
 </div>
  </div>