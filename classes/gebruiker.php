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

        $result = $conn->query($query);

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
        $conn->close();
        return $user;
    
    }

    public static function zoekIdeeeee($user_id) // deze haalt het idee op, heeft geen nut aangezien dit niet steptember is (was te lui om weg te halen)
    {
        

        require_once "database.php";
        $database = new Database();
        $database->start();



        $user_id = mysqli_real_escape_string($conn, $user_id);

        
        

        $query = "SELECT * FROM users WHERE user_id = '$user_id' ";
        $resultaat = $conn->query($query);

        $gebruikertje = null;
        if ($resultaat->num_rows > 0) {
            $rij = $resultaat->fetch_assoc();
            

            $gebruikertje = new User;
            $gebruikertje->userId = $rij["user_id"];
            $gebruikertje->username = $rij["user_username"];
            $gebruikertje->password = $rij["user_password"];
            $gebruikertje->role = $rij["user_role"];

            
    
        }
        $conn->close();
        return $gebruikertje; 
    }




    public static function findUserStepsInfo($user_id)
    {

        include "connectie.php";


        $query="SELECT * FROM steps WHERE";




    }

}
?>