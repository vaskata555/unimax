<?php
// filter_data.php
include('templates/dbConfig.php');
if (isset($_POST["action"])) {
    $query = "SELECT DISTINCT * FROM images3";
}
// Retrieve the filter parameters from the AJAX request

$priceMin = $_POST['priceMin'];
$priceMax = $_POST['priceMax'];

if (isset($_POST["categories"])) {
    $selectedCategories = $_POST['categories'];
}
if (isset($_POST["brands"])) {
    $brands = $_POST['brands'];
   
}

// Prepare the query to filter products based on price and categories
$whereClause = "";
$whereClause1 = "";
$bindTypes = "";

$bindParams = array();
$bindParams1 = array();
// Add the price filter condition
if (!empty($priceMin) && !empty($priceMax)) {
    $whereClause .= " WHERE price BETWEEN ? AND ?";
    $bindTypes .= "ii";
    $bindParams[] = $priceMin;
    $bindParams[] = $priceMax;
}

// Add the category filter condition if selectedCategories is not empty
if (!empty($selectedCategories)) {
    $categoryParams = array_fill(0, count($selectedCategories), '?');
    $categoryParams = implode(',', $categoryParams);
    $whereClause .= ($whereClause === "") ? " WHERE" : " AND";
    $whereClause .= " category_id IN ($categoryParams)";
    $bindTypes .= str_repeat('s', count($selectedCategories));
    $bindParams = array_merge($bindParams, $selectedCategories);
}
if (!empty($brands)) {
    $brandParams = array_fill(0, count($brands), '?');
    $brandParams = implode(',',  $brandParams);
    $whereClause .= ($whereClause === "") ? " WHERE" : " AND";
    $whereClause .= " brand IN ($brandParams)";
    $bindTypes .= str_repeat('s', count($brands));
    $bindParams = array_merge($bindParams, $brands);
}
// Append the where clause to the query if necessary
if (!empty($whereClause)) {
    $query .= $whereClause;
}

// Prepare and execute the query
$stmt = mysqli_prepare($db, $query);
if ($stmt) {
    if (!empty($bindParams)) {
        mysqli_stmt_bind_param($stmt, $bindTypes, ...$bindParams);
    }
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    // Generate HTML for the filtered products
    $html = '';
    if (mysqli_stmt_errno($stmt)) {
        echo "Query execution failed: " . mysqli_stmt_error($stmt);
    }
    while ($row = mysqli_fetch_assoc($result)) {
        $image_unescaped = $row['image'];
        $image_escaped = str_replace("/", "\\", $image_unescaped);

        $html .= '<div class="itemproducts">';
        $html .= '  <a href="product.php?id=' . $row['id'] . '" class="product-link">';
        $html .= '    <img class="imagebd" src="' . $image_escaped . '" />';
        $html .= '    <div class="overlay">';
        $html .= '      <div class="textproducts">' . $row['short_desc'] . '</div>';
        $html .= '    </div>';
        $html .= '  </a>';
        $html .= '</div>';
        
    }

    // If no products found, display a message
    if (empty($html)) {
        $html = '<p>No products found.</p>';
    }

    // Send the generated HTML back as the response
    echo $html;

    // Close the statement
    mysqli_stmt_close($stmt);
} else {
    // Handle the case when the statement preparation fails
    echo "Error: Failed to prepare the statement.";
}

// Close the database connection
mysqli_close($db);