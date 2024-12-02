<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator;

use PragmaGoTech\Interview\Interface\RoundingInterface;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointInterface;
use PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint\BreakpointMatcher;
use PragmaGoTech\Interview\Service\FeeCalculator\Rounding\RoundingFactory;

class FeeCalculatorBaseAlgorithm implements FeeCalculatorAlgorithmInterface
{
    private BreakpointMatcher $matcher;

    private RoundingInterface $rounding;

    private function __construct(private BreakpointInterface $breakpoint)
    {
        $this->matcher = BreakpointMatcher::create($breakpoint);
        $this->rounding = RoundingFactory::create(); // at this moment we have only RoundUpToFive class
    }

    public static function create(BreakpointInterface $breakpointGenerator): self
    {
        return new self($breakpointGenerator);
    }

    public function calculate(float $loanAmount): float
    {
        $this->matcher->getForAmount($loanAmount);

        $breakpoints = $this->breakpoint->getBreakpoints();
        $lowerBreakpoint = $this->matcher->getLowerValue();
        $upperBreakpoint = $this->matcher->getUpperValue();

        if ($loanAmount == $upperBreakpoint) {
            return $breakpoints[$upperBreakpoint];
        }

        $lowerFee = $breakpoints[$lowerBreakpoint];
        $upperFee = $breakpoints[$upperBreakpoint];

        $fee = $lowerFee + (($loanAmount - $lowerBreakpoint) / ($upperBreakpoint - $lowerBreakpoint)) * ($upperFee - $lowerFee);

        $totalAmount = $loanAmount + $fee;
        $roundedAmount = $this->rounding->round($totalAmount);

        return $roundedAmount - $loanAmount;
    }
}
