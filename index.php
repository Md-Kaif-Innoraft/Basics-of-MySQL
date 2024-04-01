<?php

// Start Session.
session_start();

// Check for user is logged in or not.
if ($_SESSION['isLogged'] == "TRUE") {
  header("location: ./Task/index.php");
}

// Including FormValidatin.php file.
include './Formvalidation/FormValidation.php';

$isValid = FALSE;
$emailErr = $passErr = $validMSg = "";

// Check for form is submitted or not.
if ($_SERVER["REQUEST_METHOD"] == "POST") {

  // Including vendor/autoload.php file.
  require ('vendor/autoload.php');

  // Include connectDb.php file.
  include './DatabaseConnection/ConnectDb.php';

  $email = $fv->checkInput($_POST['email']);
  $pass = $fv->checkInput($_POST['password']);

  $emailErr = $fv->validateEmail($email);
  $passErr = $fv->validatePassword($pass);

  // Checking error in email and password.
  if ($emailErr == "" && $passErr == "") {

    // Sql query.
    $sql = "SELECT * FROM userdata WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(1, $email, PDO::PARAM_STR);
    $stmt->execute();
    $result = $stmt->fetchall();

    // Check if record is present or not.
    if ($result) {
      // Verify password.
      if (password_verify($pass, $result[0]['password'])) {
        $isValid = TRUE;
        // Start session.
        session_start();
        // Set isLogged to TRUE.
        $_SESSION['isLogged'] = "TRUE";
        // Redirect to Assignment6/index.php.
        header("location:./Task/index.php");
        exit;
      }
    }

    // Check isValid.
    if (!$isValid) {
      $validMSg = "* Invalid Creadintials.";
    }
  }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="./css/style.css">
  <script src="./Script/index.js"></script>
</head>
<body>
  <div class="container">
    <div class="box">
      <form onsubmit="return login()" action="" method="post">
        <!--ring div starts here-->
      <div class="ring">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>
        <div class="login">
          <h2>Login</h2>
          <div class="inputBx">
            <input type="email" required placeholder="Email" id= "email" name = "email" value = "<?php echo $_POST['email']; ?>">
            <span class="error" id = "eErr"><?php echo $emailErr; ?></span>
          </div>
          <div class="inputBx">
            <input type="password" required placeholder="Password" id= "password" name = "password">
            <span class="error" id = "passErr"><?php echo $passErr; ?></span>
          </div>
          <div class="inputBx">
            <input type="submit" value="Log in">
          </div>
          <div class="error">
            <?php echo $validMSg; ?>
          </div>
          <div class="links">
            <a href="./ResetPassword/ForgotPass.php">Forget Password</a>
            <a href="./SignUp/SignUp.php">Signup</a>
          </div>
        </div>
      </div>
      <!--ring div ends here-->
      </form>
    </div>
  </div>
</body>
</html>
