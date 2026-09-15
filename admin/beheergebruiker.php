<?php

require_once "../classes/sessie.php";
require_once "../classes/gebruiker.php";

$sessie = Sessie::vindActieveSessie();
if($sessie == null)
{
    header("location: ../index.php");
    exit;
}

$gebruiker = User::zoekIdeeeee($sessie->userId);
if($gebruiker == null)
{
    header("location: ../index.php");
    exit;
}

if($gebruiker->role != "admin")
{
    header("location: overzichtgebruikers.php");
    exit;
}

if(!isset($_GET["id"]))
{
    header("location: overzichtgebruikers.php");
    exit;
}

$beheerdeGebruiker = User::zoekIdeeeee($_GET["id"]);
if($beheerdeGebruiker == null)
{
    header("location: overzichtgebruikers.php");
    exit;
}

if(isset($_POST["delete"]))
{
    $beheerdeGebruiker->delete();
    header("location: overzichtgebruikers.php");
    exit;
}

if(isset($_POST["submit"]))
{
    $beheerdeGebruiker->firstname = $_POST["voornaam"];
    $beheerdeGebruiker->lastname = $_POST["achternaam"];
    $beheerdeGebruiker->email = $_POST["email"];
    $beheerdeGebruiker->username = $_POST["gebruikersnaam"];
    $beheerdeGebruiker->password = $_POST["wachtwoord"];
    $beheerdeGebruiker->role = $_POST["role"];

    $beheerdeGebruiker->update();
    header("location: overzichtgebruikers.php");
    exit;
}

?>

<!DOCTYPE html>
<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Speelhuys</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
    </head>

    <body>
        <div class="navbar navbar-expand-lg navbar-light" style="padding: 10px;">
            <div class="container-fluid">
                <div class="collapse navbar-collapse">
                    <div class="navbar-nav">
                        
                    </div>
                    <div class="navbar-nav">
                        <li class="nav-item">
                            <a class="btn btn-primary" href="../index.php">Overzicht</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light" href="overzichtpakketten.php">Pakket beheer</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light" href="insertpakket.php">Pakket toevoegen</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light" href="themamerkbeheer.php">Merken / Thema's</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger" href="logout.php">Uitloggen</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-2">
                </div>

                <div class="col-4">
                    <form method="POST" enctype="multipart/form-data" style="padding: 5px;">
                        Voornaam:
                        <input type="text" placeholder="voornaam" name="voornaam" required value="<?= $beheerdeGebruiker->firstname ?>"/><br>

                        Achternaam:
                        <input type="text" placeholder="achternaam" name="achternaam" required value="<?= $beheerdeGebruiker->lastname ?>"/><br>

                        Email:
                        <input type="text" placeholder="email" name="email" required value="<?= $beheerdeGebruiker->email ?>"/><br>

                        Gebruikersnaam:
                        <input type="text" placeholder="gebruikersnaam" name="gebruikersnaam" required value="<?= $beheerdeGebruiker->username ?>"/><br>

                        Wachtwoord:
                        <input type="text" placeholder="wachtwoord" name="wachtwoord" required value="<?= $beheerdeGebruiker->password ?>"/><br>

                        <select name="role" class="form-select" style="margin-top: 10px;">
                            <?php
                            if($beheerdeGebruiker->isadmin)
                            {
                                ?>
                                <option value="admin" selected>
                                    admin
                                </option>
                                <option value="employee">
                                    medewerker
                                </option>

                                <?php
                            }
                            else
                            {
                                ?>
                                <option value="admin" selected>
                                    admin
                                </option>
                                <option value="employee">
                                    medewerker
                                </option>

                                <?php
                            }
                            ?>
                        </select>

                        <input type="submit" name="submit" class="btn btn-primary" value="submit"/>
                    </form>

                    <div class="card" style="padding: 10px; margin-top: 40%; border-color: red;">
                        <h5 class="text-justify text-danger">Gevarenzone</h5>
                        <form method="POST" enctype="multipart/form-data" style="padding: 5px;">
                            <input type="submit" name="delete" class="btn btn-danger" value="Verwijder gebruiker"/>
                        </form>
                    </div>
                </div>

                <div class="col-2">
                </div>
            </div>
        </div>

        <script type="text/javascript" src="http://code.jquery.com/jquery.min.js" charset="utf-8"></script>
        <script type="text/javascript" src="../js/jquery-te-1.4.0.min.js" charset="utf-8"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>

        <script>
            $(".jqte").jqte();
        </script>
    </body>
</html>
