<?php include('templates/header.php');
  
    
    ?> 
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<?php  $result = mysqli_query($db, "SELECT DISTINCT MAX(price) AS max_price  FROM products;");
        $row = mysqli_fetch_assoc($result);
        $maxPrice = $row['max_price']; ?>
<script src="js/bootstrap.min.js"></script>
<div class="product-page-wrapper">
<div class="filterbox">
    <div class="priceslider">
    <h3>Цена в лева:</h3>
                    <input type="hidden" id="min_price_hide" value="0" />
                    <input type="hidden" id="max_price_hide" value="<?php echo $maxPrice; ?> " />
                    <p id="price_show">1 - <?php echo $maxPrice; ?> </p>
                    <div id="price_range" style="width:10vw"></div>
                </div>
                <br>
    <div id="categories">
        <label for="category">Категория</label>
        <?php
        $categories = array();

        $result = mysqli_query($db, "SELECT DISTINCT products.id,products.image,products.short_desc,products.price,products.category_id,category.category_name FROM products 
    JOIN category ON category.id = products.category_id 
    group by products.category_id asc");
        while ($row = mysqli_fetch_assoc($result)) {
            $categories[$row['category_id']] = $row['category_name'];
            
        }
      
        foreach ($categories as $id => $name)  {
            echo "<div class='category'><input type='checkbox' id='categories'class='category_checkbox' value=". $id .">";
            echo '<label for="' . $id . '">' . $name . '</label></div>';
        }
        ?>
    </div>
    <br>
    <div id="brands">
        <label for="brand">Марка</label>
        <?php
      $brands = array();

      $result = mysqli_query($db, "SELECT Distinct p.brand_id, b.id, b.brand 
                             FROM products AS p
                             JOIN brands AS b 
                             ON p.brand_id = b.id");
      
      while ($row = mysqli_fetch_assoc($result)) {
          $brands [$row['id']] = $row['brand'];
      }

        foreach ($brands as $id => $brand)  {
            echo "<div class='brand'><input type='checkbox' id='brands'class='brand_checkbox' value=". $id .">";
            echo '<label for="' . $id . '">' . $brand . '</label></div>';
        }

      
        ?>
        
    </div>
    </div>
<script>
         function filterProducts() {
        var action = 'fetch_data';
        var priceMin = $("#min_price_hide").val();
        var priceMax = $("#max_price_hide").val();
        var selectedCategories = [];
        var brands = [];

$(".category_checkbox:checked").each(function () {
    selectedCategories.push($(this).val());
});
$(".brand_checkbox:checked").each(function () {
   brands.push($(this).val());
});

$.ajax({
    url: "filter_data.php",
    type: "POST",
    data: {
        action: action,
    priceMin: priceMin,
    priceMax: priceMax,
    categories: selectedCategories,
    brands: brands

    },
    success: function (response) {
        $('#results').html(response);
    }
});
}

$(document).ready(function () {
filterProducts();

$('#price_range').slider({
    range: true,
    min: 1,
    max: <?php echo $maxPrice; ?>,
    values: [1, <?php echo $maxPrice; ?>],
    step: 1,
    stop: function (event, ui) {
        $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
        $('#min_price_hide').val(ui.values[0]);
        $('#max_price_hide').val(ui.values[1]);
        filterProducts();
    }
});
$(".brand_checkbox").change(function () {
    filterProducts();
});
// Handle category checkbox change
$(".category_checkbox").change(function () {
    filterProducts();
});
});
</script>

<div class="container1products ">

     <div class="filter_results" id="results">
    </div></div></div></div>
    <?php    include('templates/footer.php'); ?>