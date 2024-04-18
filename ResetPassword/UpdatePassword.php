<?php

// Check form is submitted with POST method or not.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Include FormValidation.php file.
  include "../Formvalidation/FormValidation.php";

  // Sanitizing user inputs by callig checkInput method.
  $pass = $fv->checkInput($_POST['password']);
  $confirmPass = $fv->checkInput($_POST['confirmPass']);

  // Validating user password by callig validatePassword method.
  $passErr = $fv->validatePassword($pass);
  // Validating user Confirm password by callig validateConfirmPass method.
  $confPassErr = $fv->validateConfirmPass($pass, $confirmPass);

  // Check for error.
  if ($passErr == "" && $confPassErr == "") {
    $token = $_POST["token"];
    $token_hash = hash("sha256", $token);

    // Include vendor/autoload.php file.
    require '../vendor/autoload.php';

    // Include ConnectDb.php for database connection.
    require '../DatabaseConnection/ConnectDb.php';

    // Sql Query to fetch data form table.
    $sql = "SELECT * FROM userdata WHERE reset_token_hash = ?";

    // Prepare query.
    $stmt = $conn->prepare($sql);

    // Bind parameters.
    $stmt->bindParam(1, $token_hash, PDO::PARAM_STR);

    // Execute query.
    $stmt->execute();

    // Fetch data from table.
    $result = $stmt->fetchall();
    if($result == null) {
      die ("Token expired");
    }

    // Check for token expiry time.
    if (strtotime($result[0]['reset_token_exp']) <= time()) {
      die ("token has expired ");
    }
    // Match token hash with token hash form table.
    if ($result[0]['reset_token_hash'] != $token_hash) {
      die ("token not found ");
    }

    // Hash Password.
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Sql Query to update data.
    $sql = "UPDATE userdata SET password = ?, reset_token_hash = NULL, reset_token_exp = NULL";

    // Prepare query.
    $stmt = $conn->prepare($sql);

    // Bind parameters.
    $stmt->bindParam(1, $password, PDO::PARAM_STR);

    try {
      $stmt->execute();
      header("location: ./UpdatePassSuccess.php");
    }
    //catch exception
    catch (PDOException $e) {
      echo "Error in updating password -> " .$e->getMessage();
    }
  }
  else {
    die ($passErr.' '. $confPassErr);
  }
}
