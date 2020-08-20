<?php
declare(strict_types=1);

namespace Lpp\Tests\Service;

use Lpp\Service\DataService;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Lpp\Service\DataService
 */
class DataServiceTest extends TestCase
{

    public function prepareFilePath(string $file): string
    {
        $dirname = \dirname(__FILE__);
        return $dirname
            . DIRECTORY_SEPARATOR
            . 'JsonTestData'
            . DIRECTORY_SEPARATOR
            . $file;
    }

    public function testGetJsonFileDoesNotExist(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $DataService = new DataService();
        $DataService->getDataFromJsonFile('not-existing-file');
    }

    public function testGetJsonIncorrectFile(): void
    {
        $this->expectException(\ErrorException::class);
        $DataService = new DataService();
        $filename = $this->prepareFilePath('2.json');
        $DataService->getDataFromJsonFile($filename);
    }

    public function testGetJsonDecodeException(): void
    {
        $this->expectException(\JsonException::class);
        $DataService = new DataService();
        $filename = $this->prepareFilePath('3.json');
        $DataService->getDataFromJsonFile($filename);
    }

    public function testGetJsonFromExistingFile(): void
    {
        $DataService = new DataService();

        $filename = $this->prepareFilePath('1.json');
        $data = $DataService->getDataFromJsonFile($filename);
        $this->assertSame(
            ['key' => 'value'],
            $data
        );
    }
}