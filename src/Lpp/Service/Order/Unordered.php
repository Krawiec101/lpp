<?php

namespace Lpp\Service\Order;

class Unordered implements ResultsOrderInterface
{
    public function reorder(array $data): array
    {
        return $data;
    }
}
