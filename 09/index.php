<?php

// Part 1: 133015568
$inputs = file('input.txt', FILE_IGNORE_NEW_LINES);
for ($i = 24, $count = count($inputs); $i < $count; $i++) {
    $preamble = array_slice($inputs, $i - 24, 25);

    if (!in_array($inputs[$i + 1], calculatePossibleSums($preamble))) {
        echo 'Part 1: ' . $inputs[$i + 1] . PHP_EOL;

        break;
    }
}

foreach ($inputs as $a => $input) {
    $sum = [$input];
    for ($b = $a + 1, $count = count($inputs); $b < $count; $b++) {
        $sum[] = $inputs[$b];

        $result = array_sum($sum);

        if ($result == 133015568) {
            echo 'Part 2: ' . (min($sum) + max($sum)) . PHP_EOL;

            break 2;
        }

        if ($result > 133015568) {
            break;
        }
    }
}

function calculatePossibleSums(array $preamble): array
{
    $results = [];

    foreach ($preamble as $a => $aValue) {
        foreach ($preamble as $b => $bValue) {
            if ($a !== $b) {
                $results[] = $aValue + $bValue;
            }
        }
    }

    return $results;
}