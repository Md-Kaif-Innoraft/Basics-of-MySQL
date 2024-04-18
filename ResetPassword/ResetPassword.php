<?php

  // Token from Get request.
  $token = $_GET["token"];

  // Hash token.
  $token_hash = hash("sha256", $token);

  // Include vendor/autoload.php file.
  require '../vendor/autoload.php';

  // Include ConnectDb.php file for database connection.
  require '../DatabaseConnection/ConnectDb.php';

  // Sql query to fetch data where reset_token_hash matches.
  $sql = "SELECT * FROM userdata WHERE reset_token_hash = ?";

  // Prepare query.
  $stmt = $conn->prepare($sql);

  // Bind parameter.
  $stmt->bindParam(1, $token_hash, PDO::PARAM_STR);

  // Execute query.
  $stmt->execute();

  // Fetch data from table.
  $result = $stmt->fetchall();

  // Check if matching data exist in table.
  if($result === null) {
    die ("Token expired");
  }

  // Check for token expiry time.
  if (strtotime($result[0]['reset_token_exp']) <= time()) {
    die ("token has expired");
  }
  // Match token hash with token hash form table.
  if ($result[0]['reset_token_hash'] != $token_hash) {
    die ("token not found ");
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../css/style.css">
  <script src="../Script/index.js"></script>
</head>
<body>
  <div class="container">
    <div class="box">
      <form onsubmit="return cPass()" action="./UpdatePassword.php" method="post">
        <!--Ring div starts here.-->
        <div class="ring">
          <i style="--clr:#00ff0a;"></i>
          <i style="--clr:#ff0057;"></i>
          <i style="--clr:#fffd44;"></i>
          <div class="login">
            <h2>Reset Password</h2>
            <div class="inputBx">
              <input type="hidden" id= "token" name = "token" value = <?php echo htmlspecialchars($token); ?> >
            </div>
            <div class="inputBx">
              <input type="password" placeholder="New Password" id= "password" name = "password">
              <span class="error" id="passErr"></span>
            </div>
            <div class="inputBx">
              <input type="password" placeholder="Confirm Password" id= "confirmPass" name = "confirmPass">
              <span class="error" id="confPassErr"></span>
            </div>
            <div class="inputBx">
              <input type="submit" value="Reset Password">
            </div>
            <div class="error">
            </div>
            <div class="links">
              <a href="../index.php">Login</a>
            </div>
          </div>
        </div>
        <!--Ring div ends here.-->
      </form>
    </div>
  </div>
</body>
</html>
