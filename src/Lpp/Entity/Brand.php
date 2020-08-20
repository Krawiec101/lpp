<?php

namespace Lpp\Entity;

/**
 * Represents a single brand in the result.
 *
 */
class Brand
{
    /**
     * Name of the brand
     *
     * @var string
     */
    public $brand;

    /**
     * Brand's description
     *
     * @var string
     */
    public $description;

    /**
     * Unsorted list of items with their corresponding prices.
     *
     * @var \Lpp\Entity\Item[]
     */
    public $items = [];

    /**
     * Brand constructor.
     * @param string $brand
     * @param string $description
     * @param \Lpp\Entity\Irice[] $items
     */
    public function __construct(string $brand, string $description, array $items)
    {
        $this->brand = $brand;
        $this->description = $description;
        $this->items = $items;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return Item[]
     */
    public function getItems(): array
    {
        return $this->items;
    }
}
