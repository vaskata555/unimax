



<?php
 if(isset($_POST["txtstartdate"], $_POST["txtenddate"]))  {
  $txtstartdate = date ($_POST['txtstartdate']);
  $txtenddate=date ($_POST['txtenddate']);
$result = $db->query("SELECT image,file_name,uploaded,short_desc,long_desc FROM products WHERE 
uploaded BETWEEN '".$txtstartdate."' AND '".$txtenddate."'"); 
 $output = '';
} 
  ?>
  
  <table cellspacing=25;  class="grid">
   <?php if($result->num_rows > 0){ ?> 
    <?php $counter=0; ?> 


   <?php while($row = $result->fetch_assoc()){ ?> 
   
     <?php if($counter == 0){ ?>
         <?php echo "<tr>"; ?>
     <?php } ?>
     <?php if($counter % 3==0){ ?>
         <?php echo "</tr>"; ?>
     <?php } ?>
     <?php if($counter % 3==0){ ?>
         <?php echo "<tr>"; ?>
     <?php } ?>
     
    <td>  <div class="gallery"> 
      <div class="fadeblock">
          <img class="editLink"  src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>"  /> 
          <!-- <?php echo ($row['file_name']); ?> -->
          <div class="overlay">
      <div class="text"> <?php echo ($row['short_desc']); ?></div>
       <!-- <br><?php echo ($row['long_desc']); ?> -->
       
     </div>
     </div>
       <?php  $counter++; ?>  
       
       
       
       <?php } ?> 
   <?php } ?> 
     