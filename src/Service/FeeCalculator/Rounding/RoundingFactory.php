<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator\Rounding;

use PragmaGoTech\Interview\Interface\RoundingInterface;

class RoundingFactory
{
    public static function create(): RoundingInterface
    {
        return new RoundUpToFive();
    }
}