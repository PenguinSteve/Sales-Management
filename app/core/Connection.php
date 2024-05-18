<?php
class Connection {
    private static $instance;
    private $servername = "localhost";
    private $username = "root";
    private $password = "";
    private $dbname = "sales-management";
    private $conn;

    private function __construct() {

        if($this->conn == null){
            $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
            if ($this->conn->connect_error) {
                die("Connection failed: " . $this->conn->connect_error);
            }
        }
        
    }

    public static function getInstance() {
        if (!isset(self::$instance)) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }

    public function __destruct() {
        $this->conn->close();
    }
}

// Sử dụng:
$database = Connection::getInstance();
$conn = $database->getConnection();

?>