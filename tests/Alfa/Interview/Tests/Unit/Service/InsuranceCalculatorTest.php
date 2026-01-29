<?php

declare(strict_types=1);

namespace Alfa\Interview\Tests\Unit\Service;

use Alfa\Interview\Entity\Additional\Dog;
use Alfa\Interview\Entity\Additional\Travel;
use Alfa\Interview\Entity\Offer;
use Alfa\Interview\Entity\Type\FlatCasco;
use Alfa\Interview\Entity\Type\FlatInsurance;
use Alfa\Interview\Interface\AdditionalInterface;
use Alfa\Interview\Interface\InsuranceTypeInterface;
use Alfa\Interview\Service\InsuranceCalculator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class InsuranceCalculatorTest extends TestCase
{
    #[DataProvider('insuranceDataProvider')]
    public function testCalculateReturnsCorrectTotal(int $basePrice, array $addonPrices, int $expectedTotal): void
    {
        $offer = $this->createMock(Offer::class);
        $insuranceType = $this->createMock(InsuranceTypeInterface::class);

        // GIVEN
        $offer
            ->expects($this->once())
            ->method('getInsuranceType')
            ->willReturn($insuranceType);

        $insuranceType
            ->expects($this->once())
            ->method('getOfferValue')
            ->willReturn($basePrice);

        $addons = [];

        foreach ($addonPrices as $price) {
            $addon = $this->createMock(AdditionalInterface::class);
            $addon->expects($this->once())
                ->method('getAdditionPrice')
                ->willReturn($price);
            $addons[] = $addon;
        }

        $offer
            ->expects($this->once())
            ->method('getAdditionals')->willReturn($addons);

        $calculator = new InsuranceCalculator($offer);

        // WHEN
        $result = $calculator->calculate();

        // THEN
        $this->assertEquals($expectedTotal, $result);
    }

    public static function insuranceDataProvider(): array
    {
        $flatInsuranceOfferValue = (new FlatInsurance())->getOfferValue();
        $flatCascoOfferValue = (new FlatCasco())->getOfferValue();
        $dogValue = (new Dog())->getAdditionPrice();
        $travelValue = (new Travel())->getAdditionPrice();

        return [
            'Flat insurance without addons' => [
                $flatInsuranceOfferValue,
                [],
                $flatInsuranceOfferValue,
            ],
            'Flat insurance with dog and travel addons' => [
                $flatInsuranceOfferValue,
                [$dogValue, $travelValue],
                $flatInsuranceOfferValue + $dogValue + $travelValue,
            ],
            'Casco without addons' => [
                $flatCascoOfferValue,
                [],
                $flatCascoOfferValue,
            ],
            'Casco with dog addon' => [
                $flatCascoOfferValue,
                [$dogValue],
                $flatCascoOfferValue + $dogValue,
            ],
            'Edge case: Zero base price with addons' => [
                0,
                [$travelValue],
                $travelValue,
            ],
            'Edge case: Zero base price without addons' => [
                0,
                [],
                0,
            ],
        ];
    }
}
