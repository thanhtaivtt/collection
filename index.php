<?php

use Thanhtaivtt\Collection\Collection;

require_once "vendor/autoload.php";

$collection = new Collection([1, 2, 3 => [5 => 6], 4, 5, 6, 6, 6, 6, 'T' => [6]]);

echo $collection;