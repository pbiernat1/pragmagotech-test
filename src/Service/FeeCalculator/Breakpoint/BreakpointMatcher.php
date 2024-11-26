<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint;

class BreakpointMatcher
{
    private int $lowerValue = 0;

    private int $upperValue = 0;

    public static function create(array $breakpoints): BreakpointMatcher
    {
        return new static($breakpoints);
    }

    private function __construct(private array $breakpoints)
    {
    }

    public function calculate(float $loanAmount): void
    {
        foreach ($this->breakpoints as $amount => $fee) {
            if ($loanAmount <= $amount) {
                $this->upperValue = $amount;
                break;
            }
            $this->lowerValue = $amount;
        }
    }

    public function getLowerValue(): int
    {
        return $this->lowerValue;
    }

    public function getUpperValue(): int
    {
        return $this->upperValue;
    }
}
