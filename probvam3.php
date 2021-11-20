
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
.gallery {
    
  border: 1px solid #ccc;
}

.gallery:hover {
  border: 1px solid #777;
}

.gallery img {
  width: 380px;
  height: 380px;
}

.desc {
  padding: 15px;
  text-align: center;
}

* {
  box-sizing: border-box;
}

.responsive {
  padding: 0 6px;
  float: left;
  width: 24.99999%;
}

@media only screen and (max-width: 700px) {
  .responsive {
    width: 49.99999%;
    margin: 6px 0;
  }
}

@media only screen and (max-width: 500px) {
  .responsive {
    width: 100%;
  }
}

.clearfix:after {
  content: "";
  display: table;
  clear: both;
}
}
</style>
</head>
<body>
<?php 
// Include the database configuration file  
require_once 'dbConfig.php'; 
 
// Get image data from database 
$result = $db->query("SELECT image,file_name,short_desc,long_desc FROM images2 ORDER BY uploaded DESC"); 
?>
 <?php $counter=0; ?> 
<table>

<?php if($result->num_rows > 0){ ?> 
   
<tr>

        <?php while($row = $result->fetch_assoc()){ ?> 
            <?php if($counter % 3){ 
            }

                ?>
                

         <td>  <div class="gallery"> 
               <img  src="data:image/jpg;charset=utf8;base64, <?php echo base64_encode($row['image']);?>"  /> 
               <!-- <?php echo ($row['file_name']); ?> -->
           <br> <?php echo ($row['short_desc']); ?>
            <br><?php echo ($row['long_desc']); ?></td>
            <?php $counter++ ?> 
       
        
        <?php } ?> 
        </tr>
        </div>
    
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p> 
<?php } ?>
</table>
</body>
</html>