<?php declare(strict_types=1);

namespace Knops\BolcomClient\Model;

use Webmozart\Assert\Assert;

final class ProductOffer implements ProductOfferInterface
{
    private string $reference = '';
    private string $name = '';
    private string $description = '';
    private string $eanCode = '';
    private string $condition = ProductCondition::IS_NEW;
    private string $conditionComment = '';
    private int $inventoryQuantity = 0;
    private float $price = .0;
    private string $fulfillmentBy = FulfillmentBy::MERCHANT;
    private string $deliveryTime = '';
    private bool $forSaleAfterUpload = false;

    public function __construct(string $eanCode, int $inventoryQuantity, float $price, string $deliveryTime,
                                string $condition = ProductCondition::IS_NEW,
                                string $fulfillmentBy = FulfillmentBy::MERCHANT)
    {
        $this->setPrice($price);
        $this->setEanCode($eanCode);
        $this->setCondition($condition);
        $this->setDeliveryTime($deliveryTime);
        $this->setFulfillmentBy($fulfillmentBy);
        $this->setInventoryQuantity($inventoryQuantity);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): ProductOfferInterface
    {
        Assert::maxLength($name, 250);
        $this->name = $name;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): ProductOfferInterface
    {
        Assert::maxLength($description, 10000);
        $this->description = $description;

        return $this;
    }

    public function getReference(): string
    {
        return $this->reference;
    }

    public function setReference(string $reference): ProductOfferInterface
    {
        Assert::maxLength($reference, 20);
        $this->reference = $reference;

        return $this;
    }

    public function getEanCode(): string
    {
        return $this->eanCode;
    }

    public function setEanCode(string $eanCode): ProductOfferInterface
    {
        Assert::notEmpty($eanCode);
        Assert::maxLength($eanCode, 13);
        $this->eanCode = str_pad($eanCode, 13, '0', STR_PAD_LEFT);

        return $this;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    public function setCondition(string $condition): ProductOfferInterface
    {
        Assert::true(ProductCondition::isValid($condition));
        $this->condition = $condition;

        return $this;
    }

    public function getConditionComment(): string
    {
        return $this->conditionComment;
    }

    public function setConditionComment(string $comment): ProductOfferInterface
    {
        Assert::maxLength($comment, 2000);
        $this->conditionComment = $comment;

        return $this;
    }

    public function getInventoryQuantity(): int
    {
        return $this->inventoryQuantity;
    }

    public function setInventoryQuantity(int $quantity): ProductOfferInterface
    {
        Assert::lessThanEq($quantity, 999);
        $this->inventoryQuantity = $quantity;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): ProductOfferInterface
    {
        Assert::greaterThanEq($price, 1.0);
        Assert::lessThanEq($price, 9999.99);
        $this->price = $price;

        return $this;
    }

    public function getFulfillmentBy(): string
    {
        return $this->fulfillmentBy;
    }

    public function setFulfillmentBy(string $fulfillmentBy): ProductOfferInterface
    {
        Assert::true(FulfillmentBy::isValid($fulfillmentBy));
        $this->fulfillmentBy = $fulfillmentBy;

        return $this;
    }

    public function getDeliveryTime(): string
    {
        return $this->deliveryTime;
    }

    public function setDeliveryTime(string $deliveryTime): ProductOfferInterface
    {
        Assert::true(DeliveryTime::isValid($deliveryTime));
        $this->deliveryTime = $deliveryTime;

        return $this;
    }

    public function isForSaleAfterUpload(): bool
    {
        return $this->forSaleAfterUpload;
    }

    public function setForSaleAfterUpload(bool $forSaleAfterUpload): ProductOfferInterface
    {
        $this->forSaleAfterUpload = $forSaleAfterUpload;

        return $this;
    }
}