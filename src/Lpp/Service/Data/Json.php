<?php
declare(strict_types=1);

namespace Lpp\Service\Data;

class Json implements DataInterface
{
    private $data = [];

    public function __construct(string $file)
    {
        $this->data = $this->getDataFromJsonFile($file);
    }

    public function getResultForCollectionId(int $collectionId): array
    {
        if ((int)$this->data['id'] !== $collectionId) {
            return [];
        }
        return $this->data;
    }

    public function getResultForBrandId(int $brandId): array
    {
        return $this->data["brands"][$brandId];
    }

    public function getResultForItemId(int $itemId): array
    {
        $item = [];
        foreach ($this->data['brands'] as $brand) {
            if (!is_null($brand['items'][$itemId])) {
                $item = $brand['items'][$itemId];
                break;
            }
        }
        return $item;
    }

    protected function getDataFromJsonFile(string $file): array
    {
        $json = $this->getDataFromFile($file);
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
