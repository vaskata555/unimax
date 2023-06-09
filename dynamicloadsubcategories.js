$('#category-select').on('change', function() {
  var selectedOption = $(this).val();

  
    $.ajax({
      url: 'my_php_file.php',
      type: 'POST',
      data: {selected_category_id: '2'},
      success: function(response) {
        $('#response').html(response);
      },
      error: function(xhr, status, error) {
        console.error(error);
      }
    });
  }
);