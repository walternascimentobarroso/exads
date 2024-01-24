<?php

require __DIR__ . '/../vendor/autoload.php';

use App\ABTesting\AB;

$promoId = 1;
$abTest = new AB($promoId);
echo $abTest->redirect() . PHP_EOL;
