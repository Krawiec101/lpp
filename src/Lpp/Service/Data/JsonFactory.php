<?php
declare(strict_types=1);

namespace Lpp\Service\Data;

class JsonFactory
{
    protected $directory;

    public function __construct($directory)
    {
        $this->directory = $directory;
    }

    public function createDataSourceForCollectionId(int $id): Json
    {
        return new Json("{$this->directory}/{$id}.json");
    }
}
