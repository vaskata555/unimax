var buttons = document.querySelectorAll(".timegetter");

// Loop through each button and add an event listener
for (var i = 0; i < buttons.length; i++) {
  buttons[i].addEventListener("click", function(){
    var buttonValue = this.value;
    var secondValue = this.getAttribute("data-second-value"); // Gets the value of the clicked button
    document.getElementById("selected_time").value = buttonValue; 
    document.getElementById("selected_tech").value = secondValue; // Sets the text box's value to the clicked button's value
  });
}