<?php

namespace Lpp\Service\Data;

interface DataInterface
{
    public function getResultForCollectionId(int $collectionId): array;

    public function getResultForBrandId(int $brandId): array;

    public function getResultForItemId(int $itemId): array;
}
