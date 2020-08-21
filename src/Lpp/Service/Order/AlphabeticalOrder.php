<?php

namespace Lpp\Service\Order;

class AlphabeticalOrder implements ResultsOrderInterface
{
    public function reorder(array $data): array
    {
        $brands = [];
        foreach ($data as $brand) {
            $brands[$brand->getBrand()] = $brand;
        }
        ksort($brands);
        return array_values($brands);
    }
}
