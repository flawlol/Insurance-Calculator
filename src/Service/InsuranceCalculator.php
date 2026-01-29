<?php

declare(strict_types=1);

namespace Alfa\Interview\Service;

use Alfa\Interview\Entity\Offer;

final readonly class InsuranceCalculator
{
    public function __construct(
        private Offer $offer,
    ) {}

    public function calculate(): int
    {
        $total = $this->offer->getInsuranceType()
            ->getOfferValue();

        $additionals = $this->offer->getAdditionals();

        if (empty($additionals)) {
            return $total;
        }

        foreach ($additionals as $additional) {
            $total += $additional->getAdditionPrice();
        }

        return $total;
    }
}
