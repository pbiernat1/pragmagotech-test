<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Test;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointFactory;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\OneYearLoanBreakpoints;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\TwoYearsLoanBreakpoints;

class BreakpointFactoryTest extends TestCase
{
    private const ONE_YEAR   = 12;
    private const TWO_YEARS  = 24;
    private const FOUR_YEARS = 48;

    public function testReturnNullOnInvalidBreakpointSelected()
    {
        $breakpointObject = BreakpointFactory::create(static::FOUR_YEARS);

        $this->assertNull($breakpointObject);
    }

    public function testOneYearBreakpointSelected()
    {
        $breakpointObject = BreakpointFactory::create(static::ONE_YEAR);

        $this->assertEquals(OneYearLoanBreakpoints::class, get_class($breakpointObject));
    }

    public function testTwoYearsBreakpointSelected()
    {
        $breakpointObject = BreakpointFactory::create(static::TWO_YEARS);

        $this->assertEquals(TwoYearsLoanBreakpoints::class, get_class($breakpointObject));
    }
}
