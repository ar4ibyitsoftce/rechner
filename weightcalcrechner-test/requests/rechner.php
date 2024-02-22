<?php

//$units = $_POST['units'];
$density = $_POST['density'];
$length = $_POST['length'];
$width = $_POST['width'];
$strength = $_POST['strength'];
//$unitTumbler = $_POST['unit-tumbler'];


if((!$density || $density == 0)
    || (!$length || $length == 0)
    || (!$width || $width == 0)
    || (!$strength || $strength == 0)){
    //|| !$units || !$unitTumbler
    echo json_encode([
        'success' => 0
    ]);

    exit(0);
}

//if(($units == 'metric' && $unitTumbler == 2) || ($units == 'imperial' && $unitTumbler == 2)){
//    $length = (float)$length * 25.4;
//    $width = (float)$width * 25.4;
//    $strength = (float)$strength * 25.4;
//    $density = (float)$density * 99.78;
//}

$result = [
    'weight' => 0,
    'success' => 1,
    'data' => [],
];

foreach ($density as $key => $item) {
    $volume = ((float)$length[$key] * (float)$width[$key] * (float)$strength[$key]) / 1000;
    $weight = ((float)$density[$key] * (float)$volume) / 1000000;

//    if($units == 'imperial') $weight =  $weight * 2.2046;

    $result['weight'] += $weight;

    $result['data'][] = [
        'weight' => number_format($weight, 2, ',', ' '),
//        'unitTumbler' => $unitTumbler,
//        'units' => $units,
    ];
}


echo json_encode($result);

exit(0);