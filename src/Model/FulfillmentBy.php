<?php declare(strict_types=1);

namespace Knops\BolcomClient\Model;

final class FulfillmentBy
{
    public const BOL = 'Lvb';
    public const MERCHANT = 'verkoper';

    private function __construct()
    {
    }

    public static function isValid(string $fulfilment): bool
    {
        $reflection = new \ReflectionClass(__CLASS__);

        return in_array($fulfilment, $reflection->getConstants());
    }
}