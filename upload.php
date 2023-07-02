<?php include('templates/header.php');
   
     mysqli_set_charset($db, "utf8mb4");
     require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    ?>
       <script src='getcategoryid.js' defer></script>
       <?php
                if(isset($_SESSION['message']))
                {
                    echo "<h4>".$_SESSION['message']."</h4>";
                    unset($_SESSION['message']);
                }
                ?>
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <?php
$type = $_SESSION['sessionUsertype'];
 if (!isset($_SESSION['sessionId']) || $type != "admin" ) {
        header("Location: ../index.php?error=accessforbiden");
        exit();
    }
    
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
<?php 
// Include the database configuration file  



// If file upload form is submitted 

if(isset($_POST["submit"])){ 
    $status = 'error'; 
   
   
    $fileName = basename($_FILES["imageupload"]["name"]); 
    $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
    $short = $_POST['subject'];
    $code = $_POST['code'];
    $long = $_POST['subject1'];
   $title=$_POST['titleupload'];
   $brand=$_POST['brandupload'];
   $price=$_POST['priceupload'];
  
   $selected_subcategory_id = $_POST['subcategory-chosen'];
    $selected_category_id = $_POST['category-chosen'];
    $sqlcheck = "SELECT code FROM products WHERE code = ? ";
    $stmt1 = mysqli_stmt_init($db);
    if(!empty($_FILES["imageupload"]["name"] )) { 
        if (!mysqli_stmt_prepare($stmt1, $sqlcheck)) {
            header("Location: ../upload.php?error=sqlerror");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt1, "s", $code);
            mysqli_stmt_execute($stmt1);
          
         
            mysqli_stmt_store_result($stmt1);
            $rowCount = mysqli_stmt_num_rows($stmt1);
        
            if ($rowCount > 0) {
                echo "<br>";
              
               
               header("Location: ../unimax/upload.php?error=CODEINUSE");
              
                exit();
            
            }
        }
       
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['imageupload']['tmp_name']; 
            $imgContent = "img" .'/'. $fileName ;
           
            // Insert image content into database 
            $insert = $db->query("INSERT into products (code,image,file_name,uploaded,short_desc,price,long_desc,title,brand_id,category_id,subcategory_id) VALUES ('$code','$imgContent','$fileName',now(),'$short','$price','$long','$title','$brand','$selected_category_id','$selected_subcategory_id')");
         }
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
                
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Моля попълнете всички полета'; 
    } 

 

// Display status message 

?>


<!DOCTYPE html>
<html>
<body>
    <div class="wrapwhite">
<div class="contentupload">
<br>
    <br>
    <?php echo $statusMsg; ?>
    <br>
    <br>
<form action="upload.php" class="contentuploadform" method="post" enctype="multipart/form-data">
    <label>Избери изображение</label>
    <br>
    <input type="file" id="imageupload" name="imageupload" required><br>
    <input type="text" id="titleupload" name="titleupload" placeholder="заглавие"required><br>
    <select name="brandupload" id="brandupload"  required><br>
    <option value=""disabled selected>Изберете марка</option>
    <?php $sqlbrand = "SELECT * FROM brands ";
    $resultbrand = mysqli_query($db,$sqlbrand);
    while ($rowbr = mysqli_fetch_assoc($resultbrand)) {
      ?> 
    <option value='<?php echo $rowbr['id']  ?>'> <?php echo $rowbr['brand'] ?> </option>
    <?php }?>
    </select>
    <div class="productcategoryupload">
    <div class="uploadmaincategory">
    <?php $sql = "SELECT * FROM category ";

$result = mysqli_query($db,$sql);

if(mysqli_num_rows($result)>0){
   
?> 
<p>1.избери категория</p>
<select name='category-select' id='category-select' style="height: 100%"  >
<option value=""disabled selected>Изберете категория</option>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        ?>
        <option value='<?php echo $row['id']  ?>'> <?php echo $row['category_name'] ?> </option>
    
    <?php
    } 
    
    ?>
</select>

<?php
   
}
?>
<script>
$('#category-select').on('change', function() {
  var selectedOption = $(this).val();

  
    $.ajax({
      url: 'get_subcategories.php',
      type: 'POST',
      data: {selected_category_id: selectedOption},
      charset: 'utf-8',
      success: function(response) {
        $('#subcategory-select').html(response);
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  }
);
    </script>
</div>
<div class="uploadmainsubcategory"> 
<p>2.избери подкатегория</p>
<select name='category-select' id='subcategory-select' style="height: 100%"  >
<option value=""disabled selected>Изберете подкатегория</option>
</select>
<?php


  include("get_subcategories.php");



?>

<?php

?>
</select>

</div>
</div>


<input type="text"  name="code" id="code" placeholder="код"required><br>
    <input type="text" name="subject" id="subject" placeholder="кратко описание"required><br>
    <textarea class="textareaupload" name="subject1" id="subject1" wrap="hard" rows="10" placeholder="Описание" cols="85"required></textarea><br>
  <input type="text" id="priceupload" name="priceupload" placeholder="цена"required><br>
    
    <input type='text' class='createcategorysubmit' id='primary-category' name='category-chosen' placeholder="категория" value='' readonly>
    
    <br>
    
    <input type='text' class='createcategorysubmit' id='sub-category' placeholder="подкатегория" name='subcategory-chosen' value=''readonly>
     
    <br>
    <input type="submit" name="submit" id="submit" value="Качи"></input>
    <br><br>
</form>
</div>
<div class="contentupload">
 <div class="excel_import">
<h1>Групово качване</h1>
<form action="/unimax/uploadexcel.php" id="myForm" class="contentuploadform" method="post" enctype="multipart/form-data">
    <label>Изберете файл:</label>
    <input type="file" id="imageupload" name="import_file" required><br>
    <button type="submit" name="save_excel_data" >Качи</button>
    <br>
    <p>
    <label class="switch1">
    <input type="checkbox" id="toggle" onchange="toggleFormAction()">
    <span class="slider1"></span>
    </label>
</form>
<script>
    function toggleFormAction() {
      var form = document.getElementById("myForm");
      var button = form.querySelector("button[type='submit']");
      var toggle = document.getElementById("toggle");
      
      if (toggle.checked) {
        button.formAction = "/unimax/uploadexcelupdate.php";
      } else {
        button.formAction = "/unimax/uploadexcel.php";
      }
    }
  </script>

<h1>Таксономия за категории</h1>
<?php include('taxonomy.php');?>
<form method="POST" action="">
        <button type="submit" name="generate_excel">Генерирай Актуална таксономия </button>
       
           
       
        <a href="output.xlsx" download>Изтегли таксономия</a>
    </form>
    <h1>Файл с готови хедъри за импорт</h1>
    <?php include('uploadfile.php');?>
    <form method="POST" action="">
        <button type="submit" name="defaultexcel">Генерирай файл готов за попълване </button>
       
           
       
        <a href="defaultupload.xlsx" download>Изтегли файл</a>
    </form>
    <br>
    <h1>Таксономия за Марки</h1>
<?php include('brandtaxonomy.php');?>
<form method="POST" action="">
        <button type="submit" name="generate_excel_brand">Генерирай Актуална Tаксономия</button>
       
           
       
        <a href="outputbrands.xlsx" download>Изтегли таксономия</a>
    </form>
</div>
</div>
</div>
</body>
<?php  include('templates/footer.php'); ?>
</html>