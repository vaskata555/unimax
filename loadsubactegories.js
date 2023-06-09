function loadSubcategories() {
    const primaryCategorySelect = document.getElementById('primary-category-select');
    const subcategorySelect = document.getElementById('subcategory-select');
    
    // Clear existing options from the subcategory select element
    subcategorySelect.innerHTML = '';
    
    // Get the value of the selected primary category
    const primaryCategoryValue = primaryCategorySelect.value;
    
    // Create a new AJAX request
    const xhr = new XMLHttpRequest();
    
    // Set the URL and request method
    xhr.open('POST', 'get_subcategories.php', true);
    
    // Set the request header
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    
    // Define the response handler
    xhr.onreadystatechange = function() {
      if (xhr.readyState === 4 && xhr.status === 200) {
        // Parse the JSON response
        const subcategories = JSON.parse(xhr.responseText);
        
        // Add the retrieved subcategories to the subcategory select element
        subcategories.forEach(function(subcategory) {
          const option = document.createElement('option');
          option.text = subcategory.name;
          option.value = subcategory.id;
          subcategorySelect.add(option);
        });
      }
    };
    
    // Send the request with the selected primary category value
    xhr.send('category=' + encodeURIComponent(primaryCategoryValue));
  }