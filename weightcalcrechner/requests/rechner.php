<?php

$density = $_POST['density'];
$length = $_POST['length'];
$width = $_POST['width'];
$strength = $_POST['strength'];


// if((!$density || $density == 0)
//     || (!$length || $length == 0)
//     || (!$width || $width == 0)
//     || (!$strength || $strength == 0)){
//     echo json_encode([
//         'success' => 0
//     ]);

//     exit(0);
// }

$result = [
    'weight' => 0,
    'success' => 1,
    'errors' => [],
    'data' => [],
];

$errors = [];

foreach ($density as $key => $item) {
    if(!$length[$key] || $length[$key] == 0){
        $errors[] = 'length-error-'.$key;
    }

    if(!$width[$key] || $width[$key] == 0){
        $errors[] = 'width-error-'.$key;
    }

    if(!$strength[$key] || $strength[$key] == 0){
        $errors[] = 'strength-error-'.$key;
    }

    if(!$density[$key] || $density[$key] == 0){
        $errors[] = 'density-error-'.$key;
    }

    if(count($errors)){
        $result['errors'] = $errors;
    }

    $volume = ((float)$length[$key] * (float)$width[$key] * (float)$strength[$key]) / 1000;
    $weight = ((float)$density[$key] * (float)$volume) / 1000000;
    

    $result['weight'] += $weight;

    $result['data'][] = [
        'weight' => number_format($weight, 2, ',', ' '),
    ];
}


echo json_encode($result);

exit(0);