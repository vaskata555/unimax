<?php 
 include('templates/header.php');
 include('templates/footer.php');
// Connect to database
 // Check connection
 if (!$db) {
    die("Connection failed: " . mysqli_connect_error());
}
$id = $_GET['id'];
$sql = "SELECT * FROM users1 WHERE id = $id";

$result = mysqli_query($db,$sql);

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

			<label for="username">Username:</label><br>
			<input type="hidden" id="id" name="id" value="<?php echo $row['id'];?>"><br>
			<input type="text" id="username" name="username" value="<?php echo $row['username'];?>"><br>

      <label for="email">Email:</label><br>
			<input type="email" id="email" name="email" value="<?php echo $row['email'];?>" required><br>

			<label for="first_name">First Name:</label><br>
			<input type="text" id="first_name" name="first_name" value="<?php echo $row['first_name'];?>" required><br>

			<label for="last_name">Last Name:</label><br>
			<input type="text" id="last_name" name="last_name" value="<?php echo $row['last_name'];?>" required><br>

			<label for="organization">Organization:</label><br>
			<input type="text" id="organization" name="organization" value="<?php echo $row['organization'];?>" required><br>

      <label for="phone_number">Phone Number:</label><br>
			<input type="text" id="phone_number" name="phone_number" value="<?php echo $row['phone_number'];?>" required><br>
      
			<label for="type">User Type:</label><br>
			<select class="selectedit" id="type" name="type" required>
				<option value="">Select a user type</option>
				<option value="admin">Admin</option>
				<option value="moderator">Moderator</option>
				<option value="user">User</option>
			</select><br>

			<input class="submitedit" id="submit" name="submit" type="submit" value="Apply Changes">
			
      </form>
	  <input type="button" onclick="window.location.href='admin_dashboard.php';" class="submitedit" value="Go to Dashboard"/>
	</div>
	<?php
 }
}
if (isset($_POST["submit"])) {
	$id = $_POST['id'];
	$email = $_POST['email'];
	$username = $_POST['username'];
	$organization = $_POST['organization'];
	$first_name = $_POST['first_name'];
	$last_name = $_POST['last_name'];
	$phone_number = $_POST['phone_number'];
   
	// Update user information in the database
	$sql = "UPDATE users1 SET username = '$username', email = '$email', organization = '$organization', first_name = '$first_name', last_name = '$last_name', phone_number = '$phone_number' WHERE id = '$id'";
	mysqli_query($db, $sql);
	
  }
	?>