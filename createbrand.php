

<?php include('templates/header.php');
    
    mysqli_set_charset($db, "utf8");
    if (isset($_SESSION['message'])) {
        $message = $_SESSION['message'];
        unset($_SESSION['message']); // Remove the error from the session after retrieving it
      } else {
        $message = ""; // Set a default value if no error is present
      }
    ?>
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
            <li><a href="createbrand.php">Създай марка</a></li>
           
		</ul>
	</div>
    <div class="wrapwhite">
    <div class="contentupload">
    
    <form action="" method="post">
        <label>Добави Марка</label>
    
        <br>
        <input type="text" name="brand" placeholder="марка">
       
        <br>
        <input type="submit" name="submit" value="Добави">
    </form>
    
    </div>
    <?php  if(isset($_POST["submit"])) { 
                // Get the category value from the form
                $brand = $_POST['brand'];

            
                // Prepare the SQL query
                $sql = "SELECT * FROM brands WHERE brand = ?";
                $stmt = mysqli_prepare($db, $sql);
                mysqli_stmt_bind_param($stmt, "s", $brand);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);
                // Check if the query returned any rows
                if (mysqli_num_rows($result) > 0) {
                    // The category already exists
                    echo "<div class='contentupload'>";
                    echo "<br>";
                    echo "Грешка: марката същестува ";
                    echo"<a href='createcategories.php'>Натисни тук за да опиташ отново</a>";
                    echo "</div>";
                    exit();
                } else {
                    // The category doesn't exist, insert it into the database
                    $insert = mysqli_prepare($db, "INSERT INTO brands (brand) VALUES (?)");
                    mysqli_stmt_bind_param($insert, "s", $brand); 
                    if (mysqli_stmt_execute($insert)) {
                        echo "Success: Inserted main category.";
                    } else {
                        echo "Error: Failed to insert main category.";
                    }
                    
                    mysqli_stmt_close($insert);
                }
            
           
        
            }
            ?>