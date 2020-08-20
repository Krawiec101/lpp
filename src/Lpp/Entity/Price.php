<?php

namespace Lpp\Entity;

/**
 * Represents a single price from a search result
 * related to a single item.
 */
class Price
{
    /**
     * Description text for the price
     *
     * @var string
     */
    public $description;

    /**
     * Price in euro
     *
     * @var int
     */
    public $priceInEuro;

    /**
     * Warehouse's arrival date (to)
     *
     * @var \DateTime
     */
    public $arrivalDate;

    /**
     * Due to date,
     * defining how long will the item be available for sale (i.e. in a collection)
     *
     * @var \DateTime
     */
    public $dueDate;

    /**
     * Price constructor.
     * @param string $description
     * @param int $priceInEuro
     * @param \DateTime $arrivalDate
     * @param \DateTime $dueDate
     */
    public function __construct(string $description, int $priceInEuro, \DateTime $arrivalDate, \DateTime $dueDate)
    {
        $this->description = $description;
        $this->priceInEuro = $priceInEuro;
        $this->arrivalDate = $arrivalDate;
        $this->dueDate = $dueDate;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return int
     */
    public function getPriceInEuro(): int
    {
        return $this->priceInEuro;
    }

    /**
     * @return \DateTime
     */
    public function getArrivalDate(): \DateTime
    {
        return $this->arrivalDate;
    }

    /**
     * @return \DateTime
     */
    public function getDueDate(): \DateTime
    {
        return $this->dueDate;
    }
}
