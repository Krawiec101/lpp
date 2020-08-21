<?php

namespace Lpp\Service\Item;

/**
 * Represents the connection to a specific item store.
 * For the case study we will pretend we have only one item store to make things easier.
 *
 */

use Lpp\Entity\Item as ItemEntity;
use Lpp\Entity\Price;
use Lpp\Service\Data\DataInterface;
use Lpp\Service\Validator\Url;

class Item implements ItemInterface
{
    protected $data;
    protected $urlValidator;

    public function __construct(DataInterface $data, Url $url)
    {
        $this->data = $data;
        $this->urlValidator = $url;
    }

    public function getResultForBrandId(int $brandId): array
    {
        return $items = $this->getItems($this->data->getResultForBrandId($brandId)["items"]);
    }

    protected function getItems(array $rawData): array
    {
        $items = [];
        foreach ($rawData as $row) {
            $prices = [];
            foreach ($row["prices"] as $price) {
                $arrivalDate = new \DateTime($price['arrival']);
                $dueDate = new \DateTime($price['due']);
                $prices[] = new Price($price['description'], $price['priceInEuro'], $arrivalDate, $dueDate);
            }

            if (!$this->urlValidator->validate($row["url"])) {
                throw new \InvalidArgumentException(
                    "url is invalid"
                );
            }
            $items[] = new ItemEntity($row["name"], $row["url"], $prices);
        }
        return $items;
    }
}
