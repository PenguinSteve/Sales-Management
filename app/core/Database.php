<?php
class Database
{
    private $conn;

    function __construct()
    {
        $this->conn = Connection::getInstance()->getConnection();
    }

    //function use for action query data and return selected rows
    public function select($query, $params = [], $paramTypes = '')
    {
        $stmt = $this->conn->prepare($query);

        if ($paramTypes && $params) {
            $stmt->bind_param($paramTypes, ...$params);
        }

        $stmt->execute();
        $result = $stmt->get_result();

        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        return $data;
    }

    //function use for action add, update, delete and return rows have been affected
    public function action($query, $params = [], $paramTypes = '')
    {

        $stmt = $this->conn->prepare($query);

        if ($paramTypes && $params) {
            $stmt->bind_param($paramTypes, ...$params);
        }

        $stmt->execute();

        return $stmt->affected_rows;
    }
}
