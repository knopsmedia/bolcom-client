<?php

namespace Knops\BolcomClient\Model;

final class BundlePrice
{
    public function __construct(
        private float $unitPrice,
        private int $quantity = 1,
    ) {}

    public function getUnitPrice(): float
    {
        return $this->unitPrice;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }
}