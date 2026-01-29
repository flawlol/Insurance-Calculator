<?php

declare(strict_types=1);

namespace Alfa\Interview\Entity;

use Alfa\Interview\Interface\AdditionalInterface;
use Alfa\Interview\Interface\InsuranceTypeInterface;

final readonly class Offer
{
    public function __construct(
        private InsuranceTypeInterface $insuranceType,
        /** @var AdditionalInterface[] $additionals*/
        private array $additionals = []
    ) {}

    /**
     * @return AdditionalInterface[]
     */
    public function getAdditionals(): array
    {
        return $this->additionals;
    }

    public function getInsuranceType(): InsuranceTypeInterface
    {
        return $this->insuranceType;
    }
}
