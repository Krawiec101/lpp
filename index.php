<?php
require_once('vendor/autoload.php');

use Lpp\Service\Data;
use Lpp\Service\Brand\Brand;

try {
    $dataService = new Data("./data");
    $brandService = new Brand($dataService);
    $brandData = $brandService->getResultForCollectionId(1315475);
} catch (\Exception $exception) {
    echo $exception->getMessage();
}