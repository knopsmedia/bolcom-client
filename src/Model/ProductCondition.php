<?php declare(strict_types=1);

namespace Knops\BolcomClient\Model;

final class ProductCondition
{
    public const IS_NEW = 'nieuw';
    public const AS_NEW = 'als nieuw';
    public const USED_GOOD = 'goed';
    public const USED_TOLERABLE = 'redelijk';
    public const USED_MODERATE = 'matig';

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
        $reflection = new \ReflectionClass(__CLASS__);

        return in_array($condition, self::getConditions(), true);
    }
}