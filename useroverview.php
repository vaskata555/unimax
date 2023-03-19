<?php include('templates/header.php');
     include('templates/footer.php');
    
    ?> 
   <div class="sidebar">
		<ul>
			<li><a href="#">Dashboard</a></li>
			<li><a href="useroverview.php">Users</a></li>
			<li><a href="productsoverview.php">Products</a></li>
			<li><a href="#">Orders</a></li>
		</ul>
	</div>
    <div id="content">
    <div class="firstadminpanel">
<?php
$sql = "SELECT * FROM users1";

$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<table class='1stadminpaneltable'>";
    echo "<tr><th>ID</th><th>Username</th><th>Email</th><th>type</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo"<td>" .  $row['type'] . "</td>";
        echo "<td><a href='edit_user.php?id=".$row['id']."'class='adminbutton''". "'>Edit</a> | <a href='delete.php?id=" . $row['id'] . "'>Delete</a></td>";
      
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No users found.";
}
  ?>
  
</div>
    <div>
    </div>
</div>