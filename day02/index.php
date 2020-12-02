<?php

$p1 = $p2 = 0;
foreach (file('input') as $line) {
    preg_match('#(?<min>\d+)+\-(?<max>\d+) (?<l>\w): (?<p>\w+)#', $line, $m);

    $occurrences = count_chars($m['p'])[ord($m['l'])];
    if ($occurrences >= $m['min'] && $occurrences <= $m['max'])
        $p1++;
    if ($m['p'][$m['min']-1] == $m['l'] ^ $m['p'][$m['max']-1] == $m['l'])
        $p2++;
}

echo 'Part 1: ' . $p1 . PHP_EOL;
echo 'Part 2: ' . $p2 . PHP_EOL;
