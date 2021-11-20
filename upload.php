
 <?php include('templates/header.php');
     include('templates/footer.php');    
    ?>
   <?php
    if (isset($_SESSION['sessionId'])) {
        echo "You are logged in!";
    } else {
        header("Location: ../index.php?error=accessforbidden");
    exit();
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
       
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['image']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
           
            // Insert image content into database 
            $insert = $db->query("INSERT into images3 (file_name,image, uploaded, short_desc, long_desc) VALUES ('$fileName','$imgContent',now(),'$short','$long')");
                
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
<form action="upload.php" method="post" enctype="multipart/form-data">
    <label>Select Image File:</label>
    <input type="file" name="image">
    <input type="text" name="subject" id="subject" value="short-description">
  <input type="text" name="subject1" id="subject1" value="long-description">
    <input type="submit" name="submit" value="Upload">
</form>

 
</body>
</html>