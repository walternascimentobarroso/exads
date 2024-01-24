<?php

require __DIR__ . '/../vendor/autoload.php';

use App\ASCIIArray\RandomAsciiArrayGenerator;

$generator = new RandomAsciiArrayGenerator();
$generator->main();
