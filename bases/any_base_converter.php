<?php

class AnyBaseConverter
{
    private int $base;

    public function __construct(private readonly string $alphabet = '0123456789abcdefghijklmnopqrstuvwxyz')
    {
        $this->base = mb_strlen($this->alphabet, 'UTF-8');
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
            throw new Exception("$number passed to base $this->alphabet. Please pass a number over 0 and under $this->base.");

	return mb_substr($this->alphabet, $number, 1, 'UTF-8');
    }

    public function convert(int $original_number): string
    {
        if ($original_number < 0)
            return '';
        else if ($original_number < $this->base)
            return $this->indexFromAlphabet($original_number);

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
