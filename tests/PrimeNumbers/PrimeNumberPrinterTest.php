<?php

use PHPUnit\Framework\TestCase;
use App\PrimeNumbers\PrimeNumberPrinter;

class PrimeNumberPrinterTest extends TestCase
{
    /**
     * @var PrimeNumberPrinter
     */
    private $printer;

    protected function setUp(): void
    {
        $this->printer = new PrimeNumberPrinter();
    }

    public function testPrimeNumber(): void
    {
        // Test for a prime number
        $this->assertEquals('2 [PRIME]' . PHP_EOL, $this->printer->primeNumber(2));

        // Test for a non-prime number
        $this->assertEquals('4 ([2])' . PHP_EOL, $this->printer->primeNumber(4));

        // Test for a prime number greater than 10
        $this->assertEquals('13 [PRIME]' . PHP_EOL, $this->printer->primeNumber(13));
    }

    public function testFindMultiples(): void
    {
        // Test finding multiples for a prime number
        $this->assertEquals([], $this->printer->findMultiples(7));

        // Test finding multiples for a non-prime number
        $this->assertEquals([2, 4, 8], $this->printer->findMultiples(16));
    }
}
