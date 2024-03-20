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

  class FormValidation {
    const regexName = "/^[a-zA-Z\s]+$/";
    const regesEmpCode = "/^[a-zA-Z\s_]+$/";
    const regexEmpId = "/^RU[a-zA-Z0-9]{3,}$/";
    const regexNum = "[0-9]";
    private $empCode;
    private $empFname;
    private $empLname;
    private $empSalary;
    private $empId;
    private $empCodeName;
    private $empDname;
    private $empGp;

    function __construct() {
      $this->empCode = "";
      $this->empFname = "";
      $this->empLname = "";
      $this->empSalary = "";
      $this->empId = "";
      $this->empCodeName = "";
      $this->empDname = "";
      $this->empGp = "";
    }

    /**
     * Function to check and sanitize user inputs.
     *
     * @param string $data.
     *
     * @return string.
     *  retun data afer sanitize.
     */
    public function checkInput(string $data): string {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    /**
     * Function to validate user inputs.
     *
     * @param string $input.
     *  Name from user input.
     * @param string $error.
     *  Error for updating error.
     * @param string $fildname.
     *  Field Name of user input.
     *
     * @return string.
     *  return input upon validation otherwise null.
     */
    public function validateInput(string $input, string &$error, string $fieldName): string {
        $input = $this->checkInput($input);
        // Matching Regex.
        if (!preg_match(self::regexAlpha, $input) || empty($input)) {
          $error = "* Only letters and white space allowed";
          return "";
        }
        else {
          return $input;
        }
      }
    }

?>
