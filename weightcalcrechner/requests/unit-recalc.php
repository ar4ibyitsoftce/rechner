<?php

$units = $_POST['units'];
$density = $_POST['density'];
$length = $_POST['length'];
$width = $_POST['width'];
$strength = $_POST['strength'];

if((!$density || $density == 0)
    || (!$length || $length == 0)
    || (!$width || $width == 0)
    || (!$strength || $strength == 0)
    || !$units){
    echo json_encode([
        'success' => 0
    ]);

    exit(0);
}

if($units == 'metric'){
    $calcDensity = (float)$density * 99.78;
    $calcLength = (float)$length * 25.4;
    $calcWidth = (float)$width * 25.4;
    $calcStrength = (float)$strength * 25.4;

    echo json_encode([
        'success' => 1,
        'units' => $units,
        'density' =>  round($calcDensity),
        'length' => round($calcLength),
        'width' => round($calcWidth),
        'strength' => round($calcStrength),
        'unitTumbler' => 1
    ]);

    exit(0);
} else {
    $calcDensity = (float)$density / 99.78;
    $calcLength = (float)$length / 25.4;
    $calcWidth = (float)$width / 25.4;
    $calcStrength = (float)$strength / 25.4;

    echo json_encode([
        'success' => 1,
        'units' => $units,
        'density' =>  round($calcDensity, 2),
        'length' => round($calcLength, 2),
        'width' => round($calcWidth,2),
        'strength' => round($calcStrength,2),
        'unitTumbler' => 2
    ]);

    exit(0);
}
