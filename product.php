

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
     <div class="gallery"> 
         
         
          
     <h1><?php echo ($row['title']); ?></h1>  
     <br>   
    <img class="product image"  src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>" /> 
          <!-- <?php echo ($row['file_name']); ?> -->
       <div class="producttext">  <?php echo ($row['long_desc']); ?></div>
       <br>
      <div class="small-images"> <img   src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>" /> </div>
     
         
      <!-- <div class="text"> <?php echo ($row['short_desc']); ?></div> -->
      
</div>

     </div>
    
    <?php } ?>
     </body>
     </html>