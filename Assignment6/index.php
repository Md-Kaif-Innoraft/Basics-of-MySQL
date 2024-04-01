<?php

// Starting session.
session_start();
// Checking if the user is logged or not.
if ($_SESSION['isLogged'] != "TRUE") {
  header("location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Assignment 6</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <div class="box">
        <!-- form starts here -->
      <h2 class="text-center">PHP Assignment 6</h2><br><br>
      <form onsubmit = "return validate()" method="post" action="FormPdf.php" enctype = "multipart/form-data">
        <label for="fName"><span class="error">* </span> First Name : </label> <br>
        <input type="text" name="fName" id="fName" required maxlength = "20" pattern="[A-Za-z ]*">
        <span class = "error" id="ferror"><p><br></p> </span>

        <label for="lName"> <span class="error">* </span> Last Name : </label> <br>
        <input type="text" id="lName" name="lName" required  maxlength = "20" pattern="[A-Za-z ]*"> <br>
        <span class = "error" id="lerror"><p><br></p> </span>

        <label for="number"><span class="error">* </span> Phone number : </label> <br>
        <input type="text" id="number" name="number" required maxlength = "10" pattern="[0-9]*"> <br>
        <span class = "error" id="nerror"><p><br></p> </span>

        <label for="email"><span class="error">* </span> Email : </label> <br>
        <input type="email" id="email" name="email" required> <br>

        <label for="sub">Subjects and Marks : ( Format: English|80 )</label>
        <textarea name="sub" id="sub" rows="3"></textarea>
        <span class = "error" id="serror"><p><br></p> </span>

        <label for="image">Image : </label>
        <input class="file" type="file" name="image"><br><br>
        <input type=submit class="btn" name = "submit" value="submit"> <br> <br> <br>
      </form>
      <button class="btn btn-logout"><a href="../Logout/Logout.php">Log out</a></button>
      </div>
    </div>
    <script src="index.js"></script>
</body>
</html>
