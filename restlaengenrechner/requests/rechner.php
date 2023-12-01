<?php

$outer = $_POST['outer-diameter'] ?? null;
$inner = $_POST['inner-diameter'] ?? null;
$edge = $_POST['edge-thickness'] ?? null;

if((!$outer || $outer == 0)
    || (!$inner || $inner == 0)
    || (!$edge || $edge == 0)){
    echo json_encode([
        'success' => 0,
        'text' => 'Füllen Sie alle Felder im Formular aus'
    ]);

    exit(0);
}

if($outer <= $inner){
    echo json_encode([
        'success' => 0,
        'text' => 'Der Außendurchmesser muss größer sein als der Innendurchmesser'
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