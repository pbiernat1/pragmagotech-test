<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointFactory;

class FeeCalculatorBaseAlgorithmTest extends TestCase
{
    private const ONE_YEAR  = 12;
    private const TWO_YEARS = 24;

    public function testForHighestOneYearBreakpoint()
    {
        $breakpoint = BreakpointFactory::create(static::ONE_YEAR);
        $calc = FeeCalculatorBaseAlgorithm::create($breakpoint);

        $fee = $calc->calculate(20000);

        $this->assertSame((float)400, $fee);
    }

    public function testForHighestTwoYearsBreakpoint()
    {
        $breakpoint = BreakpointFactory::create(static::TWO_YEARS);
        $calc = FeeCalculatorBaseAlgorithm::create($breakpoint);

        $fee = $calc->calculate(20000);

        $this->assertSame((float)800, $fee);
    }

    public function testSuccessfullyCalculations()
    {
        $breakpoint1 = BreakpointFactory::create(static::ONE_YEAR);
        $calc1 = FeeCalculatorBaseAlgorithm::create($breakpoint1);

        $breakpoint2 = BreakpointFactory::create(static::TWO_YEARS);
        $calc2 = FeeCalculatorBaseAlgorithm::create($breakpoint2);

        $fee1 = $calc1->calculate(19250);
        $fee2 = $calc2->calculate(11500);

        $this->assertSame((float)385, $fee1);
        $this->assertSame((float)460, $fee2);
    }
}
