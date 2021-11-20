

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
    
         <?php  $id = $_GET['id'];
    $result = $db->query("SELECT * FROM images3 where id = $id");
   
     while($row = $result->fetch_assoc() ){ 
         ?>
     <div class="gallery"> 
         
         
           <table class="productinfo">
               <tr>
               
     <td><img   src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>" /> </td>
          <!-- <?php echo ($row['file_name']); ?> -->
       <td>  <?php echo ($row['long_desc']); ?><br> <?php echo ($row['long_desc']); ?></td>
       
     </tr>
     </table>
         
      <!-- <div class="text"> <?php echo ($row['short_desc']); ?></div> -->
      
</div>

     </div>
    
    <?php } ?>
     </body>
     </html>