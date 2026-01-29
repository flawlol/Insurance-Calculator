<?php

declare(strict_types=1);

namespace Alfa\Interview\Entity\Type;

use Alfa\Interview\Interface\InsuranceTypeInterface;

final readonly class FlatInsurance implements InsuranceTypeInterface
{
    private const int OFFER_VALUE = 100;

    public function getOfferValue(): int
    {
        return self::OFFER_VALUE;
    }
}
