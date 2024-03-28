<?Php

  // Include ConnectDb.php file.
  require 'ConnectDb.php';

  /**
   * Class SqlQueries to connect to database and execute sql queries.
   */
  class SqlQueries {

    /**
     * @var object $conn.
     *  It will store database connection.
     */
    private $conn;

    /**
     * Constructor to create new connection to database.
     */
    function __construct() {
      $connetdb = new ConnectDb();
      $this->conn = $connetdb->connect();
    }

    /**
     * Function to display data from table based of query.
     *
     * @param string $sql.
     *  It will take sql query to execute it.
     *
     * @return array.
     *  Returns Associative array based on database table.
     */
    public function displayData(string $sql): array {
      $statement = $this->conn->prepare($sql);
      $statement->execute();
      return $statement->fetchAll();
    }

    /**
     * Function to insert data into tables based on query and input field.
     *
     * @param string $sql.
     *  It will take sql query to execute it.
     */
    public function insertData(string $sql) {
      try {
        $statement = $this->conn->prepare($sql);
        $statement->execute();
      }
      catch (PDOException $e) {
        echo "Data insertion failed " . $e->getMessage();
      }
    }

  }

?>
