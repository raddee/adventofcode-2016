<?php
$sum = 0;

foreach (file('4-1.txt') as $line) {
    // Convert input to parts
    preg_match('/((\w|-)*)-([0-9]*)\[(\w*)\]/i', $line, $matches);
    $sectorid = $matches[3];
    $checksum = $matches[4];
    $room = $matches[1];

    // Count letters
    $letters = [];
    for ($x = 0; $x < strlen($room); $x++) {
        $c = substr($room, $x, 1);
        if ($c == '-') { continue; }

        if (!isset($letters[$c])) { $letters[$c] = 0; }
        $letters[$c]++;
    }

    // Sort by value, then by key
    array_multisort($letters, SORT_DESC, $letters, SORT_ASC, array_keys($letters));

    // Calculate my checksum
    $myChecksum = substr(implode('', array_keys($letters)), 0, strlen($checksum));

    if ($myChecksum == $checksum) {
        $sum += $sectorid;
    }
}

echo $sum;