<?php
require_once('vendor/autoload.php');

use Lpp\Service\Data\Json;
use Lpp\Service\Brand\Brand;
use Lpp\Service\Item\Item;
use Lpp\Service\Validator\Url;

try {
    $urlValidator = new Url();
    $dataService = new Json("./data/1315475.json");
    $itemService = new Item($dataService, $urlValidator);
    $brandService = new Brand($dataService, $itemService);
    $brandData = $brandService->getResultForCollectionId(1315475);
} catch (\Exception $exception) {
    echo $exception->getMessage();
}