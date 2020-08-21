<?php

namespace Lpp\Service\Brand;

/**
 * Represents the connection to a specific item store.
 * For the case study we will pretend we have only one item store to make things easier.
 *
 */

use Lpp\Entity\Item;
use Lpp\Entity\Price;
use Lpp\Entity\Brand as BrandEntity;
use Lpp\Service\Data;

class Brand implements BrandInterface
{
    public $dataService;

    public function __construct(Data $data)
    {
        $this->dataService = $data;
    }

    public function getResultForCollectionId(int $collectionId): array
    {
        $brands = [];
        $jsonFile = $collectionId . ".json";
        $collection = $this->dataService->getDataFromJsonFile($jsonFile);
        foreach ($collection["brands"] as $brand) {
            $items = $this->getItems($brand["items"]);
            $brands[] = new BrandEntity($brand["name"], $brand["description"], $items);
        }
        return $brands;
    }

    protected function getItems(array $rawData): array
    {
        $items = [];
        foreach ($rawData as $row) {
            $prices = [];
            foreach ($row["prices"] as $price) {
                $prices[] = new Price($price['description'], $price['priceInEuro'], new \DateTime($price['arrival']), new \DateTime($price['due']));
            }

            if (!$this->validateUrl($row["url"])) {
                throw new \InvalidArgumentException(
                    "url is invalid"
                );
            }
            $items[] = new Item($row["name"], $row["url"], $prices);
        }
        return $items;
    }

    protected function validateUrl(string $url): bool
    {
        return (filter_var($url, FILTER_VALIDATE_URL) !== false);
    }
}