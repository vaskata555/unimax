<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <script src='banner.js'defer></script>
</head>
<body>


    <?php include('templates/header.php');
     include('templates/footer.php');
    a
    ?>
    <?php
    if (isset($_SESSION['sessionId'])) {
        echo "You are logged in!";
    } else {
        echo "Home";
    }

?>


<div class="slideshow-container">
    
    <div class="mySlides fade">
    <img src="post.gif" style="width:1482px; height:620px"/>
    <div class="numbertext">1 / 3</div>
      
      
    </div>
    
    <div class="mySlides fade">
      
      <img src="camera.gif" style="width:1482px; height:620px"/>
      
    </div>
    
    <div class="mySlides fade">
      
      <img src="system.gif" style="width:1482px; height:620px"/>
    
    </div>
    
    
    </div>
    <div style="text-align:center">
      <span class="dot"></span> 
      <span class="dot"></span> 
      <span class="dot"></span> 
    </div>

    <div class="placement">
    <div class="dropdown">
  <button class="dropbtn">Filter <img src="filter2.png" height="12px" width="12px"></button>
  <div class="dropdown-content">
   <form method="post">
     
     <input type="date" id="txtstartdate"  name="txtstartdate">
     <input type="date" id="txtenddate" name="txtenddate">
     <input type="submit" name="search" id="search" value="search between dates" >
     <input type="submit" id="reset" name="reset" value="Reset" />
  </form>
  </div>
</div>
</div>
<?php
 if(isset($_POST["txtstartdate"], $_POST["txtenddate"]))  {
  $txtstartdate = date ($_POST['txtstartdate']);
  $txtenddate=date ($_POST['txtenddate']);
$result = $db->query("SELECT id,image,file_name,uploaded,short_desc,long_desc FROM images3 WHERE 
uploaded BETWEEN '".$txtstartdate."' AND '".$txtenddate."'"); 

}else{
  $result = $db->query("SELECT id,image,file_name,uploaded,short_desc,long_desc FROM images3 ORDER BY uploaded DESC");
 } 
 if(isset($_POST["reset"])){
  $result = $db->query("SELECT id,image,file_name,uploaded,short_desc,long_desc FROM images3 ORDER BY uploaded DESC");
 } ?>

 <?php $counter=0; ?> 
 <br>

 
 <table cellspacing=25;  class="grid">
 
 <div  id='order_table'> 
 
<?php if($result->num_rows > 0){ ?> 
   

  
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
         
            <a href='product.php?id=<?= $row['id'] ?>'>
               <img class="editLink"  src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>"  /> 
               <!-- <?php echo ($row['file_name']); ?> -->
              
               <div class="overlay"> 
               <div class="text"> <?php echo ($row['short_desc']); ?></div>
            <!-- <br><?php echo ($row['long_desc']); ?> -->
            </a>
            
           </div>
          </div>
          </div>
            <?php  $counter++; ?>  </td>
          
            
            
        
        <?php } ?> 
        
        


<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>
</div>
</table>

<!-- <?php $sql = "SELECT * FROM users";
 $result = mysqli_query($db, $sql);
  $rowCount = mysqli_num_rows($result); 
if ($rowCount > 0) {
   while ($row = mysqli_fetch_assoc($result)) {
      echo $row['username'] .'<br>'. $row['password'];
   }
  }else {
    echo "No results found.";
   } 
  ?> -->

</body>
</html>


