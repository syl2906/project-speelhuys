<?php

class Database
{
    private string $servername = "127.0.0.1";
    private string $user = "root";
    private string $pass = "mysql";
    private string $database = "speelhuys";

    public mysqli $conn;
    
    public function start()
    {
        $this->conn = new mysqli($this->servername, $this->user, $this->pass, $this->database);

        if($this->conn->connect_error)
        {
            die("Connectie mislukt: " . $this->conn->connect_error);
        }
    }

    public function close()
    {
        if(isset($this->conn))
        {
            $this->conn->close();
        }
    }

    /*function __destruct()
    {
        if(isset($this->conn)  && $this->conn->ping())
        {
            $this->conn->close();
        }
    }*/
}

?>