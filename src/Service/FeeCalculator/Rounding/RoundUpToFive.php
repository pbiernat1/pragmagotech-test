<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator\Rounding;

use PragmaGoTech\Interview\Interface\RoundingInterface;

class RoundUpToFive implements RoundingInterface
{
    public function round(float $amount): float
    {
        return ceil($amount / 5) * 5;
    }
}
