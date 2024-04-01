/**
 * Regular expression for validation.
 */
const REGEXNAME = /^[a-zA-Z-' ]*$/;
const EMAILREGEX = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
const PASSREGEX = /^(?=.*[a-zA-Z])(?=.*[0-9])[a-zA-Z0-9]+$/

/**
 * Function to validate user input Name.
 *
 * @param string inputId
 *  Input id of user input field.
 * @param string errorId
 *  Error id of input field.
 * @param int maxLength
 *  Maximum length of input field.
 * @param const regex
 *  Regular expression to check input data.
 *
 * @return boolean
 *  Return true if user input in correct otherwise false.
 */
function validateName(inputId, errorId, maxLength, regex) {
  var input = document.getElementById(inputId).value.trim();
  var error = document.getElementById(errorId);
  // Check for empty input.
  if (input == "") {
    error.innerHTML = "* Name is required javaS.";
    return false;
  }
  // Check for input if pattern matches or not.
  else if (!regex.test(input)) {
    error.innerHTML = "* Invalid Input.";
    return false;
  }
  // Check for input length.
  else if (input.length >= maxLength) {
    error.innerHTML = "* Name should not contain more than " + maxLength + " characters.";
    return false;
  }
  return true;
}

/**
 * Function to validate user Password.
 *
 * @param string inputId
 *  Input id of user input field.
 * @param string errorId
 *  Error id of input field.
 * @param const regex
 *  Regular expression to check input data.
 *
 * @return boolean
 *  Return true if user input in correct otherwise false.
 */
function validatePassword(inputId, errorId, regex) {
  var input = document.getElementById(inputId).value.trim();
  var error = document.getElementById(errorId);
  // Check for empty input.
  if (input == "") {
    error.innerHTML = "* Password is required.";
    return false;
  }
  // Check for input if pattern matches or not.
  else if (!regex.test(input)) {
    error.innerHTML = "* Password must contains at least one letter and one number java.";
    return false;
  }
  // Check for input length.
  else if (input.length < 8) {
    error.innerHTML = "* password must contains atleast 8 characters.";
    return false;
  }
  return true;
}

/**
 * Function to validate user Confirm password field.
 *
 * @param string errorId
 *  Error id of input field.
 *
 * @return boolean
 *  Return true if user input in correct otherwise false.
 */
function validateConfPass(errorId) {
  var error = document.getElementById(errorId);
  var pass = document.getElementById("password").value.trim();
  var confPass = document.getElementById("confirmPass").value.trim();
  if (pass != confPass) {
    error.innerHTML = "* Password and Confirm Password must be same.";
    return false;
  }
  return true;
}

/**
 * Function to validate user email.
 *
 * @param string inputId
 *  Input id of user input field.
 * @param string errorId
 *  Error id of input field.
 *
 * @return boolean
 *  Return true if email validated successfully otherwise false.
 */
function validateEmail(inputId, errorId) {
  var input = document.getElementById(inputId).value.trim();
  var error = document.getElementById(errorId);
  // Check for empty input.
  if (input == "") {
    error.innerHTML = "* Email is required.<br>";
    return false;
    }
    // Using email Regex for email validation.
    else if (!EMAILREGEX.test(input)) {
      error.innerHTML = "* Invalid email format.";
      return false;
    }
    return true;
  }

/**
 * Validating user inputs on client side for signup page.
 *
 * @return boolean
 *  Return true if all the validation are true otherwise false.
 */
function signup() {
  var nameValid = validateName("name", "nErr", 20, REGEXNAME);
  var passValid = validatePassword("password", "passErr", PASSREGEX);
  var confPassValid = validateConfPass("confPassErr");
  var emailValid = validateEmail("email", "eErr");
  return nameValid && passValid && confPassValid && emailValid;
}

/**
 * Validating user inputs on client side for login page.
 *
 * @return boolean
 *  Return true if all the validation are true otherwise false.
 */
function login() {
  var emailValid = validateEmail("email", "eErr");
  var passValid = validatePassword("password", "passErr", PASSREGEX);
  return passValid && emailValid;
}

/**
 * Validating user inputs on client side for Confirm Password page.
 *
 * @return boolean
 *  Return true if all the validation are true otherwise false.
 */
function cPass() {
  var passValid = validatePassword("password", "passErr", PASSREGEX);
  var confPassValid = validateConfPass("confPassErr");
  return passValid && confPassValid;
}

/**
 * Validating user inputs on client side for forgot password page.
 *
 * @return boolean
 *  Return true if all the validation are true otherwise false.
 */
function forPass() {
 var emailValid = validateEmail("email", "eErr");
 return emailValid;
}
