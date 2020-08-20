<?php
require_once('vendor/autoload.php');

use Lpp\Service\DataService;

$jsonFileLocation = "./data/1315475.json";
try {
    $dataService = new DataService();
    $jsonData = $dataService->getDataFromJsonFile($jsonFileLocation);
} catch (\Exception $exception) {
    echo $exception->getMessage();
}