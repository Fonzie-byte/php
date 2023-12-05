<?php

function variableUniqueId(bool $long = false, string $split = '.', int $base = 36): string
{
    $time = match ($long) {
        true => base_convert(intval(microtime(true) * 1_000_000), 10, $base),
        default => base_convert(time(), 10, $base),
    };

    $length = strlen($time);
    $rand = base_convert(random_int(0, $base ** $length), 10, $base);
    $rand = str_pad($rand, $length, '0', STR_PAD_LEFT);

    return "$time$split$rand";
}

$base = @$argv[1] ?? 36;
$base = min(36, max(2, intval($base)));
$split = @$argv[2] ?? '.';
$long = @$argv[3] ?? false;

echo variableUniqueId($long, $split, $base), PHP_EOL;
