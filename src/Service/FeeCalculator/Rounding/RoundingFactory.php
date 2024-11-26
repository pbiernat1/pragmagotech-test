<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator\Rounding;

use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\OneYearLoanBreakpoint;

class RoundingFactory
{
    public static function create(): RoundingInterface
    {
        return new RoundUpToFive();
    }
}