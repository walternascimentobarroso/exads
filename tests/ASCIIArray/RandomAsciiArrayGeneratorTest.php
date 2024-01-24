<?php

use PHPUnit\Framework\TestCase;
use App\ASCIIArray\RandomAsciiArrayGenerator;

class RandomAsciiArrayGeneratorTest extends TestCase
{
    /**
     * @var RandomAsciiArrayGenerator
     */
    private $generator;

    protected function setUp(): void
    {
        $this->generator = new RandomAsciiArrayGenerator();
    }

    public function testGenerateRandomAsciiArray(): void
    {
        $startChar = ',';
        $endChar = '|';

        $result = $this->generator->generateRandomAsciiArray($startChar, $endChar);

        $this->assertIsArray($result);
        $this->assertNotEmpty($result);

        foreach ($result as $char) {
            $this->assertGreaterThanOrEqual(ord($startChar), ord($char));
            $this->assertLessThanOrEqual(ord($endChar), ord($char));
        }
    }

    public function testRemoveRandomElement(): void
    {
        $array = ['a', 'b', 'c', 'd'];

        $removedElement = $this->generator->removeRandomElement($array);

        $this->assertContains($removedElement, ['a', 'b', 'c', 'd']);
        $this->assertNotContains($removedElement, $array);
        $this->assertCount(3, $array);
    }

    public function testDetermineMissingCharacter(): void
    {
        $array = ['a', 'c', 'd'];

        $missingCharacter = $this->generator->determineMissingCharacter($array, 'a', 'd');

        $this->assertEquals('b', $missingCharacter);
    }
}
