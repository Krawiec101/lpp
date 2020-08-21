<?php
declare(strict_types=1);

namespace Lpp\Tests\Service\Data;

use Lpp\Service\Data\Json;
use PHPUnit\Framework\TestCase;

/**
 * @covers \Lpp\Service\DataService
 */
class DataServiceTest extends TestCase
{

    public function prepareDirectoryPath($file): string
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
        new Json($this->prepareDirectoryPath('not-existing-file'));
    }

    public function testGetJsonIncorrectFile(): void
    {
        $this->expectException(\ErrorException::class);
        new Json($this->prepareDirectoryPath('2.json'));
    }

    public function testGetJsonDecodeException(): void
    {
        $this->expectException(\JsonException::class);
        new Json($this->prepareDirectoryPath('3.json'));
    }

    public function testGetJsonFromExistingFile(): void
    {
        $dataService = new Json($this->prepareDirectoryPath('1.json'));
        $data = $dataService->getResultForCollectionId(1);
        $this->assertSame(
            ['id' => 1],
            $data
        );
    }
}