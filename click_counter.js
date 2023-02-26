
let count = 0;
  const links = document.querySelectorAll(".product-link");
  
  links.forEach(link => {
    link.addEventListener("click", function() {
      count++;
      const url = link.href;
      const productId = getProductIdFromUrl(url);
      // Send the information to the server
      fetch("/api/clicks.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/x-www-form-urlencoded"
        },
        body: "id=" + productId + "&count=" + count
      })
      .then(response => response.json())
      .then(data => {
        console.log("Data was saved to the database: " + data);
      });
    });
  });
  function getProductIdFromUrl(url) {
    const params = new URLSearchParams(new URL(url).search);
    
    return params.get("id");
  }