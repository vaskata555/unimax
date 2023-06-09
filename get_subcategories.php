<?php require_once 'templates/dbConfig.php';
 header('Content-Type: text/html; charset=utf-8');
 mysqli_set_charset($db, "utf8");
 ?>
<?php
if (isset($_POST['selected_category_id'])) {
  $selected_category_id = $_POST['selected_category_id'];
echo $selected_category_id;
$stmt = $db->prepare("SELECT subcategory.id, subcategory.subcategory_name
    FROM subcategory
    JOIN category_subcategory ON subcategory.id = category_subcategory.subcategory_id
    WHERE category_subcategory.category_id = ?");
  $stmt->bind_param("i", $selected_category_id);
  $stmt->execute();
  $result1 = $stmt->get_result();
 
if ($result1) {
    $subcategories = array();
    while ($row = mysqli_fetch_assoc($result1)) {
      $subcategory = array(
        'id' => $row['id'],
        'name' => $row['subcategory_name']
      );
      array_push($subcategories, $subcategory);
    }
    echo "<select id='subcategory-select'>";
    echo "<option value=''disabled selected>" . "Изберете категория" . "</option>";
    foreach ($subcategories as $subcategory) {
      echo "<option value='" . $subcategory['id'] . "'>" . $subcategory['name'] . "</option>";
    }
    echo "</select>";
   
  } else {
    echo "Error executing query: " . mysqli_error($db);
  }
 
}
  ?>