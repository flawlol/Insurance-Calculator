<?php

declare(strict_types=1);

namespace Alfa\Interview\Tests\Unit\Service;

use Alfa\Interview\Entity\Additional\Dog;
use Alfa\Interview\Entity\Offer;
use Alfa\Interview\Entity\Type\FlatInsurance;
use Alfa\Interview\Service\InsuranceCalculator;
use PHPUnit\Framework\TestCase;

final class InsuranceCalculatorIntegrationTest extends TestCase
{
    public function testCalculateWithRealEntities(): void
    {
        // GIVEN
        $flatInsurance = new FlatInsurance();
        $dog = new Dog();
        $offer = new Offer($flatInsurance, [$dog]);
        $calculator = new InsuranceCalculator($offer);

        // WHEN
        $result = $calculator->calculate();

        // THEN
        $total = $dog->getAdditionPrice() + $flatInsurance->getOfferValue();
        $this->assertEquals($total, $result);
    }

    public function testCalculateWithFlatInsuranceOnly(): void
    {
        // GIVEN
        $flatInsurance = new FlatInsurance();
        $offer = new Offer($flatInsurance, []);
        $calculator = new InsuranceCalculator($offer);

        // WHEN
        $result = $calculator->calculate();

        // THEN
        $this->assertEquals($flatInsurance->getOfferValue(), $result);
    }
}
