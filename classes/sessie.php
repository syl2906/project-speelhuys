<?php


class Sessie
{
    public string $id;
    public string $userId;
    public string $key;
    public string $start;
    public string $end;


    public static function vindActieveSessie() // deze kijkt of er een sessie is die gelinkt is aan de gebruiker
    {
        $sessie = null;
        

        require_once "database.php";
        $database = new Database();
        $database->start();

        if (isset($_COOKIE["steptember-session"])) {


            $key = mysqli_real_escape_string($conn, $_COOKIE["steptember-session"]);

            $query = "SELECT * FROM session WHERE session_key = '" . $key . "' AND session_end > '" . date("Y-m-d H:i:s") . "' ";
            $resultaat = $conn->query($query);

            if ($resultaat->num_rows > 0) {
                $rij = $resultaat->fetch_assoc();

                $sessie = new Sessie();
                $sessie->id = $rij["session_id"];
                $sessie->userId = $rij["session_user_id"];
                $sessie->key = $rij["session_key"];
                $sessie->start = $rij["session_start"];
                $sessie->end = $rij["session_end"];
            }
        }
        $conn->close();

        return $sessie;
    }
    public function insert() // deze gooit er een lekker koekje in de DB zodat de gebruiker gebruiker dingen kan doen
    {
        

        require_once "database.php";
        $database = new Database();
        $database->start();

        
        $sql = "INSERT INTO `session` (
            session_user_id, 
            session_key, 
            session_start, 
            session_end
            ) VALUES (
            '" . $this->userId . "',
            '" . $this->key . "',
            '" . $this->start . "',
            '" . $this->end . "'
            )";

        $conn->query($sql);

        $conn->close();
    }
}