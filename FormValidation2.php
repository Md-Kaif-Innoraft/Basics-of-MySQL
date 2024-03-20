<?php

  // Include SqlQueries file.
  require 'SqlQueries.php';
  // Create object of SqlQueries class.
  $sql = new SqlQueries();

  /**
   * @var string $queryEct.
   *  Sql Queries to display employee_code_table.
   */
  $queryEct = "SELECT * FROM `employee_code_table`";

  /**
   * @var string $queryEst.
   *  Sql Queries to display employee_salary_table.
   */
  $queryEst = "SELECT * FROM `employee_salary_table`";

  /**
   * @var string $queryEdt.
   *  Sql Queries to display employee_details_table.
   */
  $queryEdt = "SELECT * FROM `employee_details_table`";

  /**
   * @var string $waq1.
   *  Sql query to list all employee first name with salary greater than 50k.
   */
  $waq1 = "SELECT ed.employee_first_name, es.employee_salary FROM employee_salary_table AS es
  INNER JOIN employee_details_table AS ed ON es.employee_id = ed.employee_id WHERE employee_salary > '50000'";

  /**
   * @var string $waq2.
   *  Sql query to list all employee last name with graduation percentile greater than 70%.
   */
  $waq2 = "SELECT employee_last_name, Graduation_percentile FROM employee_details_table
  WHERE Graduation_percentile > '70';";

  /**
   * @var string $waq3.
   *  Sql query to list all employee code name with graduation percentile less than 70%.
   */
  $waq3 = "SELECT ec.employee_code_name, ed.Graduation_percentile FROM ((employee_code_table AS ec
  INNER JOIN employee_salary_table AS es ON ec.employee_code = es.employee_code)
  INNER JOIN employee_details_table AS ed ON es.employee_id = ed.employee_id)
  WHERE Graduation_percentile < '70'";

  /**
   * @var string $waq4.
   *  Sql query to list all employee’s full name that are not of domain Java.
   */
  $waq4 = "SELECT ed.employee_first_name, ed.employee_last_name, ec.employee_domain FROM ((employee_code_table AS ec
  INNER JOIN employee_salary_table AS es ON ec.employee_code = es.employee_code)
  INNER JOIN employee_details_table AS ed ON es.employee_id = ed.employee_id)
  WHERE employee_domain <> 'JAVA'";

  /**
   * @var string $waq5.
   *  Sql query to list all employee_domain with sum of it's salary.
   */
  $waq5 = "SELECT employee_domain, SUM(employee_salary) FROM employee_code_table AS ec
  INNER JOIN employee_salary_table AS es ON ec.employee_code = es.employee_code
  GROUP BY employee_domain";

  /**
   * @var string $waq6.
   *  Sql query to list all employee_domain with sum of it's salary with salary greater than 30k.
   */
  $waq6 = "SELECT employee_domain, SUM(employee_salary) FROM employee_code_table AS ec
  INNER JOIN employee_salary_table AS es ON ec.employee_code = es.employee_code
  WHERE employee_salary > '30k' GROUP BY employee_domain";

  /**
   * @var string $waq7.
   *  Sql query to list all employee id which has not been assigned employee code.
   */
  $waq7 = "SELECT employee_id FROM employee_salary_table WHERE employee_code is null";

  // Checking if any of the input fields is not empty otherwise will not insert the data.
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!empty($_POST['employee_code']) && !empty($_POST['employee_first_name']) && !empty($_POST['employee_last_name']) &&
    !empty($_POST['employee_id']) && !empty($_POST['employee_code_name']) && !empty($_POST['graduation_percentile']) &&
    !empty($_POST['employee_salary']) && !empty($_POST['employee_domain_name'])) {
      $empCode = $_POST['employee_code'];
      $empFname = $_POST['employee_first_name'];
      $empLname = $_POST['employee_last_name'];
      $empSalary = $_POST['employee_salary'];
      $empId = $_POST['employee_id'];
      $empCodeName = $_POST['employee_code_name'];
      $empDname = $_POST['employee_domain_name'];
      $empGp = $_POST['graduation_percentile'];

      // Sql query to insert data into employee_code_table.
      $qInsertEct = "INSERT INTO `employee_code_table` (`employee_code`, `employee_code_name`, `employee_domain`)
      VALUES ('$empCode', '$empCodeName', '$empDname')";

      // Sql query to insert data into employee_salary_table.
      $qInsertEst = "INSERT INTO `employee_salary_table` (`employee_id`, `employee_salary`, `employee_code`)
      VALUES ('$empId', '$empSalary', '$empCode')";
      // Sql query to insert data into employee_details_table.
      $qInsertEdt = "INSERT INTO `employee_details_table` (`employee_id`, `employee_first_name`, `employee_last_name`, `graduation_percentile`)
      VALUES ('$empId', '$empFname', '$empLname', '$empGp')";

      // Call insertData Function to insert data into Employee code table.
      $sql->insertData($qInsertEct);
      // Call insertData Function to insert data into Employee salary table.
      $sql->insertData($qInsertEst);
      // Call insertData Function to insert data into Employee details table.
      $sql->insertData($qInsertEdt);

    }

  }

?>
