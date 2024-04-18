<?php

// Including processSignup.php file.
include './ProcessSignup.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Sign Up</title>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../Script/index.js"></script>
</head>
<body>
  <div class="container">
    <div class="box">
      <form onsubmit="return signup()" action="SignUp.php" method="post">
        <!--Ring div starts here.-->
        <div class="ring">
          <i style="--clr:#00ff0a;"></i>
          <i style="--clr:#ff0057;"></i>
          <i style="--clr:#fffd44;"></i>
          <div class="login">
            <h2>Sign up</h2>
            <div class="inputBx">
              <input type="text" required placeholder="Name" id= "name" name = "name" value ="<?php echo $_POST['name']; ?>">
              <span class="error" id="nErr"><?php echo $nameErr; ?></span>
            </div>
            <div class="inputBx">
              <input type="text" placeholder="Email" id= "email" name = "email" value ="<?php echo $_POST['email']; ?>">
              <span class="error"><?php echo $emailErr; ?></span>
              <span class="error" id="eErr"><?php echo $emailTaken; ?></span>
            </div>
            <div class="inputBx">
              <input type="password" placeholder="Password" id= "password" name = "password">
              <span class="error" id="passErr" ><?php echo $passErr; ?></span>
            </div>
            <div class="inputBx">
              <input type="password" placeholder="Confirm Password" id= "confirmPass" name = "confirmPass">
              <span class="error" id="confPassErr"><?php echo $confPassErr; ?></span>
            </div>
            <div class="inputBx">
              <input type="submit" value="Sign up">
            </div>
            <div class="links">
              <a href="../index.php">Log in</a>
            </div>
          </div>
        </div>
        <!--Ring div ends here.-->
      </form>
    </div>
  </div>
</body>
</html>
