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
<?php 
// Check if a message is stored in the session

?> 
 <?php
    if (isset($_SESSION['sessionId'])) {


        echo "Hello user: ";
        echo $_SESSION['sessionUser'];
        echo $type = $_SESSION['sessionUsertype'];
        if($type=="admin"){
        echo '<a href="admin_dashboard.php" class="btnbrand">Admin Dashboard</a>';
        echo'  ';
        echo '<a href="upload.php" class="btnbrand">upload product</a>';
        }
    } else {
        echo "Home";
    }
   
   
?>
<?php 
// Include the database configuration file  
require_once 'templates/dbConfig.php'; 


// If file upload form is submitted 
$status = $statusMsg = ''; 
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
    $sqlcheck = "SELECT code FROM images3 WHERE code = ? ";
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
            $insert = $db->query("INSERT into images3 (code,image,file_name,uploaded,short_desc,price,long_desc,title,brand,category_id,subcategory_id) VALUES ('$code','$imgContent','$fileName',now(),'$short','$price','$long','$title','$brand','$selected_category_id','$selected_subcategory_id')");
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
        $statusMsg = 'Please select an image file to upload.'; 
    } 

 

// Display status message 
echo $statusMsg; 
?>


<!DOCTYPE html>
<html>
<body>
    
<div class="contentupload">
<form action="upload.php" class="contentuploadform" method="post" enctype="multipart/form-data">
    <label>Select Image File:</label>
    <input type="file" id="imageupload" name="imageupload" required><br>
    <input type="text" id="titleupload" name="titleupload" placeholder="title"required><br>
    <input type="text" id="brandupload" name="brandupload" placeholder="brand"required><br>
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
<option value=""disabled selected>Изберете категория</option>
</select>
<?php


  include("get_subcategories.php");



?>

<?php

?>
</select>

</div>
</div>


<input type="text"  name="code" id="code" placeholder="code"required><br>
    <input type="text" name="subject" id="subject" placeholder="short-description"required><br>
    <textarea class="textareaupload" name="subject1" id="subject1" wrap="hard" rows="10" cols="85"required></textarea><br>
  <input type="text" id="priceupload" name="priceupload" placeholder="price"required><br>
    <input type="submit" name="submit" id="submit" value="Upload">
    <input type='text' class='createcategorysubmit' id='primary-category' name='category-chosen' value=''>
    
    <br>
    
    <input type='text' class='createcategorysubmit' id='sub-category' name='subcategory-chosen' value=''>
    
    
</form>
</div>
 <div class="excel_import">
<h1>Групово качване</h1>
<form action="/unimax/uploadexcel.php" id="myForm" class="contentuploadform" method="post" enctype="multipart/form-data">
    <label>Select Image File:</label>
    <input type="file" id="imageupload" name="import_file" required><br>
    <button type="submit" name="save_excel_data" >Import</button>
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
</div>
</body>
<?php  include('templates/footer.php'); ?>
</html>