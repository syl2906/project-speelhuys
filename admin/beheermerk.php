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
    </div>

<?php

// TODO: check of gebruiker beheerder is.
$isadmin = true; // TODO: zet dit wanneer administrator inlogd die dingen kan deleten.

require_once "../classes/merk.php";


// zou theoretisch nooit gebeuren behalve als de gebruiker zelf insertmerk.php intypt.
if(!isset($_GET["merk_id"]))
{
    echo "<h2 class=\"text text-danger\">Error! Geen merk_id gegeven.</h2>";
    exit;
}

$merk = new Merk();
if(!$merk->initializeer($_GET["merk_id"]))
{
    echo "<h2 class=\"text text-danger\">Error! merk met ID: " . $_GET["merk_id"] . " niet gevonden.</h2>";
    exit;
}

if(isset($_POST["delete"]) && isset($_GET["merk_id"]) && $isadmin)
{
    $merk->delete();
    header("location: merk.php");
    exit;
}

if(isset($_POST["submit"]))
{
    $image = null;
    if(!empty($_FILES["foto"]["name"]))
    {
        $image = $_FILES["foto"]["name"];

        $target = "../upload/logos/" . basename($image);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target);
    }

    $merk->naam = $_POST["merk_naam"];
    if(isset($image))
    {
        $merk->logo = basename($image);
    }
    $merk->update();
    //header("location: merk.php");
    //exit;
}

?>
    <div class="container">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-4">
                <h5 class="text">Verander merk: <?= $merk->naam ?> ( ID <?= $merk->ID ?> )</h5>
                <form method="POST" enctype="multipart/form-data" style="padding: 5px;">
                    Naam:
                    <input type="text" placeholder="merk naam" name="merk_naam" required value="<?= $merk->naam ?>"/><br>
                    <input type="file" class="form-control" id="fotoupload" name="foto" style="margin-top: 10px;"/><br>
                    <input type="submit" name="submit" class="btn btn-primary" value="submit" style="margin-top: 10px;"/>
                </form>

                <?php
                if($isadmin)
                {?>
                    <div class="card" style="padding: 10px; margin-top: 40%; border-color: red;">
                        <h5 class="text-justify text-danger">Gevarenzone</h5>
                        <form method="POST" enctype="multipart/form-data" style="padding: 5px;">
                            <input type="submit" name="delete" class="btn btn-danger" value="Verwijder merk"/>
                        </form>
                    </div>
                <?php
                }?>
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
