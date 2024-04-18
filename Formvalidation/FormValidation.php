<?php

/**
 * Class FormVAlidation for the validation of form inputs.
 */
class FormValidation {

  /**
   * Regular expression for validation.
   */
  const REGEXNAME = "/^[a-zA-Z-' ]*$/";
  const REGEXALPHA = "/[a-z]/i";
  const REGEXNUM = "/[0-9]/i";

  /**
   * Function to check and sanitize user inputs.
   *
   * @param string $data.
   *
   * @return string.
   *  Return data after sanitize.
   */
  public function checkInput(string $data): string {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  /**
   * Function to validate user Name.
   *
   * @param string $name
   *  Name from user input.
   *
   * @return string.
   *  Return error message upon wrong validation otherwise empty string.
   */
  public function validateName(string $name): string {
    // Check for input if pattern matches or not.
    if (!preg_match(self::REGEXNAME, $name)) {
      return "* Name must contins only alphabets.";
    }
    // Check for length of input.
    if (strlen($name) < 1 || strlen($name) >= 20 ) {
      return "* Name should be greater than 1 less than 20 characters.";
    }
    return "";
  }

  /**
   * Function to validate user Password.
   *
   * @param string $pass
   *  Password from user input.
   *
   * @return string
   *  Return error message upon wrong validation otherwise empty string.
   */
  public function validatePassword(string $pass): string {
    // Check for input if pattern matches or not.
    if (!preg_match(self::REGEXALPHA, $pass) || !preg_match(self::REGEXNUM, $pass)) {
      return "* Password must contains at least one letter and one number.";
    }
    // Check for input length.
    if (strlen($pass) < 8) {
      return "* password must contains atleast 8 characters.";
    }
    return "";
  }

  /**
   * Function to validate user confirm Password.
   *
   * @param string $pass
   *  Password from user input.
   * @param string $conPass
   *  Password from confirm password field.
   *
   * @return string
   *  Return error message upon wrong validation otherwise empty string.
   */
  public function validateConfirmPass(string $pass, string $conPass): string {
    // Check if password and confirm password field are same or not.
    if ($pass != $conPass) {
      return "* Password and confirm password must be same.";
    }
    return "";
  }

  /**
   * Function to validate user email.
   *
   * @param string $email
   *  email id from user input.
   *
   * @return string
   *  Return error message upon wrong validation otherwise empty string.
   */
  public function validateEmail($email): string {
    // Check for email if pattern matches or not.
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      return "* Invalid email format";
    }
    return "";
  }

}

// Create object of FormValidation class.
$fv = new FormValidation();
