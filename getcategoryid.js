
  const categorySelect = document.getElementById('category-select');
  const subcategorySelect = document.getElementById('subcategory-select');
  const categoryChosenInput = document.querySelector('input[name="category-chosen"]');
  const categoryIdInput = document.querySelector('input[name="categoryid"]');
  const subcategoryChosenInput = document.querySelector('input[name="subcategory-chosen"]');
  const subcategoryIdInput = document.querySelector('input[name="subcategoryid"]');
  categorySelect.addEventListener('change', function() {
    const selectedOption = categorySelect.options[categorySelect.selectedIndex];
    const categoryChosen = selectedOption.value;
    const categoryId = selectedOption.getAttribute('categoryid');
    categoryChosenInput.value = categoryChosen;
    categoryIdInput.value = categoryId;
  });
  subcategorySelect.addEventListener('change', function() {
    const subselectedOption = subcategorySelect.options[subcategorySelect.selectedIndex];
    const subcategoryChosen = subselectedOption.value;
    const subcategoryId = subselectedOption.getAttribute('subcategoryid');
    subcategoryChosenInput.value = subcategoryChosen;
    subcategoryIdInput.value = subcategoryId;
  });
