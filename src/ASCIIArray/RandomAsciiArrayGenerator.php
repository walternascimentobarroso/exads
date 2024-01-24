<?php

namespace App\ASCIIArray;

/**
 * Class RandomAsciiArrayGenerator
 */
class RandomAsciiArrayGenerator
{
    /**
     * Generate a random ASCII array
     *
     * @param string $startChar
     * @param string $endChar
     * @return array
     */
    public function generateRandomAsciiArray($startChar, $endChar)
    {
        $asciiArray = range(ord($startChar), ord($endChar));
        return array_map('chr', $asciiArray);
    }

    /**
     * Remove a random element from the array
     *
     * @param array $array
     * @return mixed
     */
    public function removeRandomElement(&$array)
    {
        $index = array_rand($array);
        $removedElement = $array[$index];
        unset($array[$index]);
        $array = array_values($array); // Reindex the array after removal
        return $removedElement;
    }

    /**
     * Determine the missing character
     *
     * @param array $array
     * @param string $startChar
     * @param string $endChar
     * @return string|null
     */
    public function determineMissingCharacter($array, $startChar, $endChar)
    {
        $allChars = range(ord($startChar), ord($endChar));
        $missingChar = array_diff($allChars, array_map('ord', $array));
        return empty($missingChar) ? null : chr(reset($missingChar));
    }

    /**
     * Main function
     */
    public function main()
    {
        $startChar = ',';
        $endChar = '|';

        // Generate a random ASCII array
        $randomArray = $this->generateRandomAsciiArray($startChar, $endChar);
        echo "Generated Array: " . implode(', ', $randomArray) . PHP_EOL;

        // Remove a random element from the array
        $this->removeRandomElement($randomArray);
        echo "Removed Element" . PHP_EOL;
        echo "Print New Array: " . implode(', ', $randomArray) . PHP_EOL;

        // Determine the missing character
        $missingCharacter = $this->determineMissingCharacter($randomArray, $startChar, $endChar);
        echo "Missing Character: " . ($missingCharacter ?? "None") . PHP_EOL;
    }
}
