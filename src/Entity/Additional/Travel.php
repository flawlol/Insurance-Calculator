<?php

declare(strict_types=1);

namespace Alfa\Interview\Entity\Additional;

use Alfa\Interview\Interface\AdditionalInterface;

final readonly class Travel implements AdditionalInterface
{
    private const int ADDITION_PRICE = 100;

    public function getAdditionPrice(): int
    {
        return self::ADDITION_PRICE;
    }
}
