<?php

declare(strict_types=1);

namespace PragmaGoTech\Interview\Service\FeeCalculator\Breakpoint;

class OneYearLoanBreakpoints implements BreakpointInterface
{
    public function getBreakpoints(): array
    {
        return [
            1000 => 50,
            2000 => 90,
            3000 => 90,
            4000 => 115,
            5000 => 100,
            6000 => 120,
            7000 => 140,
            8000 => 160,
            9000 => 180,
            10000 => 200,
            11000 => 220,
            12000 => 240,
            13000 => 260,
            14000 => 280,
            15000 => 300,
            16000 => 320,
            17000 => 340,
            18000 => 360,
            19000 => 380,
            20000 => 400
        ];
    }
}
