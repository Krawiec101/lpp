<?php
declare(strict_types = 1);

namespace Lpp\Tests\Service\Brand;

use Lpp\Service\Brand\Brand;
use Lpp\Service\Data;
use Lpp\Service\Validator\Url;

use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{

    protected $dataService;
    protected $brandService;
    protected $urlValidator;

    public function setUp(): void
    {
        $this->dataService = $this->createMock(Data::class);
        $this->urlValidator = $this->createMock(Url::class);
        $this->brandService = new Brand($this->dataService, $this->urlValidator);
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
            ->method('getDataFromJsonFile')
            ->with('1.json')
            ->willReturn(
                [
                    'brands' => [
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
                    ]
                ]
            );



        $returnedBrands = $this->brandService->getResultForCollectionId(1);
        $returnedBrand = \array_pop($returnedBrands);

        $this->assertSame('brand-name', $returnedBrand->getBrand());
        $this->assertSame('brand-description', $returnedBrand->getDescription());

        $items = $returnedBrand->getItems();
        $item = \array_pop($items);

        $this->assertSame('item-name', $item->getName());
        $this->assertSame('https://www.valid-url.com/', $item->getUrl());

        $prices = $item->getPrices();
        $price = \array_pop($prices);

        $this->assertSame('price', $price->getDescription());
        $this->assertSame(123, $price->getPriceInEuro());
        $this->assertEquals(new \DateTime('2019-10-14'), $price->getArrivalDate()
        );
        $this->assertEquals(new \DateTime('2019-11-14'), $price->getDueDate()
        );
    }
}