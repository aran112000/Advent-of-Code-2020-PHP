<?php

// Part 1: 460
$correctPasswords = 0;
foreach (file('input') as $line) {
    preg_match('#(?<min>[0-9]+)+\-(?<max>[0-9]+) (?<l>[a-z])\: (?<p>.*)#', $line, $m);

    $occurrences = count_chars($m['p'])[ord($m['l'])];
    if ($occurrences >= $m['min'] && $occurrences <= $m['max']) {
        $correctPasswords++;
    }
}

echo $correctPasswords . PHP_EOL;

// Part 2: 251
$correctPasswords = 0;
foreach (file('input') as $line) {
    preg_match('#(?<p1>[0-9]+)+\-(?<p2>[0-9]+) (?<l>[a-z])\: (?<p>.*)#', $line, $m);

    if ($m['p'][$m['p1']-1] === $m['l'] ^ $m['p'][$m['p2']-1] === $m['l']) {
        $correctPasswords++;
    }
}

echo $correctPasswords . PHP_EOL;