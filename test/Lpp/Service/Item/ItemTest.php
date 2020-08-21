<?php
declare(strict_types=1);

namespace Lpp\Tests\Service\Brand;

use Lpp\Service\Item\Item;
use Lpp\Service\Data\Json;
use Lpp\Service\Validator\Url;

use PHPUnit\Framework\TestCase;

class ItemTest extends TestCase
{
    protected $dataService;
    protected $urlValidator;
    protected $itemService;

    public function setUp(): void
    {
        $this->dataService = $this->createMock(Json::class);
        $this->urlValidator = $this->createMock(Url::class);
        $this->itemService = new Item($this->dataService, $this->urlValidator);
    }

    public function testGetResultForCollectionId(): void
    {
        $this->urlValidator
            ->expects($this->once())
            ->method('validate')
            ->with('https://www.valid-url.com/')
            ->willReturn(true);

        $this->dataService
            ->expects($this->once())
            ->method('getResultForBrandId')
            ->with('1')
            ->willReturn(
                [
                    'name' => 'brand-name',
                    'description' => 'brand-description',
                    'items' => [
                        [
                            'name' => 'item-name',
                            'url' => 'https://www.valid-url.com/',
                            'prices' => [
                                [
                                    'description' => 'price',
                                    'priceInEuro' => 123,
                                    'arrival' => '2019-10-14',
                                    'due' => '2019-11-14'
                                ]
                            ]
                        ]
                    ]
                ]
            );

        $items = $this->itemService->getResultForBrandId(1);
        $item = array_pop($items);

        $this->assertSame('item-name', $item->getName());
        $this->assertSame('https://www.valid-url.com/', $item->getUrl());

        $prices = $item->getPrices();
        $price = array_pop($prices);

        $this->assertSame('price', $price->getDescription());
        $this->assertSame(123, $price->getPriceInEuro());
        $this->assertEquals(new \DateTime('2019-10-14'), $price->getArrivalDate()
        );
        $this->assertEquals(new \DateTime('2019-11-14'), $price->getDueDate()
        );

    }
}