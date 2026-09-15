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
    header("location: ../overzichtpakketten.php");
    exit;
}

$gebruikers = User::vindAlleGebruikers();

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
            <a href="insertgebruiker.php" class="btn btn-primary">Maak nieuwe gebruiker</a><br>
            <div class="row justify-content-center">
                <table class="table">
                    <tr>
                        <th>Volle naam</th>
                        <th>Gebruikersnaam</th>
                        <th>Rol</th>
                        <th>Beheer</th>
                    </tr>
                    <?php
                    foreach($gebruikers as $gebruiker)
                    {
                    ?>
                    <tr>
                        <td><?=$gebruiker->firstname . " " . $gebruiker->lastname?></td>
                        <td><?=$gebruiker->username?></td>
                        <td><?=$gebruiker->role?></td>
                        <td><a href="beheergebruiker.php?id=<?=$gebruiker->userId?>">Beheer</a></td>
                    </tr>
                    <?php
                    }?>
                </table>
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
