<?php declare(strict_types=1);

namespace Knops\BolcomClient\Model;

interface ProductOfferInterface
{
    public function getReference(): string;

    /**
     * @param string $reference Max. 20 characters
     * @return $this
     */
    public function setReference(string $reference): self;

    public function getName(): string;

    /**
     * @param string $name Max. 250 characters.
     * @return $this
     */
    public function setName(string $name): self;

    public function getDescription(): string;

    /**
     * @param string $description Max. 10,000 characters.
     * @return $this
     */
    public function setDescription(string $description): self;

    public function getEanCode(): string;

    /**
     * @param string $eanCode Left padded with zeroes if length < 13.
     * @return $this
     */
    public function setEanCode(string $eanCode): self;

    public function getCondition(): string;

    /**
     * @param string $condition Must be a valid {@link ProductCondition} constant.
     *                          Defaults to {@link ProductCondition::IS_NEW}.
     * @return $this
     */
    public function setCondition(string $condition): self;

    public function getConditionComment(): string;

    public function setConditionComment(string $comment): self;

    public function getInventoryQuantity(): int;

    /**
     * @param int $quantity Max. 999
     * @return $this
     */
    public function setInventoryQuantity(int $quantity): self;

    public function getPrice(): float;

    /**
     * @param float $price Value between 1 and 9999.99
     * @return $this
     */
    public function setPrice(float $price): self;

    public function getDeliveryTime(): string;

    /**
     * @param string $deliveryTime Must be a valid {@link DeliveryTime} constant.
     * @return $this
     */
    public function setDeliveryTime(string $deliveryTime): self;

    public function getFulfillmentBy(): string;

    /**
     * @param string $fulfillmentBy Must be a valid {@link FulfillmentBy} constant.
     *                              Defaults to {@link FulfillmentBy::MERCHANT}.
     * @return $this
     */
    public function setFulfillmentBy(string $fulfillmentBy): self;

    public function isForSaleAfterUpload(): bool;

    public function setForSaleAfterUpload(bool $forSaleAfterUpload): self;
}