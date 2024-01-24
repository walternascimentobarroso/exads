<?php

namespace App\PrimeNumbers;

/**
 * Class PrimeNumberPrinter
 */
class PrimeNumberPrinter
{
    /**
     * Print prime numbers
     * @param int $value
     * @return string
     */
    public function primeNumber($value)
    {
        $multiples = $this->findMultiples($value);
        $values = (!empty($multiples))
            ? ' ([' . implode(', ', $multiples) . '])'
            : ' [PRIME]';

        return $value . $values . PHP_EOL;
    }

    /**
     * Find multiples of a number
     * @param int $number
     * @return array
     */
    public function findMultiples($number)
    {
        $multiples = [];

        for ($j = 2; $j < $number; $j++) {
            if ($number % $j == 0) {
                $multiples[] = $j;
            }
        }

        return $multiples;
    }

    /**
     * Main function
     */
    public function main()
    {
        for ($i = 1; $i <= 100; $i++) {
            echo $this->primeNumber($i);
        }
    }
}
