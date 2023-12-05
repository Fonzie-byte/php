<?php

class AnyBaseConverter
{
    private int $base;

    public function __construct(private readonly string $alphabet = '0123456789abcdefghijklmnopqrstuvwxyz')
    {
        $this->base = strlen($this->alphabet);
    }

    private function divisionWithRemainder(float $dividend, float $divisor): array
    {
        $division = floor($dividend / $divisor);
        $remainder = $dividend % $divisor;
        
        return [$division, $remainder];
    }

    private function indexFromAlphabet(int $number): string
    {
        if ($number < 0 || $number >= $this->base)
            throw new Exception("$number passed to a $this->alphabet characters long alphabet. Please pass a number over 0 and under $this->base.");

        return $this->alphabet[$number];
    }

    public function convert(int $original_number): string
    {
        if ($original_number < 0)
            return '';
        else if ($original_number === 0)
            return $this->alphabet[0];

        $result = '';
        $current_number = $original_number;

        while ($current_number > 0)
        {
            [$current_number, $remainder] = $this->divisionWithRemainder($current_number, $this->base);
            $result = $this->indexFromAlphabet($remainder, $this->alphabet) . $result;
        }

        return $result;
    }
}
