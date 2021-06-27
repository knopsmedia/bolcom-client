<?php declare(strict_types=1);

namespace Knops\BolcomClient\Model;

final class DeliveryTime
{
    public const TIME_24HOURS_CUTOFF_12 = '24uurs-12';
    public const TIME_24HOURS_CUTOFF_13 = '24uurs-13';
    public const TIME_24HOURS_CUTOFF_14 = '24uurs-14';
    public const TIME_24HOURS_CUTOFF_15 = '24uurs-15';
    public const TIME_24HOURS_CUTOFF_16 = '24uurs-16';
    public const TIME_24HOURS_CUTOFF_17 = '24uurs-17';
    public const TIME_24HOURS_CUTOFF_18 = '24uurs-18';
    public const TIME_24HOURS_CUTOFF_19 = '24uurs-19';
    public const TIME_24HOURS_CUTOFF_20 = '24uurs-20';
    public const TIME_24HOURS_CUTOFF_21 = '24uurs-21';
    public const TIME_24HOURS_CUTOFF_22 = '24uurs-22';
    public const TIME_24HOURS_CUTOFF_23 = '24uurs-23';
    public const TIME_1_2DAYS = '1-2 werkdagen';
    public const TIME_2_3DAYS = '2-3 werkdagen';
    public const TIME_3_5DAYS = '3-5 werkdagen';
    public const TIME_4_8DAYS = '4-8 werkdagen';
    public const TIME_1_8DAYS = '1-8 werkdagen';
    public const TIME_DELIVERY_PROMISE = 'MijnLeverbeloftee';

    private function __construct()
    {
    }

    public static function getTimes(): array
    {
        $reflection = new \ReflectionClass(__CLASS__);

        return $reflection->getConstants();
    }

    public static function isValid(string $code): bool
    {
        return in_array($code, self::getTimes(), true);
    }
}