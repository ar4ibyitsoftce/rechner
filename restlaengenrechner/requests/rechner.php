<?php

$outer = $_POST['outer-diameter'] ?? null;
$inner = $_POST['inner-diameter'] ?? null;
$edge = $_POST['edge-thickness'] ?? null;

if(!$outer || $outer == 0){
    echo json_encode([
        'success' => 0,
        'error' => 'aussen-error'
    ]);

    exit(0);
}

if(!$inner || $inner == 0){
    echo json_encode([
        'success' => 0,
        'error' => 'innen-error'
    ]);

    exit(0);
}

if(!$edge || $edge == 0){
    echo json_encode([
        'success' => 0,
        'error' => 'dicke-error'
    ]);

    exit(0);
}

if($outer <= $inner){
    echo json_encode([
        'success' => 0,
        'error' => 'size-error'
    ]);

    exit(0);
}

$numerator = pi() * (pow($outer, 2) - pow($inner, 2));
$denominator = (4 * $edge) * 1000;

$result = $numerator / $denominator;

echo json_encode([
    'success' => 1,
    'text' => number_format(round($result, 2), 2, ',', ' ')
]);

exit(0);