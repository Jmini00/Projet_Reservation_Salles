<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Réservations de salles</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="js/index.js" defer></script>
    </head>
    <body>
        <div class="container p-3">
            <h1>Salles à réserver</h1>

            <div class="row align-items-start mt-5">
                <div class="col-9">
                    <div class="row row-cols-4 gap-2" id="rooms"></div>
                </div>
                <div class="col-3">
                    <div class="row gap-2" id="rooms-reserved"></div>
                </div>
            </div>
        </div>

        <!-- Template pour les cartes de salle à réserver -->
        <template id="room-template">
            <div class="card p-0 col">
                <img class="card-img-top" src="" alt="" style="height: 125px; object-fit: cover">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                    <button type="button" class="btn btn-success">+</button>
                </div>
            </div>
        </template>

        <!-- Template pour les cartes de salle déjà réservées -->
        <template id="room-reserved-template">
            <div class="card p-0 col-12">
                <img class="card-img-top" src="" alt="" style="height: 125px; object-fit: cover">
                <div class="card-body">
                    <h5 class="card-title"></h5>
                    <p class="card-text"></p>
                    <button type="button" class="btn btn-danger">Supprimer</button>
                </div>
            </div>
        </template>
    </body>
</html>
