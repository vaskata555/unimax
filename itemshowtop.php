
<?php $counter=0; ?> 
 

 

 
 
 
 
  <div class="container1">
   
  <?php if($result->num_rows > 0){ ?> 
 
        <?php while($row = $result->fetch_assoc()){ ?> 
            
          <div class="item">
         <?php $image_unescaped = ($row['image']) ;
         $image_escaped = str_replace("/","\\",$image_unescaped) ?>
              <a href='product.php?id=<?= $row['id'] ?>' class="product-link">
              <img class="imagebd"  src="<?php echo  $image_escaped ;?>"/>
              
         
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