<?php

$boardingPasses = array_flip(file('input'));
foreach ($boardingPasses as $boardingPass => &$id) {
    for ($rows = range(0, 127), $i = 0, $rowCount = count($rows); $rowCount > 1; $i++) {
        $rowCount = intdiv($rowCount, 2);
        if ($boardingPass[$i] === 'F') {
            $rows = array_splice($rows, 0, $rowCount);
            continue;
        }
        $rows = array_splice($rows, -$rowCount, $rowCount);
    }

    for ($columns = range(0, 7), $columnCount = count($columns); $columnCount > 1; $i++) {
        $columnCount = intdiv($columnCount, 2);
        if ($boardingPass[$i] === 'L') {
            $columns = array_splice($columns, 0, $columnCount);
            continue;
        }
        $columns = array_splice($columns, -$columnCount, $columnCount);
    }
    $id = $rows[0] * 8 + $columns[0];
}

sort($boardingPasses);

echo 'Part 1: ' . end($boardingPasses) . PHP_EOL;

for ($i = 1, $total = count($boardingPasses) - 2; $i < $total; $i++) {
    if ($boardingPasses[$i] !== $boardingPasses[$i-1] + 1 || $boardingPasses[$i] !== $boardingPasses[$i+1] - 1) {
        echo 'Part 2: ' . ++$boardingPasses[$i];
        break;
    }
}