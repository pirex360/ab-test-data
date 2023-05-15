<?php
require __DIR__ . '/vendor/autoload.php';

use App\ABTesting;


$abTesting = new ABTesting(3);  // promoId could be 1, 2 or 3

echo "Promotion[{$abTesting->promotionName}] Design Selected: {$abTesting->selectDesign()}" . PHP_EOL;


