<?php

// Include ForgotPassProcess.php file.
include './ForgotPassProcess.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forgot Password</title>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../Script/index.js"></script>
</head>
<body>
  <div class="container">
      <form onsubmit="return forPass()" action="" method="post">
      <!--Ring div starts here.-->
      <div class="ring">
        <i style="--clr:#00ff0a;"></i>
        <i style="--clr:#ff0057;"></i>
        <i style="--clr:#fffd44;"></i>
        <div class="login">
          <h2>Forgot Password</h2>
          <div class="inputBx">
            <span class="success"><?php echo $resetPassMsg; ?></span>
            <input type="email" required placeholder="Email" id= "email" name = "email" value ="<?php echo $_POST['email']; ?>">
            <span class="error" id="eErr"><?php echo $emailErr; ?></span>
            <span class="error"><?php echo $accErr; ?></span>
          </div>
          <div class="inputBx">
            <input type="submit" value="Send">
          </div>
          <div class="links">
          <a href="../SignUp/SignUp.php">Sign up</a>
          <a href="../index.php">Log in</a>
        </div>
        </div>
      </div>
      <!--Ring div ends here.-->
      </form>
  </div>
</body>
</html>
