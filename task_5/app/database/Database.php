<?php
class Database
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $name = 'nti_ecommerce';
    private $connect;

    // Connection
    public function __construct()
    {
        $this->connect = new mysqli($this->host, $this->username, $this->password, $this->name);
        if ($this->connect->connect_error) {
            die("Connection Failed : $this->con->connect_error");
        }
    }

    // DML method to insert update or delete the Data
    public function runDML($query)
    {
        $result = $this->connect->query($query);
        return ($result) ? true : false;
    }

    // DQL method to select the Data
    public function runDQL($query)
    {
        $result = $this->connect->query($query);
        if ($result->num_rows === 1) return $result->fetch_object();
        if ($result->num_rows > 1) return $result->fetch_all(MYSQLI_ASSOC);
        return [];
    }
}
