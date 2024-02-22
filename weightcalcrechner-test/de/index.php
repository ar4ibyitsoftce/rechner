<?php

$weightcalc = include_once '../../config/weightcalc.php';

$materials = $weightcalc['material']['translate']['de'];
$bulkMetric = $weightcalc['material']['values']['metric'];
$bulkImperial = $weightcalc['material']['values']['imperial'];
//echo '<pre>';
//var_dump($bulk);
//echo '</pre>';
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
                            <h3 class="fw-normal">Rechner Plattengewichte</h3>
                            <h5 class="fw-normal">Ihr Helfer bei der Plattengewichtsberechnung</h5>
                        </div>

                        <div class="card-body">
                            <form class="" id="calcBlocks" method="POST" action="../requests/rechner.php">
                                <input type="hidden" name="unit-tumbler" class="js-unit-tumbler" value="1">

                                <div class="border-bottom pb-2">
                                    <div class="row">
                                        <div class="col-md-2">Einheiten:</div>

                                        <div class="col-md-3">
                                            <input name="units" type="radio" value="metric" class="form-check-input js-unit" id="unitMetrisch" checked>
                                            <label class="form-check-label" for="unitMetrisch">Metrisch</label>
                                        </div>

                                        <div class="col-md-3">
                                            <input name="units" type="radio" value="imperial" class="form-check-input js-unit" id="unitImperial">
                                            <label class="form-check-label" for="unitImperial">Imperial</label>
                                        </div>
                                    </div>
                                </div>

                                <div id="form-blk">
                                    <div class="row border-bottom mb-2 pb-2">
                                        <h4 class="mt-2">Platte <span>1</span></h4>

                                        <div class="col-6">
                                            <div>
                                                <label class="form-label">Material</label>
                                                <select class="form-control js-material">
                                                    <?php
                                                    foreach ($materials as $key => $material) {
                                                        echo "<option value='$key' data-density='$bulkMetric[$key]' data-type='metric' class=''>$material</option>";
                                                        echo "<option value='$key' data-density='$bulkImperial[$key]' data-type='imperial' class='d-none'>$material</option>";
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="length" class="form-label">Länge in <span class="js-mm-inch">mm</span></label>
                                                <input type="number" class="form-control js-input-field js-length" name="length" id="length" placeholder="z.B. 400" data-place-metric="z.B. 400" data-place-imperial="z.B. 16">
                                            </div>
                                            <div>
                                                <label for="width" class="form-label">Breite in <span class="js-mm-inch">mm</span></label>
                                                <input type="number" class="form-control js-input-field js-width" name="width" id="width" placeholder="z.B. 500" data-place-metric="z.B. 500" data-place-imperial="z.B. 20">
                                            </div>
                                            <div>
                                                <label for="strength" class="form-label">Stärke in <span class="js-mm-inch">mm</span></label>
                                                <input type="number" class="form-control js-input-field js-strength" name="strength" id="strength" placeholder="z.B. 19" data-place-metric="z.B. 19" data-place-imperial="z.B. 0.50">
                                            </div>
                                        </div>

                                        <div class="col-6">
                                            <div>
                                                <label for="bulk" class="form-label">Rohdichte in <span class="js-m3-gal">kg/m³</span></label>
                                                <input type="number" class="form-control js-input-field js-density" name="density" placeholder="z.B. 1000" data-place-metric="z.B. 1000" data-place-imperial="z.B. 10">
                                            </div>

                                            <div class="alert alert-secondary mt-4">
                                                *Achtung: Aufgrund von Schwankungen in den Rohdichten verschiedener Platten-Hersteller, kann das hier berechnete Gewicht vom tatsächlichen Gewicht abweichen. Passen Sie ggf. die Rohdichte manuell an.'
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row border-bottom mb-2 pb-2">
                                    <div class="col-10 mt-2">Besteht Ihre Platte aus mehreren Teilen, z.B. Holz und Spiegel? Fügen Sie eine weitere Platte hinzu:</div>
                                    <div class="col-2 text-end">
                                        <button type="button" class="btn btn-primary w40-px" id="add-row-btn">+</button>
                                    </div>
                                </div>

                                <div class="row fs-3">
                                    <div class="col-12 text-end">
                                        <span>
                                            Gesamtgewicht*
                                            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-bag-fill mb-3" viewBox="0 0 16 16">
                                              <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                                            </svg>
                                        </span>
                                        <span id="totalWeight">0.00</span>
                                        <span class="js-kg-lb">kg</span>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="d-none" id="platte-template">
            <div class="row border-bottom mb-2 pb-2">
                <div class="col-12 d-flex justify-content-between">
                    <div class=""><h4 class="mt-2">Platte <span class="platte-num"></span></h4></div>
                    <div class="text-end"><button type="button" class="btn btn-danger w40-px" onclick="removeBlk(this)">-</button></div>
                </div>


                <div class="col-6">
                    <div>
                        <label class="form-label">Material</label>
                        <select class="form-control js-material">
                            <?php
                            foreach ($materials as $key => $material) {
                                echo "<option value='$key' data-density='$bulkMetric[$key]' data-type='metric' class=''>$material</option>";
                                echo "<option value='$key' data-density='$bulkImperial[$key]' data-type='imperial' class='d-none'>$material</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="length" class="form-label">Länge in <span class="js-mm-inch">mm</span></label>
                        <input type="number" class="form-control js-input-field js-length" name="length" id="length" placeholder="z.B. 400" data-place-metric="z.B. 400" data-place-imperial="z.B. 16">
                    </div>
                    <div>
                        <label for="width" class="form-label">Breite in <span class="js-mm-inch">mm</span></label>
                        <input type="number" class="form-control js-input-field js-width" name="width" id="width" placeholder="z.B. 500" data-place-metric="z.B. 500" data-place-imperial="z.B. 20">
                    </div>
                    <div>
                        <label for="strength" class="form-label">Stärke in <span class="js-mm-inch">mm</span></label>
                        <input type="number" class="form-control js-input-field js-strength" name="strength" id="strength" placeholder="z.B. 19" data-place-metric="z.B. 19" data-place-imperial="z.B. 0.50">
                    </div>
                </div>

                <div class="col-6">
                    <div>
                        <label for="bulk" class="form-label">Rohdichte in <span class="js-m3-gal">kg/m³</span></label>
                        <input type="number" class="form-control js-input-field js-density" name="density" placeholder="z.B. 1000" data-place-metric="z.B. 1000" data-place-imperial="z.B. 10">
                    </div>

                    <div class="alert alert-secondary mt-4">
                        *Achtung: Aufgrund von Schwankungen in den Rohdichten verschiedener Platten-Hersteller, kann das hier berechnete Gewicht vom tatsächlichen Gewicht abweichen. Passen Sie ggf. die Rohdichte manuell an.'
                    </div>
                </div>
            </div>
        </div>

        <script src="../js/ajax.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>