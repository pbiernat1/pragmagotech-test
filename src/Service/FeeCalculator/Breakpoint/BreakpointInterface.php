<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint;

interface BreakpointInterface
{
    /**
     * @return array<int, int>
     */
    public function getBreakpoints(): array;
}
