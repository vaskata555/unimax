

<!DOCTYPE html>
<html>
   <head>
<title>Upload Image PHP MySQL Tutorial</title>
 <link rel='stylesheet' href='style.css' />
 <?php include('templates/header.php');
     include('templates/footer.php');
    
    ?>
 <style>
    #content{
    width: 50%;
    margin: 20px auto;
    border: 1px solid #cbcbcb;
}
form{
    width: 50%;
    margin: 20px auto;
}
form div{
    margin-top: 5px;
}
#img_div{
    width: 80%;
    padding: 5px;
    margin: 15px auto;
    border: 1px solid #cbcbcb;
}
#img_div:after{
    content: "";
    display: block;
    clear: both;
}
img{
    float: left;
    margin: 5px;
    width: 300px;
    height: 140px;
}
</style>
</head>
<body>
<?php
  $msg = "";
 
  // If upload button is clicked ...
  if (isset($_POST['upload'])) {
  
    $filename = $_FILES["uploadfile"]["name"];
    $tempname = $_FILES["uploadfile"]["tmp_name"];    
        $folder = "image/".$filename;
          
    $db = mysqli_connect("localhost", "root", "", "unimaxkasi");
  
        // Get all the submitted data from the form
        $sql = "INSERT INTO image (filename) VALUES ('$filename')";
  
        // Execute query
        mysqli_query($db, $sql);
          
        // Now let's move the uploaded image into the folder: image
        if (move_uploaded_file($tempname, $folder))  {
         $msg = "Image uploaded successfully";
     }else{
         $msg = "Failed to upload image";
   }
}
$result = mysqli_query($db, "SELECT * FROM image");

 
?>

<div id="content">
  
  <form method="POST" action="" enctype="multipart/form-data">
      <input type="file" name="uploadfile" value=""/>
        
      <div>
          <button type="submit" name="upload">UPLOAD</button>
        </div>
  </form>
</div>
</body>
</html>