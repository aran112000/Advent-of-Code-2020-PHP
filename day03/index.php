<?php

$mapData = file('input');

// Part 1
$treesHit = 0;
for ($x = 0, $y = 0, $rowsToDecent = count($mapData), $xLength = strlen(trim($mapData[0])); $y < $rowsToDecent; $y++, $x += 3) {
    if ($mapData[$y][$x % $xLength] === '#')
        $treesHit++;
}

echo 'Trees hit: ' . $treesHit . PHP_EOL;


// Part 2
$treesHit = [];
foreach ([['y' => 1, 'x' => 1], ['y' => 1, 'x' => 3], ['y' => 1, 'x' => 5], ['y' => 1, 'x' => 7], ['y' => 2, 'x' => 1]] as $i => $data) {
    $treesHit[$i] = 0;
    for ($x = 0, $y = 0, $rowsToDecent = count($mapData), $xLength = strlen(trim($mapData[0])); $y < $rowsToDecent; $y += $data['y'], $x += $data['x']) {
        if ($mapData[$y][$x % $xLength] === '#')
            $treesHit[$i]++;
    }
}

echo 'Trees hit: ' . array_product($treesHit) . PHP_EOL;