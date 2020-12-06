<?php

$questions_answered = 0;
foreach (explode("\n\n", file_get_contents('input')) as $group) {
    $questions_answered += count(array_unique(str_split(str_replace("\n", '', $group))));
}

echo "Part 1: $questions_answered\n";

$questions_answered = 0;
foreach (explode("\n\n", file_get_contents('input')) as $group) {
    $questions_answered += count(array_filter(array_count_values(str_split(str_replace("\n", '', $group))), function($value) use ($group) {
        return $value === count(explode("\n", $group));
    }));
}

echo "Part 2: $questions_answered\n";