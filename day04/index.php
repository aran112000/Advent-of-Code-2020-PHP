<?php

$passports = [];
$passportIndex = 0;
foreach (file('input') as $line) {
    if (!isset($passports[$passportIndex]))
        $passports[$passportIndex] = [];

    $line = trim($line);
    if (empty($line)) {
        $passportIndex++;
        continue;
    }

    $passports[$passportIndex] = array_merge($passports[$passportIndex], explode(' ', $line));
}

// Part 1: 242
$validPassports = 0;
foreach ($passports as $passport) {
    if (count($passport) === 8) {
        $validPassports++;
    } else if (count($passport) === 7 && !strstr(implode(' ', $passport), 'cid:')) {
        $validPassports++;
    }
}

echo $validPassports . PHP_EOL;

// Part 2: 186
$validPassports = count($passports);
foreach ($passports as $passport) {
    if (count($passport) < 7) {
        $validPassports--;
        continue;
    }
    if (count($passport) === 7 && strstr(implode(' ', $passport), 'cid:')) {
        $validPassports--;
        continue;
    }

    foreach ($passport as $rule) {
        [$rule, $value] = explode(':', $rule, 2);

        if ($rule === 'byr') {
            if ($value < 1920 || $value > 2002) {
                $validPassports--;
                continue 2;
            }

            continue;
        }

        if ($rule === 'iyr') {
            if ($value < 2010 || $value > 2020) {
                $validPassports--;
                continue 2;
            }

            continue;
        }
        if ($rule === 'eyr') {
            if ($value < 2020 || $value > 2030) {
                $validPassports--;
                continue 2;
            }

            continue;
        }
        if ($rule === 'hgt') {
            if (strstr($value, 'cm')) {
                if ((int) $value < 150 || (int) $value > 193) {
                    $validPassports--;
                    continue 2;
                }

                continue;
            }

            if (strstr($value, 'in')) {
                if ((int) $value < 59 || (int) $value > 76) {
                    $validPassports--;
                    continue 2;
                }

                continue;
            }

            $validPassports--;
            continue 2;
        }
        if ($rule === 'hcl') {
            if (!preg_match('/#[0-9a-f]{6}/mis', $value)) {
                $validPassports--;
                continue 2;
            }

            continue;
        }
        if ($rule === 'ecl') {
            if (!in_array($value, ['amb', 'blu', 'brn', 'gry', 'grn', 'hzl', 'oth'])) {
                $validPassports--;
                continue 2;
            }

            continue;
        }
        if ($rule === 'pid') {
            if (!preg_match('#^\d{9}$#', $value)) {
                $validPassports--;
                continue 2;
            }

            continue;
        }
        if ($rule === 'cid') {
            continue;
        }
    }
}

echo $validPassports;