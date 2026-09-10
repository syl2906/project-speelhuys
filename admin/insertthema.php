<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Speelhuys</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="css/jquery-te-1.4.0.css">
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
                            <a class="btn btn-light" href="beheerpakket.php">Pakket beheer</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light" href="overzichtpakketten.php">Pakket toevoegen</a>
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
    </div>

<?php

// TODO: check of gebruiker beheerder is.

require_once "../classes/thema.php";

if(isset($_POST["submit"]))
{
    $thema = new Thema();
    $thema->naam = $_POST["thema_naam"];
    $thema->insert();
    header("location: thema.php");
    exit;
}

?>
    <div class="container">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-4">
                <h5 class="text">Maak nieuwe thema</h5>
                <form method="POST" enctype="multipart/form-data" style="padding: 5px;">
                    Naam:
                    <input type="text" placeholder="thema naam" name="thema_naam" required value=""/><br>
                    <input type="submit" name="submit" class="btn btn-primary" value="submit" style="margin-top: 10px;"/>
                </form>
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
