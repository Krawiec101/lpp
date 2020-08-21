<?php

namespace Lpp\Entity;

/**
 * Represents a single item from a search result.
 */
class Item
{
    /**
     * Name of the item
     * @var string
     */
    public $name;

    /**
     * Url of the item's page
     * @var string
     */
    public $url;

    /**
     * Unsorted list of prices received from the
     * actual search query.
     * @var \Lpp\Entity\Price[]
     */
    public $prices = [];

    /**
     * Item constructor.
     * @param string $name
     * @param string $url
     * @param \Lpp\Entity\Price[] $prices
     */
    public function __construct(string $name, string $url, array $prices)
    {
        $this->name = $name;
        $this->url = $url;
        $this->prices = $prices;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @return Price[]
     */
    public function getPrices(): array
    {
        return $this->prices;
    }
}
