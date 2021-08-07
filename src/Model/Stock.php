<?php

namespace Knops\BolcomClient\Model;

final class Stock
{
    public function __construct(
        private int $amount,
        private int $correctedStock,
        private bool $managedByRetailer,
    ) {}

    public function getAmount(): int
    {
        return $this->amount;
    }

    public function getCorrectedStock(): int
    {
        return $this->correctedStock;
    }

    public function isManagedByRetailer(): bool
    {
        return $this->managedByRetailer;
    }
}