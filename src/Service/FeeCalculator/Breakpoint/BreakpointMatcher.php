<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint;

class BreakpointMatcher
{
    private int $lowerValue = 0;

    private int $upperValue = 0;

    public static function create(BreakpointInterface $generator): self
    {
        return new self($generator->getBreakpoints());
    }

    /**
     * @param array<int, int> $breakpoints
     */
    private function __construct(private array $breakpoints)
    {
    }

    public function getForAmount(float $loanAmount): void
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
