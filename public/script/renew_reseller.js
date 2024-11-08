// Validation for Pincode
function validatePincode(input) {
    var pincode = input.value;
    var errorP = input.nextElementSibling; // Get the <p> tag next to the input
    if (pincode && !pincode.match(/^[a-zA-Z0-9]{1,15}$/) || pincode.length > 15) {
        errorP.innerText = 'Pincode must contain letters and numbers only, with a maximum length of 15 characters.';
        errorP.style.color = 'red'; // Set color to red
        return false;
    }
    errorP.innerText = ''; // Clear error message
    return true;
}

// Hide Search Name if there value in Pin Code
function countChar(val) {
    var len = val.value.length;
    if (len > 0) {
        $("#search_name").hide();
        $("#or").hide();
    } else {
        $("#search_name").show();
        $("#or").show();
    }
}
// Hide Pin if there value in Search Name 
function countCharN(val) {
    var len = val.value.length;
    if (len > 0) {
        $("#search_pin").hide();
        $("#or").hide();
    } else {
        $("#search_pin").show();
        $("#or").show();
    }
}