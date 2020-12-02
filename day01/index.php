<?php

$expenses = file('input');

// Part 1
foreach ($expenses as $index1 => $expense1) {
    foreach ($expenses as $index2 => $expense2) {
        if ($index1 !== $index2 && ($expense1 + $expense2) === 2020) {
            echo 'Part 1: ' . $expense1 * $expense2 . PHP_EOL;
        }
    }
}


// Part 2
foreach ($expenses as $index1 => $expense1) {
    foreach ($expenses as $index2 => $expense2) {
        foreach ($expenses as $index3 => $expense3) {
            if ($index1 !== $index2 && $index2 !== $index3 && $index1 !== $index3 && ($expense1 + $expense2 + $expense3) === 2020) {
                echo 'Part 2: ' . $expense1 * $expense2 * $expense3 . PHP_EOL;
            }
        }
    }
}