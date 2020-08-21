<?php

namespace Lpp\Service;

use Lpp\Service\Brand\Brand;

class Collection
{
    protected $brandService;

    public function __construct(Brand $brandService)
    {
        $this->brandService = $brandService;
    }

    public function getBrandsForCollection(int $id): array
    {
        return $this->brandService->getResultForCollectionId($id);
    }
}
