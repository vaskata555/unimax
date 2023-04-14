function myFunction() {
  var x = document.getElementById("myTopnav");
  var y = document.querySelector(".dropdown-header");
  if (x.className === "topnav") {
    x.className += " responsive";
    
  } else {
    x.className = "topnav";
  }
  if (x.classList.contains("dropdown-header")) {
    x.classList.remove("responsive");
  } else {
    x.classList.add("responsive");
  }
}
