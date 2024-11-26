<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator\Rounding;

interface RoundingInterface
{
    public function round(float $amount): float;
}
