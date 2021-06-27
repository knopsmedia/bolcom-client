<?php declare(strict_types=1);

namespace Knops\BolcomClient\Validator;

use Knops\BolcomClient\Model\ProductOfferInterface;

interface ProductOfferValidatorInterface
{
    public function validate(ProductOfferInterface $offer): array;

    public function isValid(ProductOfferInterface $offer): bool;
}