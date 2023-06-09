<?php 
 include('templates/header.php');

// Connect to database
 // Check connection
 if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET['id'];
$sql = "SELECT * FROM images3 WHERE id = ?";
$stmt = mysqli_prepare($db, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

//echo"<div class='floatingvalue'>";
//while($row = $result1->fetch_assoc() ){
//echo $floatingval="user with id=".$id." username= ".$row['username']." and email= ".$row['email']." had been selected";
// Check if the form is submitted
//}
//echo "</div>";


if(mysqli_num_rows($result)>0){
	foreach($result as $row){

?>
<div class="headeredit">
		<h1>Edit User</h1>
	</div>
<div class="formedit">
<form method="POST">
<input type="hidden" id="id" name="id" value="<?php echo $row['id'];?>"><br>
			<label for="title">име на продукта:</label><br>
		
			<input type="text" id="title" name="title" value="<?php echo $row['title'];?>"><br>
		
			<label for="price">изображение - път</label><br>
			<input type="text" id="image" name="image" value="<?php echo $row['image'];?>" required><br>
      <label for="price">цена</label><br>
			<input type="text" id="price" name="price" value="<?php echo $row['price'];?>" required><br>

			<label for="long_desc">дълго описание</label><br>
			<textarea class="textareaupload" name="long_desc" id="long_desc"  wrap="hard" rows="10" cols="85"required><?php echo $row['long_desc'];?></textarea><br>
			<label for="short_desc">късо заглавие</label><br>
			<input type="text" id="short_desc" name="short_desc" value="<?php echo $row['short_desc'];?>" required><br>

			<label for="brand">марка</label><br>
			<input type="text" id="brand" name="brand" value="<?php echo $row['brand'];?>" required><br>

      <label for="category_id">ID главна категория</label><br>
			<input type="text" id="category_id" name="category_id" value="<?php echo $row['category_id'];?>" required><br>
      
			<label for="subcategory_id">ID под категория</label><br>
			<input type="text" id="subcategory_id" name="subcategory_id" value="<?php echo $row['subcategory_id'];?>" required><br>

			
			<br>
			<input class="submitedituser" id="submit" name="submit" type="submit" value="Apply Changes">
			<input type="button" onclick="window.location.href='productsoverview.php';" class="submitedituser" value="Go back"/>
      </form>
	
	</div>
	<?php
 }
}
if (isset($_POST["submit"])) {
	$id = $_POST['id'];
	$title = $_POST['title'];

	$image = $_POST['image'];
	$price = $_POST['price'];
	$long_desc = $_POST['long_desc'];
	$short_desc = $_POST['short_desc'];
	$brand = $_POST['brand'];
	$category_id = $_POST['category_id'];
	$subcategory_id = $_POST['subcategory_id'];
   
	// Update user information in the database
	$sql = "UPDATE images3 SET title = ?, image = ?, price = ?, long_desc = ?, short_desc = ?, brand = ?, category_id = ?, subcategory_id = ? WHERE id = ?";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "sssssssss", $title,$image,$price,$long_desc,$short_desc,$brand,$category_id,$subcategory_id,$id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
  }
	?>