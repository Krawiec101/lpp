<?php
require_once('vendor/autoload.php');

use Lpp\Service\Data\JsonFactory;
use Lpp\Service\Brand\Brand;
use Lpp\Service\Item\Item;
use Lpp\Service\Validator\Url;
use Lpp\Service\Collection;

try {
    $collectionId = 1315475;
    $dataServiceFactory = new JsonFactory("./data");
    $dataService = $dataServiceFactory->createDataSourceForCollectionId($collectionId);
    $urlValidator = new Url();
    $itemService = new Item($dataService, $urlValidator);
    $brandService = new Brand($dataService, $itemService);
    $collection = new Collection($brandService);
    $collection->getBrandsForCollection($collectionId);
} catch (\Exception $exception) {
    echo $exception->getMessage();
}