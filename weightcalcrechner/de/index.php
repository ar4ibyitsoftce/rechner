<?php

$weightcalc = include_once '../../config/weightcalc.php';

$materials = $weightcalc['material']['translate']['de'];
$bulkMetric = $weightcalc['material']['values']['metric'];

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
                    <div class="card mb-8 rounded-0 shadow-sm m-auto">
                        <div class="card-header mb-0 pb-0">
                            <div class="fw-normal">Rechner Plattengewichte</div>
                            <h4 class="fw-normal mb-0">Ihr Helfer bei der Plattengewichtsberechnung</h4>
                        </div>

                        <div class="card-body">
                            <form class="" id="calcBlocks" method="POST" action="../requests/rechner.php">
                                <input type="hidden" name="unit-tumbler" class="js-unit-tumbler" value="1">
                                <input type="hidden" name="units" value="metric">

                                <div id="form-blk">
                                    <div class="row oster-border-bottom mb-3 pb-3">
                                        <h4 class="mb-0">Platte <span>1</span></h4>

                                        <div class="col-6">
                                            <div>
                                                <label class="form-label">Material</label>
                                                <select class="form-control js-material" onchange="changeMaterial(this)">
                                                    <?php
                                                        foreach ($materials as $key => $material) {
                                                            echo "<option value='$key' data-density='$bulkMetric[$key]' data-type='metric' class=''>$material</option>";
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div>
                                                <label for="length" class="form-label">Länge in <span class="js-mm-inch">mm</span></label>
                                                <input type="number" class="form-control js-input-field js-length" name="length[1]" id="length" placeholder="z.B. 400" data-place-metric="z.B. 400" data-place-imperial="z.B. 16">
                                                <div class="ci-form-error length-error-1 d-none">Bitte geben Sie die Länge ein</div>
                                            </div>
                                            <div>
                                                <label for="width" class="form-label">Breite in <span class="js-mm-inch">mm</span></label>
                                                <input type="number" class="form-control js-input-field js-width" name="width[1]" id="width" placeholder="z.B. 500" data-place-metric="z.B. 500" data-place-imperial="z.B. 20">
                                                <div class="ci-form-error width-error-1 d-none">Bitte geben Sie die Breite ein</div>
                                            </div>
                                            <div>
                                                <label for="strength" class="form-label">Stärke in <span class="js-mm-inch">mm</span></label>
                                                <input type="number" class="form-control js-input-field js-strength" name="strength[1]" id="strength" placeholder="z.B. 19" data-place-metric="z.B. 19" data-place-imperial="z.B. 0.50">
                                                <div class="ci-form-error strength-error-1 d-none">Bitte geben Sie die Stärke ein</div>
                                            </div>
                                        </div>

                                        <div class="col-6 overflow-hidden">
                                            <div>
                                                <label for="bulk" class="form-label">Rohdichte in <span class="js-m3-gal">kg/m³</span></label>
                                                <input type="number" class="form-control js-input-field js-density" name="density[1]" placeholder="z.B. 1000" data-place-metric="z.B. 1000" data-place-imperial="z.B. 10">
                                                <div class="ci-form-error density-error-1 d-none">Bitte geben Sie die Rohdichte ein</div>
                                            </div>

                                            <div class="alert alert-secondary">
                                                *Achtung: Aufgrund von Schwankungen in den Rohdichten verschiedener Platten-Hersteller, kann das hier berechnete Gewicht vom tatsächlichen Gewicht abweichen. Passen Sie ggf. die Rohdichte manuell an.'
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="js-weight-blk-all js-weight-blk-1 text-end d-none">
                                                <span class="total-weight">0.00</span>
                                                <span class="js-kg-lb weight-kg">kg</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row oster-border-bottom mb-2 pb-4">
                                    <div class="col-10 mt-2 bottom-text">Besteht Ihre Platte aus mehreren Teilen, z.B. Holz und Spiegel? Fügen Sie eine weitere Platte hinzu:</div>
                                    <div class="col-2 text-end plus-btn__wrap">
                                        <button type="button" class="plus-btn" id="add-row-btn"><div class="mt--3">+</div></button>
                                    </div>
                                </div>

                                <div class="row fs-1">
                                    <div class="col-6">
                                        <button class="oster-button" type="submit">Berechnen</button>
                                    </div>
                                    <div class="col-6 text-end">
                                        <span>
                                            Gesamtgewicht*
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
            <div class="row oster-border-bottom mb-3 pb-3">
                <div class="col-12 d-flex justify-content-between">
                    <div class=""><h4 class="mb-0">Platte <span class="platte-num"></span></h4></div>
                    <div class="text-end"><button type="button" class="plus-btn" onclick="removeBlk(this)"><div class="mt--3">-</div></button></div>
                </div>


                <div class="col-6">
                    <div>
                        <label class="form-label">Material</label>
                        <select class="form-control js-material" onchange="changeMaterial(this)">
                            <?php
                            foreach ($materials as $key => $material) {
                                echo "<option value='$key' data-density='$bulkMetric[$key]' data-type='metric' class=''>$material</option>";
                            }
                            ?>
                        </select>
                    </div>
                    <div>
                        <label for="length" class="form-label">Länge in <span class="js-mm-inch">mm</span></label>
                        <input type="number" class="form-control js-input-field js-length" name="length[0]" id="length" placeholder="z.B. 400" data-place-metric="z.B. 400" data-place-imperial="z.B. 16">
                        <div class="ci-form-error d-none">Bitte geben Sie die Länge ein</div>
                    </div>
                    <div>
                        <label for="width" class="form-label">Breite in <span class="js-mm-inch">mm</span></label>
                        <input type="number" class="form-control js-input-field js-width" name="width[0]" id="width" placeholder="z.B. 500" data-place-metric="z.B. 500" data-place-imperial="z.B. 20">
                        <div class="ci-form-error d-none">Bitte geben Sie die Breite ein</div>
                    </div>
                    <div>
                        <label for="strength" class="form-label">Stärke in <span class="js-mm-inch">mm</span></label>
                        <input type="number" class="form-control js-input-field js-strength" name="strength[0]" id="strength" placeholder="z.B. 19" data-place-metric="z.B. 19" data-place-imperial="z.B. 0.50">
                        <div class="ci-form-error d-none">Bitte geben Sie die Stärke ein</div>
                    </div>
                </div>

                <div class="col-6 overflow-hidden">
                    <div>
                        <label for="bulk" class="form-label">Rohdichte in <span class="js-m3-gal">kg/m³</span></label>
                        <input type="number" class="form-control js-input-field js-density" name="density[0]" placeholder="z.B. 1000" data-place-metric="z.B. 1000" data-place-imperial="z.B. 10">
                        <div class="ci-form-error d-none">Bitte geben Sie die Rohdichte ein</div>
                    </div>  
                </div>

                <div class="col-12">
                    <div class="js-weight-blk-all js-weight-blk-1 text-end d-none">
                        <span class="total-weight">0.00</span>
                        <span class="js-kg-lb weight-kg">kg</span>
                    </div>
                </div>
            </div>
        </div>

        <script src="../js/ajax.js"></script>
        <script src="../js/main.js"></script>
    </body>
</html>