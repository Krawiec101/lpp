<?php
require_once('vendor/autoload.php');

use Lpp\Service\Data;
use Lpp\Service\Brand\Brand;
use Lpp\Service\Validator\Url;

try {
    $urlValidator = new Url();
    $dataService = new Data("./data");
    $brandService = new Brand($dataService, $urlValidator);
    $brandData = $brandService->getResultForCollectionId(1315475);
} catch (\Exception $exception) {
    echo $exception->getMessage();
}