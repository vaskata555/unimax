var option1 = document.getElementById('company');
var option2 = document.getElementById('person');
var input1 = document.getElementById('organization');
var input2 = document.getElementById('bulstat');

// Add event listener to the radio buttons
option1.addEventListener('change', function() {
    if (option1.checked) {
        input1.disabled = false;
        input2.disabled = false;
        input1.value = "";
        input2.required = true;
    }
});

option2.addEventListener('change', function() {
    if (option2.checked) {
        input1.disabled = true;
        input2.disabled = true;
        input2.required = false;
        input1.value = "ФИЗИЧЕСКО ЛИЦЕ";
    }
});