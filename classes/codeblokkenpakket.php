<?php

class CodeBlokkenPakket
{
    public int $ID;
    public string $naam;
    public string $beschrijving;
    public int $brandID;
    public int $themeID;
    public string $fotoNaam;
    public float $prijs;
    public int $age;
    public int $steentjes;
    public int $voorraad;

    public function initializeer($inID): bool
    {
        require_once "database.php";

        $database = new Database();
        $database->start();

        $query = "SELECT * FROM sets WHERE set_id = " . $inID;
        $resultaat = $database->conn->query($query);

        if($resultaat->num_rows > 0)
        {
            $rij = $resultaat->fetch_assoc();

            $this->ID = $rij["set_id"];
            $this->naam = $rij["set_name"];
            $this->beschrijving = $rij["set_description"];
            $this->brandID = $rij["set_brand_id"];
            $this->themeID = $rij["set_theme_id"];
            $this->fotoNaam = $rij["set_image"];
            $this->prijs = $rij["set_price"];
            $this->age = $rij["set_age"];
            $this->steentjes = $rij["set_pieces"];
            $this->voorraad = $rij["set_stock"];

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

        $veiligeNaam = mysqli_real_escape_string($database->conn, $this->naam);
        $veiligeBeschrijving = mysqli_real_escape_string($database->conn, $this->beschrijving);
        $veiligeFotoNaam = mysqli_real_escape_string($database->conn, $this->fotoNaam);

        $query = "UPDATE sets SET set_name = '{$veiligeNaam}',
                    set_description = '{$veiligeBeschrijving}',
                    set_brand_id = {$this->brandID},
                    set_theme_id = {$this->themeID},
                    set_image = '{$veiligeFotoNaam}',
                    set_price = {$this->prijs},
                    set_age = {$this->age},
                    set_pieces = {$this->steentjes},
                    set_stock = {$this->voorraad}
                    WHERE set_id = {$this->ID}";
        $database->conn->query($query);
        $database->close();
    }

    public function insert()
    {
        require_once "database.php";

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
        $database->close();
    }

    public function delete()
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $query = "DELETE FROM sets WHERE set_id = " . $this->ID;

        $database->conn->query($query);
        $database->close();
    }

    public static function vindAlleMetZoekTerm($zoekTerm)
    {
        require_once "database.php";

        $database = new Database();
        $database->start();
        
        $veiligZoekTerm = mysqli_real_escape_string($database->conn, $zoekTerm);
        $query = "SELECT * FROM sets WHERE " . $veiligZoekTerm;
        $resultaat = $database->conn->query($query);

        $pakketten = [];
        if($resultaat->num_rows > 0)
        {
            while($rij = $resultaat->fetch_assoc())
            {
                $pakket = new CodeBlokkenPakket();

                $pakket->ID = $rij["set_id"];
                $pakket->naam = $rij["set_name"];
                $pakket->beschrijving = $rij["set_description"];
                $pakket->brandID = $rij["set_brand_id"];
                $pakket->themeID = $rij["set_theme_id"];
                $pakket->fotoNaam = $rij["set_image"];
                $pakket->prijs = $rij["set_price"];
                $pakket->age = $rij["set_age"];
                $pakket->steentjes = $rij["set_pieces"];
                $pakket->voorraad = $rij["set_stock"];

                // kan pakket id hier doen voor sommigen dingen maar waarschijnlijk niet nodig
                $pakketten[] = $pakket;
            }
        }

        $database->close();
        return $pakketten;
    }

    public static function vindAlleMetThema($inThema)
    {
        $zoekTerm = "set_theme = " . $inThema; // wordt veilig gemaakt door vindAlleMetZoekTerm.
        return vindAlleMetZoekTerm($zoekTerm);
    }

    public static function vindAlleMetMerk($inMerk)
    {
        $zoekTerm = "set_brand = " . $inMerk; // wordt veilig gemaakt door vindAlleMetZoekTerm.
        return vindAlleMetZoekTerm($zoekTerm);
    }

    public static function vindAlleMetMerkEnThema($inThema, $inMerk)
    {
        $zoekTerm = "set theme = " . $inTheme . " AND set_brand = " . $inMerk;
        return vindAlleMetZoekTerm($zoekTerm);
    }
}

?>