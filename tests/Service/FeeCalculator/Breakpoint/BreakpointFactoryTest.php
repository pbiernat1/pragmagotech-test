<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Test;

use PHPUnit\Framework\TestCase;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointFactory;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\OneYearLoanBreakpoints;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\TwoYearsLoanBreakpoints;

class BreakpointFactoryTest extends TestCase
{
    public function testReturnNullOnInvalidBreakpointSelected()
    {
        $breakpointObject = BreakpointFactory::create(48);

        $this->assertNull($breakpointObject);
    }

    public function testOneYearBreakpointSelected()
    {
        $breakpointObject = BreakpointFactory::create(12);

        $this->assertEquals(OneYearLoanBreakpoints::class, get_class($breakpointObject));
    }

    public function testTwoYearsBreakpointSelected()
    {
        $breakpointObject = BreakpointFactory::create(24);

        $this->assertEquals(TwoYearsLoanBreakpoints::class, get_class($breakpointObject));
    }
}
