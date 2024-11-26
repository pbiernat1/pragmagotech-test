<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint;

class BreakpointFactory
{
    private const ONE_YEAR = 12;

    private const TWO_YEARS = 24;

    public static function create(int $term): ?BreakpointInterface
    {
        switch ($term) {
            case static::ONE_YEAR:
                return new OneYearLoanBreakpoints();
                break;
            case static::TWO_YEARS:
                return new TwoYearsLoanBreakpoints();
                break;
        }

        return null;
    }
}
