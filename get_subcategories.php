<?php require_once 'templates/dbConfig.php';

 mysqli_set_charset($db, "utf8");
 ?>
<?php
if (isset($_POST['selected_category_id'])) {
  $selected_category_id = $_POST['selected_category_id'];

  $stmt = $db->prepare("SELECT subcategory.id, subcategory.subcategory_name
      FROM subcategory
      JOIN category_subcategory ON subcategory.id = category_subcategory.subcategory_id
      WHERE category_subcategory.category_id = ?");
  $stmt->bind_param("i", $selected_category_id);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result) {
      $subcategories = array();
      while ($row = $result->fetch_assoc()) {
          $subcategory = array(
              'id' => $row['id'],
              'name' => $row['subcategory_name']
          );
          array_push($subcategories, $subcategory);
      }
      echo "<select id='subcategory-select'>";
      echo "<option value='' disabled selected>Изберете подкатегория</option>";
      foreach ($subcategories as $subcategory) {
          echo "<option value='" . $subcategory['id'] . "'>" . $subcategory['name'] . "</option>";
      }
      echo "</select>";
  } else {
      echo "Error executing query: " . mysqli_error($db);
  }
}
?>