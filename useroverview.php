<?php include('templates/header.php');
    
    
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
    <div id="content">
    <div class="adminuseroverview">
    <div class="firstadminpanel">
<?php
$sql = "SELECT * FROM users";

$result = mysqli_query($db, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<table class='firstadminpaneltable'>";
    echo "<tr><th>ID</th><th>Потребител</th><th>Имейл</th><th>Вид</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      
        echo "<tr>";
        echo "<td>" . $row['id'] . "</td>";
        echo "<td>" . $row['username'] . "</td>";
        echo "<td>" . $row['email'] . "</td>";
        echo"<td>" .  $row['type'] . "</td>";
        echo "<td><a href='edit_user.php?id=".$row['id']."'class='adminbutton''". "'>Промени</a> | <a href='delete.php?id=" . $row['id'] . "'>Изтрий</a></td>";
      
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
</div>
</div>