<?php

$input = file('input.txt', FILE_IGNORE_NEW_LINES);
foreach ($input as $i => $row) {
    $input[$i] = str_split($row);
}

// Part 1
$changes = null;
while ($changes !== 0) {
    $changes = 0;
    $seatsOccupied = 0;

    $resultingInput = $input;

    foreach ($input as $y => $row) {
        foreach ($row as $x => $space) {
            if ($space === '.') {
                continue;
            }

            $occupiedSeatsAdjacent = substr_count(implode('', [
                $input[$y-1][$x-1] ?? '',
                $input[$y-1][$x] ?? '',
                $input[$y-1][$x+1] ?? '',
                $input[$y][$x-1] ?? '',
                $input[$y][$x+1] ?? '',
                $input[$y+1][$x-1] ?? '',
                $input[$y+1][$x] ?? '',
                $input[$y+1][$x+1] ?? '',
            ]), '#');

            if ($space === 'L' && $occupiedSeatsAdjacent === 0) {
                // If a seat is empty (L) and there are no occupied seats adjacent to it, the seat becomes occupied.
                $resultingInput[$y][$x] = '#';
                $changes++;
            } elseif ($space === '#' && $occupiedSeatsAdjacent >= 4) {
                // If a seat is occupied (#) and four or more seats adjacent to it are also occupied, the seat becomes empty.
                $resultingInput[$y][$x] = 'L';
                $changes++;
            }

            if ($resultingInput[$y][$x] === '#') {
                $seatsOccupied++;
            }
        }
    }

    $input = $resultingInput;
}

echo "Part 1: $seatsOccupied\n";

// Part 2
$input = file('input.txt', FILE_IGNORE_NEW_LINES);
foreach ($input as $i => $row) {
    $input[$i] = str_split($row);
}
$iterations = 0;
$changes = null;
while ($changes !== 0 && $iterations < 5000) {
    $iterations++;
    $changes = 0;
    $seatsOccupied = 0;

    $resultingInput = $input;

    foreach ($input as $y => $row) {
        foreach ($row as $x => $space) {
            if ($space === '.') {
                continue;
            }

            $occupiedSeatsAdjacent = occupiedAdjacentSeats($input, $x, $y);

            if ($space === 'L' && $occupiedSeatsAdjacent === 0) {
                // If a seat is empty (L) and there are no occupied seats adjacent to it, the seat becomes occupied.
                $resultingInput[$y][$x] = '#';
                $changes++;
            } elseif ($space === '#' && $occupiedSeatsAdjacent >= 5) {
                // If a seat is occupied (#) and four or more seats adjacent to it are also occupied, the seat becomes empty.
                // Part 2 changes this: it now takes five or more visible occupied seats for an occupied seat to become empty (rather than four or more from the previous rules)
                $resultingInput[$y][$x] = 'L';
                $changes++;
            }

            if ($resultingInput[$y][$x] === '#') {
                $seatsOccupied++;
            }
        }
    }

    $input = $resultingInput;
}

echo "Part 2: $seatsOccupied\n";

function occupiedAdjacentSeats(array $input, int $startX, int $startY): int
{
    $xLength = count(end($input)) - 1;
    $yLength = count($input) - 1;

    $count = 0;

    // Up, Left
    $x = $startX; $y = $startY;
    while ($x >= 0 && $y >= 0) {
        $y--;
        $x--;
        if (($input[$y][$x] ?? '') === 'L') {
            break;
        } elseif (($input[$y][$x] ?? '') === '#') {
            $count++;
            break;
        }
    }

    // Up
    $x = $startX; $y = $startY;
    while ($y >= 0) {
        $y--;
        if (($input[$y][$x] ?? '') === 'L') {
            break;
        } elseif (($input[$y][$x] ?? '') === '#') {
            $count++;
            break;
        }
    }

    // Up, Right
    $x = $startX; $y = $startY;
    while ($x <= $xLength && $y >= 0) {
        $y--;
        $x++;
        if (($input[$y][$x] ?? '') === 'L') {
            break;
        } elseif (($input[$y][$x] ?? '') === '#') {
            $count++;
            break;
        }
    }

    // Left
    $x = $startX; $y = $startY;
    while ($x >= 0) {
        $x--;
        if (($input[$y][$x] ?? '') === 'L') {
            break;
        } elseif (($input[$y][$x] ?? '') === '#') {
            $count++;
            break;
        }
    }

    // Right
    $x = $startX; $y = $startY;
    while ($x <= $xLength) {
        $x++;
        if (($input[$y][$x] ?? '') === 'L') {
            break;
        } elseif (($input[$y][$x] ?? '') === '#') {
            $count++;
            break;
        }
    }

    // Down, Left
    $x = $startX; $y = $startY;
    while ($x >= 0 && $y <= $yLength) {
        $y++;
        $x--;
        if (($input[$y][$x] ?? '') === 'L') {
            break;
        } elseif (($input[$y][$x] ?? '') === '#') {
            $count++;
            break;
        }
    }

    // Down
    $x = $startX; $y = $startY;
    while ($y <= $yLength) {
        $y++;
        if (($input[$y][$x] ?? '') === 'L') {
            break;
        } elseif (($input[$y][$x] ?? '') === '#') {
            $count++;
            break;
        }
    }

    // Down, Right
    $x = $startX; $y = $startY;
    while ($x <= $xLength && $y <= $yLength) {
        $y++;
        $x++;
        if (($input[$y][$x] ?? '') === 'L') {
            break;
        } elseif (($input[$y][$x] ?? '') === '#') {
            $count++;
            break;
        }
    }

    return $count;
}