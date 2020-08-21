<?php

namespace Lpp\Service\Brand;

/**
 * Represents the connection to a specific item store.
 * For the case study we will pretend we have only one item store to make things easier.
 *
 */

use Lpp\Entity\Brand as BrandEntity;
use Lpp\Service\Data\DataInterface;
use Lpp\Service\Item\ItemInterface;


class Brand implements BrandInterface
{
    protected $dataService;
    protected $urlValidator;
    protected $itemService;

    public function __construct(DataInterface $data, ItemInterface $itemService)
    {
        $this->dataService = $data;
        $this->itemService = $itemService;
    }

    public function getResultForCollectionId(int $collectionId): array
    {
        $brands = [];
        $collection = $this->dataService->getResultForCollectionId($collectionId);
        foreach ($collection["brands"] as $id => $brand) {
            $items = $this->itemService->getResultForBrandId($id);
            $brands[] = new BrandEntity($brand["name"], $brand["description"], $items);
        }
        return $brands;
    }

}
