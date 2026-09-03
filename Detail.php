<?php

include "classes/database.php";

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
                            <img src="upload/product.jpg" alt="Product afbeelding">
                        </div>
                    </div>

                    <div class="col-md-5">

                        <h4 class="mb-3">
                            Product naam
                        </h4>

                        <p>
                        Merk:
                        </p>

                        <p>
                        Thema:
                        </p>

                        <p>
                        Leeftijd:
                        </p>

                        <p>
                        Steentjes:
                        </p>

                        <p>
                        Prijs:
                        </p>

                        <p>
                        Voorraad:
                        </p>

                    </div>

                </div>
                <div class="row mt-4">

                    <div class="beschrijving-container">

                        <p>
                            <strong>Beschrijving:</strong>
                        </p>

                        <div class="beschrijving">
                            Product omschrijving
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

</body>

</html>