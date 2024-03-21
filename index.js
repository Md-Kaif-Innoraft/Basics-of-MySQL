/**
 * Regex to match input with alphabets.
 */
const regexName = /^[a-zA-Z\s]+$/;

/**
 * Regex to match input with alphabets and underscore.
 */
const regexEmpCode = /^[a-zA-Z\s_]+$/;

/**
 * Regex to match input start with RU and can only have 3 chars.
 */
const regexEmpId = /^RU[a-zA-Z0-9]{3,}$/;

/**
 * Regex to match input with numbers and end with k.
 */
const regexEmpSalary = /^\d+k$/i;

/**
 * Regex to match input with numbers.
 */
const regexNum = /\b(0*(?:[1-9][0-9]?|100))\b/;

/**
 * Function to validate user input.
 *
 * @param string @inputId.
 *  Input id of user input field.
 * @param string @errorId.
 *  Error id of input field.
 * @param int @maxLength.
 *  Maximum length of input field.
 * @param const @regex.
 *  Regular expression to check input data.
 *
 * @return boolean.
 *  Return true if user input in correct otherwise false.
 */
function validateInput(inputId, errorId, regex, maxLength) {
  var input = document.getElementById(inputId).value.trim();
  var error = document.getElementById(errorId);
  if (!regex.test(input) || input == "") {
    error.innerHTML = "* Invalid Input frontend.";
    return false;
  }
  else if (input.length >= maxLength) {
    error.innerHTML = "* Maximum 20 characters allowed.";
    return false;
  }
  return true;
}

/**
 * Validating user inputs on client side.
 *
 * @return boolean.
 *  Return true if all the validation are true otherwise false.
 */
function validate() {
  var empCodeValid = validateInput("employee_code", "empCodeErr", regexEmpCode, 20);
  var empFnameValid = validateInput("employee_first_name", "empFnameErr", regexName, 20);
  var empLnameValid = validateInput("employee_last_name", "empLnameErr", regexName, 20);
  var empSalaryValid = validateInput("employee_salary", "empSalaryErr", regexEmpSalary, 20);
  var empIdValid = validateInput("employee_id", "empIdErr", regexEmpId, 20);
  var empCodeNameValid = validateInput("employee_code_name", "empCodeNameErr", regexEmpCode, 20);
  var empDomainValid = validateInput("employee_domain", "empDomainErr", regexName, 20);
  var empGpValid = validateInput("graduation_percentile", "empGpErr", regexNum, 20);

  // All validations passed, allow form submission other wise don't.
  return empCodeValid && empFnameValid && empLnameValid && empSalaryValid && empIdValid
   && empCodeNameValid && empDomainValid && empGpValid;
}

// Calling datatable function for desigining table.
$(document).ready(function() {
    $('.myTable').DataTable();
});
