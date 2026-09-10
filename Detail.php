<?php

include "classes/database.php";
include "classes/codeblokkenpakket.php";
include "classes/merk.php";
include "classes/thema.php";

$pakket = new CodeBlokkenPakket();

if(isset($_GET["pakket_id"])) {

    if(!$pakket->initializeer($_GET["pakket_id"])) {
        echo "geen pakket gevonden!";
        exit;
    }

}
else {
    echo "geen pakket geselecteerd";
    exit;
}

$merk = new Merk();

$merk->initializeer($pakket->brandID);

$thema = new Thema();
if(!$thema->initializeer($pakket->themeID))
{
    $thema = null;
}


?>





<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>speelhuys</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body class="bg-light">

    <div class="container mt-4">
        <nav class="mb-2">
            <a href="index.php" class="btn btn-outline-secondary">
                Homepagina
            </a>

            <a href="login.php" class="btn btn-outline-secondary">
                Inloggen
            </a>
        </nav>

        <div class="detail-card">

            <div class="card-body">

                <h1 class="text-center mb-5">
                    Speelhuys
                </h1>

                <div class="row align-items-center">

                    <div class="col-md-5 text-center">

                        <div class="image-placeholder">
                            <img src="upload/sets/<?= $pakket->fotoNaam ?>" alt="Product afbeelding">
                            
                        </div>
                    </div>

                    <div class="col-md-5">

                        <h4 class="mb-3">
                            <?= $pakket->naam ?>
                        </h4>

                        <p>
                        Merk:
                            <?= $merk->naam ?>
                        </p>

                        <?php
                        if($thema != null)
                        {
                        ?>
                            <p>
                            Thema:
                                <?= $thema->naam ?>
                            </p>
                        <?php } ?>

                        <p>
                        Leeftijd:
                            <?= $pakket->age ?>
                        </p>

                        <p>
                        Steentjes:
                            <?= $pakket->steentjes ?>
                        </p>

                        <p>
                        Prijs:
                           <?= $pakket->prijs ?>
                        </p>

                        <p>
                        Voorraad:
                            <?= $pakket->voorraad ?>
                        </p>

                    </div>

                </div>
                <div class="row mt-4">

                    <div class="beschrijving-container">

                        <p>
                            <strong>Beschrijving:</strong>
                        </p>

                        <div class="beschrijving">
                            <?= $pakket->beschrijving ?>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>