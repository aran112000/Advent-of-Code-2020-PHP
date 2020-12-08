<?php

$instructions = file('input');

function run(array $instructions): int {
    for ($accumulator = 0, $instructionsProcessed = [], $i = 0, $count = count($instructions); $i < $count;) {
        if (in_array($i, $instructionsProcessed)) {
            throw new Exception($accumulator);
        }

        $instructionsProcessed[] = $i;

        [$operation, $argument] = explode(' ' , $instructions[$i]);

        if ($operation === 'jmp') {
            $i += $argument;
            continue;
        }

        if ($operation === 'acc') $accumulator += $argument;

        $i++;
    }

    return $accumulator;
}

try {
    run($instructions);
} catch (Exception $exception) {
    echo 'Part 1: ' . $exception->getMessage() . PHP_EOL;
}

$result = 0;
foreach ($instructions as $i => $instruction) {
    $argument = substr($instruction, 0, 3);

    if ($argument === 'acc') continue;

    $tmp = $instructions;
    $tmp[$i] = str_replace($argument, $argument == 'jmp' ? 'nop' : 'jmp', $instruction);

    try {
        $result = run($tmp);
        echo "Part 2: $result\n";
        break;
    } catch (Exception $e) {

    }
}

