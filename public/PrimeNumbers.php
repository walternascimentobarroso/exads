<?php

require __DIR__ . '/../vendor/autoload.php';

use App\PrimeNumbers\PrimeNumberPrinter;

$printer = new PrimeNumberPrinter();
$printer->main();
