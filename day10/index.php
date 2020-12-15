<?php

$inputs = file('input.txt', FILE_IGNORE_NEW_LINES);
$inputs[] = 0;
sort($inputs);
$inputs[] = end($inputs) + 3;

// Part 1
for ($results = [1 => 0, 3 => 0], $i = 0, $total = count($inputs) - 1; $i < $total; $i++)
    $results[($inputs[$i + 1] - $inputs[$i])]++;

echo 'Part 1: ' . $results[1] * $results[3] . PHP_EOL;

// Part 2
function paths(int $n, array $inputs, array &$cache)
{
    if (!empty($cache[$n]))
        return $cache[$n];

    $answer = 0;
    for ($i = $n + 1, $total = count($inputs); $i < $total; $i++)
        if ($inputs[$i] - $inputs[$n] < 4)
            $answer += paths($i, $inputs, $cache);

    return $cache[$n] = $answer;
}

$cache = [count($inputs) - 1 => 1];
echo 'Part 2: ' . paths(0, $inputs, $cache) . PHP_EOL;
