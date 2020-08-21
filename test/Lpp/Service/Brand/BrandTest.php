<?php
declare(strict_types = 1);

namespace Lpp\Tests\Service\Brand;

use Lpp\Service\Brand\Brand;
use Lpp\Service\Item\Item;
use Lpp\Service\Data\Json;

use PHPUnit\Framework\TestCase;

class BrandTest extends TestCase
{

    protected $dataService;
    protected $brandService;
    protected $itemService;

    public function setUp(): void
    {
        $this->dataService = $this->createMock(Json::class);
        $this->itemService = $this->createMock(Item::class);
        $this->brandService = new Brand($this->dataService, $this->itemService);
    }

    public function testGetResultForCollectionId(): void
    {
        $this->dataService
            ->expects($this->once())
            ->method('getResultForCollectionId')
            ->with('1')
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
        $returnedBrand = array_pop($returnedBrands);

        $this->assertSame('brand-name', $returnedBrand->getBrand());
        $this->assertSame('brand-description', $returnedBrand->getDescription());
    }
}