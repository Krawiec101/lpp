<?php
declare(strict_types=1);

namespace Lpp\Tests\Service;

use Lpp\Service\Data;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Lpp\Service\DataService
 */
class DataServiceTest extends TestCase
{

    public function prepareDirectoryPath(): string
    {
        $dirname = \dirname(__FILE__);
        return $dirname
            . DIRECTORY_SEPARATOR
            . 'JsonTestData'
            . DIRECTORY_SEPARATOR;
    }

    public function testGetJsonFileDoesNotExist(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $DataService = new Data($this->prepareDirectoryPath());
        $DataService->getDataFromJsonFile('not-existing-file');
    }

    public function testGetJsonIncorrectFile(): void
    {
        $this->expectException(\ErrorException::class);
        $DataService = new Data($this->prepareDirectoryPath());
        $DataService->getDataFromJsonFile('2.json');
    }

    public function testGetJsonDecodeException(): void
    {
        $this->expectException(\JsonException::class);
        $DataService = new Data($this->prepareDirectoryPath());
        $DataService->getDataFromJsonFile('3.json');
    }

    public function testGetJsonFromExistingFile(): void
    {
        $DataService = new Data($this->prepareDirectoryPath());
        $data = $DataService->getDataFromJsonFile('1.json');
        $this->assertSame(
            ['key' => 'value'],
            $data
        );
    }
}