<?php include('templates/header.php');
     include('templates/footer.php');
    
    ?>
  <?php
$type = $_SESSION['sessionUsertype'];
 if (!isset($_SESSION['sessionId']) || $type != "admin" ) {
        header("Location: ../index.php?error=accessforbiden");
        exit();
    }
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
    if(!empty($_FILES["image"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
        $short = $_POST['subject'];
        $long = $_POST['subject1'];
       $title=$_POST['title'];
       $price=$_POST['price'];
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
           
            // Insert image content into database 
            $insert = $db->query("INSERT into images3 (file_name,image, uploaded, short_desc, long_desc,title,price) VALUES ('$fileName','$imgContent',now(),'$short','$long','$title','$price')");
                
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
} 

// Display status message 
echo $statusMsg; 
?>


<!DOCTYPE html>
<html>
<body>
<div class="contentupload">
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label>Select Image File:</label>
    <input type="file" name="image">
    <input type="text" name="title" value="title">
    <input type="text" name="subject" id="subject" value="short-description">
  <input type="text" name="subject1" id="subject1" value="long-description">
  <input type="text" name="price" value="price">
    <input type="submit" name="submit" value="Upload">
</form>
</div>
 
</body>
</html>