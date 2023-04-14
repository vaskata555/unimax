<?php include('templates/header.php');
     include('templates/footer.php');
    
    ?>
    <script src="getcategoryid.js"defer></script>
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



// If file upload form is submitted 
$status = $statusMsg = ''; 
$status2 = $statusMsg1 = '';
if(isset($_POST["submit"])){ 
    $status = 'error'; 
       $category=$_POST['category'];
       $subcategory=$_POST['subcategory'];
       $categorycheck=isset($_POST['categorycheck']) ? true : false;
       $subcategorycheck=isset($_POST['subcategorycheck']) ? true : false;
        
       
       
         
           
            // Insert image content into database 
            if(isset($_POST["categorycheck"])) { 
                // Get the category value from the form
               
            
                // Prepare the SQL query
                $sql = "SELECT * FROM category WHERE category_name = '$category'";
            
                // Execute the SQL query
                $result = mysqli_query($db, $sql);
            
                // Check if the query returned any rows
                if (mysqli_num_rows($result) > 0) {
                    // The category already exists
                    echo "<div class='contentupload'>";
                    echo "<br>";
                    echo "Грешка: категорията същестува ";
                    echo"<a href='createcategories.php'>Натисни тук за да опиташ отново</a>";
                    echo "</div>";
                    exit();
                } else {
                    // The category doesn't exist, insert it into the database
                    $insert = mysqli_query($db, "INSERT into category (category_name) VALUES ('$category')");
                    if ($insert) {
                        echo "Success: Inserted main category.";
                    } else {
                        echo "Error: Failed to insert main category.";
                        
                    }
                }
            
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "Category Created successfully."; 
            }else{ 
                $statusMsg = "Category upload failed, please try again."; 
            }  
        
            }
            if(isset($_POST["subcategorycheck"])){ 
                $sql = "SELECT * FROM subcategory WHERE subcategory_name = '$subcategory'";
            
                // Execute the SQL query
                $result = mysqli_query($db, $sql);
            
                // Check if the query returned any rows
                if (mysqli_num_rows($result) > 0) {
                    // The category already exists
                    echo "<br>";
                     echo "<div class='contentupload'>";
                    echo "Грешка: подкатегорията същестува ";
                    echo"<a href='createcategories.php'>Натисни тук за да опиташ отново</a>";
                    echo "</div>";
                    exit();
                } else {
            $insert2 = $db->query("INSERT into subcategory (subcategory_name) VALUES ('$subcategory')"); 
                }
            if($insert2){ 
                $status1 = 'success'; 
                $statusMsg1 = "SUBCategory Created successfully."; 
            }else{ 
                $statusMsg1 = "SUBCategory upload failed, please try again."; 
            } 
            }
           
           
        
    }else{ 
        $statusMsg = 'моля въведете категория'; 
        $statusMsg1 = 'моля въведете подкатегория.'; 
    
}

// Display status message 
echo "<br>";
echo $statusMsg; 
echo "<br>";
echo $statusMsg1; 
?>


<!DOCTYPE html>
<html>
<body>
<div class="contentupload">
<form action="" method="post">
    <label>add cateogory/subcategory</label>

    <br>
    <input type="text" name="category" placeholder="category">
    <input type="checkbox" id="categorycheck" name="categorycheck"><br>
    <input type="text" name="subcategory" placeholder="subcategory">
    <input type="checkbox" id="subcategorycheck" name="subcategorycheck"><br>
    <br>
    <input type="submit" name="submit" value="Upload">
</form>
</div>
<div class="categoryupload">
    <div class="uploadmaincategory">
<?php $sql = "SELECT * FROM category ";

$result = mysqli_query($db,$sql);

if(mysqli_num_rows($result)>0){
    foreach($result as $row){
?> 
<p>избери категория</p>
  <select name='category-select' id='category-select' size="15"style="height: 100%">
    <?php
      while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['category_name'] . "' categoryid='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
      }
    ?>
  </select>
<?php
    }
}
?>
</div>
 <div class="uploadmainsubcategory">
<?php $sql1 = "SELECT * FROM subcategory ";

$result1 = mysqli_query($db,$sql1);

if(mysqli_num_rows($result1)>0){
    foreach($result1 as $row1){

?>  
<p>избери подкатегория</p>
  <select name='subcategory-select' id='subcategory-select' size="15"style="height: 100%">
    <?php
      while ($row1 = mysqli_fetch_assoc($result1)) {
        echo "<option value='" . $row1['subcategory_name'] . "' subcategoryid='" . $row1['id'] . "'>" . $row1['subcategory_name'] . "</option>";
         
      }
    ?>
  </select>
  




<?php
    }
}
?>
</div>
<div class="uploadcategorymap">
    <form method="POST">
    <br>
     <input type='text' class='createcategorysubmit' name='category-chosen' value=''>
     <input type='text' class='categoryid' name='categoryid' value=''>
     <br>
     <input type='text' class='createcategorysubmit' name='subcategory-chosen' value=''>
    <input type='text' class='categoryid' name='subcategoryid' value=''>
    <br>
    <input name='submitcategorycombo' type="submit">
</form>
</div>
</div>
<?php
if(isset($_POST["submitcategorycombo"])){ 
    $category_id = $_POST['categoryid'];
    $category_name = $_POST['category-chosen'];

    // Get the selected subcategory IDs
    $subcategory_id = $_POST['subcategoryid'];
    $subcategory_name = $_POST['subcategory-chosen'];
    echo"категория: ".$category_name. " и субкатегория:".$subcategory_name." бяха разрешени" ;
    // Insert the data into the "category_subcategory_map" table
  
      $sql = "INSERT INTO category_subcategory(category_id, subcategory_id) VALUES ('$category_id', '  $subcategory_id')";
      mysqli_query($db, $sql);
    
}
    ?>
</body>
</html>