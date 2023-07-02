var productSelect = document.getElementById('product-select');
var warrantyDate = document.getElementById('warranty_date');
var orderid = document.getElementById('order_id');

productSelect.addEventListener("change", function() {
  var selectedOption = productSelect.options[productSelect.selectedIndex];
  warrantyDate.value = selectedOption.dataset.warranty;
  orderid.value = selectedOption.dataset.orderid;
  
});