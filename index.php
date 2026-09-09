<?php


include "classes/codeblokkenpakket.php";


$pakketten = CodeBlokkenPakket::vindVoorPagina(1, "");

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

    <div>
        <img src="https://www.pngall.com/wp-content/uploads/5/Lego-Toy-PNG-Download-Image.png" class="rounded float-start" width="200">
    </div>

    <div class="container mt-4">

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
            <input type="text" placeholder="zoeken...">
        </div>


        <div>
            <p>
                Filteren:
                Merk ▼
                Thema ▼
                Leeftijd ▼
                Steentjes ▼
                Prijs ▼
            </p>
        </div>


        <div class="row">


            <?php

            foreach ($pakketten as $pakket)
            {

            ?>

                <section class="producten">

                    <div>

                        <a href="Detail.php?pakket_id=<?= $pakket->ID ?>">

                            <img
                                src="upload/<?= $pakket->fotoNaam ?>"
                                width="100"
                            >

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

            <button><</button>

            <span>1</span>
            <span>2</span>
            <span>3</span>

            <button>></button>

        </div>

    </div>

</main>

</body>

</html>