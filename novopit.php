<?php
//This code shows how to Upload And Insert Image Into Mysql Database Using Php Html.
//connecting to unimaxkasi database.
$conn = mysqli_connect("localhost", "root", "", "unimaxkasi");
if($conn) {
//if connection has been established display connected.
echo "connected";
}
//if button with the name unimaxkasisub has been clicked
if(isset($_POST['unimaxkasisub'])) {
//declaring variables
$filename = $_FILES['unimaxkasi']['name'];
$filetmpname = $_FILES['unimaxkasi']['tmp_name'];
//folder where images will be uploaded
$folder = 'C:\xampp\htdocs\unimax\imagesuploadedf';
//function for saving the uploaded images in a specific folder
move_uploaded_file($filetmpname, $folder.$filename);
//inserting image details (ie image name) in the database
$sql = "INSERT INTO `kasi4` (`imagename`) VALUES ('$filename')";
$qry = mysqli_query($conn, $sql);
if( $qry) {
echo "</br>image uploaded";
}
}
?>
<!DOCTYPE html>
<html>
<body>

<input type="file" name="unimaxkasi" />
<input type="submit" name="unimaxkasisub" value="upload" />
</form>
<div id="content">
  
  <form method="POST" action="" enctype="multipart/form-data">
      <input type="file" name="unimaxkasi" value="upload"/>
        
      <div>
          <button type="submit" name="unimaxkasisub">UPLOAD</button>
        </div>
  </form>
 
                <?php  
                $conn = mysqli_connect("localhost", "root", "", "unimaxkasi");
                $query = "SELECT * FROM kasi4 ORDER BY id DESC";  
                $result = mysqli_query($conn, $query);  
               
                
                 
                 while($images = mysqli_fetch_array($result))  ?> 
					
                    
                                  <img src="image\<?=$images['imagename']?>" height="200" width="200" class="img-thumnail" />
                                    
                           
                       
              
                <script>  
 $(document).ready(function(){  
      $('#insert').click(function(){  
           var image_name = $('#image').val();  
           if(image_name == '')  
           {  
                alert("Please Select Image");  
                return false;  
           }  
           else  
           {  
                var extension = $('#image').val().split('.').pop().toLowerCase();  
                if(jQuery.inArray(extension, ['gif','png','jpg','jpeg']) == -1)  
                {  
                     alert('Invalid Image File');  
                     $('#image').val('');  
                     return false;  
                }  
           }  
      });  
 });  
 </script>   
</body>
</html>