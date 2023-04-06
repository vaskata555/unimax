
  var productSelect = document.getElementById('product-select');
  var warrantyDate = document.getElementById('warranty_date');

  productSelect.addEventListener("change", function() {
    var selectedOption = productSelect.options[productSelect.selectedIndex];
    warrantyDate.value = selectedOption.dataset.warranty;
  });
