<?php

declare(strict_types=1);

require_once __DIR__ . '/vendor/autoload.php';

use Alfa\Interview\Entity\Additional\Dog;
use Alfa\Interview\Entity\Additional\Travel;
use Alfa\Interview\Entity\Offer;
use Alfa\Interview\Entity\Type\FlatCasco;
use Alfa\Interview\Entity\Type\FlatInsurance;
use Alfa\Interview\Interface\AdditionalInterface;
use Alfa\Interview\Service\InsuranceCalculator;

/** @var AdditionalInterface[] $additionals */
$additionals = [
    new Dog(),
    new Travel(),
];

$insurance = new FlatInsurance();
$insurance = new FlatCasco();

/**
 * Fejlesztői megjegyzés:
 * Felmerült, hogy mi van akkor ha egy olyan tömböt adunk át, amiben nem AdditionalInterface-t
 * megvalósító objektumok vannak.
 *
 * Jelenleg a PHPSTAN megfogja ezt a hibát, de futásidőben nincs ellenőrzés.
 *
 * Meglehetne valósítani validatorral, de nem volt célom "nem létező problémákat" megoldani (jelenleg) :D
 *
 * Tesztelés: "make" parancs futtatása vagy vendor/bin/phpstan analyse src run.php --level=9, kikommentelés után
 */
//$additionals = [
//    123,
//];

$offer = new Offer(
    $insurance,
    $additionals
);

$calculator = new InsuranceCalculator($offer);

echo $calculator->calculate() . PHP_EOL;
