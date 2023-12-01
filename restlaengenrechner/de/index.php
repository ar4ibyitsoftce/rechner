<?php

//$weightcalc = include_once '../../config/weightcalc.php';

?>
<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rechner Plattengewichte</title>

    <link type="text/css" rel="stylesheet" href="../../lib/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="../css/main.css">

    <script src="../../lib/js/jquery-3.7.3.min.js"></script>
</head>

<body>
<div class="container-md">
    <div class="row">
        <div class="col">
            <div class="card mb-8 rounded-3 shadow-sm m-auto">
                <div class="card-header py-3">
                    <h3 class="fw-normal">Restlängenrechner</h3>
                </div>

                <div class="card-body">
                    <form class="" id="calcBlocks" method="POST" action="../requests/rechner.php">
                        <div class="row mb-2">
                            <div class="col-md-3">
                                <img src="../img/one.png">
                            </div>
                            <div class="col-md-5">
                                <label for="outer-diameter" class="form-label">Außendurchmesser (mm):</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="outer-diameter" id="outer-diameter">
                            </div>
                        </div>

                        <div class="row mb-2">
                            <div class="col-md-3">
                                <img src="../img/two.png">
                            </div>
                            <div class="col-md-5">
                                <label for="inner-diameter" class="form-label">Innendurchmesser (mm):</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="inner-diameter" id="inner-diameter">
                            </div>
                        </div>

                        <div class="row border-bottom mb-2 pb-2">
                            <div class="col-md-3">
                                <img src="../img/three.png">
                            </div>
                            <div class="col-md-5">
                                <label for="edge-thickness" class="form-label">Kantendicke (mm):</label>
                            </div>
                            <div class="col-md-4">
                                <input type="number" class="form-control" name="edge-thickness" id="edge-thickness">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-9">
                                <div class="d-none fs-5">
                                    Auf der Rolle sind noch <span class="fw-bold" id="result-blk">0,00</span> m
                                </div>
                            </div>
                            <div class="col-md-3 text-end">
                                <button class="btn btn-primary btn-sm" type="submit">Berechnen</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="../js/ajax.js"></script>
<script src="../js/main.js"></script>
</body>
</html>