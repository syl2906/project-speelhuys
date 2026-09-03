<?php

class Merk
{
    public int $ID;
    public string $naam;
    public string $logo;

    public function initializeer($inID): bool
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $veiligID = mysqli_real_escape_string($database->conn, $inID);
        $query = "SELECT * FROM brands WHERE brand_id = " . $veiligID;
        $resultaat = $database->conn->query($query);

        if($resultaat->num_rows > 0)
        {
            $rij = $resultaat->fetch_assoc();
            $this->ID = $rij["brand_id"];
            $this->naam = $rij["brand_name"];
            $this->logo = $rij["brand_logo"];
            $database->close();
            return true;
        }

        $database->close();
        return false;
    }

    public function update()
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $veiligID = mysqli_real_escape_string($database->conn, $this->ID);
        $query = "UPDATE brands SET brand_name = '{$this->naam}', brand_logo = '{$this->logo}' WHERE brand_id = {$veiligID}";
        $database->conn->query($query);
        $database->close();
    }

    public function insert()
    {
        require_once "database.php";

        $database = new Database(); 
        $database->start();

        $veiligeNaam = mysqli_real_escape_string($database->conn, $this->naam);
        $veiligeLogo = mysqli_real_escape_string($database->conn, $this->logo);
        $query = "INSERT INTO themes ( brand_name, brand_logo ) VALUES ( '{$veiligeNaam}', '{$veiligeLogo}' )";

        $database->conn->query($query);
        $database->close();
    }

    public function delete()
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $query = "DELETE FROM brands WHERE brand_id = " . $this->ID;

        $database->conn->query($query);
        $database->close();
    }

    public static function vindAlleMerken()
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $query = "SELECT * FROM brands";
        $resultaat = $database->conn->query($query);
        
        $merken = [];
        if($resultaat->num_rows > 0)
        {
            while($rij = $resultaat->fetch_assoc())
            {
                $merk = new Merk();
                $merk->ID = $rij["brand_id"];
                $merk->naam = $rij["brand_name"];
                $merk->logo = $rij["brand_logo"];

                $merken[] = $merk;
            }
        }

        $database->close();
        return $merken;
    }
}

?>