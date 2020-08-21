<?php

namespace Lpp\Service\Item;

/**
 * Represents the connection to a specific item store.
 * For the case study we will pretend we have only one item store to make things easier.
 *
 */
interface ItemInterface
{
    /**
     * This method should read from a datasource (JSON for case study)
     * and should return an unsorted list of brands found in the datasource.
     *
     * @param int $brandId
     *
     * @return Lpp\Entity\Item[]
     */
    public function getResultForBrandId(int $brandId): array;
}
