<?php
declare(strict_types=1);

namespace Lpp\Tests\Service\Validator;

use Lpp\Service\Validator\Url;
use PHPUnit\Framework\TestCase;

class UrlTest extends TestCase
{

    public function testGetJsonFromExistingFile(): void
    {
        $urlValidator = new Url();
        $data = $urlValidator->validate('http://www.anotherexample.com');
        $this->assertSame(
            true,
            $data
        );
    }

    public function testGetJsonFromExistingFile1(): void
    {
        $urlValidator = new Url();
        $data = $urlValidator->validate('anotherexample');
        $this->assertSame(
            false,
            $data
        );
    }
}
