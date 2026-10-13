<?php

$lat_Centro = 36.866329;
$lng_Centro = -6.178427;

$lat_Casa = 36.782694;
$lng_Casa = -6.342361;

function calcularDistancia($lat1, $lng1, $lat2, $lng2) {
    $radioTierra = 6371000; 

    $lat1_rad = deg2rad($lat1);
    $lat2_rad = deg2rad($lat2);
    $deltaLat = deg2rad($lat2 - $lat1);
    $deltaLng = deg2rad($lng2 - $lng1);

    $a = sin($deltaLat / 2) * sin($deltaLat / 2) +
         cos($lat1_rad) * cos($lat2_rad) *
         sin($deltaLng / 2) * sin($deltaLng / 2);

    $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

    return $radioTierra * $c;
}

$metros = calcularDistancia($lat_Centro, $lng_Centro, $lat_Casa, $lng_Casa);

echo "Distancia en línea recta: " . round($metros) . " metros<br>";
echo "Son " . round($metros / 1000, 2) . " km";
?>