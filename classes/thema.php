<?php

class Thema
{
    public int $ID;
    public string $naam;

    public function initializeer($inID): bool
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $veiligID = mysqli_real_escape_string($database->conn, $inID);
        $query = "SELECT * FROM themes WHERE theme_id = " . $veiligID;
        $resultaat = $database->conn->query($query);

        if($resultaat->num_rows > 0)
        {
            $rij = $resultaat->fetch_assoc();
            $this->ID = $rij["theme_id"];
            $this->naam = $rij["theme_name"];
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
        $query = "UPDATE themes SET theme_name = '{$this->naam}' WHERE theme_id = {$veiligID}";
        $database->conn->query($query);
        $database->close();
    }

    public static function vindAlleThemas()
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $query = "SELECT * FROM themes";
        $resultaat = $database->conn->query($query);
        
        $themas = [];
        if($resultaat->num_rows > 0)
        {
            while($rij = $resultaat->fetch_assoc())
            {
                $thema = new Thema();
                $thema->ID = $rij["theme_id"];
                $thema->naam = $rij["theme_name"];

                $themas[] = $thema;
            }
        }

        $database->close();
        return $themas;
    }
}

?>