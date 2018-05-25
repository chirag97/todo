<?php

// $db_host = "localhost";
// $db_userName = "root";
// $db_password = "";
// $database = "todo";

// $conn = mysqli_connect($db_host,$db_userName,$db_password,$database);
// if(!$conn)
// {
//     die("DB Connection Failed".mysqli_connect_error());
// }



class Connection
{
    private $db_host = "localhost";
    private $db_userName = "root";
    private $db_password = "";
    private $database = "todo";
    public $conn = "";
    
    public function __construct()
    {

    }
    
    public function db_connect()
    {
        $this->conn = mysqli_connect($this->db_host, $this->db_userName, $this->db_password,$this->database);
        if (!$this->conn) {
            die("DB Connection Failed" . mysqli_connect_error());
        }

    }

}


