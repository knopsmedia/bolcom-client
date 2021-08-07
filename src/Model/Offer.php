<?php declare(strict_types=1);

namespace Knops\BolcomClient\Model;

final class Offer
{
    private string $id = '';
    private string $ean = '';
    private string $reference = '';
    private bool $onHoldByRetailer = false;
    private string $unknownProductTitle = '';
    private array $pricing = [];
    private ?Stock $stock = null;

    public static function fromObject(object $object)
    {
        $offer = new self();
        $offer->id = $object->offerId;
        $offer->ean = $object->ean;
    }
}