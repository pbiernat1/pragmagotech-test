<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Test;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointFactory;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointMatcher;

class BreakpointMatcherTest extends TestCase
{
    private const ONE_YEAR = 12;
    private const TWO_YEARS = 24;

    private const VALUE_BELOW_RANGE = 10;
    private const VALUE_OVER_RANGE = 100000;
    private const VALUE_BETWEEN_RANGE = 10000;

    public function testValueBelowRangeForOneYearLoanBreakpoints()
    {
        $breakpoints = BreakpointFactory::create(static::ONE_YEAR)
            ->getBreakpoints();

        $breakpointsMatcher = BreakpointMatcher::create($breakpoints);
        $breakpointsMatcher->calculate(static::VALUE_BELOW_RANGE);

        $this->assertEquals(0, $breakpointsMatcher->getLowerValue());
        $this->assertEquals(1000, $breakpointsMatcher->getUpperValue());
    }

    public function testValueOverRangeForOneYearLoanBreakpoints()
    {
        $breakpoints = BreakpointFactory::create(static::ONE_YEAR)
            ->getBreakpoints();

        $breakpointsMatcher = BreakpointMatcher::create($breakpoints);
        $breakpointsMatcher->calculate(static::VALUE_OVER_RANGE);

        $this->assertEquals(20000, $breakpointsMatcher->getLowerValue());
        $this->assertEquals(0, $breakpointsMatcher->getUpperValue());
    }

    public function testMatchedValueForOneYearLoanBreakpoints()
    {
        $breakpoints = BreakpointFactory::create(static::ONE_YEAR)
            ->getBreakpoints();

        $breakpointsMatcher = BreakpointMatcher::create($breakpoints);
        $breakpointsMatcher->calculate(static::VALUE_BETWEEN_RANGE);

        $this->assertEquals(9000, $breakpointsMatcher->getLowerValue());
        $this->assertEquals(10000, $breakpointsMatcher->getUpperValue());
    }

    public function testValueBelowRangeForTwoYearsLoanBreakpoints()
    {
        $breakpoints = BreakpointFactory::create(static::ONE_YEAR)
            ->getBreakpoints();

        $breakpointsMatcher = BreakpointMatcher::create($breakpoints);
        $breakpointsMatcher->calculate(static::VALUE_BELOW_RANGE);

        $this->assertEquals(0, $breakpointsMatcher->getLowerValue());
        $this->assertEquals(1000, $breakpointsMatcher->getUpperValue());
    }

    public function testValueOverRangeForTwoYearLoanBreakpoints()
    {
        $breakpoints = BreakpointFactory::create(static::TWO_YEARS)
            ->getBreakpoints();

        $breakpointsMatcher = BreakpointMatcher::create($breakpoints);
        $breakpointsMatcher->calculate(static::VALUE_OVER_RANGE);

        $this->assertEquals(20000, $breakpointsMatcher->getLowerValue());
        $this->assertEquals(0, $breakpointsMatcher->getUpperValue());
    }

    public function testMatchedValueForTwoYearsLoanBreakpoints()
    {
        $breakpoints = BreakpointFactory::create(static::ONE_YEAR)
            ->getBreakpoints();

        $breakpointsMatcher = BreakpointMatcher::create($breakpoints);
        $breakpointsMatcher->calculate(static::VALUE_BETWEEN_RANGE);

        $this->assertEquals(9000, $breakpointsMatcher->getLowerValue());
        $this->assertEquals(10000, $breakpointsMatcher->getUpperValue());
    }
}
