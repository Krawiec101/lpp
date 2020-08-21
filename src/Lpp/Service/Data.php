<?php
declare(strict_types=1);

namespace Lpp\Service;

class Data
{
    private $fileDirectory;

    public function __construct(string $fileDirectory)
    {
        $this->fileDirectory = $fileDirectory;
    }

    public function getDataFromJsonFile(string $file): array
    {
        $filePath = $this->fileDirectory . "/" . $file;
        $json = $this->getDataFromFile($filePath);
        $data = $this->convertJsonToArray($json);
        $this->checkOutput($data);
        return $data;
    }

    protected function getDataFromFile($filePath)
    {
        if (!file_exists($filePath)) {
            throw new \InvalidArgumentException("File doesn't exist.");
        }

        return file_get_contents($filePath);
    }

    protected function convertJsonToArray($json)
    {
        if (!$json) {
            throw new \ErrorException("Unable to get data from json file.");
        }

        return json_decode($json, true, 512, \JSON_THROW_ON_ERROR);

    }

    protected function checkOutput($data)
    {
        if (!is_array($data)) {
            throw new \ErrorException(
                "Returned value must be an array."
            );
        }
    }
}
