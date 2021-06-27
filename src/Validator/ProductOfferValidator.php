<?php declare(strict_types=1);

namespace Knops\BolcomClient\Validator;

use Knops\BolcomClient\Model\ProductOfferInterface;

final class ProductOfferValidator implements ProductOfferValidatorInterface
{
    public function validate(ProductOfferInterface $offer): array
    {
        $errors = [];

        if (!$offer->getEanCode()) {
            $errors[] = 'EAN is a mandatory field';
        }

        if (!$offer->getCondition()) {
            $errors[] = 'Condition is a mandatory field';
        }

        // if ($offer->getCondition() !== ProductCondition::IS_NEW
        //     && $offer->getConditionComment() === '') {
        //     $errors[] = sprintf('Condition comment is mandatory when condition is "%s"', $offer->getCondition());
        // }

        // if ($offer->getFulfillmentBy() === FulfillmentBy::MERCHANT
        //     && $offer->getInventoryQuantity() === null) {
        //     $errors[] = 'When fulfillment is done by the merchant, your offer must include an inventory quantity';
        // }

        if (!$offer->getPrice()) {
            $errors[] = 'Price is a mandatory field';
        }

        if (!$offer->getFulfillmentBy()) {
            $errors[] = 'FulfillmentBy is a mandatory field';
        }

        return $errors;
    }

    public function isValid(ProductOfferInterface $offer): bool
    {
        // no errors found
        return [] === $this->validate($offer);
    }
}