<?php

// Including FormValidation.php file for validating inputs.
include '../Formvalidation/FormValidation.php';

$emailErr = $accErr = $resetPassMsg = "";

// Checking if form is submitted or not.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $fv->checkInput($_POST["email"]);
  $emailErr = $fv->validateEmail($email);
  // Check if error is empty.
  if ($emailErr == "") {
    // Generating random bytes.
    $token = bin2hex(random_bytes(16));

    // Hashing token.
    $token_hash = hash("sha256", $token);

    // Set expiry date.
    $expiry = date("y-m-d H:i:s",time() + 60 * 30);

    // Include vendor/autoload.php file.
    require ('../vendor/autoload.php');

    // Include ConnectDb.php file for database connection.
    require '../DatabaseConnection/ConnectDb.php';

    // Sql query to update reset_token_hash and reset_token_exp.
    $sql = "UPDATE userdata SET reset_token_hash = ?, reset_token_exp = ?
    WHERE email = ?";

    // Preparing query.
    $stmt = $conn->prepare($sql);

    // Binding parameters for query.
    $stmt->bindParam(1, $token_hash, PDO::PARAM_STR);
    $stmt->bindParam(2, $expiry, PDO::PARAM_STR);
    $stmt->bindParam(3, $email, PDO::PARAM_STR);

    try {
      // Excuting query.
      $stmt->execute();
      // Count rows of table.
      $row = $stmt->rowCount();
      // Check if row exist.
      if ($row != null) {
        // Include SendMail.php file to send mail for password reset.
        include './SendMail.php';
      }
      else {
        $accErr = "* You don't have an account.";
      }
    }
    // Catch exception.
    catch (PDOException $e) {
      $accErr = "Invalid Request, Please try again later.";
    }
  }
}
