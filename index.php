<?php

  // Including formvalidation file.
  // require 'FormValidation.php';
  require 'SqlQueries.php';
  // Create object of SqlQueries class.
  $sql = new SqlQueries();
  $query1 = "select * from Matches";
  $query2 = "select * from Teams";

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sql assignment 1</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  </head>
  <body>

    <div class="container">
      <div class="box">
        <h1 class = "text-center" >Matches Table </h1>
        <!-- Display employee_code_table Data.-->
        <table class="table table-striped myTable table-hover" border = "1" >
        <thead>
          <tr class = "table-dark">
            <th scope="col">Match Id</th>
            <th scope="col">Venue</th>
            <th scope="col">Date</th>
            <th scope="col">Team1 Id</th>
            <th scope="col">Team2 Id</th>
            <th scope="col">Toss Won by</th>
            <th scope="col">Match Won By</th>
          </tr>
        </thead>
        <tbody>
          <!-- Loop though array to display data. -->
          <?php foreach ($sql->displayData($query1) as $row) { ?>
          <tr>
            <td><?php echo $row['match_id']; ?> </td>
            <td><?php echo $row['venue']; ?></td>
            <td><?php echo $row['date']; ?></td>
            <td><?php echo $row['team1_id']; ?> </td>
            <td><?php echo $row['team2_id']; ?></td>
            <td><?php echo $row['toss_won_by']; ?></td>
            <td><?php echo $row['match_won_by']; ?></td>
          </tr>
        <?php } ?>
        </tbody>
        </table>
        <hr>
      </div>

      <div class="box">
      <!-- Display employee_salary_table Data.-->
      <h1 class = "text-center" >Team Table </h1>
      <table class="table table-striped myTable table-hover" border = "1" >
      <thead>
        <tr class = "table-dark">
          <th scope="col">Team Id</th>
          <th scope="col">Team Name</th>
          <th scope="col">Captain</th>
        </tr>
      </thead>
      <tbody>
        <!-- Loop though array to display data. -->
        <?php foreach ($sql->displayData($query2) as $row) { ?>
        <tr>
          <td><?php echo $row['team_id']; ?> </td>
          <td><?php echo $row['team_name']; ?></td>
          <td><?php echo $row['captain']; ?></td>
        </tr>
      <?php } ?>
      </tbody>
      </table>
      <hr>
      </div>
    </div>
    <div class="container text-box">
      <h1 class= "text-center">Pros:</h1>
      <li><strong>Reduces data redundancy:</strong> <br>Team details like name and captain are stored only once in the Teams table,
      reducing redundancy and saving storage space.</li>
      <li><strong>Maintains data integrity:</strong> <br>
      Foreign key constraints ensure that only valid team IDs can be inserted into the Matches table, maintaining data integrity.</li>
      <br><hr>
      <h1 class= "text-center">Cons:</h1>
      <li><strong>Join operations required:</strong><br>Join operations required: To retrieve complete match information(including team names and captains),
      joins between the Matches and Teams tables are necessary, which may slightly impact query performance.</li>
      <li><strong> Additional complexity:</strong><br>Managing foreign key constraints and performing joins adds a layer of complexity to
      the database design and queries compared to denormalized structures.</li>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
  <script src="index.js"></script>
  </body>
</html>
