<?php

namespace Knops\BolcomClient\Service;

final class OfferApi
{
    public function __construct(
        private RetailerClient $retailerClient,
    ) {}

    public function updatePrice(string $offerId, float $unitPrice): void
    {
        $response = $this->retailerClient->request('PUT', sprintf('/offers/%s/price', $offerId), [
            'pricing' => [
                'bundlePrices' => [
                    [
                        'quantity' => 1,
                        'unitPrice' => $unitPrice,
                    ],
                ],
            ],
        ]);

        if ($response->getStatusCode() !== 202) throw new \Exception('Failed to update price for offer ' . $offerId);
    }

    public function updateStock(string $offerId, int $amount, bool $managedByRetailer = true): void
    {
        $response = $this->retailerClient->request('PUT', sprintf('/offers/%s/stock', $offerId), compact(
            'amount',
            'managedByRetailer'
        ));

        if ($response->getStatusCode() !== 202) throw new \Exception('Failed to update stock for offer ' . $offerId);
    }
}