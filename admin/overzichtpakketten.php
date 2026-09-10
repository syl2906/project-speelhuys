<!DOCTYPE html>
<html>

    <?php
    require_once "../classes/codeblokkenpakket.php";
    require_once "../classes/merk.php";
    require_once "../classes/thema.php";

    // TODO: Authenticatie check.

    $pakketten = CodeBlokkenPakket::vindAlleMetZoekTerm("");
    ?>
    
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
            <a class="btn btn-primary" href="insertpakket.php">Maak nieuw pakket</a>
            <div class="row justify-content-center">

                <table class="table">
                    <tr>
                        <th>Foto</th>
                        <th>Naam</th>
                        <th>Merk</th>
                        <th>Thema</th>
                        <th>Leeftijd</th>
                        <th>Prijs</th>
                        <th>Steentjes</th>
                        <th>Voorraad</th>
                        <th>Beheer</th>
                    </tr>

                <?php
                foreach($pakketten as $pakket)
                {
                    $themaNaam = "";
                    if($pakket->themeID != 0)
                    {
                        $thema = new Thema();
                        if($thema->initializeer($pakket->themeID))
                        {
                            $themaNaam = $thema->naam;
                        }
                    }

                    $merkNaam = "";
                    $merk = new Merk();
                    if($merk->initializeer($pakket->brandID))
                    {
                        $merkNaam = $merk->naam;
                    }

                    ?>
                    <tr>
                        <td><img src="../upload/sets/<?=$pakket->fotoNaam?>" width="50" alt="Foto"/></td>
                        <td><?=$pakket->naam?></td>
                        <td><?=$merkNaam?></td>
                        <td><?=$themaNaam?></td>
                        <td><?=$pakket->age?></td>
                        <td><?=$pakket->prijs?></td>
                        <td><?=$pakket->steentjes?></td>
                        <td><?=$pakket->voorraad?></td>
                        <td><a href="beheerpakket.php?pakket_id=<?=$pakket->ID?>">Beheer</a></td>
                    </tr>
                    <?php
                }
                ?>

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
