<?php


class User
{

    public int $userId;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $username;
    public string $password;
    public string $role;

    public static function allUsers ($username, $password)
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $query = "SELECT * FROM users WHERE user_username = '" . $username . "' AND user_password = '" . $password . "'";

        $result = $database->conn->query($query);

        $user = null;

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $user = new User ();
                $user->userId = $row['user_id'];
                $user->firstname = $row['user_firstname'];
                $user->lastname = $row['user_lastname'];
                $user->email = $row['user_email'];
                $user->username = $row['user_username'];
                $user->password = $row['user_password'];
                $user->role = $row['user_role'];
            }
        }
        $database->close();
        return $user;
    
    }

    public static function vindAlleGebruikers()
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $gebruikers = [];
        
        $query = "SELECT * FROM users";
        $resultaat = $database->conn->query($query);

        if($resultaat->num_rows > 0)
        {
            while($row = $resultaat->fetch_assoc())
            {
                $gebruiker = new User();
                $gebruiker->userId = $row["user_id"];
                $gebruiker->firstname = $row["user_firstname"];
                $gebruiker->lastname = $row["user_lastname"];
                $gebruiker->email = $row["user_email"];
                $gebruiker->username = $row["user_username"];
                $gebruiker->password = $row["user_password"];
                $gebruiker->role = $row["user_role"];
                $gebruikers[] = $gebruiker;
            }
        }

        $database->close();
        return $gebruikers;

    }

    public static function zoekIdeeeee($user_id) // deze haalt het idee op, heeft geen nut aangezien dit niet steptember is (was te lui om weg te halen)
    {
        

        require_once "database.php";
        $database = new Database();
        $database->start();



        $user_id = mysqli_real_escape_string($database->conn, $user_id);

        
        

        $query = "SELECT * FROM users WHERE user_id = '$user_id' ";
        $resultaat = $database->conn->query($query);

        $gebruikertje = null;
        if ($resultaat->num_rows > 0) {
            $row = $resultaat->fetch_assoc();
            

            $gebruikertje = new User();
            $gebruikertje->userId = $row['user_id'];
            $gebruikertje->firstname = $row['user_firstname'];
            $gebruikertje->lastname = $row['user_lastname'];
            $gebruikertje->email = $row['user_email'];
            $gebruikertje->username = $row['user_username'];
            $gebruikertje->password = $row['user_password'];
            $gebruikertje->role = $row['user_role'];
        
    
        }
        $database->close();
        return $gebruikertje; 
    }

    public function update()
    {
        require_once "database.php";
        $database = new Database();
        $database->start();

        $veiligID = mysqli_real_escape_string($database->conn, $this->userId);
        $veiligFirstname = mysqli_real_escape_string($database->conn, $this->firstname); 
        $veiligLastname = mysqli_real_escape_string($database->conn, $this->lastname); 
        $veiligEmail = mysqli_real_escape_string($database->conn, $this->email); 
        $veiligUsername = mysqli_real_escape_string($database->conn, $this->username); 
        $veiligPassword = mysqli_real_escape_string($database->conn, $this->password);
        $veiligRol = mysqli_real_escape_string($database->conn, $this->role);

        $query = "UPDATE users SET user_firstname = '{$veiligFirstname}', user_lastname = '{$veiligLastname}',
                user_email = '{$veiligEmail}',
                user_username = '{$veiligUsername}',
                user_password = '{$veiligPassword}',
                user_role = '{$veiligRol}'
        WHERE user_id = {$veiligID}";

        $database->conn->query($query);
        $database->close();
    }

    public function insert()
    {
        require_once "database.php";

        $database = new Database(); 
        $database->start();

        $veiligFirstname = mysqli_real_escape_string($database->conn, $this->firstname); 
        $veiligLastname = mysqli_real_escape_string($database->conn, $this->lastname); 
        $veiligEmail = mysqli_real_escape_string($database->conn, $this->email); 
        $veiligUsername = mysqli_real_escape_string($database->conn, $this->username); 
        $veiligPassword = mysqli_real_escape_string($database->conn, $this->password);
        $veiligRol = mysqli_real_escape_string($database->conn, $this->role);

        $query = "INSERT INTO users ( user_firstname, user_lastname, user_email, user_username, user_password, user_role ) VALUES ( '{$veiligNaam}', '{$veiligLastname}',
                '{$veiligEmail}', '{$veiligUsername}', '{$veiligPassword}', '{$veiligRol}' )";

        $database->conn->query($query);
        $database->close();
    }




    public static function findUserStepsInfo($user_id)
    {

        include "connectie.php";


        $query="SELECT * FROM steps WHERE";




    }

}
?>
