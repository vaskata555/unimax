<?php include('templates/header.php');
    
    mysqli_set_charset($db, "utf8");
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']); // Remove the error from the session after retrieving it
      } else {
        $message = ""; // Set a default value if no error is present
      }
    ?>
    <script src="getcategoryid.js"defer></script>
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
    <div class="wrapwhite">
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
                $sql = "SELECT * FROM category WHERE category_name = ?";
                $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_bind_param($stmt, "s", $category);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
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
                    $insert = mysqli_prepare($db, "INSERT INTO category (category_name) VALUES (?)");
                    mysqli_stmt_bind_param($insert, "s", $category); 
                    if (mysqli_stmt_execute($insert)) {
                        echo "Success: Inserted main category.";
                    } else {
                        echo "Error: Failed to insert main category.";
                    }
                    
                    mysqli_stmt_close($insert);
                }
            
           
        
            }
            if(isset($_POST["subcategorycheck"])){ 
                $sql = "SELECT * FROM subcategory WHERE subcategory_name = ?";
                $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_bind_param($stmt, "s", $subcategory);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                // Execute the SQL query
                
            
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
            $insert2  = mysqli_prepare($db, "INSERT into subcategory (subcategory_name) VALUES (?)"); 
            mysqli_stmt_bind_param($insert2, "s", $subcategory); 
                }
            if(mysqli_stmt_execute($insert2)){ 
                $status1 = 'success'; 
                $statusMsg1 = "SUBCategory Created successfully."; 
            }else{ 
                $statusMsg1 = "SUBCategory upload failed, please try again."; 
            } 
            mysqli_stmt_close($insert2);
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
    <label>Добави категория/подкатегория</label>

    <br>
    <input type="text" name="category" placeholder="category">
    <input type="checkbox" id="categorycheck" name="categorycheck"><br>
    <input type="text" name="subcategory" placeholder="subcategory">
    <input type="checkbox" id="subcategorycheck" name="subcategorycheck"><br>
    <br>
    <input type="submit" name="submit" value="Добави">
</form>

</div>
<div class="categoryupload">
<br>
  <p><?php echo '  ' . $message; ?></p>
  <br>
    <div class="uploadmaincategory">
  
<?php $sql = "SELECT * FROM category ";

$result = mysqli_query($db,$sql);

if(mysqli_num_rows($result)>0){
   
?> 
<p>избери категория</p>
<select name='category-select' id='category-select' size="15" style="height: 100%">
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<option value='" . $row['category_name'] . "' categoryid='" . $row['id'] . "'>" . $row['category_name'] . "</option>";
    }
    ?>
</select>
<?php
    
}
?>
</div>
<div class="uploadmainsubcategory">
<?php $sql1 = "SELECT * FROM subcategory ";

$result1 = mysqli_query($db,$sql1);

if(mysqli_num_rows($result1)>0){
   
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
?>
</div>
<div class="uploadcategorymap">
    <form  method="POST">
    <br>
    <input type='text' class='createcategorysubmit' name='category-chosen' value='' readonly>
    <input type='text' class='categoryid' name='categoryid' value='' readonly>
    <br>
    <input type='text' class='createcategorysubmit' name='subcategory-chosen' value='' readonly>
    <input type='text' class='categoryid' name='subcategoryid' value='' readonly>
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
   
    // Insert the data into the "category_subcategory_map" table

    $sql = mysqli_prepare($db,  "INSERT INTO category_subcategory(category_id, subcategory_id) VALUES (?,?)");
    mysqli_stmt_bind_param($sql, "ii",$category_id,$subcategory_id); 

if(mysqli_stmt_execute($sql)){ 
    
    $_SESSION['message'] = "категория: ".$category_name. " и субкатегория:".$subcategory_name." бяха разрешени";
}else{ 
    $_SESSION['message'] = "Грешка категориите не бяха добавени";
} 
mysqli_stmt_close($sql);
  
}  

    ?>
    </div>
</body>
</html>