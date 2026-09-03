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

    public function insert()
    {
        /*require_once "database.php";

        $database = new Database(); 
        $database->start();

        $veiligeNaam = mysqli_real_escape_string($database->conn, $this->naam);
        $veiligeBeschrijving = mysqli_real_escape_string($database->conn, $this->beschrijving);
        $veiligeFotoNaam = mysqli_real_escape_string($database->conn, $this->fotoNaam);

        $query = "INSERT INTO sets (
            set_name,
            set_description,
            set_brand_id,
            set_theme_id,
            set_image,
            set_price,
            set_age,
            set_pieces,
            set_stock ) VALUES (
            '{$veiligeNaam}',
            '{$veiligeBeschrijving}',
            {$this->brandID},
            {$this->themeID},
            '{$veiligeFotoNaam}',
            {$this->prijs},
            {$this->age},
            {$this->steentjes},
            {$this->voorraad} )";
        
        $database->conn->query($query);
        $database->close();*/

        require_once "database.php";

        $database = new Database(); 
        $database->start();

        $veiligeNaam = mysqli_real_escape_string($database->conn, $this->naam);
        $query = "INSERT INTO themes ( theme_name ) VALUES ( '{$veiligeNaam}' )";

        $database->conn->query($query);
        $database->close();
    }

    public function delete()
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $query = "DELETE FROM themes WHERE theme_id = " . $this->ID;

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