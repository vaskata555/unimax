<?php 
 include('templates/header.php');
 if (isset($_POST["submit"])) {
	$id = $_POST['id'];
	$title = $_POST['title'];

	$image = $_POST['image'];
	$price = $_POST['price'];
	$long_desc = $_POST['long_desc'];
	$short_desc = $_POST['short_desc'];
	$brand = $_POST['brandupload'];
	$selected_subcategory_id = $_POST['subcategory-chosen'];
    $selected_category_id = $_POST['category-chosen'];
   
	// Update user information in the database
	$sql = "UPDATE products SET title = ?, image = ?, price = ?, long_desc = ?, short_desc = ?, brand_id = ?, category_id = ?, subcategory_id = ? WHERE id = ?";
	$stmt = mysqli_prepare($db, $sql);
	mysqli_stmt_bind_param($stmt, "sssssssss", $title,$image,$price,$long_desc,$short_desc,$brand, $selected_category_id,$selected_subcategory_id ,$id);
	mysqli_stmt_execute($stmt);
	$result = mysqli_stmt_get_result($stmt);
  }
// Connect to database
 // Check connection
 if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}

$id = $_GET['id'];
$sql = "SELECT * FROM products WHERE id = ?";
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
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src='getcategoryid.js' defer></script>
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
			<select name="brandupload" id="brandupload"  required><br>
    <option value=""disabled selected>Изберете марка</option>
    <?php $sqlbrand = "SELECT * FROM brands ";
    $resultbrand = mysqli_query($db,$sqlbrand);
    while ($rowbr = mysqli_fetch_assoc($resultbrand)) {
      ?> 
    <option value='<?php echo $rowbr['id']  ?>'> <?php echo $rowbr['brand'] ?> </option>
    <?php }?>
    </select>
			<?php $sql = "SELECT * FROM category ";
			$result = mysqli_query($db,$sql);

if(mysqli_num_rows($result)>0){
   
?> 
			<p>1.избери категория</p>
<select name='category-select' id='category-select' style="height: 20px"  >
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


<p>2.избери подкатегория</p>
<select name='category-select' id='subcategory-select' style="height: 20px"  >
<option value=""disabled selected>Изберете подкатегория</option>
</select>

<?php


  include("get_subcategories.php");



?>
      
			

			<br>
			<br>
			<input type='hidden' class='createcategorysubmit' id='primary-category' name='category-chosen' placeholder="категория" >
    
    <br>
    
    <input type='hidden' class='createcategorysubmit' id='sub-category' placeholder="подкатегория" name='subcategory-chosen' value="" >
			<input class="submitedituser" id="submit" name="submit" type="submit" value="Промени">
			
			<input type="button" onclick="window.location.href='productsoverview.php';" class="submitedituser" value="Върни се"/>
			</form>
	
	</div>
	</div>
	<?php
 }
}

	?>