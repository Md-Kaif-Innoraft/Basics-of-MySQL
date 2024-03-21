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
  $waq1 = "SELECT ed.employee_first_name, es.employee_salary
  FROM employee_salary_table AS es INNER JOIN employee_details_table AS ed
  ON es.employee_id = ed.employee_id WHERE employee_salary > '50000'";

  /**
   * @var string $waq2.
   *  Sql query to list all employee last name with graduation percentile greater than 70%.
   */
  $waq2 = "SELECT employee_last_name, Graduation_percentile
  FROM employee_details_table WHERE Graduation_percentile > '70';";

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
  $waq4 = "SELECT ed.employee_first_name, ed.employee_last_name, ec.employee_domain
  FROM ((employee_code_table AS ec INNER JOIN employee_salary_table AS es
  ON ec.employee_code = es.employee_code) INNER JOIN employee_details_table AS ed
  ON es.employee_id = ed.employee_id) WHERE employee_domain <> 'JAVA'";

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

  /**
   * Class FormValidation to validate user inputs and insert data into tables.
   */
  class FormValidation {

    /**
     * @var string $regexName.
     *  Regex to match input with alphabets.
     */
    const regexName = "/^[a-zA-Z\s]+$/";

    /**
     * @var string $regexEmpCode.
     *  Regex to match input with alphabets and underscore.
     */
    const regexEmpCode = "/^[a-zA-Z\s_]+$/";

    /**
     * @var string $regexEmpId.
     *  Regex to match input start with RU and can only have 3 chars.
     */
    const regexEmpId = "/^RU[a-zA-Z0-9]{3,}$/";

    /**
     * @var string $regexEmpSalary.
     *  Regex to match input with numbers and end with k.
     */
    const regexEmpSalary = "/^\d+k$/i";

    /**
     * @var string $regexNum.
     *  Regex to match input with numbers.
     */
    const regexNum = "/\b(0*(?:[1-9][0-9]?|100))\b/";

    /**
     * @var string $empCode.
     *  It will store employee code from user input.
     */
    private $empCode;

    /**
     * @var string $empFname.
     *  It will store employee first name from user input.
     */
    private $empFname;

    /**
     * @var string $empLname.
     *  It will store employee last name from user input.
     */
    private $empLname;

    /**
     * @var string $empSalary.
     *  It will store employee salary from user input.
     */
    private $empSalary;

    /**
     * @var string $empId.
     *  It will store employee id from user input.
     */
    private $empId;

    /**
     * @var string $empCodeName.
     *  It will store employee code name from user input.
     */
    private $empCodeName;

    /**
     * @var string $empDomain.
     *  It will store employee domain from user input.
     */
    private $empDomain;

    /**
     * @var string $empGp.
     *  It will store employee Graduation percentile from user input.
     */
    private $empGp;

    /**
     * @var string $empCodeErr.
     *  It will store error message upon failed validaton of Employee code.
     */
    private $empCodeErr;

    /**
     * @var string $empFnameErr.
     *  It will store error message upon failed validaton of Employee first Name.
     */
    private $empFnameErr;

    /**
     * @var string $empLnameErr.
     *  It will store error message upon failed validaton of Employee Last name.
     */
    private $empLnameErr;

    /**
     * @var string $empSalaryErr.
     *  It will store error message upon failed validaton of Employee Salary.
     */
    private $empSalaryErr;

    /**
     * @var string $empIdErr.
     *  It will store error message upon failed validaton of Employee Id.
     */
    private $empIdErr;

    /**
     * @var string $empCodeNameErr.
     *  It will store error message upon failed validaton of Employee code name.
     */
    private $empCodeNameErr;

    /**
     * @var string $empDoaminErr.
     *  It will store error message upon failed validaton of Employee Domain.
     */
    private $empDomainErr;

    /**
     * @var string $empGpErr.
     *  It will store error message upon failed validaton of Employee Graduation percentile.
     */
    private $empGpErr;

    /**
     * @var boolean $errFlag.
     *  It will store true|false upon failed validaton of any user input field.
     */
    private $errFlag;

    /**
     * Constructer to set the instance variables of class.
     */
    function __construct() {
      $this->empCode = "";
      $this->empFname = "";
      $this->empLname = "";
      $this->empSalary = "";
      $this->empId = "";
      $this->empCodeName = "";
      $this->empDomain = "";
      $this->empGp = "";
      $this->empCodeErr = "";
      $this->empFnameErr = "";
      $this->empLnameErr = "";
      $this->empSalaryErr = "";
      $this->empIdErr = "";
      $this->empCodeNameErr = "";
      $this->empDomainErr = "";
      $this->empGpErr = "";
      $this->errFlag = TRUE;
    }

    /**
     * Function will return error message of employee code.
     *
     * @return string.
     *  Return error message of employee code.
     */
    function getEmpCodeErr(): string {
      return $this->empCodeErr;
    }

    /**
     * Function will return error message of employee First Name.
     *
     * @return string.
     *  Return error message of employee first name.
     */
    function getEmpFnameErr(): string {
      return $this->empFnameErr;
    }

    /**
     * Function will return error message of employee Last Name.
     *
     * @return string.
     *  Return error message of employee last name.
     */
    function getEmpLnameErr(): string {
      return $this->empLnameErr;
    }

    /**
     * Function will return error message of employee Salary.
     *
     * @return string.
     *  Return error message of employee salary.
     */
    function getEmpSalaryErr(): string {
      return $this->empSalaryErr;
    }

    /**
     * Function will return error message of employee Id.
     *
     * @return string.
     *  Return error message of employee Id.
     */
    function getEmpIdErr(): string {
      return $this->empIdErr;
    }

    /**
     * Function will return error message of employee code name.
     *
     * @return string.
     *  Return error message of employee code name.
     */
    function getEmpCodeNameErr(): string {
      return $this->empCodeNameErr;
    }

    /**
     * Function will return error message of employee Doamin.
     *
     * @return string.
     *  Return error message of employee domain.
     */
    function getEmpDomainErr(): string {
      return $this->empDomainErr;
    }

    /**
     * Function will return error message of employee Graduation percentile.
     *
     * @return string.
     *  Return error message of employee graduation percentile.
     */
    function getempGpErr(): string {
      return $this->empGpErr;
    }

    /**
     * Function to check and sanitize user inputs.
     *
     * @param string $data.
     *
     * @return string.
     *  Return data afer sanitize.
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
     *  Return input upon validation otherwise null.
     */
    public function validateInput(string $input, string &$error, $regex, $maxLen): string {
        $input = $this->checkInput($input);
        // Matching Regex.
        if (!preg_match($regex, $input) || empty($input)) {
          $error = "* Invalid Input Backend.";
          $this->errFlag = FALSE;
          return "";
        }
        // Check for length of input.
        elseif (strlen($input)>$maxLen) {
          $error = "* Maximum 20 characters allowed.";
          return "";
        }
        else {
          return $input;
        }
      }

      /**
       * Function to process form data and validate user inputs.
       */
      function processForm() {
        // Check for request method.
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
          $this->empCode = $this->validateInput($_POST['employee_code'], $this->empCodeErr, self::regexEmpCode, 20);
          $this->empFname = $this->validateInput($_POST['employee_first_name'], $this->empFnameErr, self::regexName, 20);
          $this->empLname = $this->validateInput($_POST['employee_last_name'], $this->empLnameErr, self::regexName, 20);
          $this->empSalary = $this->validateInput($_POST['employee_salary'], $this->empSalaryErr, self::regexEmpSalary, 20);
          $this->empId = $this->validateInput($_POST['employee_id'], $this->empIdErr, self::regexEmpId, 20);
          $this->empCodeName = $this->validateInput($_POST['employee_code_name'], $this->empCodeNameErr, self::regexEmpCode, 20);
          $this->empDomain = $this->validateInput($_POST['employee_domain'], $this->empDomainErr, self::regexName, 20);
          $this->empGp = $this->validateInput($_POST['graduation_percentile'], $this->empGpErr, self::regexNum, 20);

          if ($this->errFlag) {
            // Sql query to insert data into employee_code_table.
            $qInsertEct = "INSERT INTO `employee_code_table` (`employee_code`, `employee_code_name`, `employee_domain`)
            VALUES ('$this->empCode', '$this->empCodeName', '$this->empDomain')";

            // Sql query to insert data into employee_salary_table.
            $qInsertEst = "INSERT INTO `employee_salary_table` (`employee_id`, `employee_salary`, `employee_code`)
            VALUES ('$this->empId', '$this->empSalary', '$this->empCode')";
            // Sql query to insert data into employee_details_table.
            $qInsertEdt = "INSERT INTO `employee_details_table` (`employee_id`, `employee_first_name`, `employee_last_name`, `graduation_percentile`)
            VALUES ('$this->empId', '$this->empFname', '$this->empLname', '$this->empGp')";

            // Create object of SqlQueries class.
            $sql = new SqlQueries();
            // Call insertData Function to insert data into Employee code table.
            $sql->insertData($qInsertEct);
            // Call insertData Function to insert data into Employee salary table.
            $sql->insertData($qInsertEst);
            // Call insertData Function to insert data into Employee details table.
            $sql->insertData($qInsertEdt);
          }
        }
      }

    }

    // Create object of FormValidation class.
    $formval = new FormValidation();
    // Call function processForm.
    $formval->processForm();

?>
