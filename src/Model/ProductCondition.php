<?php declare(strict_types=1);

namespace Knops\BolcomClient\Model;

final class ProductCondition
{
    public const NEW = 'NEW';
    public const AS_NEW = 'AS_NEW';
    public const USED_GOOD = 'GOOD';
    public const USED_REASONABLE = 'REASONABLE';
    public const USED_MODERATE = 'MODERATE';

    private function __construct()
    {
    }

    public static function getConditions(): array
    {
        $reflection = new \ReflectionClass(__CLASS__);

        return $reflection->getConstants();
    }

    public static function isValid(string $condition): bool
    {
        return in_array($condition, self::getConditions(), true);
    }
}