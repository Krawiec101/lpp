<?php
declare(strict_types=1);

namespace Lpp\Tests\Service\Brand;

use Lpp\Entity\Brand;
use Lpp\Service\Order\AlphabeticalOrder;
use PHPUnit\Framework\TestCase;

class AlphabeticalOrderTest extends TestCase
{
    public function testGetResultForCollectionId(): void
    {
        $brands = [
            new Brand("C","Description", []),
            new Brand("B","Description", []),
            new Brand("A","Description", [])
        ];
        $resultsOrder = new AlphabeticalOrder();
        $results = $resultsOrder->reorder($brands);
        $this->assertSame($results[0]->getBrand(), "A");
        $this->assertSame($results[1]->getBrand(), "B");
        $this->assertSame($results[2]->getBrand(), "C");
    }
}