<?php

require_once "../classes/merk.php";
require_once "../classes/thema.php";
require_once "../classes/codeblokkenpakket.php";

// TODO: Check voor sessie en of gebruiker beheerder is
$isadmin = false; // TODO: zet dit wanneer administrator inlogd die dingen kan deleten.

if(!isset($_GET["pakket_id"]) && !isset($_POST["pakket_naam"]))
{
    ?>

    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Speelhuys</title>
        <link rel="stylesheet" type="text/css" href="../css/style.css" />
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
        <link rel="stylesheet" href="../css/jquery-te-1.4.0.css">
    </head>

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
                            <a class="btn btn-light" href="insertpakket.php">Pakket toevoegen</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light" href="themas.php">Merken / Thema's</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger" href="logout.php">Uitloggen</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 10px;">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-4">
                <form method="POST" enctype="multipart/form-data" style="padding: 5px;">
                    <input type="text" placeholder="pakket naam" name="pakket_naam" required value=""/><br>
                    <input type="submit" name="beheerpakket" class="btn btn-primary" value="Beheer pakket" style="margin-top: 10px;"/>
                </form>
            </div>
            <div class="col-2">
            </div>

    <?php
    exit;
}

$error = null;
$pakket = new CodeBlokkenPakket();

if(isset($_GET["pakket_id"]) && !$pakket->initializeer($_GET["pakket_id"]))
{
    ?>
    <h2>Error! Kan niet pakket id: <?= $_GET["pakket_id"] ?> vinden.</h2>;
    <?php
    exit;
}
elseif(isset($_POST["pakket_naam"]) && !$pakket->initMetNaam($_POST["pakket_naam"]))
{
    ?>
    <h2>Error! Kan niet pakket naam: <?= $_POST["pakket_naam"] ?> vinden.</h2>;
    <?php
    exit;
}

if(isset($_POST["delete"]) && isset($_GET["pakket_id"]) && $isadmin)
{
    $pakket->delete();
    header("location: ../overview.php");
    exit;
}

if(isset($_POST["submit"]) && isset($_GET["pakket_id"]))
{
    $wasChanged = false;

    $image = null;
    if(!empty($_FILES["foto"]["name"]))
    {
        $image = $_FILES["foto"]["name"];

        $target = "../upload/" . basename($image);
        move_uploaded_file($_FILES["foto"]["tmp_name"], $target);
        $wasChanged = true;
    }

    if(isset($_POST["naam"]))
    {
        $pakket->naam = $_POST["naam"];
        $wasChanged = true;
    }

    if(isset($_POST["beschrijving"]))
    {
        $pakket->beschrijving = $_POST["beschrijving"];
        $wasChanged = true;
    }

    if(isset($_POST["merk"]))
    {
        $pakket->brandID = $_POST["merk"];
        $wasChanged = true;
    }

    if(isset($_POST["thema"]))
    {
        $pakket->themeID = $_POST["thema"];
        $wasChanged = true;
    }

    if(isset($_POST["prijs"]))
    {
        $pakket->prijs = $_POST["prijs"];
        $wasChanged = true;
    }

    if(isset($_POST["leeftijd"]))
    {
        $pakket->age = $_POST["leeftijd"];
        $wasChanged = true;
    }

    if(isset($_POST["steentjes"]))
    {
        $pakket->steentjes = $_POST["steentjes"];
        $wasChanged = true;
    }

    if(isset($_POST["voorraad"]))
    {
        $pakket->voorraad = $_POST["voorraad"];
        $wasChanged = true;
    }

    if($wasChanged)
    {
        $pakket->update();
    }
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
                            <a class="btn btn-light" href="beheerpakket.php">Pakket beheer</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light" href="insertpakket.php">Pakket toevoegen</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-light" href="themas.php">Merken / Thema's</a>
                        </li>
                        <li class="nav-item">
                            <a class="btn btn-danger" href="logout.php">Uitloggen</a>
                        </li>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container" style="margin-top: 10px;">
        <div class="row">
            <div class="col-3">
            </div>
            <div class="col-4">
                <form method="POST" enctype="multipart/form-data" style="padding: 5px;">
                    <input type="text" placeholder="naam" name="naam" required value="<?= $pakket->naam ?>"/><br>

                    <select name="merk" class="form-select" style="margin-top: 10px;">
                        <?php
                        $merken = Merk::vindAlleMerken();

                        foreach ($merken as $merk) {
                            
                            //<option value="<?= $merk->ID ? >">
                            if(isset($pakket) && $pakket->ID > 0 && $merk->ID == $pakket->brandID)
                            {
                                echo "<option value=\"" . $merk->ID . "\" selected>";
                            }
                            else
                            {
                                echo "<option value=\"" . $merk->ID . "\">";
                            }
                            ?>
                                <?= $merk->naam ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>

                    <select name="thema" class="form-select" style="margin-top: 10px;">
                        <?php
                        $themas = Thema::vindAlleThemas();

                        foreach ($themas as $thema) {
                            
                            //<option value="<?= $thema->ID ? >">
                            if(isset($pakket) && $pakket->ID > 0 && $thema->ID == $pakket->themeID)
                            {
                                echo "<option value=\"" . $thema->ID . "\" selected>";
                            }
                            else
                            {
                                echo "<option value=\"" . $thema->ID . "\">";
                            }
                            ?>
                                <?= $thema->naam ?>
                            </option>
                            <?php
                        }
                        ?>
                    </select>

                    <div class="form-group" style="margin-top: 10px;">
                        <textarea class="jqte" id="beschrijving" name="beschrijving" required><?= $pakket->beschrijving ?></textarea>
                    </div>

                    <input type="text" placeholder="leeftijd" name="leeftijd" required value="<?= $pakket->age ?>" style="margin-top: 10px;"/><br>
                    <input type="text" placeholder="steentjes" name="steentjes" required value="<?= $pakket->steentjes ?>" style="margin-top: 10px;"/><br>
                    <input type="text" placeholder="prijs" name="prijs" required value="<?= $pakket->prijs ?>" style="margin-top: 10px;"/><br>
                    <input type="text" placeholder="voorraad" name="voorraad" required value="<?= $pakket->voorraad ?>" style="margin-top: 10px;"/><br>
                    <input type="file" class="form-control" id="fotoupload" name="foto" style="margin-top: 10px;"/><br>

                    <input type="submit" name="submit" class="btn btn-primary" value="Verander pakket"/>
                </form>

                <?php
                if($isadmin)
                {?>
                    <div class="card" style="padding: 10px; margin-top: 40%; border-color: red;">
                        <h5 class="text-justify text-danger">Gevarenzone</h5>
                        <form method="POST" enctype="multipart/form-data" style="padding: 5px;">
                            <input type="submit" name="delete" class="btn btn-danger" value="Verwijder pakket"/>
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