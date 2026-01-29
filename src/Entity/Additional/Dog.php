<?php

declare(strict_types=1);

namespace Alfa\Interview\Entity\Additional;

use Alfa\Interview\Interface\AdditionalInterface;

final readonly class Dog implements AdditionalInterface
{
    private const int ADDITION_PRICE = 50;

    public function getAdditionPrice(): int
    {
        return self::ADDITION_PRICE;
    }
}
