<?php


include "classes/codeblokkenpakket.php";
include "classes/merk.php";
include "classes/thema.php";


$pagina = 1;

if (isset($_GET["pagina"])) {
    $pagina = $_GET["pagina"];
}

$filterQuery = "";

if (isset($_GET["merk"]) && $_GET["merk"] != "") {
    $filterQuery = "set_brand_id = " . (int)$_GET["merk"];
}

if (isset($_GET["thema"]) && $_GET["thema"] != "") {
    if ($filterQuery != "") $filterQuery .= " AND ";

    $filterQuery .= "set_theme_id = " . (int)$_GET["thema"];
}

if (isset($_GET["leeftijd"]) && $_GET["leeftijd"] != "") {
    if ($filterQuery != "") $filterQuery .= " AND ";

    $filterQuery .= "set_age = " . (int)$_GET["leeftijd"];
}

if(isset($_GET["steentjes_min"]) && $_GET["steentjes_min"] != "")
{
    if($filterQuery != "") $filterQuery .= " AND ";

    $filterQuery .= "set_pieces >= " . (int)$_GET["steentjes_min"];
}

if(isset($_GET["steentjes_max"]) && $_GET["steentjes_max"] != "")
{
    if($filterQuery != "") $filterQuery .= " AND ";

    $filterQuery .= "set_pieces <= " . (int)$_GET["steentjes_max"];
}

if (isset($_GET["prijs_min"]) && $_GET["prijs_min"] != "") {
    if ($filterQuery != "") $filterQuery .= " AND ";

    $filterQuery .= "set_price  >= " . (float)$_GET["prijs_min"];
}

if (isset($_GET["prijs_max"]) && $_GET["prijs_max"] != "") {
    if ($filterQuery != "") $filterQuery .= " AND ";

    $filterQuery .= "set_price  <=" . (float)$_GET["prijs_max"];
}


$merken = Merk::vindAlleMerken();
$themas = Thema::vindAlleThemas();

$pakketten = CodeBlokkenPakket::vindVoorPagina($pagina, $filterQuery);

?>

<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Speelhuys</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <main>



        <div class="container mt-4">

            <div>
                <img src="https://www.pngall.com/wp-content/uploads/5/Lego-Toy-PNG-Download-Image.png" class="rounded float-start" width="200">
            </div>

            <div>
                <img src="https://www.pngall.com/wp-content/uploads/5/Lego-Toy-PNG-Download-Image.png" class="rounded float-end" width="200">
            </div>


            <nav class="mb-2">
                <a href="index.php" class="btn btn-outline-secondary">
                    Homepagina
                </a>

                <a href="login.php" class="btn btn-outline-secondary">
                    Inloggen
                </a>
            </nav>


            <h1>Speelhuys</h1>

            <p>Welkom! Speelhuys Codeblokken.</p>



            <div>

                <form method="GET">


                    <br><br>

                    <p>Filteren:</p>

                    <select name="merk">
                        <option value="">Merk</option>

                        <?php foreach ($merken as $merk) { ?>
                            <option value="<?= $merk->ID ?>">
                                <?= $merk->naam ?>
                            </option>
                        <?php } ?>

                    </select>

                    <select name="thema">
                        <option value="">Thema</option>

                        <?php foreach ($themas as $thema) { ?>
                            <option value="<?= $thema->ID ?>">
                                <?= $thema->naam ?>
                            </option>
                        <?php } ?>

                    </select>

                    <select name="leeftijd">
                        <option value="">Leeftijd</option>
                        <option value="6">6+</option>
                        <option value="8">8+</option>
                        <option value="10">10+</option>
                        <option value="12">12+</option>
                    </select> </br></br>

                    <label>steentjes:</label>
                    <input type="number" name="steentjes_min" placeholder="Min">
                    <input type="number" name="steentjes_max" placeholder="Max">
                    </br>
                    <label>prijs:</label>
                    <input type="number" name="prijs_min" placeholder="Min">
                    <input type="number" name="prijs_max" placeholder="Max">
                    </br>


                    <button type="submit">Zoeken</button>

                </form>
            </div>


            <div class="row">


                <?php

                foreach ($pakketten as $pakket) {

                ?>

                    <section class="col-4 producten">

                        <div>

                            <a href="Detail.php?pakket_id=<?= $pakket->ID ?>">

                                <img
                                    src="upload/sets/<?= $pakket->fotoNaam ?>"
                                    width="200">

                            </a>

                            <p>
                                <?= $pakket->naam ?>
                            </p>

                            <p>
                                Prijs: € <?= number_format($pakket->prijs, 2, ',', '.') ?>
                            </p>

                        </div>

                    </section>


                <?php

                }

                ?>


            </div>


            <div>

                <a href="?pagina=<?= $pagina - 1 ?>">&lt;</a>

                <?php
                    $hoeveelHeid = CodeBlokkenPakket::vindHoeveelheidPaginas($filterQuery);
                    for($i = 0; $i < $hoeveelHeid; $i++)
                    {
                        ?>
                        <a href="?pagina=<?= $i + 1 ?>"><?= $i + 1?></a>
                        <?php
                    }
                ?>

                <a href="?pagina=<?= $pagina + 1 ?>">&gt;</a>

            </div>

        </div>

    </main>

</body>

</html>
