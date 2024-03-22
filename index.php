<?php

  // Including formvalidation file.
  require 'FormValidation.php';

?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>sql assignment 2</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="//cdn.datatables.net/2.0.2/css/dataTables.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
  </head>
  <body>
    <div class="container my-4 form-box">
    <!-- Form to take user input and insert into table. -->
      <form onsubmit = "return validate()" method = "post" action="<?php echo htmlspecialchars($_SERVER["SELF_PHP"]); ?>">
        <h1>Enter Employee Details</h1>

        <div class="mb-3 my-4">
          <label for="employee_first_name" class="form-label">Employee First Name <span class="error" id="empFnameErr">*<?php echo $formval->getEmpFnameErr(); ?></span></label>
          <input type="text" required pattern="^[a-zA-Z\s]+$" class="form-control" id="employee_first_name" name = "employee_first_name" value = "<?php echo $_POST['employee_first_name']; ?>">
          <div id="emailHelp" class="form-text">Example: John</div>
        </div>

        <div class="mb-3">
          <label for="employee_last_name" class="form-label">Employee Last Name <span class="error" id="empLnameErr">*<?php echo $formval->getEmpLnameErr(); ?></span></label>
          <input type="text" required pattern="^[a-zA-Z\s]+$" class="form-control" id="employee_last_name" name = "employee_last_name" value = "<?php echo $_POST['employee_last_name']; ?>">
          <div id="emailHelp" class="form-text">Example: Snow</div>
        </div>

        <div class="mb-3">
          <label for="employee_id" class="form-label">Employee Id <span class="error" id="empIdErr">*<?php echo $formval->getEmpIdErr(); ?></span></label>
          <input type="text" required pattern="^RU[a-zA-Z0-9]{3,}$" class="form-control" id="employee_id" name = "employee_id" value = "<?php echo $_POST['employee_id']; ?>">
          <div id="emailHelp" class="form-text">Example: RU122</div>
        </div>

        <div class="mb-3">
          <label for="employee_code" class="form-label">Employee Code <span class="error" id="empCodeErr">*<?php echo $formval->getEmpCodeErr(); ?></span></label>
          <input type="text" required pattern ="^[a-zA-Z\s_]+$" class="form-control" id="employee_code" name = "employee_code" value = "<?php echo $_POST['employee_code']; ?>">
          <div id="emailHelp" class="form-text">Example: su_john</div>
        </div>

        <div class="mb-3">
          <label for="employee_code_name" class="form-label">Employee Code Name <span class="error" id="empCodeNameErr">*<?php echo $formval->getEmpCodeNameErr(); ?></span></label>
          <input type="text" required pattern ="^[a-zA-Z\s_]+$" class="form-control" id="employee_code_name" name = "employee_code_name" value = "<?php echo $_POST['employee_code_name']; ?>">
          <div id="emailHelp" class="form-text">Example: ru_John</div>
        </div>

        <div class="mb-3">
          <label for="employee_domain" class="form-label">Employee Domain Name <span class="error" id="empDomainErr">*<?php echo $formval->getEmpDomainErr(); ?></span></label>
          <input type="text" required pattern="^[a-zA-Z\s]+$" class="form-control" id="employee_domain" name = "employee_domain" value = "<?php echo $_POST['employee_domain']; ?>">
          <div id="emailHelp" class="form-text">Example: Java</div>
        </div>

        <div class="mb-3">
          <label for="graduation_percentile" class="form-label">Employee Percentile <span class="error" id="empGpErr">*<?php echo $formval->getEmpGpErr(); ?></span></label>
          <input type="text" required pattern="\b(0*(?:[1-9][0-9]?|100))\b" class="form-control" id="graduation_percentile" name = "graduation_percentile" value = "<?php echo $_POST['graduation_percentile']; ?>">
          <div id="emailHelp" class="form-text">Example: 60 (Don't enter %)</div>
        </div>

        <div class="mb-3">
          <label for="employee_salary" class="form-label">Employee Salary <span class="error" id ="empSalaryErr">*<?php echo $formval->getEmpSalaryErr(); ?></span></label>
          <input type="text" required pattern="\d+k" class="form-control" id="employee_salary" name = "employee_salary" value = "<?php echo $_POST['employee_salary']; ?>">
          <div id="emailHelp" class="form-text">Example: 60k</div>
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
      </form>
    </div>

    <div class="container">
      <div class="box">
        <div class="table-heading">
          <hr>
          <h1 class = "text-center" >Employee Tables </h1>
        </div>
      <!-- Display employee_code_table Data.-->
      <table class="table table-striped myTable table-hover" border = "1" >
      <thead>
        <tr class="table-dark">
          <th colspan="3">employee_code_table</th>
        </tr>
        <tr>
          <th scope="col">employee_code</th>
          <th scope="col">employee_code_name</th>
          <th scope="col">employee_domain</th>
        </tr>
      </thead>
      <tbody>
        <!-- Loop though array to display data. -->
        <?php foreach ($sql->displayData($queryEct) as $row) { ?>
        <tr>
          <td><?php echo $row['employee_code']; ?> </td>
          <td><?php echo $row['employee_code_name']; ?></td>
          <td><?php echo $row['employee_domain']; ?></td>
        </tr>
      <?php } ?>
      </tbody>
      </table>
      <hr>
      </div>

      <div class="box">
      <!-- Display employee_salary_table Data.-->
      <table class="table table-striped myTable table-hover" border = "1" >
      <thead>
        <tr class="table-dark">
          <th colspan="3">employee_salary_table</th>
        </tr>
        <tr>
          <th scope="col">employee_id</th>
          <th scope="col">employee_salary</th>
          <th scope="col">employee_code</th>
        </tr>
      </thead>
      <tbody>
        <!-- Loop though array to display data. -->
        <?php foreach ($sql->displayData($queryEst) as $row) { ?>
        <tr>
          <td><?php echo $row['employee_id']; ?> </td>
          <td><?php echo $row['employee_salary']; ?></td>
          <td><?php echo $row['employee_code']; ?></td>
        </tr>
      <?php } ?>
      </tbody>
      </table>
      <hr>
      </div>

      <div class="box">
      <!-- Display employee_salary_table Data.-->
      <table class="table table-striped myTable table-hover" border = "1" >
      <thead>
        <tr class="table-dark">
          <th colspan="4">employee_details_table</th>
        </tr>
        <tr>
          <th scope="col">employee_id</th>
          <th scope="col">employee_first_name</th>
          <th scope="col">employee_last_name</th>
          <th scope="col">Graduation_percentile</th>
        </tr>
      </thead>
      <tbody>
        <!-- Loop though array to display data. -->
        <?php foreach ($sql->displayData($queryEdt) as $row) { ?>
        <tr>
          <td><?php echo $row['employee_id']; ?> </td>
          <td><?php echo $row['employee_first_name']; ?></td>
          <td><?php echo $row['employee_last_name']; ?></td>
          <td><?php echo $row['Graduation_percentile']; ?>% </td>
        </tr>
      <?php } ?>
      </tbody>
      </table>
      </div>
    </div>
    <!-- Accordian to display queries data. -->
    <div class="container">
      <h1 class = "text-center" >Queries Result </h1>
      <div class="accord my-5">
        <div class="accordion" id="accordionExample">
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingOne">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                <li>WAQ to list all employee first name with salary greater than 50k.</li>
              </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-striped my-4" border = "1" >
                <thead>
                  <tr>
                    <th colspan="3">Employee First name with salary greater than 50K.</th>
                  </tr>
                  <tr>
                    <th scope="col">employee_first_name</th>
                    <th scope="col">employee_salary</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop though array to display data. -->
                  <?php foreach ($sql->displayData($waq1) as $row) { ?>
                  <tr>
                    <td><?php echo $row['employee_first_name']; ?> </td>
                    <td><?php echo $row['employee_salary']; ?></td>
                  </tr>
                <?php } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <li>WAQ to list all employee last name with graduation percentile greater than 70%.</li>
              </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-striped my-4" border = "1" >
                <thead>
                  <tr>
                    <th colspan="3">Employee Last name with Graduation percentile greater than 70%.</th>
                  </tr>
                  <tr>
                    <th scope="col">employee_last_name</th>
                    <th scope="col">Graduation_percentile</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop though array to display data. -->
                  <?php foreach ($sql->displayData($waq2) as $row) { ?>
                  <tr>
                    <td><?php echo $row['employee_last_name']; ?> </td>
                    <td><?php echo $row['Graduation_percentile']; ?>% </td>
                  </tr>
                <?php } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingThree">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <li>WAQ to list all employee code name with graduation percentile less than 70%.</li>
              </button>
            </h2>
            <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-striped my-4" border = "1" >
                <thead>
                  <tr>
                    <th colspan="3">Employee Code name with Graduation percentile less than 70%.</th>
                  </tr>
                  <tr>
                    <th scope="col">employee_code_name</th>
                    <th scope="col">Graduation_percentile</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop though array to display data. -->
                  <?php foreach ($sql->displayData($waq3) as $row) { ?>
                  <tr>
                    <td><?php echo $row['employee_code_name']; ?> </td>
                    <td><?php echo $row['Graduation_percentile']; ?>%</td>
                  </tr>
                <?php } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFour">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <li>WAQ to list all employee’s full name that are not of domain Java.</li>
              </button>
            </h2>
            <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-striped my-4" border = "1" >
                <thead>
                  <tr>
                    <th colspan="3">Employee Code name with Graduation percentile less than 70%.</th>
                  </tr>
                  <tr>
                    <th scope="col">employee_full_name</th>
                    <th scope="col">employee_domain</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop though array to display data. -->
                  <?php foreach ($sql->displayData($waq4) as $row) { ?>
                  <tr>
                    <td><?php echo $row['employee_first_name'].' '.$row['employee_last_name']; ?> </td>
                    <td><?php echo $row['employee_domain']; ?></td>
                  </tr>
                <?php } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingFive">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                <li>WAQ to list all employee_domain with sum of it's salary.</li>
              </button>
            </h2>
            <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-striped my-4" border = "1" >
                <thead>
                  <tr>
                    <th colspan="3">employee_domain with sum of it's salary.</th>
                  </tr>
                  <tr>
                    <th scope="col">employee_domain</th>
                    <th scope="col">sum_of_salary</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop though array to display data. -->
                  <?php foreach ($sql->displayData($waq5) as $row) { ?>
                  <tr>
                    <td><?php echo $row['employee_domain']; ?> </td>
                    <td><?php echo $row['SUM(employee_salary)']; ?>k</td>
                  </tr>
                <?php } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingSix">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                <li>Write the above query again but dont include salaries which is less than 30k.</li>
              </button>
            </h2>
            <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-striped my-4" border = "1" >
                <thead>
                  <tr>
                    <th colspan="3">employee_domain with sum of it's salary where salary is greater than 30k.</th>
                  </tr>
                  <tr>
                    <th scope="col">employee_domain</th>
                    <th scope="col">sum_of_salary</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop though array to display data. -->
                  <?php foreach ($sql->displayData($waq6) as $row) { ?>
                  <tr>
                    <td><?php echo $row['employee_domain']; ?> </td>
                    <td><?php echo $row['SUM(employee_salary)']; ?>k</td>
                  </tr>
                <?php } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="accordion-item">
            <h2 class="accordion-header" id="headingSeven">
              <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
                <li>WAQ to list all employee id which has not been assigned employee code.</li>
              </button>
            </h2>
            <div id="collapseSeven" class="accordion-collapse collapse" aria-labelledby="headingSeven" data-bs-parent="#accordionExample">
              <div class="accordion-body">
                <table class="table table-striped my-4" border = "1" >
                <thead>
                  <tr>
                    <th colspan="3">Employee id which has not been assigned employee code.</th>
                  </tr>
                  <tr>
                    <th scope="col">employee_id</th>
                  </tr>
                </thead>
                <tbody>
                  <!-- Loop though array to display data. -->
                  <?php foreach ($sql->displayData($waq7) as $row) { ?>
                  <tr>
                    <td><?php echo $row['employee_id']; ?> </td>
                  </tr>
                <?php } ?>
                </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/2.0.2/js/dataTables.min.js"></script>
  <script src="index.js"></script>
  </body>
</html>
