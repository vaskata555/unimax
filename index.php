<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
   
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  <script src='banner.js'defer></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.10.4/gsap.min.js"></script>
  
</head>
<body>


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



  
<div class="slideshow-container">
    
    <div class="mySlides fade">
    <img src="post.gif" style="height: 100%; width: 100%; object-fit: contain"/>
    
      
      
    </div>
    
    <div class="mySlides fade">
      
      <img src="camera.gif" style="height: 100%; width: 100%; object-fit: contain"/>
      
    </div>
    
    <div class="mySlides fade">
      
      <img src="system.gif" style="height: 100%; width: 100%; object-fit: contain"/>
    
    </div>
    
    
</div>
    <div style="text-align:center">
      <span class="dot"></span> 
      <span class="dot"></span> 
      <span class="dot"></span> 
    </div>
  
    <div class="content">
 <div class="container2">


  
 <div class="minigallery">
 <a href=file.php>
 <img src="pc2.jpg">
 <div class="overlay1">
 
     <div class="text1">  "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vulputate arcu. Nam quis mauris metus. Maecenas placerat condimentum metus, sit amet rhoncus odio tempor eget. Nulla rhoncus, sapien ut dictum eleifend, nisi sem elementum ex, quis venenatis mauris lacus at libero.<br> <button class="burrongrid" >Вижте повече</button>
  </div></div></div>
  <div class="minigallery">
 <a href=file.php>
 <img src="pc2.jpg">
 <div class="overlay1">
 
     <div class="text1">  "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vulputate arcu. Nam quis mauris metus. Maecenas placerat condimentum metus, sit amet rhoncus odio tempor eget. Nulla rhoncus, sapien ut dictum eleifend, nisi sem elementum ex, quis venenatis mauris lacus at libero.<br> <button class="burrongrid" >Вижте повече</button>
  </div></div></div>
  <div class="minigallery">
 <a href=file.php>
 <img src="pc2.jpg">
 <div class="overlay1">
 
     <div class="text1">  "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vulputate arcu. Nam quis mauris metus. Maecenas placerat condimentum metus, sit amet rhoncus odio tempor eget. Nulla rhoncus, sapien ut dictum eleifend, nisi sem elementum ex, quis venenatis mauris lacus at libero.<br> <button class="burrongrid" >Вижте повече</button>
  </div></div></div>
       
  <div class="minigallery">
 <a href=file.php>
 <img src="pc2.jpg">
 <div class="overlay1">
 
     <div class="text1">  "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vulputate arcu. Nam quis mauris metus. Maecenas placerat condimentum metus, sit amet rhoncus odio tempor eget. Nulla rhoncus, sapien ut dictum eleifend, nisi sem elementum ex, quis venenatis mauris lacus at libero.<br> <button class="burrongrid" >Вижте повече</button>
  </div></div></div>
  
  <div class="minigallery">
 <a href=file.php>
 <img src="pc2.jpg">
 <div class="overlay1">
 
     <div class="text1">  "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vulputate arcu. Nam quis mauris metus. Maecenas placerat condimentum metus, sit amet rhoncus odio tempor eget. Nulla rhoncus, sapien ut dictum eleifend, nisi sem elementum ex, quis venenatis mauris lacus at libero.<br> <button class="burrongrid" >Вижте повече</button>
  </div></div></div>
      
  <div class="minigallery">
 <a href=file.php>
 <img src="pc2.jpg">
 <div class="overlay1">
 
     <div class="text1">  "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vulputate arcu. Nam quis mauris metus. Maecenas placerat condimentum metus, sit amet rhoncus odio tempor eget. Nulla rhoncus, sapien ut dictum eleifend, nisi sem elementum ex, quis venenatis mauris lacus at libero.<br> <button class="burrongrid" >Вижте повече</button>
  </div></div></div>
  <div class="minigallery">
 <a href=file.php>
 <img src="pc2.jpg">
 <div class="overlay1">
 
     <div class="text1">  "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vulputate arcu. Nam quis mauris metus. Maecenas placerat condimentum metus, sit amet rhoncus odio tempor eget. Nulla rhoncus, sapien ut dictum eleifend, nisi sem elementum ex, quis venenatis mauris lacus at libero.<br> <button class="burrongrid" >Вижте повече</button>
  </div></div></div>
      
  <div class="minigallery">
 <a href=file.php>
 <img src="pc2.jpg">
 <div class="overlay1">
 
     <div class="text1">  "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed et vulputate arcu. Nam quis mauris metus. Maecenas placerat condimentum metus, sit amet rhoncus odio tempor eget. Nulla rhoncus, sapien ut dictum eleifend, nisi sem elementum ex, quis venenatis mauris lacus at libero.<br> <button class="burrongrid" >Вижте повече</button>
  </div></div></div>
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

<?php include 'itemshow.php';?>


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
</div>
<div class="bg"></div>
<div class="bg bg2"></div>
<div class="bg bg3"></div>
</body>
</html>


