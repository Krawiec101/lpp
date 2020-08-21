<?php

namespace Lpp\Service\Order;

interface ResultsOrderInterface
{
    public function reorder(array $data): array;
}
