<!DOCTYPE html>
<?php include('templates/header.php'); ?>
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
      <div class="loggedpanel">
         <?php
            if (isset($_SESSION['sessionId'])) {
                echo "Hello: ";
                echo $_SESSION['sessionUser'];
                echo'  ';
                echo $type = $_SESSION['sessionUsertype'];
                echo'  ';
                if ($type == "admin") {
                    echo '<a href="admin_dashboard.php" class="btnbrand">Admin Dashboard</a>';
                    echo'  ';
                    echo '<a href="upload.php" class="btnbrand">upload product</a>';
                }
            } else {
                echo "";
            }
            ?>
      </div>
      <div class="slideshow-container">
         <div class="mySlides">
            <img id="banner-1"src="test1.jpg">
            <div class="top-right"><p class="top-righttext">Унимакс - решения за вашият бизнес</p></div>
            <div class="top-right2"><p class="top-righttext2">Намерете подходящо устройство <br>за вашите търговски цели</p></div>
         </div>
         <div class="mySlides fade">
            <img id="banner-2" src="camera.gif">
         </div>
         <div class="mySlides fade">
            <img  id="banner-3"src="system.gif">
         </div>
      </div>
      <div style="text-align:center">
         <span class="dot"></span> 
         <span class="dot"></span> 
         <span class="dot"></span> 
      </div>
      <div class="content">
         
            
        
         <div class="article">
            
         <div class="flex-box">
        
  <div class="small-article">
  <img src="img\icons8-task-100.png">
  <h5>Персонализиран подход</h5>
 
  <b class="info-p">Държим много на нашите клиенти и предлагаме<br> специализиран подход в изработката<br> и поддръжката на системи<br> за търговия и видео наблюдение</b>

</div>

<div class="small-article">
  <img src="img\icons8-cash-register-100.png">
  <h5>Асортимент от продукти</h5>
 
  <b class="info-p">Богатият избор от продукти,<br> предлагани от Унимакс ООД,<br> включва касови апарати, фискални принтери,<br>  ФУВАС системи и други бизнес решения.</b>

</div>
<div class="small-article">
  <img src="img\icons8-service-100.png">
  <h5>Поддъжка и сервиз</h5>
 
  <b class="info-p">Kaчествена поддъжка и лицензиран сервиз.<br>Вярваме в качественото обслужване и сме<br> готови да отговорим на вашите нужди,<br>като гарантираме бърза и ефективна работа</b>

</div>
</div>
         </div>
         <div class="container2">
         
            <?php
               $result = $db->query("SELECT i.id,i.image,i.file_name, i.title,i.short_desc,i.long_desc, COUNT(*)
               FROM images3 i
               JOIN payment_info p ON i.id = p.id_product
               GROUP BY i.id
               ORDER BY COUNT(*) DESC
               LIMIT 3;");
               //mqsto za otdelenie
               ?>
              <div class="top-product">
<p><b>Нашите топ продукти<b></p>
          </div>
         
         <?php include 'itemshow.php';?>
      </div>
      
      <div class="bg"></div>
      <div class="bg bg2"></div>
      <div class="bg bg3"></div>
   </body>
   <?php include('templates/footer.php'); ?>
</html>