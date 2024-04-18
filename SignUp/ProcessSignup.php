<?php

// Include FormValidation.php file.
include '../Formvalidation/FormValidation.php';

$nameErr = $emailErr = $passErr= $confPassErr = $emailTaken = "";

// Check if form is submitted.
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $fv->checkInput($_POST['name']);
  $email = $fv->checkInput($_POST['email']);
  $pass = $fv->checkInput($_POST['password']);
  $confirmPass = $fv->checkInput($_POST['confirmPass']);

  $nameErr = $fv->validateName($name);
  $emailErr = $fv->validateEmail($email);
  $passErr = $fv->validatePassword($pass);
  $confPassErr = $fv->validateConfirmPass($pass, $confirmPass);

  // Check if there is not any error in name, email, password and confirm password fields.
  if ($nameErr == "" && $emailErr == "" && $passErr == "" && $confPassErr == "") {

    // Include vendor/autoload.php file.
    require ('../vendor/autoload.php');

    // Include ConnectDb.php file for database connection.
    include '../DatabaseConnection/ConnectDb.php';

    // Hashing password.
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Sql query.
    $sql = "INSERT INTO userdata (name, email, password) VALUES (?,?,?)";
    $stmt = $conn->prepare($sql);

    $stmt->bindParam(1, $name, PDO::PARAM_STR);
    $stmt->bindParam(2, $email, PDO::PARAM_STR);
    $stmt->bindParam(3, $password, PDO::PARAM_STR);

    try {
      $stmt->execute();
      header("location: SignUpSuccess.php");
      exit;
    }
    //catch exception
    catch (PDOException $e) {
      // Check if email alredy exist in database.
      if ($e->errorInfo[1] === 1062) {
        $emailTaken = "* Email Alredy Registered";
      }
      else {
        $emailTaken = "Error in Creating user.";
      }
    }
  }

}
